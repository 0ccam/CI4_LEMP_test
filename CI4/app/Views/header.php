<?php

/**=/
/**/
echo '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/style.css">';
//echo '<link rel="stylesheet" type="text/css" href="' . base_url() . 'css/form.css">';

echo '<div class="header">
  <h1>Заголовок сайта</h1>
</div>';

echo '<div class="topnav">';
echo anchor('', 'Поиск');
echo anchor('add', 'Добавить');
echo anchor('open', 'Открыть');
echo '</div>';
