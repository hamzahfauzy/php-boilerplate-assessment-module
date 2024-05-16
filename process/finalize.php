<?php

use Core\Database;

$db = new Database();
$id = $_GET['id'];
$data = $db->single('assessment_records', ['id' => $id]);

if($data->assessor_id != auth()->id)
{
    die('Error 403. Unauthorized');
}

$db->update('assessment_records', [
    'status' => 'FINAL'
], [
    'id' => $id
]);

set_flash_msg(['success'=>"Penilaian berhasil di tetapkan menjadi penilaian Final"]);

header('location:'.routeTo('assessment/detail',['id' => $data->id]));
die();