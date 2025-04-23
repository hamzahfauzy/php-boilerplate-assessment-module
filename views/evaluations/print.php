<style>
body {
    font-family: arial, sans-serif;
}

h2, p {
    padding:0;
    margin:0;
}

table {
    border-collapse: collapse;
}

td,
th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

thead {
    display: table-header-group;
}

</style>
<h2 align="center">DATA EVALUASI LAPORAN</h2>
<p align="center"><?= $_GET['date_from']?> s/d <?=$_GET['date_end']?></p>
<br>
<div class="container">
    <table width="98%" align="center" border="1" cellpadding="5" cellspacing="0">
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
</div>
<script>
    window.print()
</script>