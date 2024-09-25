<?php

use Core\Database;

$db = new Database();
$user_id = auth()->id;

$db->query = "SELECT 
    assessment_records.period_id, 
    assessment_records.user_id, 
    assessment_records.instrument_id, 
    assessment_instruments.name instrument_name,
    assessment_periods.name period_name
FROM 
    assessment_records 
JOIN assessment_instruments ON assessment_instruments.id = assessment_records.instrument_id 
JOIN assessment_periods ON assessment_periods.id = assessment_records.period_id 
WHERE assessment_records.user_id = $user_id
GROUP BY assessment_records.period_id, 
    assessment_records.user_id, 
    assessment_records.instrument_id, 
    instrument_name,
    period_name";

$records = $db->exec('all');

return view('assessment/views/reports/index', [
    'records' => $records
]);