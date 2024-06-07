<?php

namespace App\Libraries;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Shared\Date as SharedDate;

class MyData
{
	static $revision_struct = [
		[
			'name'	=> 'revision_id',
			'label'	=> '№',
			'type'	=> 'number',
			'pattern' => '/^[_\d]{1,6}$/',
			'search_pattern' => '/^[%_\d]?[_\d]{1,4}[%_\d]?$/',
			'default_value' => '%',
		],[
			'name'	=> 'smp_title',
			'label'	=> 'Проверяемый СМП',
			'type'	=> 'text',
			'pattern' => '/^[\w\s]{1,50}$/u',
			'search_pattern' => '/^[\w%]?[\w\s]{1,48}[\w%]?$/u',
			'default_value' => '%',
		],[
			'name'	=> 'inspector_title',
			'label'	=> 'Контролирующий орган',
			'type'	=> 'text',
			'pattern' => '/^[\w\s]{1,50}$/u',
			'search_pattern' => '/^[\w%]?[\w\s]{1,48}[\w%]?$/u',
			'default_value' => '%',
		],[
			'name'	=> 'revision_start',
			'label'	=> 'Начало проверки',
			'type'	=> 'date',
			'pattern' => '/^\d{4}-\d{2}-\d{2}$/',
			'search_pattern' => '/^\d{4}-\d{2}-\d{2}$/',
			'default_value' => '1900-01-01',
		],[
			'name'	=> 'revision_stop',
			'label'	=> 'Окончание проверки',
			'type'	=> 'date',
			'pattern' => '/^\d{4}-\d{2}-\d{2}$/',
			'search_pattern' => '/^\d{4}-\d{2}-\d{2}$/',
			'default_value' => '2100-12-31',
		],[
			'name'	=> 'revision_duration',
			'label'	=> 'Плановая длительность проверки',
			'type'	=> 'number',
			'pattern' => '/^[_\d]{1,6}$/',
			'search_pattern' => '/^[%_\d][_\d]{1,4}[%_\d]$/',
			'default_value' => '%',
		]
	];

	static $revision = [
		'revision_id' => [
			'label'	=> '№',
			'type'	=> 'number',
			'pattern' => '/^[_\d]{1,6}$/',
			'search_pattern' => '/^[%_\d]?[_\d]{1,4}[%_\d]?$/',
			'default_value' => '%',
		],
		'smp_title' => [
			'label'	=> 'Проверяемый СМП',
			'type'	=> 'text',
			'pattern' => '/^[\w\s]{1,50}$/u',
			'search_pattern' => '/^[\w%]?[\w\s]{1,48}[\w%]?$/u',
			'default_value' => '%',
		],
		'inspector_title' => [
			'label'	=> 'Контролирующий орган',
			'type'	=> 'text',
			'pattern' => '/^[\w\s]{1,50}$/u',
			'search_pattern' => '/^[\w%]?[\w\s]{1,48}[\w%]?$/u',
			'default_value' => '%',
		],
		'revision_start'=> [
			'label'	=> 'Начало проверки',
			'type'	=> 'date',
			'pattern' => '/^\d{4}-\d{2}-\d{2}$/',
			'search_pattern' => '/^\d{4}-\d{2}-\d{2}$/',
			'default_value' => '1900-01-01',
		],
		'revision_stop'=> [
			'label'	=> 'Окончание проверки',
			'type'	=> 'date',
			'pattern' => '/^\d{4}-\d{2}-\d{2}$/',
			'search_pattern' => '/^\d{4}-\d{2}-\d{2}$/',
			'default_value' => '2100-12-31',
		],
		'revision_duration' => [
			'label'	=> 'Плановая длительность проверки',
			'type'	=> 'number',
			'pattern' => '/^[_\d]{1,6}$/',
			'search_pattern' => '/^[%_\d][_\d]{1,4}[%_\d]$/',
			'default_value' => '%',
		]
	];
}
