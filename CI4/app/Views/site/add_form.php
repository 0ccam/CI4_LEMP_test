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
<h2>Добавление проверки</h2>
<h5>* новая проверка не должна пересекаться по времени с уже созданными при прочих равных значениях</h5>
<div class="container">
  <form action="add" method="POST" >
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
      <select id="smp_title" name="country">
	<?php foreach ($smp_list as $smp) {
		echo "<option value='{$smp['title']}'>{$smp['title']}</option>";
	}?>
      </select>
    </div>
  <div class="row">
    <div class="col-25">
      <label for="inspector_title">Контролирующий орган</label>
    </div>
    <div class="col-75">
      <select id="inspector_title" name="country">
	<?php foreach ($inspector_list as $ins) {
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
      <input type="date" id="revision_start" name="revision_start">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="revision_stop">Окончание проверки, до</label>
    </div>
    <div class="col-75">
      <input type="date" id="revision_stop" name="revision_stop">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="revision_duration">Плановая длительность проверки</label>
    </div>
    <div class="col-75">
      <input type="number" id="revision_duration" name="revision_duration">
    </div>
  </div>
<!--
  <div class="row">
    <div class="col-25">
      <label for="country">Country</label>
    </div>
    <div class="col-75">
      <select id="country" name="country">
        <option value="australia">Australia</option>
        <option value="canada">Canada</option>
        <option value="usa">USA</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="subject">Subject</label>
    </div>
    <div class="col-75">
      <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
    </div>
  </div>
-->
  <br>
  <div class="row">
    <input type="submit" value="Добавить">
  </div>
  </form>
</div>
</div>