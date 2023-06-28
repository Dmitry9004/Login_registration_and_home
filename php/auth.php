<?php 
	session_start();
	if(isset($_SESSION['logg']) && isset($_SESSION['id']) && $_SESSION['logg'] == true){
		header("Location: home.php".$_SESSION['id']);
	}

	$_SESSION['logg'] = false;
 	
 	require('Database.php');
 	$conn = get_connection();
 	if(!isset($conn) || $conn == null){
 		header("Location: index.php?message=error");
 	}

 	include("Brute_force.php");
 	$tries = get_tries($_SERVER['REMOTE_ADDR']);
 	$last_enter = get_last_enter($_SERVER['REMOTE_ADDR']);
 	
 	$limit_tries = 6;



 	if(isset($_POST['login']) && isset($_POST['password']) && ($_POST['login'] != "") && ($_POST['password'] !="")){

 		if(isset($tries) && isset($last_enter)){

 			if($tries < $limit_tries){
		 			$user = getUserByUsername($conn, $_POST['login'], $_POST['password']);

					if(isset($user)){
			 			$_SESSION['logg'] = true;
			 			$_SESSION['id'] = $user['id'];
			 			header("Location: home.php?id=".$user['id']);
			 		}else{
		 				update_enter($_SERVER['REMOTE_ADDR'], $tries+1, time());	
		 				header("Location: index.php?message=error");
				 	}
 			}else{
 				header("Location: manyTries.php");
 			}
		}else{
 			set_enter($_SERVER['REMOTE_ADDR'], 0, time());
 			header("Location: index.html?message=error");
 		}
	}

 	function getUserByUsername($conn, $login, $password){
 		$stm = $conn->prepare("SELECT * FROM users WHERE login=?");
 	 	$stm->bind_param("s", $login);
 	 	$stm->execute();

 	 	$res = $stm->get_result();
 	 	$row = $res->fetch_assoc();

 		if(password_verify($password, $row['password'])){
 			$user = array(
 				"id"=>$row['id']
 			);
 		return $user;
 	}
 }

 	function getUserById($conn, $id){
 		$stm = $conn->prepare("SELECT * FROM users WHERE id=?");
 	 	$stm->bind_param("s", $id);
 	 	$stm->execute();

 	 	$res = $stm->get_result();
 	 	$row = $res->fetch_assoc();

 		$user = array(
 				"id"=>$row['id']
 		);

 		return $user;
 	}
 	function brute_force_defend(){
 		if(!isset($_SESSION['try_pass'])){
 			$_SESSION['try_pass'] = 0;
 		}
 	}
?>
