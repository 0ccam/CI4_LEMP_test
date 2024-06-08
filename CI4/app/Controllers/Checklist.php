<?php

namespace App\Controllers;
use App\Libraries\MyData as MyData;
use App\Libraries\Excel as Excel;
use App\Libraries\Revision as Revision;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Checklist extends BaseController
{
	/* Имя экспортируемого файла */
	public $regfile = "реестр.xlsx";

	public function index(): string
	{
		$request = $this->request->getPost();
		$html = '';
		$html .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/style.css">';
		$html .= view('site/header');
		$html .= view('site/topnav');
		$html .= view('site/search_form' , [
			'defaults' => [
				'revision_id' => '%',
				'revision_duration' => '%',
				'smp_title' => '%',
				'inspector_title' => '%',
				'revision_start' => '1970-01-01',
				'revision_stop' => '2038-01-19',
			]]);
		$html .= view('site/footer');
		return $html;
	}

	public function search(): string
	{
		$request = $this->request->getPost();
		$revision = new Revision();
		$found = $revision->search($request);

		$html = '';
		$html .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/style.css">';
		$html .= '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/table.css">';
		$html .= view('site/header');
		$html .= view('site/topnav');
		$html .= view('site/search_form', ['defaults' => $request]);
		if ($found->isError()) {
			$html .= view('site/message_view', ['messages' => $found->getErrors()]);
		} elseif ($found->isData()) {
			$html .= view('site/export_form', ['hidden' => $request]);
			$html .= view('site/table_view', ['table_header' => $revision->getHeader(), 'table_body' => $found->getData()]);
		} else {
			$html .= view('site/message_view', ['messages' => ['Ничего не найдено']]);
		}
		return $html;
	}

	public function export(): string
	{
		/*  Функция отправки файла клиенту */
		function SendFile($filename)
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

		$request = $this->request->getGet();
		$revision = new Revision();
		$excel = new Excel();
		$found = $revision->search($request);
		if ($found->isData()) {
			$table = $found->getData();
			array_unshift($table, $revision->getHeader()); // Вставить table_header в начало таблицы $table.
			$path = '/tmp/' . $this->regfile;
			$excel->writeFile($path, $table);
			SendFile($path);
		}
		return view('search_form', ['defaults' => []]);
	}
}
