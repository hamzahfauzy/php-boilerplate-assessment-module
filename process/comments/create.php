<?php

use Core\Database;
use Core\Page;

$db = new Database();

$db->insert('assessment_comments',[
    'user_id' => $_POST['user_id'],
    'period_id' => $_POST['period_id'],
    'instrument_id' => $_POST['instrument_id'],
    'commenter_id' => auth()->id,
    'description' => $_POST['description'],
]);

set_flash_msg(['success'=> 'Tanggapan berhasil disimpan']);

if($_POST['user_id'] == auth()->id)
{
    header('location: '.routeTo('assessment/reports/detail',[
        'user_id' => $_POST['user_id'],
        'period_id' => $_POST['period_id'],
        'instrument_id' => $_POST['instrument_id'],
    ]));
}
else
{
    $detail = $db->single('assessment_records', [
        'user_id' => $_POST['user_id'],
        'period_id' => $_POST['period_id'],
        'instrument_id' => $_POST['instrument_id'],
        'assessor_id' => auth()->id
    ]);

    header('location: '.routeTo('assessment/detail',['id' => $detail->id]));
}
die();