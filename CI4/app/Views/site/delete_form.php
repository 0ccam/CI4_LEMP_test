<!--  -->
<div class="card">
	<h2>Удалить запись</h2>
	<div class="container">
		<div class="row">
			<form action="delete" method="POST"   accept-charset="utf-8">
			<input type="hidden" name="revision_id" value="<?php echo $hidden['revision_id'];?>">
			<input type="submit" name="submit" value="Удалить">
			</form>
		</div>
	</div>
</div>