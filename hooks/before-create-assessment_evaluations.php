<?php

use Modules\Default\Libraries\Sdk\Media;

$media = Media::singleUpload($_FILES['file']);

$data['media_id'] = $media->id;
$data['user_id'] = auth()->id;