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
        echo"
                     <li><a href='main_menu.php'>MAIN MENU</a></li>
                     <li><a href='logout.php'>LOGOUT</a></li>
                   </ul>
                </nav>
            </div>
         </nav>";
        echo'
            <div id = "break"></div>
            <h1>Delete This Student?</h1>
                 <br>
         <center>';
require "dbconfig.php";

echo "<BR/>";

$id = $_POST['delete_id'];

$sql = "select * from student174 where student_id = :id";
$stid = oci_parse($conn,$sql);

oci_bind_by_name($stid,':id',$id);

oci_execute($stid);

$row = oci_fetch_array($stid);

$studentid = htmlspecialchars($row[0]);
$studentname = htmlspecialchars($row[1]);


	echo'<table>
		<col width="250">
		<col width="250">
		<tr>';
		echo"
			<th align='left'>$studentid</th><th align='left'>$studentname</th>
		</tr>
	</table>
	</br>
	<form action='delete_student.php' method='post'><button class='btn btn-primary' type='submit' name='delete_id' value='".$id."'>Delete Student</button></form></th>";

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

