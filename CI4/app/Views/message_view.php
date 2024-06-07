<?php

/**=/
foreach ($messages as $msg) {
	echo '<b>' . $msg . '</b><br>';
}

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

print_msgs($messages, '');