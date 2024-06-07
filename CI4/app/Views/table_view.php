<?php

use App\Libraries\MyData as MyData;

$table = new \CodeIgniter\View\Table();
$template = ['table_open' => '<table border="1" width="100%" cellpadding="2" cellspacing="1" class="table">',];
$table->setCaption('<h3>Результаты поиска</h3>');
$table->setTemplate($template);
$table->setHeading($table_header)->setSyncRowsWithHeading(true);
echo $table->generate($table_body);