<style>
/**/
input[type="file"] {
  font-size: 18px;
}
</style>
<!--  -->
<div class="card">
	<h2>Добавить данные из Excel файла</h2>
	<div class="container">
		<div class="row">
			<form enctype="multipart/form-data" action="import" method="POST">
				<div class="col-25">
					<input type="file" name="userfile">
				</div>
				<div class="col-75">
					<input type="submit" value="Отправить">
				</div>
			</form>
		</div>
	</div>
</div>