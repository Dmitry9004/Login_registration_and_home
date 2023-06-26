<?php
	$conn = null;
	 function get_connection(){
	 		try{
				$conn = mysqli_connect("127.0.0.1", "root", "", "users");
			}catch(Exception $e){
				return null;		
			}
			if(mysqli_connect_errno()){
				return null;
		}
		return $conn;
	}

	$conn_enter = null;
	function get_connection_enter(){
		try{
			$conn_enter = mysqli_connect("127.0.0.1", "root", "", "users_enter");
		}catch(Exception $e){
			return null;
		}
		if(mysqli_connect_errno()){
			return null;
		}
		return $conn_enter;
	}
?>