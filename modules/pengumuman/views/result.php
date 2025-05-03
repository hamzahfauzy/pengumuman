<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$peserta->nama?> | Pengumuman Online</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
<div class="container my-5">
    <div class="row">
        <div class="col-6 m-auto">
            <div class="position-relative p-5 text-muted bg-body border border-dashed rounded-5">
                <img src="<?=getLogo()?>" alt="">
                <h2 class="text-body-emphasis mt-4"><?= $peserta->record_status == 'LULUS' ? getSetting('APP_KATA_KELULUSAN') : getSetting('APP_KATA_TIDAK_LULUS') ?></h2>
            
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                                <h6 class="mb-0">NISN</h6>
                                <p class="mb-0 opacity-75"><?=$peserta->kode?></p>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                                <h6 class="mb-0">Nama</h6>
                                <p class="mb-0 opacity-75"><?=$peserta->nama?></p>
                            </div>
                        </div>
                    </a>
                    <?php if($peserta->jurusan): ?>
                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                            <h6 class="mb-0">Jurusan</h6>
                            <p class="mb-0 opacity-75"><?=$peserta->jurusan?></p>
                            </div>
                        </div>
                    </a>
                    <?php endif ?>
                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                            <h6 class="mb-0">Sekolah</h6>
                            <p class="mb-0 opacity-75"><?=getSetting('APP_NAMA_SEKOLAH')?></p>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                            <h6 class="mb-0">Kabupaten</h6>
                            <p class="mb-0 opacity-75"><?=getSetting('APP_KABUPATEN')?></p>
                            </div>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                            <h6 class="mb-0">Provinsi</h6>
                            <p class="mb-0 opacity-75"><?=getSetting('APP_PROVINSI')?></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="text-center w-100">
                    <form action="<?=routeTo('pengumuman/download-result')?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="kode" value="<?=$peserta->kode?>">
                        <input type="hidden" name="tanggal_lahir" value="<?=$peserta->tanggal_lahir?>">
                        <a href="<?=routeTo('/')?>" class="btn btn-warning px-5 mt-5" type="button">
                            Kembali
                        </a>
                        <button class="btn btn-primary px-5 mt-5" type="submit">
                            Download Surat
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>