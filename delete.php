<?php
 include('dbconnection.php');
if(isset($_POST["date"])){
	$date = $mysqli->real_escape_string($_POST['date']);
	$tablename = $mysqli->real_escape_string($_POST['tablename']);
	$column = $mysqli->real_escape_string($_POST['column']);
	$querySelect= "SELECT `" . $column . "` FROM `" . $tablename . "` WHERE userid = '{$_SESSION["userId"]}' AND date = '".$date."'";

	$res = $mysqli->query($querySelect);
	 if ($res->num_rows > 0) {
	 	$query = "UPDATE `" . $tablename . "` SET `" . $column . "` = NULL WHERE userid = '{$_SESSION["userId"]}' AND date = '".$date."'";
	 	if($mysqli->query($query))
		{
		echo "Delete Successful";
		}
	}else{
		echo "Data to be deleted is not in the database";
	}
}
?>