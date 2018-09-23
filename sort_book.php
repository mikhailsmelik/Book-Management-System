<?php
	require "dbconfig.php";
	session_save_path('/webpages/msmelik/sessions');
    ini_set('session.gc_probability',1);
	session_start();

	$stuff = "Delete from Sort where studentid = '".$_SESSION['id']."'";
	$stid = oci_parse($conn, $stuff);
	oci_execute($stid);
	oci_free_statement($stid);

	$query = oci_parse($conn, "select * from Books");

	oci_execute($query);

	while ($row = oci_fetch_array($query)) {
		$sum = 0;
		$sortLexile = $_POST['sLexile'];
		$sortAuthor = $_POST['sAuthor'];
		$sortRecommended = $_POST['sRecommended'];
		$sortPages = $_POST['sPages'];
		$sortTopic = $_POST['sTopic'];
		$sortProtagonist = $_POST['sProtagonist'];
		$oldLexile = substr($row[4], 0, -1);
		if ($sortLexile <> '') {
			if ($sortLexile - 100 <= $oldLexile) {
				if ($sortLexile + 50 >= $oldLexile) {
					$sum = $sum + 100;
				}
			}
		}
		if (strcmp($sortAuthor,'') <> 0) {
			if (strcmp($sortAuthor,$row[2]) == 0) {
				$sum = $sum + 50;
			}
		}
		if (strcmp($sortRecommended,'') <> 0) {
			if (strcmp($sortRecommended,$row[6]) == 0) {
				$sum = $sum + 25;
			}
		}
		if ($sortPages <> '') {
			$value = $sortPages + 100;
			if ($sortPages <= $row[5]) {
				if ($value > $row[5]) {
					$sum = $sum + 12;
				}
			}
		}
		if (strcmp($sortTopic,'') <> 0) {
			if (strcmp($sortTopic,$row[7]) == 0) {
				$sum = $sum + 6;
			}
		}
		if (strcmp($sortProtagonist,'') <> 0) {
			if (strcmp($sortProtagonist,$row[8]) == 0 || strcmp($sortProtagonist,$row[9]) == 0) {
				$sum = $sum + 3;
			}
		}
		$str = str_replace("'","''",$row[0]);
		$strauthor = str_replace("'","''",$row[2]);
		$sql = "INSERT INTO Sort(studentid,title,author,sum) values ('".$_SESSION['id']."',:str,:strauthor,:sum)";
		$stid = oci_parse($conn, $sql);

		oci_bind_by_name($stid,':str',$str);
		oci_bind_by_name($stid,':strauthor',$strauthor);
		oci_bind_by_name($stid,':sum',$sum);

		oci_execute($stid);
		oci_free_statement($stid);
	}
	OCILogoff($conn);
	header("Location: show_sorted_books.php");
	die();
?>
		
