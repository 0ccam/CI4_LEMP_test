<style>
/**=/
input[type="date"] {
  background-color: red;
  outline: none;
}

/**=/
input[type="date"] {
  font-size: 14px;
  height: 40px;
  position: relative;
}

/**=/
input[type="number"] {
  font-size: 14px;
  height: 40px;
  position: relative;
}
/**=/
input[type="date"]::-webkit-inner-spin-button {
  height: 28px;
}

/**/
input[type="date"] {
  font-size: 18px;
}

/**/
input[type="number"] {
  font-size: 18px;
}
</style>
<!--  -->
<div class="card">
<h2>Редактировать запись о проверке</h2>
<div class="container">
  <form action="edit" method="POST" >
<!--
  <div class="row">
    <div class="col-25">
      <label for="revision_id">№</label>
    </div>
    <div class="col-75">
      <input type="text" id="revision_id" name="revision_id" placeholder="Id">
    </div>
  </div>
-->
  <div class="row">
    <div class="col-25">
      <label for="smp_title">Проверяемый СМП</label>
    </div>
    <div class="col-75">
      <select id="smp_title" name="smp_title"  value="<?php echo $defaults['smp_title']; ?>">
	<?php foreach ($smp_titles as $smp) {
		echo "<option value='{$smp['title']}'>{$smp['title']}</option>";
	}?>
      </select>
    </div>
  <div class="row">
    <div class="col-25">
      <label for="inspector_title">Контролирующий орган</label>
    </div>
    <div class="col-75">
      <select id="inspector_title" name="inspector_title"  value="<?php echo $defaults['inspector_title']; ?>">
	<?php foreach ($inspector_titles as $ins) {
		echo "<option value='{$ins['title']}'>{$ins['title']}</option>";
	}?>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="revision_start">Начало проверки, от</label>
    </div>
    <div class="col-75">
      <input type="date" id="revision_start" name="revision_start" value="<?php echo $defaults['revision_start']; ?>">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="revision_stop">Окончание проверки, до</label>
    </div>
    <div class="col-75">
      <input type="date" id="revision_stop" name="revision_stop" value="<?php echo $defaults['revision_stop']; ?>">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="revision_duration">Плановая длительность проверки</label>
    </div>
    <div class="col-75">
      <input type="number" id="revision_duration" name="revision_duration" value="<?php echo $defaults['revision_duration']; ?>">
    </div>
  </div>
  <br>
  <div class="row">
    <input type="submit" value="Сохранить">
  </div>
  </form>
</div>
</div>