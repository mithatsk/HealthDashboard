<?php
include('dbconnection.php');
if (isset($_POST['username']) and isset($_POST['password']) and !empty($_POST['username'])) {
$name = $mysqli->real_escape_string($_POST['username']);
 $pwd = $mysqli->real_escape_string($_POST['password']);
 $query = <<<END
SELECT username, password, userid FROM Persons
 WHERE username = '{$name}'
 AND password = '{$pwd}'
END;
 $result = $mysqli->query($query);
 if($result->num_rows > 0){
 	$row = $result->fetch_object();
 	$_SESSION["username"] = $row->username;
 	$_SESSION["userId"] = $row->userid;
 	$response_array['status'] = 'success'; 
 //	header("Location:home.php");
 } else {
 	echo "Wrong username or password.Try again";
 }
}else{
	echo "Username and pasword has to be entered";
}

?>