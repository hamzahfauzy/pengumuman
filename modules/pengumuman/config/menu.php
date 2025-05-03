<?php 

return [
    [
        'label' => 'pengumuman.menu.periode',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-calendar',
        'route' => routeTo('crud/index',['table' => 'peng_periode']),
        'activeState' => 'pengumuman.peng_periode'
    ],
    [
        'label' => 'pengumuman.menu.peserta',
        'icon'  => 'fa-fw fa-lg me-2 fa-solid fa-users',
        'route' => routeTo('crud/index',['table' => 'peng_peserta']),
        'activeState' => 'pengumuman.peng_peserta'
    ],
];