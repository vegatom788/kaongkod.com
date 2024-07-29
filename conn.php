<?php

// database credential
$host = "127.0.0.1:3306";
$dbname =  "u510162695_kaongkod";
$username = "u510162695_kaongkod";
$password = "1Kaongkod";

//create connection
	$conn = new mysqli($host, $username, $password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
		echo "Connection Failed";
	}
	echo "Connection Success"; 
?>

