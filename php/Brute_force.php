<?php 	
require_once("Database.php");

	function get_tries($ip){
		$conn = get_connection_enter();
		try{
			$stm = $conn->prepare("SELECT * FROM users_enter WHERE ip = ?");
			$stm->bind_param("s",$ip);
			$stm->execute();

			$res = $stm->get_result();
			$row = $res->fetch_assoc();

			return $row['tries'];
		}catch(Exception $e){
			return null;
		}

}	
	
	function get_last_enter($ip){
			$conn = get_connection_enter();

		try{
			$stm = $conn->prepare("SELECT * FROM users_enter WHERE ip = ?");
			$stm->bind_param("s", $ip);
			$stm->execute();

			$res = $stm->get_result();
			$row = $res->fetch_assoc();

			return $row['last_enter'];	
		}catch(Exception $e){
			return null;
		}
}	

	function set_enter($ip, $tries, $last_enter){
		$conn = get_connection_enter();

		try{
			$stm = $conn->prepare("INSERT INTO users_enter(ip, tries, last_enter)  VALUES(?,?,?)");
			$stm->bind_param("sss", $ip, $tries, $last_enter);
			$stm->execute();
		}catch(Exception $e){
			return false;
		}

		return true;
	}

	function update_enter($ip, $tries, $last_enter){		
				$conn = get_connection_enter();

		try{
			$stm = $conn->prepare("UPDATE users_enter SET tries = ?, last_enter = ? WHERE ip=?");
			$stm->bind_param("sss", $tries, $last_enter, $ip);
			$stm->execute();
		}catch(Exception $e){
			return false;
		}

		return true;
	}
?>
