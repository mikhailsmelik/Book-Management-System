<?php
require "dbconfig.php";

echo "<BR/>";
$handle = fopen('./booksdata.csv', "r");
for($i =1;($data = fgetcsv($handle, 100000)) !== FALSE; $i++) {
//	Prepare the SQL statement to insert values


$title = htmlspecialchars(trim($data[0]));
$first = htmlspecialchars(trim($data[1]));
$last = htmlspecialchars(trim($data[2]));
$copyright = htmlspecialchars(trim($data[3]));
$lexile = htmlspecialchars(trim($data[4]));
$pages = htmlspecialchars(trim($data[5]));
$recommended = htmlspecialchars(trim($data[6]));
$topic = htmlspecialchars(trim($data[7]));
$primary = htmlspecialchars(trim($data[8]));
$secondary = htmlspecialchars(trim($data[9]));
$reserved = '';
	
$sql = "INSERT INTO Books(title,first,last,copyright,lexile,pages,recommended,topic,primary,secondary,reserved)
VALUES(:title,:first,:last,:copyright,:lexile,:pages,upper(:recommended),lower(:topic),lower(:primary),lower(:secondary),:reserved)";
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
oci_bind_by_name($stid,':reserved',$reserved);


// Execute the statement
oci_execute($stid);
}
oci_free_statement($stid);
oci_close($conn);
fclose($handle);

echo'Books Uploaded Successfully';
?>
