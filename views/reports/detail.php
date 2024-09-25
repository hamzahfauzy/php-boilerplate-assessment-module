<?php get_header() ?>
<style>
table td img {
    max-width:150px;
}
</style>
<div class="card">
    <div class="card-header d-flex flex-grow-1 align-items-center">
        <p class="h4 m-0"><?php get_title() ?></p>
    </div>
    <div class="card-body">
        <table class="table mb-4">
            <tr>
                <td rowspan="11">1</td>
                <td colspan="4"><b>YANG DINILAI</b></td>
            </tr>
            <tr>
                <td>a. Nama</td>
                <td><?=$user->name?></td>
            </tr>
            <tr>
                <td>b. NIDN</td>
                <td></td>
            </tr>
            <tr>
                <td>c. Pangkat, Golongan ruang</td>
                <td></td>
            </tr>
            <tr>
                <td>d. Jabatan</td>
                <td></td>
            </tr>
            <tr>
                <td>- Struktural</td>
                <td></td>
            </tr>
            <tr>
                <td>- Akademik</td>
                <td></td>
            </tr>
            <tr>
                <td>e. Unit Kerja</td>
                <td></td>
            </tr>
            <tr>
                <td>- Perguruan Tinggi Swasta</td>
                <td></td>
            </tr>
            <tr>
                <td>- Fakultas</td>
                <td></td>
            </tr>
            <tr>
                <td>- Program Studi</td>
                <td></td>
            </tr>

            <?php foreach($records as $index => $record): ?>
            <tr>
                <td rowspan="11"><?=$index+2?></td>
                <td colspan="4"><b><?=ucwords($record->record_type)?> PENILAI</b></td>
            </tr>
            <tr>
                <td>a. Nama</td>
                <td><?= $record->assessor->name ?></td>
            </tr>
            <tr>
                <td>b. NIDN</td>
                <td></td>
            </tr>
            <tr>
                <td>c. Pangkat, Golongan ruang</td>
                <td></td>
            </tr>
            <tr>
                <td>d. Jabatan</td>
                <td></td>
            </tr>
            <tr>
                <td>- Struktural</td>
                <td></td>
            </tr>
            <tr>
                <td>- Akademik</td>
                <td></td>
            </tr>
            <tr>
                <td>e. Unit Kerja</td>
                <td><?= $record->assessor->organization->name?></td>
            </tr>
            <tr>
                <td>- Perguruan Tinggi Swasta</td>
                <td></td>
            </tr>
            <tr>
                <td>- Fakultas</td>
                <td></td>
            </tr>
            <tr>
                <td>- Program Studi</td>
                <td></td>
            </tr>
            <?php endforeach ?>

            <tr>
                <td rowspan="<?=5+count($categories)?>"><?= count($records)+2 ?></td>
                <td colspan="4"><b>PENILAIAN</b></td>
            </tr>
            <tr>
                <td rowspan="2"><b>UNSUR YANG DINILAI</b></td>
                <td colspan="2"><b>NILAI</b></td>
                <td rowspan="2"><b>KETERANGAN</b></td>
            </tr>
            <tr>
                <td><b>ANGKA</b></td>
                <td><b>SEBUTAN</b></td>
            </tr>
            <?php 
            $jumlah = 0;
            foreach($categories as $category): 
                $jumlah+=$finalReport[$category->id];
            ?>
            <tr>
                <td><?=$category->name?></td>
                <td><?=$finalReport[$category->id]?></td>
                <td><?=terbilang($finalReport[$category->id])?></td>
                <td></td>
            </tr>
            <?php endforeach ?>
            <tr>
                <td>JUMLAH</td>
                <td><?=$jumlah?></td>
                <td><?=terbilang($jumlah)?></td>
                <td></td>
            </tr>
            <tr>
                <td>RATA-RATA</td>
                <td><?=$jumlah/count($categories)?></td>
                <td><?=terbilang($jumlah/count($categories))?></td>
                <td></td>
            </tr>
        </table>
    </div>
</div>
<?php get_footer() ?>
