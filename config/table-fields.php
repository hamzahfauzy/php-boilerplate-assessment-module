<?php 

return [
    'assessment_periods' => [
        'name' => [
            'label' => __('assessment.label.name'),
            'type' => 'text'
        ],
        'status' => [
            'label' => __('assessment.label.status'),
            'type' => 'options:ACTIVE|INACTIVE'
        ]
    ],
    'assessment_categories' => [
        'name' => [
            'label' => __('assessment.label.name'),
            'type' => 'text'
        ],
        'order_number' => [
            'label' => __('assessment.label.order_number'),
            'type' => 'number'
        ],
    ],
    'assessment_weights' => [
        'name' => [
            'label' => __('assessment.label.name'),
            'type' => 'text'
        ],
        'min' => [
            'label' => __('assessment.label.min'),
            'type' => 'number'
        ],
        'max' => [
            'label' => __('assessment.label.max'),
            'type' => 'number'
        ],
    ],
    'assessment_instruments' => [
        'name' => [
            'label' => __('assessment.label.name'),
            'type' => 'text'
        ],
    ],
    'assessment_questions' => [
        'instrument_id' => [
            'label' => __('assessment.label.instrument'),
            'type' => 'options-obj:assessment_instruments,id,name'
        ],
        'category_id' => [
            'label' => __('assessment.label.category'),
            'type' => 'options-obj:assessment_categories,id,name'
        ],
        'description' => [
            'label' => __('assessment.label.description'),
            'type' => 'textarea'
        ],
    ],
    'assessment_evaluations' => [
        'employee' => [
            'label' => __('assessment.label.employee'),
            'type' => 'text',
            'search' => 'emp.name'
        ],
        'evaluator' => [
            'label' => __('assessment.label.evaluator'),
            'type' => 'text',
            'search' => 'evl.name'
        ],
        'work_date' => [
            'label' => __('assessment.label.work_date'),
            'type' => 'date'
        ],
        'title' => [
            'label' => __('assessment.label.title'),
            'type' => 'text'
        ],
        'description' => [
            'label' => __('assessment.label.description'),
            'type' => 'textarea'
        ],
        'file' => [
            'label' => __('assessment.label.file'),
            'type' => 'file',
            'search' => false
        ],
        'notes' => [
            'label' => __('assessment.label.notes'),
            'type' => 'textarea'
        ],
    ],
    'assessment_records' => [
        'period_id' => [
            'label' => __('assessment.label.period'),
            'type' => 'options-obj:assessment_periods,id,name'
        ],
        'user_id' => [
            'label' => __('assessment.label.employee'),
            'type' => 'options-obj:users,id,name'
        ],
        'assessor_id' => [
            'label' => __('assessment.label.evaluator'),
            'type' => 'options-obj:users,id,name'
        ],
        'instrument_id' => [
            'label' => __('assessment.label.instrument'),
            'type' => 'options-obj:assessment_instruments,id,name'
        ],
        'record_type' => [
            'label' => __('assessment.label.record_type'),
            'type' => 'options:Pejabat|Atasan Pejabat'
        ],
    ],
];