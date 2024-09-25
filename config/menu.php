<?php 

$menu = [
    [
        'label' => 'assessment.menu.periods',
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-calendar-plus',
        'route' => routeTo('crud/index',['table'=>'assessment_periods']),
        'activeState' => 'assessment.assessment_periods'
    ],
    [
        'label' => 'assessment.menu.categories',
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-stream',
        'route' => routeTo('crud/index',['table'=>'assessment_categories']),
        'activeState' => 'assessment.assessment_categories'
    ],
    [
        'label' => 'assessment.menu.weights',
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-cubes',
        'route' => routeTo('crud/index',['table'=>'assessment_weights']),
        'activeState' => 'assessment.assessment_weights'
    ],
    [
        'label' => 'assessment.menu.instruments',
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-scroll',
        'route' => routeTo('crud/index',['table'=>'assessment_instruments']),
        'activeState' => 'assessment.assessment_instruments'
    ],
    [
        'label' => 'assessment.menu.assessments',
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-compact-disc',
        'activeState' => ['assessment.assessment_records','assessment.reports'],
        'items' => [
            [
                'label' => 'assessment.menu.records',
                'route' => routeTo('crud/index',['table'=>'assessment_records']),
                'activeState' => 'assessment.assessment_records',
            ],
            [
                'label' => 'assessment.menu.reports',
                'route' => routeTo('assessment/reports'),
                'activeState' => 'assessment.reports',
            ]
        ]
    ],
    [
        'label' => 'assessment.menu.evaluation_reports',
        'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-clipboard',
        'activeState' => 'assessment.assessment_evaluations',
        'route' => routeTo('crud/index',['table'=>'assessment_evaluations']),
    ],
];

// if(get_role(auth()->id)->id == 1)
// {
//     $menu[4] = [
//         'label' => 'assessment.menu.assessments',
//         'icon'  => 'fa-fw fa-xl me-2 fa-solid fa-compact-disc',
//         'route' => routeTo('crud/index',['table'=>'assessment_records']),
//         'activeState' => ['assessment.assessment_records'],
//     ];
// }

return $menu;