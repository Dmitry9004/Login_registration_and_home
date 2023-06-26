<?php 
	session_start();

	if(!isset($_GET['id'])){
		header("Location: index.php");
	}else if(!isset($_SESSION['id']) || $_SESSION['id'] != $_GET['id'] || !isset($_SESSION['logg'])){
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel = "stylesheet" type = "text/css" href = "home.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inconsolata&display=swap" rel="stylesheet">
</head>
<?php 
	if(isset($_GET['id'])){
		require("database.php");
		$conn = get_connection();
		if(isset($conn)){
			try{
		$stm = $conn->prepare("SELECT * FROM users WHERE id=?");
		$stm->bind_param("s", $_GET['id']);
		$stm->execute();

		$res = $stm->get_result();
		$row = $res->fetch_assoc();
	}catch(Exception $e){
		throw Exception;
		}
	}
}
?>
<body onload="success()">


	<div class = "success" id = "message">
		<span class = "suc">Successful authorization!</span>
	</div>

	<div class = "main_container">
		<a class = "logout" id = "logout" href = "logout.php">logout</a>
	<div class = "person_container">

	<span class = "border"></span>
	<div class = "person">
		<div class = "about">
		<img class = "photo" src = "images/<?php echo $row['photo'];?>"/>
		<span class = "name"> <?php echo $row['name'];?></span>
		<span class = "date"><?php echo $row['date_birth'];?></span>
	</div>
	</div>
</div>
</div>

<script type="text/javascript">

function success(){
	setTimeout(function(){
		document.getElementById('message').classList.add("message_none");
	}, 5000);
}

</script>
</body>
</html>

