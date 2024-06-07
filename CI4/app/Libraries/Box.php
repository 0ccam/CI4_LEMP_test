<?php

namespace App\Libraries;

class Box // хранилище для возврата
{
	private $data;
	private $errors;

	public function addData($data)
	{
		$this->data = $data; // простое присваивание
	}

	public function addError($error)
	{
		$this->errors[] = $error; // добавление в конец списка
	}

	public function getData()
	{
		return $this->data;
	}

	public function getErrors()
	{
		return $this->errors;
	}

	public function isData()
	{
		return !empty($this->data);
	}

	public function isError()
	{
		return !empty($this->errors);
	}
}