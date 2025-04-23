<?php

use Core\Database;
use Core\Page;
use Core\Request;

$db = new Database;
$assessment_record_id = $_GET['id'];
$data = $db->single('assessment_records', ['id' => $assessment_record_id]);
$data->user = $db->single('users', ['id' => $data->user_id]);
$organization_user = $db->single('organization_users', ['user_id' => $data->user_id]);
$data->user->organization = $db->single('organizations', ['id' => $organization_user?->organization_id]);
$data->instrument = $db->single('assessment_instruments', ['id' => $data->instrument_id]);
// $data->instrument->question_lists = $db->all('assessment_questions', ['instrument_id' => $data->instrument_id]);
$weights = $db->all('assessment_weights');

// question categories
$db->query = "SELECT * FROM assessment_categories WHERE id IN (SELECT category_id FROM assessment_questions WHERE instrument_id = $data->instrument_id GROUP BY category_id)";
$categories = $db->exec('all');
foreach($categories as $category)
{
    $category->questions = $db->all('assessment_questions', ['instrument_id' => $data->instrument_id, 'category_id' => $category->id]);
}

$success_msg = get_flash_msg('success');
$error_msg   = get_flash_msg('error');

if(Request::isMethod('POST'))
{
    if($data->assessor_id != auth()->id)
    {
        die('Error 403. Unauthorized');
    }

    $questions = $data->questions ? json_decode($data->questions) : [];
    $questions[] = [
        'questions' => $_POST['question'],
        'datetime' => date('Y-m-d H:i:s')
    ];
    
    $db->update('assessment_records', [
        'questions' => json_encode($questions),
    ], [
        'id' => $data->id
    ]);

    set_flash_msg(['success'=>"Penilaian berhasil disimpan"]);

    header('location:'.routeTo('assessment/detail',['id' => $data->id]));
    die();
}

// page section
$title = _ucwords(__("assessment.label.assessment"));
Page::setActive("assessment.assessment");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'title' => 'Assessment'
    ]
]);

return view('assessment/views/do', compact('success_msg','error_msg','data','weights','categories'));