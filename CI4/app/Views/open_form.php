<?php

helper('form');

echo '<h3>Открыть данные проверки</h3>';
echo form_open('open', 'method="POST" ');
echo form_label('Введите номер записи о проверке', 'revision_id');
echo form_input('revision_id');
echo form_submit('submit', 'Открыть');
echo form_close();