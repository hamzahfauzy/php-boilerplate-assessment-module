<?php get_header() ?>
<style>
table td img {
    max-width:150px;
}
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center no-print">
        <p class="h4 m-0"><?php get_title() ?></p>
        <div class="right-button ms-auto">
            <button class="btn btn-info" onclick="window.print()"><i class="fas fa-print"></i> Cetak</button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered mb-4">
            <tr>
                <td rowspan="11">1</td>
                <td colspan="4"><b>YANG DINILAI</b></td>
            </tr>
            <tr>
                <td>a. Nama</td>
                <td colspan="3"><?=$user->name?></td>
            </tr>
            <tr>
                <td>b. NIDN</td>
                <td colspan="3"><?=$user->profile?->NIDN?></td>
            </tr>
            <tr>
                <td>c. Pangkat, Golongan ruang</td>
                <td colspan="3"><?=$user->profile?->pangkat?>, <?=$user->profile?->golongan?></td>
            </tr>
            <tr>
                <td>d. Jabatan</td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td>- Struktural</td>
                <td colspan="3"><?=$user->profile?->jab_struktural?></td>
            </tr>
            <tr>
                <td>- Akademik</td>
                <td colspan="3"><?=$user->profile?->jab_akademik?></td>
            </tr>
            <tr>
                <td>e. Unit Kerja</td>
                <td colspan="7"></td>
            </tr>
            <tr>
                <td>- Perguruan Tinggi</td>
                <td colspan="3"><?=$user->profile?->perguruan_tinggi?></td>
            </tr>
            <tr>
                <td>- Fakultas</td>
                <td colspan="3"><?=$user->profile?->fakultas?></td>
            </tr>
            <tr>
                <td>- Program Studi</td>
                <td colspan="3"><?=$user->profile?->program_studi?></td>
            </tr>

            <?php foreach($records as $index => $record): ?>
            <tr>
                <td rowspan="11"><?=$index+2?></td>
                <td colspan="4"><b><?=ucwords($record->record_type)?> PENILAI</b></td>
            </tr>
            <tr>
                <td>a. Nama</td>
                <td colspan="3"><?= $record->assessor->name ?></td>
            </tr>
            <tr>
                <td>b. NIDN</td>
                <td colspan="3"><?=$record->assessor->profile?->NIDN?></td>
            </tr>
            <tr>
                <td>c. Pangkat, Golongan ruang</td>
                <td colspan="3"><?=$record->assessor->profile?->pangkat?>, <?=$record->assessor->profile?->golongan?></td>
            </tr>
            <tr>
                <td>d. Jabatan</td>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td>- Struktural</td>
                <td colspan="3"><?=$record->assessor->profile?->jab_struktural?></td>
            </tr>
            <tr>
                <td>- Akademik</td>
                <td colspan="3"><?=$record->assessor->profile?->jab_akademik?></td>
            </tr>
            <tr>
                <td>e. Unit Kerja</td>
                <td colspan="7"></td>
            </tr>
            <tr>
                <td>- Perguruan Tinggi</td>
                <td colspan="3"><?=$record->assessor->profile?->perguruan_tinggi?></td>
            </tr>
            <tr>
                <td>- Fakultas</td>
                <td colspan="3"><?=$record->assessor->profile?->fakultas?></td>
            </tr>
            <tr>
                <td>- Program Studi</td>
                <td colspan="3"><?=$record->assessor->profile?->program_studi?></td>
            </tr>
            <?php endforeach ?>

            <tr>
                <td rowspan="<?=5+count($categories)?>"><?= count($records)+2 ?></td>
                <td colspan="4" class="text-center"><b>PENILAIAN</b></td>
            </tr>
            <tr>
                <td rowspan="2"><b>UNSUR YANG DINILAI</b></td>
                <td colspan="2" class="text-center"><b>NILAI</b></td>
                <td rowspan="2" class="text-center"><b>KETERANGAN</b></td>
            </tr>
            <tr>
                <td class="text-center"><b>ANGKA</b></td>
                <td class="text-center"><b>SEBUTAN</b></td>
            </tr>
            <?php 
            $jumlah = 0;
            foreach($categories as $category): 
                $jumlah+=$finalReport[$category->id];
            ?>
            <tr>
                <td><?=ucwords(strtolower($category->name))?></td>
                <td><?=$finalReport[$category->id]?></td>
                <td><?=ucwords(terbilang($finalReport[$category->id]))?></td>
                <td><?=$weights[$category->id]?></td>
            </tr>
            <?php endforeach ?>
            <tr>
                <td>JUMLAH</td>
                <td><?=$jumlah?></td>
                <td><?=ucwords(terbilang($jumlah))?></td>
                <td></td>
            </tr>
            <tr>
                <td>RATA-RATA</td>
                <td><?=$jumlah/count($categories)?></td>
                <td><?=ucwords(terbilang($jumlah/count($categories)))?></td>
                <td><?= $avg_weight ?></td>
            </tr>
        </table>
    </div>
</div>

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

<?php if(!$isFinal): ?>
<div class="card">
    <div class="card-header">
        <p class="h4">Berikan Tanggapan</p>
    </div>
    <div class="card-body">
        <form action="<?=routeTo('assessment/comments/create')?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="period_id" value="<?=$_GET['period_id']?>">
            <input type="hidden" name="instrument_id" value="<?=$_GET['instrument_id']?>">
            <input type="hidden" name="user_id" value="<?=$_GET['user_id']?>">
            <textarea name="description" id="" class="form-control" placeholder="Ketik tanggapan disini..." rows="8"></textarea>
            <button class="btn btn-primary mt-2">Submit</button>
        </form>
    </div>
</div>
<?php endif ?>
<?php get_footer() ?>
