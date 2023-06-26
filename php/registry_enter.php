
<?php
	error_reporting(0);
	if(isset($_POST['login']) && isset($_POST['password'])){
		require_once('Database.php');

		$conn = get_connection();

		$login = $_POST['login'];

		$stm = $conn->prepare("SELECT * FROM users WHERE login=?");
		$stm->bind_param("s", $login);
		$stm->execute();

		$res = $stm->get_result();
		$row = $res->fetch_assoc();

		if(isset($row['id'])){
			header("Location: registry.php?message=error_login");
		}

		$password = $_POST['password'];
		$name = $_POST['name'];
		
		//here path to save space 
		$folder = "/xampp_one/htdocs/images/";
		$date = $_POST['date'];


		$stm_n = $conn->prepare("INSERT INTO users (login, password, name, photo, date_birth) VALUES(?,?,?,?,?)");
		$stm_n->bind_param("sssss", $login, password_hash($password, PASSWORD_BCRYPT), $name, $login, $date);

		try{
			if($stm_n->execute() && move_uploaded_file($_FILES["photo"]["tmp_name"],"$folder".$login)){
				header('Location: index.php');
			}else{
				header("Location: registry.php?message=error");
			}
	}catch(Exception $e){
			echo $e;
		}
}
?>
