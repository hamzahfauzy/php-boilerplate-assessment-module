<?php

$roles = get_roles(auth()->id);
$roleIds = [];
foreach($roles as $role)
{
    $roleIds[] = $role->role_id;
}

if(!in_array(1, $roleIds) && !in_array(env('EVALUATOR_ROLE_ID'), $roleIds))
{
    unset($fields['user_id']);
}

$fields['created_at'] = [
    'type' => 'datetime-local',
    'label' => __('assessment.label.created_at'),
    'search' => false
];

return $fields;