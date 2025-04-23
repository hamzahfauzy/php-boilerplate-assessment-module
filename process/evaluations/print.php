<?php

use Core\Database;
use Core\Response;

$db = new Database;
$db->query = "SELECT 
                assessment_evaluations.*,
                emp.name employee,
                evl.name evaluator
                FROM assessment_evaluations 
                LEFT JOIN users AS emp ON emp.id = assessment_evaluations.user_id
                LEFT JOIN users AS evl ON evl.id = assessment_evaluations.evaluator_id
                LEFT JOIN media ON media.id = assessment_evaluations.media_id 
                WHERE assessment_evaluations.work_date BETWEEN '$_GET[date_from]' AND '$_GET[date_end]'";
$data = $db->exec('all');


return view('assessment/views/evaluations/print', compact('data'));