<?php
/**=/
foreach ($argv as $key => $value) {
	echo "$key =>" . gettype($value). "<br>";
}

/**/
function ifset($arr, $key) {
	echo (isset($arr) and (gettype($arr) == 'array') and array_key_exists($key,$arr)) ? $arr[$key] : '';
}?>

<!--  -->
<div class="card">
<h2>Перечень плановых проверок</h2>
<h5><b>%</b> заменяет любое количество любых символов в начале и/или конце фразы <b>_</b> заменяет один любой символ Формат даты <b>гггг-мм-дд</b></h5>
<div class="container">
  <form action="search" method="POST" >
  <div class="row">
    <div class="col-25">
      <label for="revision_id">№</label>
    </div>
    <div class="col-75">
      <input type="text" id="revision_id" name="revision_id" placeholder="%, _, буква или цифра" value="<?php ifset($defaults, 'revision_id')?>">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="smp_title">Проверяемый СМП</label>
    </div>
    <div class="col-75">
      <input type="text" id="smp_title" name="smp_title" placeholder="%, _, буквы или цифры" value="<?php ifset($defaults, 'smp_title')?>">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="inspector_title">Контролирующий орган</label>
    </div>
    <div class="col-75">
      <input type="text" id="inspector_title" name="inspector_title" placeholder="%, _, буквы или цифры" value="<?php ifset($defaults, 'inspector_title')?>">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="revision_start">Начало проверки, от</label>
    </div>
    <div class="col-75">
      <input type="text" id="revision_start" name="revision_start" placeholder="Вести поиск от этой даты" value="<?php ifset($defaults, 'revision_start')?>">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="revision_stop">Окончание проверки, до</label>
    </div>
    <div class="col-75">
      <input type="text" id="revision_stop" name="revision_stop" placeholder="Вести поиск до этой даты" value="<?php ifset($defaults, 'revision_stop')?>">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="revision_duration">Плановая длительность проверки</label>
    </div>
    <div class="col-75">
      <input type="text" id="revision_duration" name="revision_duration" placeholder="%, _ или цифры" value="<?php ifset($defaults, 'revision_duration')?>">
    </div>
  </div>
  <br>
  <div class="row">
    <input type="submit" value="Искать">
  </div>
  </form>
</div>
</div>