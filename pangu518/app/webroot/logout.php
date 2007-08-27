<?php
	session_start();
	session_unregister("osLGflag");
	echo "<SCRIPT LANGUAGE='JavaScript'>location.replace('main.php');</SCRIPT>";
?>