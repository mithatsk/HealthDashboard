<?php
include('dbconnection.php');
	$username = $mysqli->real_escape_string($_POST['username']);
	$password = $mysqli->real_escape_string($_POST['password']);
if (isset($_POST['username']) and isset($_POST['password']) and !empty($_POST['username'])) {
	$querySelect= "SELECT * FROM Persons WHERE username = '{$username}' AND password = '{$password}' ";

	$res = $mysqli->query($querySelect);
	 if ($res->num_rows > 0) {
	 	echo "User with this username and password already exists";
	}else{

 	$query = <<<END
		INSERT INTO Persons(username,password)
 		VALUES('{$username}','{$password}')
END;
 if ($mysqli->query($query) != TRUE) {
 	echo "Failed to interact with database";
 }
  echo "Register successful";
}
}
?>