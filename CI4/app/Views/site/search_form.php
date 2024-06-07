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
      <input type="text" id="revision_id" name="revision_id" placeholder="Your name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="smp_title">Проверяемый СМП</label>
    </div>
    <div class="col-75">
      <input type="text" id="smp_title" name="smp_title" placeholder="Your last name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="inspector_title">Контролирующий орган</label>
    </div>
    <div class="col-75">
      <input type="text" id="inspector_title" name="inspector_title" placeholder="Your name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="revision_start">Начало проверки, от</label>
    </div>
    <div class="col-75">
      <input type="text" id="revision_start" name="revision_start" placeholder="Your name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="revision_stop">Окончание проверки, до</label>
    </div>
    <div class="col-75">
      <input type="text" id="revision_stop" name="revision_stop" placeholder="Your name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="revision_duration">Плановая длительность проверки</label>
    </div>
    <div class="col-75">
      <input type="text" id="revision_duration" name="revision_duration" placeholder="Your name..">
    </div>
  </div>
  <br>
  <div class="row">
    <input type="submit" value="Искать">
  </div>
  </form>
</div>
</div>