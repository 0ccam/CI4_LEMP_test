<?php
/**/
function print_msgs($msgs, $char)
{
	if (gettype($msgs) == 'array') {
		$accum = "$char&#8627;";
		foreach ($msgs as $msg) {
			print_msgs($msg, $accum);
		}
	} else {
		echo "$char$msgs<br>";
	}
}
?>

<!--  -->
<div class="card">
	<h2>Системные сообщения</h2>
	<div class="container">
		<div class="row">
			<?php print_msgs($messages, '');?>
		</div>
	</div>
</div>