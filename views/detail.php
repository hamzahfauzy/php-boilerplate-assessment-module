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
            <?php if($data->assessor_id == auth()->id && $data->status == 'DRAFT' && empty($data->questions)): ?>
            <a href="<?=routeTo('assessment/do', ['id' => $data->id])?>" class="btn btn-sm btn-info">
                Buat Penilaian
            </a>
            <?php endif ?>
            <?php if($data->assessor_id == auth()->id && $data->status == 'DRAFT' && !empty($data->questions)): ?>
            <a href="<?=routeTo('assessment/to-review', ['id' => $data->id])?>" class="btn btn-sm btn-success" onclick="if(confirm('Apakah anda yakin akan mengirim penilaian ini ke pegawai ?')){return true}else{return false}">
                Kirim Penilaian ke Pegawai
            </a>
            <?php endif ?>
            <?php if($data->assessor_id == auth()->id && $data->status == 'DISKUSI'): ?>
            <a href="<?=routeTo('assessment/do', ['id' => $data->id])?>" class="btn btn-sm btn-info">
                Revisi Penilaian
            </a>
            <a href="<?=routeTo('assessment/finalize', ['id' => $data->id])?>" class="btn btn-sm btn-success" onclick="if(confirm('Apakah anda yakin akan menetapkan penilaian ini menjadi penilaian final ?')){return true}else{return false}">
                Tetapkan Sebagai Penilaian Final
            </a>
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
                $jumlah = 0; 
                foreach($categories as $category): 
                ?>
                <tr>
                    <td colspan="<?=count($weights)+2?>" class="text-center fw-bold"><?= $category->name ?></td>
                </tr>
                <?php foreach($category->questions as $question): $jumlah += $data->questions?->questions?->{$question->id}; ?>
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

<?php if($data->assessor_id == auth()->id && $data->status == 'DISKUSI'): ?>
<div class="card">
    <div class="card-header">
        <p class="h4">Tanggapan</p>
    </div>
    <div class="card-body">
        <?php foreach($comments as $comment): ?>
        <div class="comment mb-3 bg-light p-3 rounded">
            <b><?=$comment->commenter_name?></b> - <small><?=$comment->created_at?></small><br>
            <p><?=$comment->description?></p>
        </div>
        <?php endforeach ?>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <p class="h4">Berikan Tanggapan</p>
    </div>
    <div class="card-body">
        <form action="<?=routeTo('assessment/comments/create')?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="period_id" value="<?=$data->period_id?>">
            <input type="hidden" name="instrument_id" value="<?=$data->instrument_id?>">
            <input type="hidden" name="user_id" value="<?=$data->user_id?>">
            <textarea name="description" id="" class="form-control" placeholder="Ketik tanggapan disini..." rows="8"></textarea>
            <button class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
</div>
<?php endif ?>
<?php get_footer() ?>
