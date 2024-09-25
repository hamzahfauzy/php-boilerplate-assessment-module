<?php 

use Core\Database;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

$db = new Database;

$instrument_id     = $_GET['instrument_id'];

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    
    // Jenis file yang diizinkan
    $allowedTypes = ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    
    if (!in_array($file['type'], $allowedTypes)) {
        set_flash_msg(['error'=> 'Silakan unggah file Excel']);
    }
    else
    {

        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        
        if (in_array($fileExtension, ['xls', 'xlsx'])) {
            $spreadsheet = IOFactory::load($file['tmp_name']);
            $sheet = $spreadsheet->getActiveSheet();
    
            foreach ($sheet->getRowIterator(2) as $row) {
                $category_name = $sheet->getCell('A' . $row->getRowIndex())->getValue();
                $description = $sheet->getCell('B' . $row->getRowIndex())->getValue();
    
                // check category
                $category = $db->single('assessment_categories', ['name' => $category_name]);
                if(empty($category))
                {
                    $category = $db->insert('assessment_categories', ['name' => $category_name, 'order_number' => 1]);
                }
    
                $db->insert('assessment_questions', [
                    'instrument_id'     => $instrument_id,
                    'description'       => $description,
                    'category_id'       => $category->id,
                ]);
            }
        }
           
        set_flash_msg(['success'=> 'Data berhasil di Import']);
    }
    
} else {
    set_flash_msg(['error'=> 'Silakan unggah file Excel atau CSV.']);
}

header('Location: '.routeTo('crud/index',['table' => 'assessment_questions', 'filter' => ['instrument_id' => $instrument_id] ]));
die();
