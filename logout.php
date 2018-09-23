<?php
	session_save_path('/webpages/msmelik/sessions');
    ini_set('session.gc_probability',1);
	session_start();
	unset($_SESSION['user']);
	unset($_SESSION['type']);
	unset($_SESSION['id']);
	header("Location: login.html");
	die();
?>
