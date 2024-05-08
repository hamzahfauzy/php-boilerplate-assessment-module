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
        'organization_id' => [
            'label' => __('organization.label.organization'),
            'type' => 'options-obj:organizations,id,name'
        ],
        'position_id' => [
            'label' => __('organization.label.position'),
            'type' => 'options-obj:organization_positions,id,name'
        ],
        'name' => [
            'label' => __('assessment.label.name'),
            'type' => 'text'
        ],
    ],
    'assessment_questions' => [
        'category_id' => [
            'label' => __('assessment.label.category'),
            'type' => 'options-obj:assessment_categories,id,name'
        ],
        'instrument_id' => [
            'label' => __('assessment.label.instrument'),
            'type' => 'options-obj:assessment_instruments,id,name'
        ],
        'description' => [
            'label' => __('assessment.label.description'),
            'type' => 'textarea'
        ],
    ],
    'assessment_evaluations' => [
        'user_id' => [
            'label' => __('assessment.label.user'),
            'type' => 'options-obj:users,id,name'
        ],
        'evaluator_id' => [
            'label' => __('assessment.label.evaluator'),
            'type' => 'options-obj:users,id,name'
        ],
        'file' => [
            'label' => __('assessment.label.file'),
            'type' => 'file'
        ],
        'notes' => [
            'label' => __('assessment.label.notes'),
            'type' => 'textarea'
        ],
    ],
];