<?php

    // connect to your database
    // You must edit the line below to give your username, password
    // and a correct path to your database

    require "dbconfig.php";

    // Parse the SQL query
    $query = oci_parse($conn, "SELECT * FROM Books");

    // Execute the query
    oci_execute($query);

    // Prepare to display results
    echo '<table border="1">';
    echo '<table style="padding: 20px 20px 20px 20px">';
    echo '<col>
	  <col width="175">
	  <col width="175">
	  <col width="100">
	  <col width="100">
	  <col width="100">
	  <col width="125">
	  <col width="200">
	  <col width="200">
	  <col width="200">';
    echo '<tr><th align="left">Title</th><th align="left">Author First Name</th><th align="left">Author Last Name</th><th align="left">Copyright</th><th align="left">Lexile</th><th align="left">Pages</th><th align="left">Recommended</th><th align="left">Topic</th><th align="left">Primary Protagonist Nature</th><th align="left">Secondary Protagonist Nature</th></tr>';
    // Fetch each row. The first column is 0, then 1, etc.
    while ($row = oci_fetch_array($query)) {
	echo '<tr>';
	$str = htmlspecialchars($row[0]);
	echo "<th align='left'> $str </th>";
	$str1 = htmlspecialchars($row[1]);
	echo "<th align='left'> $str1 </th>";
	$str2 = htmlspecialchars($row[2]);
	echo "<th align='left'> $str2 </th>";
	$str3 = htmlspecialchars($row[3]);
	echo "<th align='left'> $str3 </th>";
	$str4 = htmlspecialchars($row[4]);
	echo "<th align='left'> $str4 </th>";
	$str5 = htmlspecialchars($row[5]);
	echo "<th align='left'> $str5 </th>";
	$str6 = htmlspecialchars($row[6]);
	echo "<th align='left'> $str6 </th>";
	$str7 = htmlspecialchars($row[7]);
	echo "<th align='left'> $str7 </th>";
	$str8 = htmlspecialchars($row[8]);
	echo "<th align='left'> $str8 </th>";
	$str9 = htmlspecialchars($row[9]);
	echo "<th align='left'> $str9 </th>";
	echo '</tr>';	
    }
    echo '</table>';

    // Log off
    OCILogoff($conn);
?>
   <br><br>
   <!-- <form action="main_menu.php">
      <input type="submit" name="return_to_menu" value="Return to Menu"/>
   </form> -->
</html>
