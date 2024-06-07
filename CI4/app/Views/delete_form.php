<?php

helper('form');

echo form_open('delete', 'method="POST" ', $hidden_data);
echo form_label('Удалить запись');
echo form_submit('submit', 'Удалить');
echo form_close();