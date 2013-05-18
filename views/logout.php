<?php
	session_checkstart();
	session_destroy();
	header("location:login.php");
?>