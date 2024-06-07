<?php

namespace App\Controllers;

use App\Libraries\Box as Box;
use App\Libraries\MyData as MyData;
use App\Libraries\Excel as Excel;
use App\Libraries\Revision as Revision;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Edit extends BaseController
{
	public function index()
	{
		$html = view('header');
		$html .= view('open_form');
		return $html;
	}

	public function open()
	{
		$html = view('header');
		$html .= view('open_form');
		$request = $this->request->getPost();
		if (array_key_exists('revision_id', $request) and $request['revision_id']) {
			$revision_id = $request['revision_id'];
			$revision = new Revision();
			$revise = $revision->getRevision($revision_id);
			$smp_titles = $revision->getSmpTitles()->getData();
			$inspector_titles = $revision->getInspectorTitles()->getData();
			if ($revise->isData()) {
				$data = $revise->getData();
				$html .= view('edit_form', ['smp_titles' => $smp_titles, 'inspector_titles' => $inspector_titles, 'defaults' => $data]);
				$html .= view('delete_form', ['hidden_data' => $request]);
			}
			if ($revise->isError()) {
				$html .= view('message_view', ['messages'=>$revise->getErrors()]);
			}
		}
		return $html;
	}

	public function edit()
	{
		$revision = new Revision();
		$request = $this->request->getPost();
		$result = $revision->edit($request);
		$message = $result->isError() ? $result->getErrors() : ['Запись изменена'];

		$html = view('header');
		$html .= view('open_form');
		$html .= view('message_view', ['messages'=>$message]);
		return $html;
	}

	public function delete()
	{
		$revision = new Revision();
		$request = $this->request->getPost();

		$result = $revision->delete($request);
		$message = $result->isError() ? $result->getErrors() : ['Запись удалена'];

		$html = view('header');
		$html .= view('open_form');
		$html .= view('message_view', ['messages'=>$message]);
		return $html;
	}
}
