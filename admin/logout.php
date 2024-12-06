<?php

	session_start();
	unset($_SESSION['sess']);
	echo "<script>window.open('../admin', '_self');</script>";

?>