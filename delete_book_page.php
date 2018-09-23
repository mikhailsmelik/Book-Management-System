<?php
  session_save_path('/webpages/msmelik/sessions');
    ini_set('session.gc_probability',1);
  session_start();
  if (isset($_SESSION['user']) && (strcmp($_SESSION['type'], 'Admin')==0 || strcmp($_SESSION['type'], 'Teacher')==0)){ #checking for admin access
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
           th{
             padding-right: 20px !important;
             text-align: right !important;
           }
           .fontColor{
             color: #555 !important;
           }
          tr:nth-child(even){
             background-color:  #8eb5c0
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
      echo "   
                     <li><a href='main_menu.php'>MAIN MENU</a></li>
                     <li><a href='logout.php'>LOGOUT</a></li>
                   </ul>
                </nav>
            </div>
         </nav>";
      echo '
            <div id = "break"></div>
            <h1>Delete Books</h1>
                 <br>';

          // connect to your database
          // You must edit the line below to give your username, password
          // and a correct path to your database

          require "dbconfig.php";

          // Parse the SQL query
          $query = oci_parse($conn, "SELECT title FROM Books");

          // Execute the query
          oci_execute($query);

          $array = array();
          $count = 0;

          while($row = oci_fetch_array($query)) {
                array_push($array,$row[0]);
                $count = $count + 1;
          }

          echo '<b>';
          echo '<br>';
          echo '<center><table>';
              echo '<th align="right">';
              echo '<form action="delete_book.php" method="post">
                     Book Title: <input list="Title" name="chosen_title" class="fontColor" size="50"  maxlength="50">
                        <datalist id="Title">';
                                for($j = 0; $j < $count; $j++) {
                                        $topic = $array[$j];
                                        echo"<option value='$topic'>";
                                }
        echo'           </datalist>
                   <input type="submit" name="chosen_book_button" class="btn btn-primary" value="Delete This Book"/>  
                   </form>';
              echo '<br>';
              echo '</th>';
          echo '</table></center>';
          echo '</b>  
                </html>';

          OCILogoff($conn);
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
      <strong>You do not have access to view this page!</strong> Please login to view this page.
    </div></center>
    <center><a href="loginBEST.html">
    <input type="submit" class="btn btn-primary" name="submit_preferences" value="Login Now"/>
    </a></center>
    </body>
    </html>';
  }
