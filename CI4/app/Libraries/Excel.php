<?php

namespace App\Libraries;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Shared\Date as SharedDate;

class Excel
{
	/* Допустимые форматы табличных файлов */
	static array $validMimeTypes = [
			'application/vnd.ms-excel', // xls
			'application/vnd.oasis.opendocument.spreadsheet', // ods
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xlsx
		];


	/* Максимальный размер импортируемого файла */
	const USER_FILE_MAX_SIZE = 1*1024*1024;


	/* Функция преобразования формата даты из Excel в SQL*/
	static function DateFromExcelToSQL ($exceldate) {
		$serialdate = SharedDate::PHPToExcel($exceldate); //  Преобразовать распознаваемую форматированную строку в сериализованную временную метку Excel.
		$phpdatetime = SharedDate::excelToDateTimeObject($serialdate); // Преобразовать сериализованную временную метку Excel в объект PHP DateTime.
		$sqldate = $phpdatetime->format('Y-m-d'); // Приведение даты к нужному формату для SQL.
		return $sqldate;
	}


	/* Функция преобразования формата даты из SQL в Excel */
	static function DateFromSQLToExcel ($sqldate) {
		$phpdatetime = DateTimeImmutable::createFromFormat('Y-m-d', $sqldate); // Преобразовать строку даты формата SQL в объект PHP DateTime.
		$sqldate = $phpdatetime->format('d/m/Y'); // Приведение даты к желаемому формату отображения в Excel.
		return $sqldate;
	}

	/* Функция чтения Excel файла в массив */
	public function readFile($filename): array
	{
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filename);
		$dataArray = $spreadsheet->getActiveSheet()->rangeToArray('B2:F1001');
		return $dataArray;
	}

	public function writeFile($filename, $array)
	{
		$spreadsheet = new Spreadsheet();
		/* Установить стили таблицы */
		$spreadsheet->getDefaultStyle()->getFont()->setName('Arial');
		$spreadsheet->getDefaultStyle()->getFont()->setSize(13);
		$spreadsheet->getActiveSheet()->getStyle('1')->getFont()->setBold(true); // Установить стиль заголовка: выделить жирным
		$spreadsheet->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setWrapText(true);
		$spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(50, 'pt');
		$spreadsheet->getActiveSheet()->getStyle('A1:F1')
			->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
		//foreach (['A','B','C','D','E','F'] as $column) {
		//	$spreadsheet->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
		//}
		$spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(90, 'pt');
		/* Создать рабочий лист */
		$worksheet = $spreadsheet->getActiveSheet();
		$worksheet->fromArray($array);
		/* Запись в файл */
		$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
		$writer->save($filename);
	}
}
