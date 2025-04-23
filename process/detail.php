<?php

use Core\Database;
use Core\Page;
use Core\Request;

$db = new Database;
$assessment_record_id = $_GET['id'];
$data = $db->single('assessment_records', ['id' => $assessment_record_id]);
$data->assessor = $db->single('users', ['id' => $data->assessor_id]);
$data->user = $db->single('users', ['id' => $data->user_id]);
$organization_user = $db->single('organization_users', ['user_id' => $data->user_id]);
$data->user->organization = $db->single('organizations', ['id' => $organization_user?->organization_id]);
$data->instrument = $db->single('assessment_instruments', ['id' => $data->instrument_id]);
if($data->questions)
{
    $data->questions = json_decode($data->questions);
    $data->questions = end($data->questions);
}

// $data->instrument->question_lists = $db->all('assessment_questions', ['instrument_id' => $data->instrument_id]);
$weights = $db->all('assessment_weights');

// question categories
$db->query = "SELECT * FROM assessment_categories WHERE id IN (SELECT category_id FROM assessment_questions WHERE instrument_id = $data->instrument_id GROUP BY category_id)";
$categories = $db->exec('all');
foreach($categories as $category)
{
    $category->questions = $db->all('assessment_questions', ['instrument_id' => $data->instrument_id, 'category_id' => $category->id]);
}

$db->query = "SELECT assessment_comments.*, commenter.name as commenter_name FROM assessment_comments JOIN users commenter ON commenter.id = assessment_comments.commenter_id WHERE assessment_comments.period_id = $data->period_id AND assessment_comments.instrument_id=$data->instrument_id AND assessment_comments.user_id=$data->user_id";

$comments = $db->exec('all');

$success_msg = get_flash_msg('success');

// page section
$title = _ucwords(__("assessment.label.detail"));
Page::setActive("assessment.detail");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'title' => 'Assessment Detail'
    ]
]);

return view('assessment/views/detail', compact('success_msg','data','weights','categories','comments'));