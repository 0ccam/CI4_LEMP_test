<?php

helper('form');

echo form_open_multipart('import', ' class="form-style-2"');
echo form_label('Добавить данные из Excel файла');
echo form_upload('userfile');
echo form_submit('submit', 'Добавить');
echo form_close();