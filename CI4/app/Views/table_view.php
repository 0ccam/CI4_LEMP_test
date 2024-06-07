<?php

use App\Libraries\MyData as MyData;

$table = new \CodeIgniter\View\Table();
//echo '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/table.css">';
$template = ['table_open' => '<table border="1" width="100%" cellpadding="2" cellspacing="1" class="table">',];
$table->setTemplate($template);
$table->setCaption('<h3>Результаты поиска</h3>');
$table->setHeading($table_header)->setSyncRowsWithHeading(true);
echo $table->generate($table_body);