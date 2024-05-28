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
        /*$validationRule = [
            'userfile' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[userfile]',
                    'is_image[userfile]',
                    'mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                    'max_size[userfile,100]',
                    'max_dims[userfile,1024,768]',
                ],
            ],
        ];*/
        /*
        if (! $this->validateData([], $validationRule)) {
            $data = ['errors' => $this->validator->getErrors()];

            return view('upload_form', $data);
        }*/

        $userfile = $this->request->getFile('userfile');
        $fd = fopen('php://temp/userfile', 'w') or die('не удалось создать файл');
        fputs($fd, $userfile);
        //fclose($fd);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('php://temp/userfile');
        //$size = $userfile->getSize();
        //echo $size;
        //$type = $userfile->getMimeType();
        //echo $type; // image/png

        /*
        if (! $img->hasMoved()) {
            $filepath = WRITEPATH . 'uploads/' . $img->store();

            $data = ['uploaded_fileinfo' => new File($filepath)];

            return view('upload_success', $data);
        }

        $data = ['errors' => 'The file has already been moved.'];
        */

        return view('upload_form', ['errors' => []]);
    }
}
