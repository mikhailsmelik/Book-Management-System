<?php
require "dbconfig.php";

echo "<BR/>";

$sql = "DELETE FROM LOGIN where lower(position) = lower('teacher')";
$stid = oci_parse($conn,$sql);

oci_execute($stid);
oci_free_statement($stid);
oci_close($conn);


header("Location: main_menu.php");
die();
?>
