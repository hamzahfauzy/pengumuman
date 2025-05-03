<?php

use Core\Database;
use Core\Request;
use PhpOffice\PhpWord\TemplateProcessor;

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

    $pdfFile = 'storage/'.$peserta->nama.'.pdf';

    // if(file_exists($pdfFile))
    // {
    //     header('location:/'.$pdfFile);
    //     die;
    // }

    $templateFile = getSetting('APP_TEMPLATE_SURAT');
    $templateFile = str_replace(env('APP_URL') .'/', '', $templateFile);

    $template = new TemplateProcessor($templateFile);
    $mapping = [
        'nama' => $peserta->nama,
        'kode' => $peserta->kode,
    ];

    foreach ($mapping as $key => $value) {
        $template->setValue($key, $value);
    }

    // Simpan sebagai Word sementara
    $filePath = $peserta->kode;
    $wordFile = '../storage/media/'.$filePath.'.docx';
    $template->saveAs($wordFile);

    \PhpOffice\PhpWord\Settings::setPdfRendererName(\PhpOffice\PhpWord\Settings::PDF_RENDERER_DOMPDF);
    \PhpOffice\PhpWord\Settings::setPdfRendererPath('../vendor/dompdf/dompdf');

    $reader = \PhpOffice\PhpWord\IOFactory::load($wordFile);
    $writer = \PhpOffice\PhpWord\IOFactory::createWriter($reader, 'PDF');
    
    $pdfFile = '../storage/media/' . $filePath .' - '.$peserta->nama.'.pdf';
    $writer->save($pdfFile);

    header("Content-type:application/pdf");
    header('Content-Disposition: attachment; filename=' . $filePath .' - '.$peserta->nama.'.pdf');
    readfile( $pdfFile );
    die;

}

return view('pengumuman/views/' . ($peserta ? 'result' : 'not-found'), [
    'periode' => $periode,
    'peserta' => $peserta
]);