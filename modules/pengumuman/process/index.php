<?php

use Core\Database;
use Core\Request;

$db = new Database;
$periode = $db->single('peng_periode', [
    'record_status' => 'AKTIF'
]);

return view('pengumuman/views/index', [
    'periode' => $periode
]);