<?php
/*********************************
* Класс импорта в реестр из файла Excel
*********************************/
namespace App\Controllers;
use App\Libraries\MyUtils as MyUtils;

class Import extends BaseController
{
	public function index()
	{
		/* Допустимые форматы табличных файлов */
		$validMimeTypes = [
			'application/vnd.ms-excel', // xls
			'application/vnd.oasis.opendocument.spreadsheet', // ods
			'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // xlsx
		];

		/* Максимальный размер импортируемого файла */
		define('USER_FILE_MAX_SIZE', 1*1024*1024);

		/* Загрузить пользовательский файл */
		$userfile = $this->request->getFile('userfile');

		/* Проверка на корректности загрузки */
		if (! $userfile->isValid())
			return view('import_form', ['errors' => [
				'Не удалось загрузить файл']]);

		/* Проверка корректности размера файла */
		if ((USER_FILE_MAX_SIZE) < $userfile->getSize())
			return view('import_form', ['errors' => [
				'Недопустимый размер файла']]);

		/* Проверка корректности формата файла */
		if (! in_array(
				$userfile->getMimeType(),
				$validMimeTypes))
			return view('import_form', ['errors' => [
				'Недопустимый формат файла']]);

		/* Получение временного имени загруженного файла */
		$tempname = $userfile->getTempName();
		/* Загрузка таблицы из полученного файла */
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($tempname);
		/* Чтение таблицы в двумерный массив: столбцы от B до F, строки от 2 до 1001 */
		$dataArray = $spreadsheet->getActiveSheet()->rangeToArray('B2:F1001');

		/* Перебор массива по строкам таблицы */
		foreach ($dataArray as $row) {
			/* Если одна из ячеек оказалась пустой, выйти из цикла */
			if (in_array(null, $row)) break;
			/* Создать запись в БД о проверке*/
			MyUtils::CreateRevise($row);

			return view('import_success');
		}

		return view('import_form', ['errors' => $errors ?? []]);
	}
}
