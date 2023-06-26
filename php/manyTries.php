<?php
	include('Brute_force.php');
	$tries = get_tries($_SERVER['REMOTE_ADDR']);
	$last_try = get_last_enter($_SERVER['REMOTE_ADDR']); 
	$block_time = 60;
	$allow_tries = 6;

	if(!(time() - $last_try < $block_time)){
		update_enter($_SERVER['REMOTE_ADDR'], 0, time());
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Many Tries</title>
	<link rel = "stylesheet" type = "text/css" href = "manyTries.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
</head>
<body onload = "success()">
	<div class = "container_message">
		<a id = "message" class = "message">Many tries, wait 1 minute and reload page</a>
	</div>
</body>

<script type="text/javascript">
	
function success(){
	setTimeout(function(){
		document.getElementById('message').setAttribute("href","index.php");
	}, 60005);
}
</script>
</html>