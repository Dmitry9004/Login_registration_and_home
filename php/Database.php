<?php
//!!!!!!! SQL FOR CREATE DATABASE AND TABLES IN MYSQL
//
//CREATE DATABASE users;
//
//CREATE TABLE users(
// id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
// login varchar(255) NOT NULL UNIQUE,
// password varchar(255) NOT NULL,
// name varchar(255) NOT NULL,
// photo varchar(255) NOT NULL,
// date_birth date NOT NULL
//)
//


	$conn = null;
	 function get_connection(){
	 		try{
				// here your servername, username, password, nameDB
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
			// here your servername, username, password, nameDB
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
