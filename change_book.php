<?php
require "dbconfig.php";

echo "<BR/>";

$title = htmlspecialchars(trim($_POST['modify_title']));
$first = htmlspecialchars(trim($_POST['modify_first']));
$last = htmlspecialchars(trim($_POST['modify_last']));
$copyright = $_POST['modify_copyright'];
$lexile = $_POST['modify_lexile']. 'L';
$pages = $_POST['modify_pages'];
$recommended = $_POST['modify_recommended'];
$topic = htmlspecialchars(trim($_POST['modify_topic']));
$primary = htmlspecialchars(trim($_POST['modify_primary']));
$secondary = htmlspecialchars(trim($_POST['modify_secondary']));

$sql = "UPDATE Books
SET first = :first, last = :last, copyright = :copyright, lexile = :lexile, pages = :pages, recommended = :recommended, topic = lower(:topic), primary = lower(:primary), secondary = lower(:secondary)
WHERE title = :title";

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

oci_execute($stid);
oci_free_statement($stid);
oci_close($conn);

header("Location: main_menu.php");
die();
?>
