<!DOCTYPE html>
<html>
<head>
	<title>Registry</title>
	<link rel = "stylesheet" type = "text/css" href = "registry.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class = "section_registry">
	<form class = "form_registry" enctype="multipart/form-data" action = "registry_enter.php" method="post">
			
			<?php if(isset($_GET['message']) && $_GET['message'] == "error_login"){ echo "<span class = 'error message'>Choice another login</span>";}?>
			<label for = "login" >Your login:</label>
			<input id = "login" type="text" name="login" required pattern="\w{3,14}"  minlength=3 maxlength=14>

			<label for = "password" >Your password:</label>
			<input id = "password" type="password" name="password" required pattern="\w{8,}"  minlength=8>

			<label for = "passwordT" >Your password is repeated:</label>
			<input id = "password_ex" type="password" name="passwordT" required pattern="\w{8,}"  minlength=8>

			<label for = "name" >Your name:</label>
			<input id = "name" type="text" name="name" required pattern="\w{3,14}"  minlength=2 maxlength=14>

			<label for = "photo">Your photo:</label>
			<input id = "file" type="file" name="photo" required>

			<label for = "date">Your date of birth:</label>
			<input id = "date" type="date" name="date" required min = "1930-01-01" pattern="[0-9]{1,2}/[0-9]{1,2}/[0-9]{4}">

			<div class = "contain_sb"><input class = "submit" type = "submit" value = "Save" name = "submit_form"></div>
			<a class = "sign" href = "index.php">Sign In</a>

		</form>
	</div>

<script>
	let login = document.getElementById('login');
	let password = document.getElementById("password");
	let password_ex = document.getElementById("password_ex");
	let name = document.getElementById("name");
	let date = document.getElementById("date");
	let now = new Date();
	let m = now.getMonth() > 9?now.getMonth():"0"+now.getMonth();
	let d = now.getDay() > 9?now.getDay():"0"+now.getDay();
	date.setAttribute("max", now.getFullYear()+"-"+m+"-"+d);
	let file = document.getElementById("file");
	let ALLOWED_EX = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

	function error(item){
			if(item.classList.contains("valid")){
				item.classList.remove("valid");
			}
			
			item.classList.add("error");
	}
	function valid(item){
			if(item.classList.contains("error")){
				item.classList.remove("error");
			}
			
			item.classList.add("valid");
			item.setCustomValidity("");	
	}

	login.addEventListener("input",function(){
		if(login.validity.tooLong){
			error(login);
			login.setCustomValidity("Login should be less than 15 characters");
		}else if(login.validity.tooShort){
			error(login);
			login.setCustomValidity("Login should be more than 2 characters");
		}else if(login.validity.patternMismatch){
			error(login);
			login.setCustomValidity("Login should contain only Latin letters or/and numbers");
		}else if(login.value == ""){
			error(login);
		}
		else if(!login.validity.patternMismatch){
			valid(login);
		}
	});

	password.addEventListener("input", function(){
		if(password.validity.patternMismatch){
			error(password);
			error(password_ex);
			password.setCustomValidity("Password should contain only Latin letters or/and numbers");
		}else if(password.value != password_ex.value){
			error(password);
			error(password_ex);
			password.setCustomValidity("Passwords don't equal");
		}else if(password.value == ""){
			error(password);
		}else if(!password.validity.patternMismatch){
			if(!password_ex.validity.patternMismatch){
				valid(password_ex);
			}
			valid(password);
		}
	});
	password_ex.addEventListener("input", function(){
		if(password.value != password_ex.value){
			error(password);
			password.setCustomValidity("Passwords don't equal");
		}else if(!password.validity.patternMismatch && !password_ex.validity.patternMismatch){
			valid(password_ex);
			valid(password)
		}else if(password_ex.value == ""){
			error(password_ex);
		}
		else{
			error(password_ex);
		}
	});
	name.addEventListener("input", function(){
		if(name.validity.tooLong){
			error(name);
			name.setCustomValidity("Name should be less than 20 characters");
		}else if(name.validity.patternMismatch){
			error(name);
			name.setCustomValidity("Name should contain only Latin letters or/and numbers");
		}else if(name.value == ""){
			error(name);
		}
		else if(!name.validity.patternMismatch){
			valid(name);
		}
	});

	date.addEventListener("change", function(){
		if(date.validity.patternMismatch){
			error(date);
			name.setCustomValidity("Incorrect date");
		}else if(date.validity.rangeUnderflow){
			error(date);
		}else if(date.validity.rangeOverflow){
			error(date);
		}
		else if(date.value == ""){
			error(date);
		}else{
			valid(date);
		}
	});

	file.addEventListener("change", function(){
		if(!ALLOWED_EX.exec(file.value)){
			error(file);
			file.setCustomValidity("Allowed file type: jpg jpeg png gif");
		}else{
			valid(file);
		}
	});


</script>
</body>
</html>