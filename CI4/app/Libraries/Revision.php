<?php

namespace App\Libraries;
use App\Libraries\MyData as MyData;
use App\Libraries\Excel as Excel;
use App\Libraries\Box as Box;

class Revision
{
	private $revision_id_pattern = [
		// всего возможно от 1 до 6 цифр
		'revision_id' => '/^\d{1,6}$/'
	];

	private $add_patterns = [
		// всего возможно от 1 до 6 цифр
		'revision_duration' => '/^\d{1,6}$/',
		 //  От 1 до 50 букв, цифр или пробелов
		'smp_title' => '/^[\w\s]{1,50}$/u',
		'inspector_title' => '/^[\w\s]{1,50}$/u',
		// Дата yyyy-mm-dd
		'revision_start' => '/^\d{4}-\d{2}-\d{2}$/',
		'revision_stop' => '/^\d{4}-\d{2}-\d{2}$/',	
	];


	private $search_patterns = [
		// % в начале или в конце заменяет любое количество любых символов, _ заменяет один любой символ
		 // всего возможно от 1 до 6 цифр
		'revision_id' => '/^[%]?[_\d]{0,6}[%]?$/',
		'revision_duration' => '/^[%]?[_\d]{0,6}[%]?$/',
		 //  От 1 до 50 букв, цифр или пробелов
		'smp_title' => '/^%?[\w\s]{0,50}%?$/u',
		'inspector_title' => '/^%?[\w\s]{0,50}%?$/u',
		// Дата yyyy-mm-dd
		'revision_start' =>  '/^\d{4}-\d{2}-\d{2}$/', // '/^[%]?[_\-\d]{0,10}[%]?$/',
		'revision_stop' =>  '/^\d{4}-\d{2}-\d{2}$/', // '/^[%]?[_\-\d]{0,10}[%]?$/',	
	];


	/* Проверка соответствия данных шаблону */
	public function validation($data, $patterns): ?string
	{
		foreach ($patterns as $name => $pattern) {
			if (!array_key_exists($name, $data))
				return "Отсутствует параметр `$name`";
			if (!$data[$name])
				return "Значение параметра `$name`не установлено";
			$value = $data[$name];
			if (!preg_match($pattern, $value))
				return "Значение `$value` параметра `$name`не соответствует регулярному выражению `$pattern`";
		}

		$parsed = date_parse_from_format('Y-m-d', $data['revision_start']);
		if ($parsed['warning_count'] != 0)
			return "Некорректное значение даты {$data['revision_start']}";
		$parsed = date_parse_from_format('Y-m-d', $data['revision_stop']);
		if ($parsed['warning_count'] != 0)
			return "Некорректное значение даты {$data['revision_stop']}";
		if ($data['revision_start'] > $data['revision_stop'])
			return "Дата окончания должна быть больше или равна дате начала";
		return null;
	}


	public function getHeader(): array
	{
		$names = array_column(MyData::$revision_struct, 'name');
		$labels = array_column(MyData::$revision_struct, 'label');
		foreach ($names as $key => $name) {
			$header[$name] = $labels[$key];
		}
		return $header;
	}


	public function getSmpTitles(): Box
	{
		$box = new Box();
		$db = db_connect();
		$query = $db->query("SELECT title FROM smp ORDER BY title;");
		$result = $query->getResult('array');
		$box->addData($result);
		return $box;
	}


	public function getInspectorTitles(): Box
	{
		$box = new Box();
		$db = db_connect();
		$query = $db->query("SELECT title FROM inspector ORDER BY title;");
		$result = $query->getResult('array');
		$box->addData($result);
		return $box;
	}


	public function getRevision($revision_id)
	{
		$box = new Box();

		if (!preg_match('/^\d{1,6}$/', $revision_id)) {
			$box->addError("Неверный формат числа");
			return $box;
		}
		$db = db_connect();
		$revise = $db->query("SELECT * FROM revise WHERE revise.id = $revision_id;")->getResult('array');
		if (empty($revise)) {
			$box->addError("Не найдено");
			return $box;
		}

		$sql = "
		SELECT
			r.id AS revision_id,
			s.title AS smp_title,
			i.title AS inspector_title,
			r.revise_start AS revision_start,
			r.revise_stop AS revision_stop,
			r.duration AS revision_duration
		FROM
			smp AS s,
			inspector AS i,
			revise AS r
		WHERE
			r.id = $revision_id AND
			s.id = r.smp_id AND i.id = r.inspector_id
		ORDER BY r.id";

		$query = $db->query($sql);
		$result = $query->getRowArray();

		$box->addData($result);
		return $box;
	}


