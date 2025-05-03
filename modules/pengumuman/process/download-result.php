<?php

use Core\Database;
use Core\Request;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
// use PhpOffice\PhpWord\TemplateProcessor;

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

    $mapping = [
        '{nama}' => $peserta->nama,
        '{kode}' => $peserta->kode,
        '{jurusan}' => $peserta->jurusan,
    ];

    $template = getSetting('APP_TEXT_TEMPLATE');
    foreach($mapping as $key => $value)
    {
        $template = str_replace($key, $value, $template);
    }

    $template = str_replace(env('APP_URL') .'/storage/', dirname(__FILE__) . '/../../../storage/media/', $template);
    
    $peserta->template_text = $template;

    $kop = getSetting('APP_KOP_SURAT');
    $kop = str_replace(env('APP_URL') .'/storage/', '', $kop);

    $kop = dirname(__FILE__) . '/../../../storage/media/'.$kop;

    $content = view('pengumuman/views/download-result', [
        'periode' => $periode,
        'peserta' => $peserta,
        'kop' => $kop
    ]);


    try {
        $filename = 'storage/'.$peserta->nama.'.pdf';
        $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->pdf->SetDisplayMode('fullpage');
    
        $html2pdf->writeHTML($content);
        $html2pdf->output($filename, 'D');
        // $html2pdf->output();
    } catch (Html2PdfException $e) {
        $html2pdf->clean();
    
        $formatter = new ExceptionFormatter($e);
        echo $formatter->getHtmlMessage();
    }

}

return view('pengumuman/views/' . ($peserta ? 'download-result' : 'not-found'), [
    'periode' => $periode,
    'peserta' => $peserta
]);