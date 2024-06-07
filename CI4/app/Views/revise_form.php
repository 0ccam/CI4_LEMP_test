<?php

use App\Libraries\MyData as MyData;

helper('form');

function addField($values , $name, $label, $type){
	echo form_label($label, $name);
	echo form_input([
		'name'	=> $name,
		'type'	=> $type,
		'value'	=> (array_key_exists($name, $values)) ? $values[$name] : '',
	]);
}

echo '<h3>' . $title . '</h3>';
echo form_open($action, 'method="GET" ');


foreach (MyData::$revision_struct as $elem) {
	if (in_array($elem['name'], $ignore)) continue;
//foreach ($fields as $name) {
	//$elem  = MyData::$revision[$name];
	addField($defaults, $elem['name'], $elem['label'], $elem['type']);
}
echo form_submit('submit', $button);
echo form_close();