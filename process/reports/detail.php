<?php

use Core\Database;
use Core\Page;

$db = new Database();
$user_id = (get_role(auth()->id)->id != 1) ? auth()->id : $_GET['user_id'];

$period_id = $_GET['period_id'];
$instrument_id = $_GET['instrument_id'];

$user = $db->single('users', ['id' => $user_id]);
$organization_user = $db->single('organization_users', ['user_id' => $user_id]);
$user->organization = $db->single('organizations', ['id' => $organization_user->organization_id]);

$records = $db->all('assessment_records', [
    'period_id' => $period_id,
    'instrument_id' => $instrument_id,
    'user_id' => $user_id
]);

$finalReport = [];

foreach($records as $data)
{
    $data->assessor = $db->single('users', ['id' => $data->assessor_id]);
    $organization_user = $db->single('organization_users', ['user_id' => $data->assessor_id]);
    $data->assessor->organization = $db->single('organizations', ['id' => $organization_user->organization_id]);
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

foreach($finalReport as $category => $value)
{
    $questions = $db->exists('assessment_questions', ['instrument_id' => $instrument_id, 'category_id' => $category]);
    $finalReport[$category] = ceil(($value/$questions)/count($records));
}

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

return view('assessment/views/reports/detail', [
    'user' => $user,
    'records' => $records,
    'categories' => $categories,
    'finalReport' => $finalReport,
]);