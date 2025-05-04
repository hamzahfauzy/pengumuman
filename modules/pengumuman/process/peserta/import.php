<?php 

use Core\Database;
use PhpOffice\PhpSpreadsheet\IOFactory;

$db = new Database;

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    
    // Jenis file yang diizinkan
    $allowedTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    
    if (!in_array($file['type'], $allowedTypes)) {
        set_flash_msg(['error'=> 'Silakan unggah file Excel']);
    }
    else
    {
        $bulanMap = [
            'JANUARI' => 'January',
            'FEBRUARI' => 'February',
            'MARET' => 'March',
            'APRIL' => 'April',
            'MEI' => 'May',
            'JUNI' => 'June',
            'JULI' => 'July',
            'AGUSTUS' => 'August',
            'SEPTEMBER' => 'September',
            'OKTOBER' => 'October',
            'NOVEMBER' => 'November',
            'DESEMBER' => 'December',
        ];

        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        
        if (in_array($fileExtension, ['xls', 'xlsx'])) {
            $spreadsheet = IOFactory::load($file['tmp_name']);
            $sheet = $spreadsheet->getActiveSheet();
    
            foreach ($sheet->getRowIterator(2) as $row) {
                $kode = $sheet->getCell('B' . $row->getRowIndex())->getFormattedValue();
                $nama = $sheet->getCell('C' . $row->getRowIndex())->getFormattedValue();
                $tanggalLahir = $sheet->getCell('D' . $row->getRowIndex())->getFormattedValue();
                $jurusan = $sheet->getCell('E' . $row->getRowIndex())->getFormattedValue();
                $status = $sheet->getCell('F' . $row->getRowIndex())->getFormattedValue();
                
                // check username
                $peserta = $db->single('peng_peserta', ['kode' => $kode]);
                if(!$peserta)
                {
                    $tglUpper = strtoupper($tanggalLahir);
    
                    // Ganti nama bulan Indonesia ke Inggris
                    foreach ($bulanMap as $indo => $eng) {
                        if (strpos($tglUpper, $indo) !== false) {
                            $tglUpper = str_replace($indo, $eng, $tglUpper);
                            break;
                        }
                    }

                    // Parsing ke format Y-m-d
                    $dateObj = DateTime::createFromFormat('d F Y', $tglUpper);
                    if ($dateObj) {
                        $tanggalLahir = $dateObj->format('Y-m-d') . "\n";
                    }

                    $data = [
                        'periode_id' => $_POST['periode_id'],
                        'kode' => $kode,
                        'nama' => $nama,
                        'jurusan' => $jurusan,
                        'tanggal_lahir' => $tanggalLahir,
                        'record_status' => $status
                    ];

                    $db->insert('peng_peserta', $data);
                }
            }
        }
           
        set_flash_msg(['success'=> 'Data berhasil di Import']);
    }
    
} else {
    set_flash_msg(['error'=> 'Silakan unggah file Excel atau CSV.']);
}

header('Location: '.routeTo('crud/index',['table' => 'peng_peserta']));
die();
