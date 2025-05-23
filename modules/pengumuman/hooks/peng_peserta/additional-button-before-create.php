<?php ob_start(); ?>

<div class="modal fade" id="importPesertaModal" tabindex="-1" role="dialog" aria-labelledby="importPesertaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importPesertaModalLabel">Form Import</h5>
      </div>
      <div class="modal-body">
        <form action="<?=routeTo('pengumuman/peserta/import')?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="form-group mb-3">
                <label for="" class="mb-2">Sample File</label><br>
                <a href="<?=asset('assets/pengumuman/format-import-peserta.xlsx')?>">Download</a>
            </div>
            <div class="form-group mb-3">
                <label for="" class="mb-2">Periode</label>
                <?= \Core\Form::input('options-obj:peng_periode,id,nama', 'periode_id', ['class' => 'form-control', 'required' => 'required']); ?>
            </div>
            <div class="form-group mb-3">
                <label for="" class="mb-2">File</label>
                <input type="file" class="form-control" name="file">
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

<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importPesertaModal">
Import
</button>
<?php

return ob_get_clean();