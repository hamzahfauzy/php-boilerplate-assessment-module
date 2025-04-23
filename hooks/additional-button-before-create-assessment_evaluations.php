<?php ob_start(); ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Cetak</h5>
      </div>
      <div class="modal-body">
        <form action="/assessment/evaluations/print">
            <div class="form-group mb-3">
                <label for="" class="mb-2">Tanggal Awal</label>
                <input type="date" class="form-control" name="date_from" value="<?=date('Y-m-01')?>">
            </div>
            <div class="form-group mb-3">
                <label for="" class="mb-2">Tanggal Akhir</label>
                <input type="date" class="form-control" name="date_end" value="<?=date('Y-m-d')?>">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="downloadModalLabel">Form Download</h5>
      </div>
      <div class="modal-body">
        <form action="/assessment/evaluations/download">
            <div class="form-group mb-3">
                <label for="" class="mb-2">Tanggal Awal</label>
                <input type="date" class="form-control" name="date_from" value="<?=date('Y-m-01')?>">
            </div>
            <div class="form-group mb-3">
                <label for="" class="mb-2">Tanggal Akhir</label>
                <input type="date" class="form-control" name="date_end" value="<?=date('Y-m-d')?>">
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
Cetak
</button>

<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#downloadModal">
Download
</button>
<?php

return ob_get_clean();