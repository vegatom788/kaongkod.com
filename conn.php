<?php
$server = "127.0.0.1";
$username = "u510162695_kaongkod";
$password = "1Kaongkod";
$dbname =  "u510162695_kaongkod";


$conn = new mysqli($server, $username, $password, $dbname);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
		echo "Connection Failed";
	}
	echo "Connection Success"; 
    ?>