<?php

return '
<a href="'.routeTo('crud/index',['table'=>'assessment_questions','filter'=>['instrument_id' => $data->id]]).'" class="btn btn-sm btn-info">'.__('assessment.label.questions').'</a>
';