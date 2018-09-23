<?php
	session_save_path('/webpages/msmelik/sessions');
    ini_set('session.gc_probability',1);
	session_start();
	if (isset($_SESSION['user']) && (strcmp($_SESSION['type'], 'Admin')==0 || strcmp($_SESSION['type'], 'Student')==0)){
		echo' 
			<html>
			   <style>
			     .btn-primary:hover,
			     .btn-primary:focus,
			     .btn-primary:active,
			     .btn-primary {
			       color: #ffffff !important;
			       background-color: #8eb5c0 !important;
			       border-color: #8eb5c0 !important;
			     }
			     th{
			       padding-right: 20px !important;
			       text-align: right !important;
			     }
			     .fontColor{
			       color: #000 !important;
			     }
			   </style>
			   <head>
			       <meta charset="UTF-8">
			      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
			      <title>Books</title>
			       <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
			       <link rel="stylesheet" href="css/style.css">
			       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
					<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
			   </head>
			   <body>
			   <nav class="navbar navbar-inverse navbar-fixed-top navbar-custom">
			      <div class="container-fluid">
			         <div class="navbar-header">  
			          <p id="name">BOOKS</p>
			            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			              <span class="icon-bar"></span>
			              <span class="icon-bar"></span>
			              <span class="icon-bar"></span>                           
			            </button> 
			          </div>
			          <nav class="collapse navbar-collapse" id="myNavbar">
			             <ul class="nav navbar-nav navbar-right">';

			            if (strcmp($_SESSION['type'], 'Admin')==0) {
                                                echo"
			               <li><a href='main_menu.php'>MAIN MENU</a></li>";
				    }
				echo"
				       <li><a href='show_sorted_books.php'>SORTED BOOKS</a></li>
			               <li><a href='loginBEST.html'>LOGOUT</a></li>
			             </ul>
			          </nav>
			      </div>
			   </nav>";
			   echo '
			 	  <div id = "break"></div>
			      <h1>Search</h1>
			           <br>
			           <center>';

				require "dbconfig.php";
				
				$query = oci_parse($conn, "SELECT unique(last) FROM Books");
				$topicquery = oci_parse($conn, "select unique(topic) from Books");
				$primaryquery = oci_parse($conn, "select unique(primary) from Books where upper(primary) <> upper(secondary)");
				$secondaryquery = oci_parse($conn, "select unique(secondary) from Books");

				oci_execute($query);
				oci_execute($topicquery);
				oci_execute($primaryquery);
				oci_execute($secondaryquery);

				$authorarray = array();
			        $topicarray = array();
			        $protagonistarray = array();

				$authorcount = 0;
				$topiccount = 0;
				$protagonistcount = 0;

				while($authorrow = oci_fetch_array($query)) {
					array_push($authorarray, $authorrow[0]);
					$authorcount = $authorcount + 1;
				}
				while($topicrow = oci_fetch_array($topicquery)) {
					array_push($topicarray, $topicrow[0]);
					$topiccount = $topiccount + 1;
				}
				while($primaryrow = oci_fetch_array($primaryquery)) {
					array_push($protagonistarray, $primaryrow[0]);
					$protagonistcount = $protagonistcount + 1;
				}
				while($secondaryrow = oci_fetch_array($secondaryquery)) {
					array_push($protagonistarray, $secondaryrow[0]);
					$protagonistcount = $protagonistcount + 1;
				}

				echo'
				<form action="sort_book.php" method="post">
				<table>
					<col width="250">
					<col width="300">
					<tr>
						<th align="left">Lexile: </th><th class="fontColor"><input type="number" name="sLexile" max="9999" min="0"/></th>
					</tr>
					<tr>
						<th align="left">Author: </th><th class="fontColor"><input list="Authors" name="sAuthor">
						<datalist id="Authors">';
							for($i = 0; $i < $authorcount; $i++) {
								$string = $authorarray[$i];
								$string = preg_replace("/'/", "&#39;", $string);
								echo"<option value='$string'>";
							}
				echo'		</datalist></th>
					</tr>
					<tr>
						<th align="left">Recommended: </th><th><input type="radio" name="sRecommended" value="Y"> Yes<br><input type="radio" name="sRecommended" value="N"> &nbsp;No</th>
					</tr>
					<tr>
						<th align="left">Page Numbers: </th><th class="fontColor"><select name="sPages"><option value="">None</option><option value="0">0-99</option><option value="100">100-199</option><option value="200">200-299</option><option value="300">300-399</option><option value="400">400-499</option><option value="500">500-599</option><option value="600">600-699</option><option value="700">700-799</option><option value="800">800-899</option><option value="900">900-999</option><option value="1000">1000-1099</option></th>
					</tr>
					<tr>
						<th align="left">Genre: </th><th class="fontColor"><input list="Genres" name="sTopic">
						<datalist id="Genres">';
							for($j = 0; $j < $topiccount; $j++) {
								$topic = $topicarray[$j];
								echo"<option value='$topic'>";
							}
				echo'		</datalist></th>
					</tr>
					<tr>
			                         <th align="left">Protagonist Nature: </th><th class="fontColor"><input list="Protagonists" name="sProtagonist">
			                         <datalist id="Protagonists">';
			                                    for($k = 0; $k < $protagonistcount; $k++) {
			                                            $protagonist = $protagonistarray[$k];
			                                            echo"<option value='$protagonist'>";
			                                    }
			            echo'        </datalist></th>
			                </tr>
				<table>
				<br>
				<input type="submit" class="btn btn-primary" name="submit_preferences" value="Submit Preferences"/>
				</form>';
				OCILogoff($conn);
			echo ' 		
			</center>
			</body>
			</html>';
		}
		else {
			echo '
		<html>
		<style>
			.btn-primary:hover,
			.btn-primary:focus,
			.btn-primary:active,
			.btn-primary {
				color: #ffffff !important;
				background-color: #8eb5c0 !important;
				border-color: #8eb5c0 !important;
			}
		</style>
		<head>
		    <meta charset="UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
			<title>Books</title>
		    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		    <link rel="stylesheet" href="css/style.css">
	            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 		</head>
		<body>
		<center><div class="alert alert-danger">
		  <strong>You are not logged in!</strong> Please login to view this page.
		</div></center>
		<center><a href="loginBEST.html">
		<input type="submit" class="btn btn-primary" name="submit_preferences" value="Login Now"/>
		</a></center>
		</body>
		</html>';
		}
