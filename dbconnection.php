<?php
session_name('Website');
session_start();
$host = "localhost";
$user = "mitkas16";
$pwd = "9QOHmyIDRo";
$db = "mitkas16_db";
$mysqli = new mysqli($host, $user, $pwd, $db);
?>