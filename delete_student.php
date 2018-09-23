<?php
require "dbconfig.php";

echo "<BR/>";

$id = $_POST['delete_id'];

$sql = "DELETE FROM LOGIN where student_id = :id";
$sortsql = "DELETE FROM SORT where studentid = :id";
$studentsql = "DELETE FROM STUDENT174 where student_id = :id";
$stid = oci_parse($conn,$sql);
$sortstid = oci_parse($conn,$sortsql);
$studentstid = oci_parse($conn,$studentsql);

oci_bind_by_name($stid,':id',$id);
oci_bind_by_name($sortstid,':id',$id);
oci_bind_by_name($studentstid,':id',$id);

oci_execute($stid);
oci_execute($sortstid);
oci_execute($studentstid);

oci_free_statement($stid);
oci_free_statement($sortstid);
oci_free_statement($studentstid);
oci_close($conn);

header("Location: main_menu.php");
die();
?>
