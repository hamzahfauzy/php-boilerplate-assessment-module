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
            
            <table class="table mb-4">
                <tr>
                    <td width="200px">Nama</td>
                    <td width="10px">:</td>
                    <td><?=$data->user->name?></td>
                </tr>
                <tr>
                    <td>Unit Kerja</td>
                    <td>:</td>
                    <td><?=$data->user->organization?->name?></td>
                </tr>
                <tr>
                    <td>Tanggal Penilaian</td>
                    <td>:</td>
                    <td><?= date('d/m/Y') ?></td>
                </tr>
            </table>

            <table class="table table-bordered">
                <tr>
                    <td class="text-center fw-bold">No</td>
                    <td class="text-center fw-bold">PERTANYAAN</td>
                    <td class="text-center fw-bold">PENILAIAN</td>
                </tr>
                <?php 
                $no=1; 
                foreach($categories as $category): 
                ?>
                <tr>
                    <td colspan="3" class="text-center fw-bold"><?= $category->name ?></td>
                </tr>
                <?php foreach($category->questions as $question): ?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$question->description?></td>
                    <td><input class="form-control" id="question-<?=$question->id?>>" type="number" name="question[<?=$question->id?>]" value=""></td>
                </tr>
                <?php endforeach; ?>
                <?php 
                endforeach;
                ?>
            </table>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php get_footer() ?>
