<?php

use Core\Database;

\Modules\Default\Libraries\Sdk\Dashboard::add('dashboardStatistic');

function dashboardStatistic()
{
    $db = new Database;

    $data = [];
    $data['periode'] = $db->exists('assessment_periods');
    $data['kategori'] = $db->exists('assessment_categories');
    $data['instrumen'] = $db->exists('assessment_instruments');
    $data['penilaian'] = $db->exists('assessment_records');
    $data['laporan'] = $db->exists('assessment_evaluations');


    return view('assessment/views/dashboard/statistic', compact('data'));
}