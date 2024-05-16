<?php
$user = auth();
$button = "";

if(is_allowed('assessment/detail', $user->id))
{
    $button .= '<a href="'.routeTo('assessment/detail',['id'=>$data->id]).'" class="btn btn-sm btn-info">'.__('assessment.label.detail').'</a>';
}

return $button;