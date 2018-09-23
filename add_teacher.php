<?php

require "dbconfig.php";

echo "<BR/>";

$username = $_POST['add_username'];
$password = md5($_POST['add_password']);
$position = 'Teacher';

$sql = "INSERT INTO Login(username,password,position) values(:username,:password,:position)";

$stid = oci_parse($conn, $sql);

oci_bind_by_name($stid,':username',$username);
oci_bind_by_name($stid,':password',$password);
oci_bind_by_name($stid,':position',$position);

oci_execute($stid);
oci_free_statement($stid);
oci_close($conn);

header("Location: main_menu.php");
die();
?>
