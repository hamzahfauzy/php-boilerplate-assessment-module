<?php 

return [
    [
        'label' => 'assessment.menu.periods',
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-calendar-plus',
        'route' => routeTo('crud/index',['table'=>'assessment_periods']),
        'activeState' => 'assessment.periods'
    ],
    [
        'label' => 'assessment.menu.categories',
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-stream',
        'route' => routeTo('crud/index',['table'=>'assessment_categories']),
        'activeState' => 'assessment.categories'
    ],
    [
        'label' => 'assessment.menu.weights',
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-cubes',
        'route' => routeTo('crud/index',['table'=>'assessment_weights']),
        'activeState' => 'assessment.weights'
    ],
    [
        'label' => 'assessment.menu.instruments',
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-scroll',
        'route' => routeTo('crud/index',['table'=>'assessment_instruments']),
        'activeState' => 'assessment.instruments'
    ],
    [
        'label' => 'assessment.menu.records',
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-compact-disc',
        'route' => routeTo('crud/index',['table'=>'assessment_records']),
        'activeState' => 'assessment.records'
    ],
    [
        'label' => 'assessment.menu.evaluation_reports',
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-clipboard',
        'activeState' => 'assessment.report',
        'route' => routeTo('crud/index',['table'=>'assessment_evaluations']),
    ],
];