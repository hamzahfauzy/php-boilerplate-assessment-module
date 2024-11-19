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
        <div class="table-responsive table-hover table-sales">
            <table class="table table-bordered datatable-crud" style="width:100%">
                <thead>
                    <tr>
                        <th width="20px">#</th>
                        <th>Periode</th>
                        <th>Instrumen</th>
                        <th class="text-right">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($records as $index => $record): ?>
                    <tr>
                        <td><?=$index+1?></td>
                        <td><?=$record->period_name?></td>
                        <td><?=$record->instrument_name?></td>
                        <td>
                            <a href="<?= routeTo('assessment/reports/detail', ['period_id' => $record->period_id, 'instrument_id' => $record->instrument_id, 'user_id' => $record->user_id]) ?>" class="btn btn-primary">Hasil</a>
                        </td>
                    </tr>
                    <?php endforeach ?>

                    <?php if(empty($records)): ?>
                    <tr>
                        <td colspan="4" class="text-center"><i>Tidak ada Data</i></td>
                    </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php get_footer() ?>
