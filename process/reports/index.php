<?php

use Core\Database;
use Core\Page;

$db = new Database();

$for_user = "";

$user_id = auth()->id;

if(get_role(auth()->id)->id != 1)
{
    $for_user = "WHERE assessment_records.user_id = $user_id AND assessment_records.status <> 'DRAFT'";
}


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
$for_user
GROUP BY assessment_records.period_id, 
    assessment_records.user_id, 
    assessment_records.instrument_id, 
    instrument_name,
    period_name";

$records = $db->exec('all');

Page::setTitle("Assesment Report");
Page::setModuleName("Report");
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'title' => 'Assessment Report'
    ]
]);

return view('assessment/views/reports/index', [
    'records' => $records
]);