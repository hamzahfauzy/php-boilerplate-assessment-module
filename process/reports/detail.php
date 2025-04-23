<?php

use Core\Database;
use Core\Page;
use Core\Response;

$db = new Database();
$user_id = (get_role(auth()->id)->id != 1) ? auth()->id : $_GET['user_id'];

$period_id = $_GET['period_id'];
$instrument_id = $_GET['instrument_id'];

$user = $db->single('users', ['id' => $user_id]);
$organization_user = $db->single('organization_users', ['user_id' => $user_id]);
$user->organization = $db->single('organizations', ['id' => $organization_user?->organization_id]);
$user->profile = $db->single('assessment_profiles',[
    'user_id' => $user_id
]);

$records = $db->all('assessment_records', [
    'period_id' => $period_id,
    'instrument_id' => $instrument_id,
    'user_id' => $user_id
]);

$db->query = "SELECT assessment_comments.*, commenter.name as commenter_name FROM assessment_comments JOIN users commenter ON commenter.id = assessment_comments.commenter_id WHERE assessment_comments.period_id = $period_id AND assessment_comments.instrument_id=$instrument_id AND assessment_comments.user_id=$user_id";

$comments = $db->exec('all');

$finalReport = [];
$assessmentStatusFinal = false;

foreach($records as $data)
{
    if(!$assessmentStatusFinal && $data->status == 'FINAL')
    {
        $assessmentStatusFinal = true;
    }

    $data->assessor = $db->single('users', ['id' => $data->assessor_id]);
    $organization_user = $db->single('organization_users', ['user_id' => $data->assessor_id]);
    $data->assessor->organization = $db->single('organizations', ['id' => $organization_user?->organization_id]);
    $data->assessor->profile = $db->single('assessment_profiles',[
        'user_id' => $data->assessor_id
    ]);
    $data->instrument = $db->single('assessment_instruments', ['id' => $data->instrument_id]);
    if($data->questions)
    {
        $data->questions = json_decode($data->questions);
        $data->questions = end($data->questions);
    }
}

// question categories
$db->query = "SELECT * FROM assessment_categories WHERE id IN (SELECT category_id FROM assessment_questions WHERE instrument_id = $instrument_id GROUP BY category_id)";
$categories = $db->exec('all');
foreach($categories as $category)
{
    $questions = $db->all('assessment_questions', ['instrument_id' => $instrument_id, 'category_id' => $category->id]);
    $finalReport[$category->id] = 0;
    foreach($questions as $question)
    {
        foreach($records as $data)
        {
            $finalReport[$category->id] += $data->questions?->questions?->{$question->id};
        }
    }
}

$weights = [];

foreach($finalReport as $category => $value)
{
    $questions = $db->exists('assessment_questions', ['instrument_id' => $instrument_id, 'category_id' => $category]);
    $v = ceil(($value/$questions)/count($records));
    $weight = $db->single('assessment_weights', [
        'min' => ['<=', $v],
        'max' => ['>=', $v],
    ]);
    $finalReport[$category] = $v;
    $weights[$category] = $weight->name;
}

$avg = array_sum($finalReport) / count($categories);
$weight = $db->single('assessment_weights', [
    'min' => ['<=', $avg],
    'max' => ['>=', $avg],
]);

Page::setTitle("Assesment Report Detail");
Page::setModuleName("Report");
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'title' => 'Assessment Report',
        'url' => routeTo('assessment/reports')
    ],
    [
        'title' => 'Assessment Report Detail',
    ]
]);

$data = [
    'user' => $user,
    'records' => $records,
    'categories' => $categories,
    'finalReport' => $finalReport,
    'weights' => $weights,
    'avg_weight' => $weight->name,
    'comments' => $comments,
    'isFinal' => $assessmentStatusFinal
];

return view('assessment/views/reports/detail', $data);