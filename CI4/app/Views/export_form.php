<?php

helper('form');

echo form_open('export', 'method="GET"  class="form-style-2"', $hidden);
echo form_label('Экспортировать в Excel файл');
echo form_submit('submit', 'Экспортировать');
echo form_close();