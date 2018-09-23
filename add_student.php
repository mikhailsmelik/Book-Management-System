<?php

require "dbconfig.php";

echo "<BR/>";

$student_id = $_POST['add_id'];
$name = $_POST['add_name'];
$username = $_POST['add_username'];
$password = md5($_POST['add_password']);
$position = 'Student';

$sql = "INSERT INTO Login(username,password,position,student_id) values(:username,:password,:position,:student_id)";

$sql2 = "INSERT INTO Student174(student_id,name) values(:student_id,:name)";

$stid2 = oci_parse($conn, $sql2);
$stid = oci_parse($conn, $sql);

oci_bind_by_name($stid2,':student_id',$student_id);
oci_bind_by_name($stid2,':name',$name);
oci_bind_by_name($stid,':student_id',$student_id);
oci_bind_by_name($stid,':username',$username);
oci_bind_by_name($stid,':password',$password);
oci_bind_by_name($stid,':position',$position);

oci_execute($stid2);
oci_free_statement($stid2);
oci_execute($stid);
oci_free_statement($stid);
oci_close($conn);

header("Location: main_menu.php");
die();
?>
