<?php

use Core\Storage;

$file = $_FILES['foto_url'];
$name = $file['name'];

if(!empty($name))
{
    $data['foto_url'] = Storage::upload($file);
}