<?php
/*******************************
* Класс экспорта реестра в файл Excel
*******************************/
namespace App\Controllers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Export extends BaseController
{
    public function index(): string
    {
		/* Имя экспортируемого файла */
		$regfile = "/tmp/реестр.xlsx";

		/* Шапка таблицы */
		$rowArray[] = [
			'№',
			'Проверяемый СМП',
			'Контролирующий орган',
			'Плановый период проверки',
			'Плановая длительность'
		];

		/*  Функция отправки файла клиенту */
		function send_file($filename)
		{
			if (file_exists($filename)) {
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename=' . basename($filename));
				header('Content-Transfer-Encoding: binary');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($filename));
				readfile($filename);
				exit;
			}
		}

		/*  Получение реестра из БД */
		$db = db_connect();
		$query = $db->query('
			SELECT
				r.id AS id,
				s.title AS smp_title,
				i.title AS inspector_title,
				r.revise_start AS revise_start,
				r.revise_stop AS revise_stop,
				r.duration AS duration
			FROM
				smp AS s,
				inspector AS i,
				revise AS r
			WHERE
				s.id = r.smp_id AND
				i.id = r.inspector_id
			ORDER BY r.id
		');

		foreach ($query->getResult() as $row) {
			$rowArray[] = [
				$row->id,
				$row->smp_title,
				$row->inspector_title,
				$row->revise_start,
				$row->revise_stop,
				$row->duration
			];
		}

		$spreadsheet = new Spreadsheet();
		$worksheet = $spreadSheet->getActiveSheet();
		$worksheet->getStyle('1')->getFont()->setBold(true);
		$worksheet->fromArray($rowArray);
		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
		$writer->save($regfile);
		send_file($regfile);

        return view('welcome_message');
    }
}