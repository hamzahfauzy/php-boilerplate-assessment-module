<?php
$user = auth();
$button = "";

if(is_allowed('assessment/evaluations', $user->id))
{
    $button .= '<a href="'.routeTo('assessment/evaluations',['id'=>$data->id]).'" class="btn btn-sm btn-info">'.__('assessment.label.do_evaluation').'</a>';
}

return $button;