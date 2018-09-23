<?php
require "dbconfig.php";

echo "<BR/>";

$title = $_POST['modify_title'];
$last = $_POST['modify_last'];

$sql = "DELETE FROM BOOKS where title = :title and last = :last";

$stid = oci_parse($conn,$sql);

oci_bind_by_name($stid,':title',$title);
oci_bind_by_name($stid,':last',$last);

oci_execute($stid);
oci_free_statement($stid);
oci_close($conn);

header("Location: main_menu.php");
die();
?>
