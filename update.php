<?php
 include('dbconnection.php');
if(isset($_POST["text"])){
	$date = $mysqli->real_escape_string($_POST['date']);
	$text = $mysqli->real_escape_string($_POST['text']);
	$tablename = $mysqli->real_escape_string($_POST['tablename']);
	$column = $mysqli->real_escape_string($_POST['column']);
	$querySelect= "SELECT `" . $column . "` FROM `" . $tablename . "` WHERE userid = '{$_SESSION["userId"]}' AND date = '".$date."'";

	$res = $mysqli->query($querySelect);
	 if ($res->num_rows > 0) {
	 	$query = "UPDATE `" . $tablename . "` SET `" . $column . "` = '".$text."' WHERE userid = '{$_SESSION["userId"]}' AND date = '".$date."'";
	 	if($mysqli->query($query))
		{
		echo "Update Successful";
		}
	}
	else{
		echo "Data to be updated is not in the database";
	}
	/*else{
	$query = "INSERT INTO `" . $tablename . "`(userid,date,`" . $column . "`) VALUES ('{$_SESSION["userId"]}', '".$date."', '".$text."')";
	//$result = mysqli->query($query);
	if($mysqli->query($query))
	{
		echo "Insert Successful";
	}
}*/
}
?>