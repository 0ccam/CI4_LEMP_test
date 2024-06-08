<!--  -->
<div class="card">
	<h2>Экспортировать в Excel файл</h2>
	<div class="container">
		<div class="row">
			<form action="export" method="GET"   accept-charset="utf-8">
			<input type="hidden" name="revision_id" value="<?php echo $hidden['revision_id'];?>">
			<input type="hidden" name="smp_title" value="<?php echo $hidden['smp_title'];?>">
			<input type="hidden" name="inspector_title" value="<?php echo $hidden['inspector_title'];?>">
			<input type="hidden" name="revision_start" value="<?php echo $hidden['revision_start'];?>">
			<input type="hidden" name="revision_stop" value="<?php echo $hidden['revision_stop'];?>">
			<input type="hidden" name="revision_duration" value="<?php echo $hidden['revision_duration'];?>">
			<input type="submit" name="submit" value="Экспортировать">
			</form>
		</div>
	</div>
</div>