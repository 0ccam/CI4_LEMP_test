<?php

namespace App\Controllers;

use CodeIgniter\Files\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Upload extends BaseController
{
    protected $helpers = ['form'];

    public function get()
    {
        //$spreadsheet = new Spreadsheet();
        //$activeWorksheet = $spreadsheet->getActiveSheet();
        //$activeWorksheet->setCellValue('A1', 'Hello World !');
        return view('upload_form', ['errors' => []]);
    }

    public function post()
    {
        $userfile = $this->request->getFile('userfile');
        if (!$userfile) throw new \Exception('нет $userfile');

    	$tmpfname = tempnam(sys_get_temp_dir(), '');
		if (!$tmpfname) throw new \Exception("не удалось создать имя $tmpfname");

    	$fhandler = fopen($tmpfname, "w");
    	if (!$fhandler) throw new \Exception('не удалось создать файл $tmpfname');

		$result = fwrite($fhandler, $userfile);
        if (!$result) throw new \Exception('не удалось записать файл $tmpfname');

        $spreadSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($tmpfname);
        //$spreadSheet->getActiveSheet()->setCellValue('A1', 1513789642);
        fclose($fd);
        $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($tmpfname);
        echo $inputFileType;
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($tmpfname);
        //$workSheet = $spreadSheet->getActiveSheet();
        //$cell = $workSheet->getCell('A1');
        //echo "value: ", $cell->getValue(), "<br>";
        //$size = $userfile->getSize();
        //echo $size;
        //$type = $userfile->getMimeType();
        //echo $type; // image/png

        return view('upload_form', ['errors' => []]);
    }
}
