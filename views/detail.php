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
            <?php if($data->assessor_id == auth()->id && $data->status == 'DISKUSI'): ?>
            <a href="<?=routeTo('assessment/do', ['id' => $data->id])?>" class="btn btn-sm btn-info">
                <?= $data->questions ? 'Revisi Penilaian' : 'Buat Penilaian' ?>
            </a>
            <?php if($data->questions): ?>
            <a href="<?=routeTo('assessment/finalize', ['id' => $data->id])?>" class="btn btn-sm btn-success" onclick="if(confirm('Apakah anda yakin akan menetapkan penilaian ini menjadi penilaian final ?')){return true}else{return false}">
                Tetapkan Sebagai Penilaian Final
            </a>
            <?php endif ?>

            <?php endif ?>
        </div>
    </div>
    <div class="card-body">
        <?php if ($success_msg) : ?>
        <div class="alert alert-success"><?= $success_msg ?></div>
        <?php endif ?>
        
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
                    <td>Penilai</td>
                    <td>:</td>
                    <td><?= $data->assessor->name?></td>
                </tr>
                <tr>
                    <td>Tanggal Penilaian</td>
                    <td>:</td>
                    <td><?= $data->questions ? date('d/m/Y H:i:s', strtotime($data->questions->datetime)) : ''?></td>
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
                    <td colspan="<?=count($weights)+2?>" class="text-center fw-bold"><?= $category->name ?></td>
                </tr>
                <?php $jumlah = 0; foreach($category->questions as $question): $jumlah += $data->questions?->questions?->{$question->id}; ?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$question->description?></td>
                    <td><?=$data->questions?->questions?->{$question->id}?></td>
                </tr>
                <?php endforeach; ?>
                <?php 
                endforeach;
                ?>
                <tr>
                    <td></td>
                    <td><b>Total</b></td>
                    <td><?=number_format($jumlah,0,',','.')?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><b>Rata-rata</b></td>
                    <td><?=number_format($jumlah/$no,0,',','.')?></td>
                </tr>
            </table>

            <h3>Penjelasan Dalam Angka</h3>
            <ul>
                <?php foreach($weights as $weight): ?>
                <li><b><?=$weight->name?></b> = <?=$weight->min?> - <?=$weight->max?></li>
                <?php endforeach ?>
            </ul>
    </div>
</div>
<?php get_footer() ?>
