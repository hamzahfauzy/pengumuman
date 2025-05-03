<?php 

return [
    'peng_periode' => [
        'nama' => [
            'label' => 'Nama',
            'type' => 'text'
        ],
        'record_status' => [
            'label' => 'Status',
            'type' => 'options:AKTIF|TIDAK AKTIF'
        ]
    ],
    'peng_peserta' => [
        'periode_id' => [
            'label' => 'Periode',
            'type' => 'options-obj:peng_periode,id,nama'
        ],
        'kode' => [
            'label' => 'Kode',
            'type' => 'text'
        ],
        'nama' => [
            'label' => 'Nama',
            'type' => 'text'
        ],
        'tanggal_lahir' => [
            'label' => 'Tanggal Lahir',
            'type' => 'date'
        ],
        'jurusan' => [
            'label' => 'Jurusan',
            'type' => 'text'
        ],
        'foto_url' => [
            'label' => 'File Foto',
            'type' => 'file'
        ],
        'record_status' => [
            'label' => 'Status',
            'type' => 'options:LULUS|TIDAK LULUS'
        ],
    ]
];