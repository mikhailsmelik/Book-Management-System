<?php
  session_save_path('/webpages/msmelik/sessions');
    ini_set('session.gc_probability',1);
  session_start();
  if (isset($_SESSION['user']) && (strcmp($_SESSION['type'], 'Admin')==0 || strcmp($_SESSION['type'], 'Student')==0)) {
    echo '
        <html>
        <style>
        tr:nth-child(even){background-color:  #8eb5c0}
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
      <nav class="navbar navbar-inverse navbar-custom">
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
	if (strcmp($_SESSION['type'], 'Student')==0) {
	    echo"
              <li><a href='parameter_choice.php'>PREFERENCES</a></li>";
	}
	echo"
              <li><a href='loginBEST.html'>LOGOUT</a></li>
              </ul>
            </nav>
        </div>
      </nav>
      <h1>Sorted List of Books</h1>
            <br>";

        // connect to your database
        // You must edit the line below to give your username, password
        // and a correct path to your database

        require "dbconfig.php";

        // Parse the SQL query
        $query = oci_parse($conn, "select s.title,b.first,b.last,b.copyright,b.lexile,b.pages,b.recommended,b.topic,b.primary,b.secondary,s.sum from Books b, Sort s where s.title=b.title and s.author=b.last and s.studentid = '".$_SESSION['id']."' order by s.sum desc");

        // Execute the query
        oci_execute($query);

        // Prepare to display results
        echo '<table border="1">';
        echo '<table style="padding: 20px 20px 20px 20px">';
        echo '<col width="350">
              <col width="175">
              <col width="175">
              <col width="100">
              <col width="100">
              <col width="100">
              <col width="125">
              <col width="200">
              <col width="200">
              <col width="200">
        <col width="200">';
        echo '<tr><th align="left">Title</th><th align="left">Author First Name</th><th align="left">Author Last Name</th><th align="left">Copyright</th><th align="left">Lexile</th><th align="left">Pages</th><th align="left">Recommended</th><th align="left">Topic</th><th align="left">Primary Protagonist Nature</th><th align="left">Secondary Protagonist Nature</th></th><th align="left">Sorting Score</th></tr>';

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
            echo "<th align='left'> $row[10] </th>";
            echo '</tr>';
        }
        echo '</table>';

        // Log off
        OCILogoff($conn);
  echo '
       <br><br>
    </body>
    </html>';

  }

  else{
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


