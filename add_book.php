<?php

require "dbconfig.php";

echo "<BR/>";

$title = htmlspecialchars(trim($_POST['add_title']));
$first = htmlspecialchars(trim($_POST['add_first']));
$last = htmlspecialchars(trim($_POST['add_last']));
$copyright = $_POST['add_copyright'];
$lexile = $_POST['add_lexile']. 'L';
$pages = $_POST['add_pages'];
$recommended = $_POST['add_recommended'];
$topic = htmlspecialchars(trim($_POST['add_topic']));
$primary = htmlspecialchars(trim($_POST['add_primary']));
$secondary = htmlspecialchars(trim($_POST['add_secondary']));

$sql = "INSERT INTO Books(title,first,last,copyright,lexile,pages,recommended,topic,primary,secondary)
VALUES(:title,:first,:last,:copyright,:lexile,:pages,:recommended,lower(:topic),lower(:primary),lower(:secondary))";
$stid = oci_parse($conn, $sql);

oci_bind_by_name($stid,':title',$title);
oci_bind_by_name($stid,':first',$first);
oci_bind_by_name($stid,':last',$last);
oci_bind_by_name($stid,':copyright',$copyright);
oci_bind_by_name($stid,':lexile',$lexile);
oci_bind_by_name($stid,':pages',$pages);
oci_bind_by_name($stid,':recommended',$recommended);
oci_bind_by_name($stid,':topic',$topic);
oci_bind_by_name($stid,':primary',$primary);
oci_bind_by_name($stid,':secondary',$secondary);

// Execute the statement
oci_execute($stid);
oci_free_statement($stid);
oci_close($conn);

header("Location: main_menu.php");
die();
?>
