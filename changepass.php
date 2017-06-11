<?php
 include('dbconnection.php');
if(isset($_POST["password"])){
	$password = $mysqli->real_escape_string($_POST['password']);
	$newpassword = $mysqli->real_escape_string($_POST['newpassword']);
	$querySelect= "SELECT * FROM  Persons WHERE userid = '{$_SESSION["userId"]}' AND password = '".$password."'";

	$res = $mysqli->query($querySelect);
	 if ($res->num_rows > 0) {
	 	$query = "UPDATE Persons SET password = '".$newpassword."' WHERE userid = '{$_SESSION["userId"]}' AND password = '".$password."'";
	 	if($mysqli->query($query))
		{
		echo "Password changed";
		}
	}
	else{
		echo "Wrong password";
	}
	
}
?>