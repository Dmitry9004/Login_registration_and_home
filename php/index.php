<?php 
	session_start();

	if(isset($_SESSION['id'])){
		header("Location: home.php?id=".$_SESSION['id']);
	}

	include('Brute_force.php');
	$tries = get_tries($_SERVER['REMOTE_ADDR']);
	$last_try = get_last_enter($_SERVER['REMOTE_ADDR']); 
	$allow_tries = 6;

	if((isset($last_try) && isset($tries)) && (($tries >= $allow_tries))){
		header("Location: manyTries.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Enter</title>
	<link rel = "stylesheet" type = "text/css" href = "index.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
</head>
<body>	
	<div class = "section_enter">

	<form id = "form" name = "form_enter"class = "form_enter" action = "auth.php" method="post">

		<span id = "error" class = "error message"
		<?php if(isset($_GET['message'])){echo "style='display:block'";}else{echo "style='display:none'";}?>
		>
		Wrong password or login</span>

		<label for = "login">Username:</label>
		 <input id = "login"type = "text" name = "login" pattern="\w{3,14}" required minlength=3 maxlength=14>

		 <label for = "password">Password:</label>
		<input id = "password" type="password" name="password" required>

	<div class = "contain_sb"><input class = "submit" type = "submit" value = "Save" name = "submit_form"></div> 


		<a class = "sign" href = "/registry.php">Sign Up</a>
	</form>

	<div id = "demo"></div>

<script type="text/javascript">
	let login = document.getElementById('login');

	login.addEventListener("input",function(){
		if(login.validity.tooLong){
			login.setCustomValidity("Login should be less than 15 characters");
		}else if(login.validity.tooShort){
			login.setCustomValidity("Login should be more than 2 characters");
		}else if(login.validity.patternMismatch){
			login.setCustomValidity("Login should contain only Latin letters or/and numbers");
		}
		else{
			login.setCustomValidity("");
		}
	});


</script>
</div>
</body>
</html>