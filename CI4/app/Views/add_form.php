<?php

function if_exist($arr, $key)
{
	return array_key_exists($key, $arr) ? $arr[$key] : '';
}

function getTitlesArray($array_of_arrays)
{
	$temp_array = [];
		if (!empty($array_of_arrays)) {
		foreach ($array_of_arrays as $smp) {
			$title = $smp['title'];
			$temp_array[$title] = $title;
		}
	}
	return $temp_array;
}


function addField($def_values, $params)
{
	$label = $params['label'];
	$name = $params['name'];
	$params['value'] = if_exist($def_values, $name);
	echo form_label($label, $name);
	echo form_input($params);
}


helper('form');

echo '<h3>Добавление проверки</h3>';
echo '* новая проверка не должна пересекаться по времени с уже созданными при прочих равных';
echo form_open('edit', 'method="POST" ');

echo form_label('Выберите СМП', 'smp_title');
echo form_dropdown('smp_title', getTitlesArray($smp_list), if_exist($defaults, 'smp_title'));

addField( $defaults, [
	'label' => 'Период проверки с',
	'name' => 'revision_start',
	'type' => 'date',
]);


addField( $defaults, [
	'label' => 'по',
	'name' => 'revision_stop',
	'type' => 'date',
]);

echo form_label('Контролирующий орган', 'inspector_title');
echo form_dropdown('inspector_title', getTitlesArray($inspector_list), if_exist($defaults, 'inspector_title'));

addField( $defaults, [
	'label' => 'Плановая длительность проверки',
	'name' => 'revision_duration',
	'type' => 'number',
	'min' => 1,
	'step' => 1,
	'max' => 10,
]);

echo form_submit('submit', 'Сохранить');
echo form_close();