<?php

	session_start();
	unset($_SESSION['sess2']);
	echo "<script>window.open('../residents', '_self');</script>";

?>