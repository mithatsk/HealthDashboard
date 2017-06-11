<?php
 include('dbconnection.php');
 	$column = $mysqli->real_escape_string($_POST['column']);
 	$tablename = $mysqli->real_escape_string($_POST['tablename']);
 	if(!empty($_POST['column2']) && isset($_POST['column2'])){
 		$column2 = $mysqli->real_escape_string($_POST['column2']);	
 		if($column2 =="steps" || $column2 == "getup" || $column2 == "in_temp"){
 			$querySelect= "SELECT * FROM (SELECT date , `" . $column . "` , `" . $column2 . "` FROM `" . $tablename . "` WHERE userid = '{$_SESSION["userId"]}' AND `" . $column . "` IS NOT NULL AND `" . $column2 . "` IS NOT NULL ORDER BY date  DESC LIMIT 7)sub ORDER BY date ASC ";

 		}
 	}
 	else {
	$querySelect= "SELECT * FROM (SELECT date , `" . $column . "` FROM `" . $tablename . "` WHERE userid = '{$_SESSION["userId"]}' AND `" . $column . "` IS NOT NULL ORDER BY date  DESC LIMIT 7)sub ORDER BY date ASC";

	}
	$result = $mysqli->query($querySelect);
	 if ($result->num_rows > 0) {
	 	$data = array();
	 	foreach ($result as $row) {
	 		$data[] = $row;
	 	}
	 	$result->close();
	 	print json_encode($data);

	 }

?>