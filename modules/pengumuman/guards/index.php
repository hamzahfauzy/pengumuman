<?php

$auth = auth();

if(!in_array($route, ['pengumuman/index','pengumuman/result','pengumuman/download-result']) && empty($auth))
{
    header('location:'.routeTo('auth/login'));
    die;
}