	/* Поиск записей в БД о ревизиях по входным данным */
	public function search($data): Box
	{
		$box = new Box();

		$valid_error = $this->validation($data, $this->search_patterns);
		if ($valid_error) {
			$box->addError($valid_error);
			return $box;
		}

		/*  Получение реестра из БД */
		$db = db_connect();
		$sql = "
			SELECT
				r.id AS revision_id,
				s.title AS smp_title,
				i.title AS inspector_title,
				r.revise_start AS revision_start,
				r.revise_stop AS revision_stop,
				r.duration AS revision_duration
			FROM
				smp AS s,
				inspector AS i,
				revise AS r
			WHERE
				s.title LIKE '{$data['smp_title']}' AND
				i.title  LIKE '{$data['inspector_title']}' AND
				r.id LIKE '{$data['revision_id']}' AND
				r.duration LIKE '{$data['revision_duration']}' AND
				r.revise_start <= '{$data['revision_stop']}' AND
				r.revise_stop >= '{$data['revision_start']}'  AND
				s.id = r.smp_id AND
				i.id = r.inspector_id
			ORDER BY r.id";

		$query = $db->query($sql);
		$result = $query->getResult('array');
		$box->addData($result);
		return $box;
	}


	/* Создание записи о ревизии */
	public function add($data): Box
	{
		$box = new Box();

		$valid_error = $this->validation($data, $this->add_patterns);
		if ($valid_error) {
			$box->addError($valid_error);
			return $box;
		}

		/* Проверить на наличие подобных записей */
		$found = $this->search($data);
		if ($found->isData()) {
			$box->addError('Подобные записи уже существуют');
			return $box;
		}

		/* Подключиться к БД */
		$db = db_connect();
		/* Создать запись о СМП, если не существует */
		$db->query("INSERT IGNORE smp (title) VALUES ('{$data['smp_title']}');");
		/* Создать запись о контролирующем органе, если не существует */
		$db->query("INSERT IGNORE inspector (title) VALUES ('{$data['inspector_title']}');");
		/* Создать запись о проверке */
		$db->query("
			INSERT revise (
				`smp_id`,
				`inspector_id`,
				`duration`,
				`revise_start`,
				`revise_stop`) 
			VALUES (
				(SELECT id FROM smp WHERE title='{$data['smp_title']}'),
				(SELECT id FROM inspector WHERE title='{$data['inspector_title']}'),
				{$data['revision_duration']},
				'{$data['revision_start']}',
				'{$data['revision_stop']}');"
		);
		return $box;
	}


	/* Редактирование записи о ревизии */
	public function edit($data): Box
	{
		$box = new Box();

		$valid_error = $this->validation($data, $this->revision_id_pattern);
		if ($valid_error) {
			$box->addError($valid_error);
			return $box;
		}

		$valid_error = $this->validation($data, $this->add_patterns);
		if ($valid_error) {
			$box->addError($valid_error);
			return $box;
		}

		/* Проверить на наличие подобных записей */
		$revise = $this->getRevision($data['revision_id']);
		if (!$revise->isData()) {
			$box->addError('Нет записи с таким номером');
			return $box;
		}
		if ($revise->isError()) {
			$box->addError($revise->getErrors());
			return $box;
		}

		/* Подключиться к БД */
		$db = db_connect();
		/* Создать запись о СМП, если не существует */
		$db->query("INSERT IGNORE smp (title) VALUES ('{$data['smp_title']}');");
		/* Создать запись о контролирующем органе, если не существует */
		$db->query("INSERT IGNORE inspector (title) VALUES ('{$data['inspector_title']}');");
		/* Создать запись о проверке */
		$db->query("
			UPDATE revise
			SET `smp_id` = (SELECT id FROM smp WHERE title='{$data['smp_title']}'),
				`inspector_id` = (SELECT id FROM inspector WHERE title='{$data['inspector_title']}'),
				`duration` = {$data['revision_duration']},
				`revise_start` = '{$data['revision_start']}',
				`revise_stop` = '{$data['revision_stop']}'
			WHERE revise.id = {$data['revision_id']};"
			);
		return $box;
	}

	/* Удаление записи о ревизии */
	public function delete($data): Box
	{
		$box = new Box();
		var_dump($data);
		/* Проверить на наличие подобной записи */
		$result = $this->getRevision($data['revision_id']);
		if (!$result->isData()) {
			$box->addError('Нет подходящей записи');
			return $box;
		}
		if ($result->isError()) {
			$box->addError($result->getErrors());
			return $box;
		}

		/* Подключиться к БД */
		$db = db_connect();
		/* Удалить запись о проверке */
		$db->query("DELETE FROM revise WHERE `revise`.`id` = {$data['revision_id']};");

		return $box;
	}
}
