<?php

use Core\Database;
use Core\Request;

$db = new Database;
$periode = $db->single('peng_periode', [
    'record_status' => 'AKTIF'
]);

$peserta = [];

if(Request::isMethod('POST'))
{
    $peserta = $db->single('peng_peserta',[
        'kode' => $_POST['kode'],
        'tanggal_lahir' => $_POST['tanggal_lahir'],
        'periode_id' => $periode->id
    ]);
}

return view('pengumuman/views/' . ($peserta ? 'result' : 'not-found'), [
    'periode' => $periode,
    'peserta' => $peserta
]);