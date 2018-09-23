<?php
  session_save_path('/webpages/msmelik/sessions');
    ini_set('session.gc_probability',1);
  session_start(); 

  #Checks if you're logged in, if so, displays webpage
  if (isset($_SESSION['user']) && (strcmp($_SESSION['type'], 'Admin')==0 || strcmp($_SESSION['type'], 'Teacher')==0)) {
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
      echo"
              <li><a href='main_menu.php'>MAIN MENU</a></li>
              <li><a href='loginBEST.html'>LOGOUT</a></li>
              </ul>
            </nav>
        </div>
      </nav>
      <h1>List of Students</h1>
            <br>";


    
    require "dbconfig.php";

    $query = oci_parse($conn, "SELECT * FROM Student174");
    oci_execute($query);


    echo '<center>';
    echo '<table border="1">';
    echo '<table style="padding: 20px 20px 20px 20px">';
    echo '<col width="200">
      <col width="200">
      <col width="200">';

      echo '<tr><th align="left">STUDENT ID</th><th align="left">STUDENT NAME</th><th align="left"></th></tr>';
      
      echo '<form action="delete_student.php" method="post">';

      // Fetch each row. The first column is 0, then 1, etc.
      while ($row = oci_fetch_array($query)) {
	  if ($row[0] == '0000') {
	  }
	  else {
              echo '<tr>';
              echo "<th align='left'> $row[0] </th>";
	      $str = htmlspecialchars($row[1]);
              echo "<th align='left'> $str </th>";
	      echo "<th align='left'><form action='remove_student.php' method='post'><button class='btn btn-primary' type='submit' name='delete_id' value='".$row[0]."'>Delete This Student</button></form></th>";
              echo '</tr>';
	  }

      }
      echo '</table>';
      echo "</br>";

      // Log off
      OCILogoff($conn);

    }
  #will probably need to have a redirect here   
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

?>

