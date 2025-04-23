<table width="100%" align="center" border="1" cellpadding="5" cellspacing="0">
    <thead>
    <tr>
        <th>NO</th>
        <th>Karyawan</th>
        <th>Yang Mengevaluasi</th>
        <th>Tanggal Kerja</th>
        <th>Judul</th>
        <th>Deskripsi</th>
        <th>Catatan</th>
        <th>Tanggal Dibuat</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($data as $index => $d): ?>
    <tr>
        <td><?=$index+1?></td>
        <td><?=$d->employee?></td>
        <td><?=$d->evaluator?></td>
        <td><?=$d->work_date?></td>
        <td><?=$d->title?></td>
        <td><?=$d->description?></td>
        <td><?=$d->notes?></td>
        <td><?=$d->created_at?></td>
    </tr>
    <?php endforeach ?>
    </tbody>
</table>