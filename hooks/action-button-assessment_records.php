<?php
$user = auth();
$button = "";

if(is_allowed('assessment/do', $user->id))
{
    $button .= '<a href="'.routeTo('assessment/do',['id'=>$data->id]).'" class="btn btn-sm btn-info">'.__('assessment.label.do_assessment').'</a>';
}

return $button;