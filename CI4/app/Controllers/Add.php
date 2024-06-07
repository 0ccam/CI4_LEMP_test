<?php

namespace App\Controllers;
use App\Libraries\MyData as MyData;
use App\Libraries\Excel as Excel;
use App\Libraries\Revision as Revision;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Add extends BaseController
{
	public function index()
	{
		$revision = new Revision();
		$smp_list = $revision->getSmpTitles()->getData();
		$inspector_list = $revision->getInspectorTitles()->getData();

		$html = view('header');
		$html .= view('add_form', ['smp_list' => $smp_list, 'inspector_list' => $inspector_list, 'defaults' => []]);
		$html .= view('import_form');
		return $html;
	}

	public function add(): string
	{
		$revision = new Revision();
		$smp_list = $revision->getSmpTitles()->getData();
		$inspector_list = $revision->getInspectorTitles()->getData();

		$request = $this->request->getPost();
		$result = $revision->add($request);
		$message = $result->isError() ? $result->getErrors() : ['Запись добавлена'];

		$html = view('header');
		$html .= view('add_form', ['smp_list' => $smp_list, 'inspector_list' => $inspector_list, 'defaults' => $request]);
		$html .=view('message_view', ['messages'=>$message]);
		$html .= view('import_form');
		return $html;
	}

	public function import(): string
	{
		function zip($arr_keys, $arr_vals)
		{
			$temp = [];
			foreach ($arr_keys as $key) {
				$temp[$key] = array_shift($arr_vals);
			}
			return $temp;
		}

		function collector($file): array
		{
			$messages = [];

			/* Проверка корректности загрузки */
			if (! $file->isValid()) {
				$messages[] = 'Не удалось загрузить файл';
				return $messages;
			}

			$excel = new Excel();

			/* Проверка корректности размера файла */
			if ($file->getSize() > $excel::USER_FILE_MAX_SIZE) {
				$messages[] = 'Недопустимый размер файла';
				return $messages;
			}

			/* Проверка корректности формата файла */
			if (! in_array($file->getMimeType(), $excel::$validMimeTypes)) {
				$messages[] = 'Недопустимый формат файла';
				return $messages;
			}

			/* Получение временного имени загруженного файла */
			$tempname = $file->getTempName();
			$table = $excel->readFile($tempname);

			$revision = new Revision();
			/* Перебор таблицы по строкам таблицы */
			$counter = 1;
			$good_counter = 0;
			$bad_counter = 0;
			foreach ($table as $row) {
				$dict = zip(['smp_title','inspector_title','revision_start','revision_stop','revision_duration'], $row);
				$result = $revision->add($dict);
				if($result->isError()) {
					$messages[] = "Не удалось добавить строку номер $counter";
					$messages[] = $result->getErrors();
					//$messages[] = $row;
					$bad_counter++;
				} else {
					$messages[] = "Строка номер $counter добавлена";
					$good_counter++;
				}
				$counter++;
			}

			$messages[] = "Строк загружено: $good_counter, пропущено: $bad_counter";
			return $messages;
		}

		/* Загрузить пользовательский файл */
		$userfile = $this->request->getFile('userfile');
		if(!$userfile) return 'no file!';
		$messages = collector($userfile);

		$html = view('header');
		$html .= view('import_form');
		$html .=view('message_view', ['messages'=>$messages]);
		return $html;
	}
}
