<?php

helper('form');

echo form_open_multipart('import', '');
echo form_label('Добавить данные из Excel файла');
echo form_upload('userfile');
echo form_submit('submit', 'Добавить');
echo form_close();