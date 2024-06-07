<?php

helper('form');
//echo '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/form.css">';
echo '<h3>Перечень плановых проверок</h3>';
echo form_open('search', 'method="POST" ');
echo "<b>%</b> заменяет любое количество любых символов в начале и/или конце фразы<br><b>_</b> заменяет один любой символ<br>Формат даты <b>гггг-мм-дд</b><br>";

function addField($def_values, $params)
{
	$label = $params['label'];
	$name = $params['name'];
	$params['value'] = $def_values[$name] ?? '';
	echo form_label($label, $name);
	echo form_input($params);
}

addField( $defaults,
[
	'label' => '№',
	'name' => 'revision_id',
	'type' => 'text',
]);

addField( $defaults,
[
	'label' => 'Проверяемый СМП',
	'name' => 'smp_title',
	'type' => 'text',
]);

addField( $defaults,
[
	'label' => 'Контролирующий орган',
	'name' => 'inspector_title',
	'type' => 'text',
]);

addField( $defaults,
[
	'label' => 'Начало проверки, от',
	'name' => 'revision_start',
	'type' => 'text',
]);

addField( $defaults,
[
	'label' => 'Окончание проверки, до',
	'name' => 'revision_stop',
	'type' => 'text',
]);

addField( $defaults,
[
	'label' => 'Плановая длительность проверки',
	'name' => 'revision_duration',
	'type' => 'text',
]);

echo form_submit('submit', 'Искать');
echo form_close();