<?php get_header() ?>
<style>
table td img {
    max-width:150px;
}
</style>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>
        <div class="right-button ms-auto">
            
        </div>
    </div>
    <div class="card-body">
        <?php if ($success_msg) : ?>
        <div class="alert alert-success"><?= $success_msg ?></div>
        <?php endif ?>
        <?php if ($error_msg) : ?>
        <div class="alert alert-danger"><?= $error_msg ?></div>
        <?php endif ?>
        
        <form action="" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group mb-3">
                <label for="" class="mb-2">File</label>
                <iframe src="<?=asset($data->file->name)?>" frameborder="0" width="100%" height="500px"></iframe>
            </div>
            <div class="form-group mb-3">
                <label for="" class="mb-2"><?= __('assessment.label.notes') ?></label>
                <textarea name="notes" id="" class="form-control"><?=$data->notes?></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php get_footer() ?>
