<?php

use Core\Database;
use Core\Page;
use Core\Request;

// init table fields
$success_msg = get_flash_msg('success');
$error_msg   = get_flash_msg('error');

$db = new Database;
$data = $db->single('assessment_evaluations', ['id' => $_GET['id']]);
$data->file = $db->single('media', ['id' => $data->media_id]);

if(Request::isMethod('POST'))
{
    $db->update('assessment_evaluations', [
        'notes' => $_POST['notes'],
        'evaluator_id' => auth()->id
    ], [
        'id' => $data->id
    ]);

    set_flash_msg(['success'=>"Data Evaluasi berhasil disimpan"]);

    header('location:'.crudRoute('crud/index','assessment_evaluations'));
    die();
}

// page section
$title = _ucwords(__("assessment.label.evaluations"));
Page::setActive("assessment.evaluations");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'title' => 'Evaluations'
    ]
]);

Page::pushHead('<script src="https://cdn.tiny.cloud/1/rsb9a1wqmvtlmij61ssaqj3ttq18xdwmyt7jg23sg1ion6kn/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>');
Page::pushHead("<script>
tinymce.init({
    selector: 'textarea:not(.select2-search__field)',
    relative_urls : false,
  remove_script_host : false,
  convert_urls : true,
  plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
});
</script>");

return view('assessment/views/evaluations', compact('success_msg','error_msg','data'));