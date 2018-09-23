<?php
  session_save_path('/webpages/msmelik/sessions');
    ini_set('session.gc_probability',1);
  session_start();
  if (isset($_SESSION['user']) && strcmp($_SESSION['type'], 'Admin')==0){ #checking for admin access
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
            <h1>Add Teacher</h1>
                 <br>
         <center>';

	require "dbconfig.php";
	$query = oci_parse($conn,"select count(*) from login where lower(position) = lower('teacher')");
	oci_execute($query);
	$row = oci_fetch_array($query);
	$count = $row[0];

	if ($count == 0) {
echo'	 <form action="add_teacher.php" method="post">
            <table>
               <col width="250">
               <col width="250">
               <tr>
                  <th align="left">Username:</th><th class="fontColor"><input required name="add_username" size="25" maxlength="25"/></th>
               </tr>
               <tr>
                  <th align="left">Password:</th><th class="fontColor"><input required type="password" name="add_password" size="25" maxlength="25" id="add_password"/></th>
               </tr>
               <tr>
                  <th align="left">Confirm Password:</th><th class="fontColor"><input required type="password" name="confirm_password" size="25" maxlength="25" id="confirm_password"/>
               </tr>
            </table>
            <br>

            <input type="submit" class="btn btn-primary" name="add_teacher_submit_button" value="Add Teacher" onclick="return Validate()" />

<script type="text/javascript">
    function Validate() {
        var password = document.getElementById("add_password").value;
        var confirmPassword = document.getElementById("confirm_password").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>
         </form>';
	}
	else {
	$teacherquery = oci_parse($conn, "select username from login where lower(position) = lower('teacher')");
	oci_execute($teacherquery);
	$teacherrow = oci_fetch_array($teacherquery);
	$teacherusername = htmlspecialchars($teacherrow[0]);
	echo"
	<table>
		<col width='200'>
		<col width='200'>
		<tr>
			<th align='left'>Teacher Username:</th>
			<th align='left'>$teacherusername</th>
		</tr>
		<tr>
			<th align='left'>Delete this Teacher:</th>
			<th align='left'><form action='delete_teacher.php'>
					 <input type='submit' name='delete_teacher_button' class='btn btn-primary' value='Delete Teacher'/></form></th>
		</tr>
	</table>";
	}
	
     echo' </body>
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
      <strong>You do not have access to view this page!</strong> Please login to view this page.
    </div></center>
    <center><a href="loginBEST.html">
    <input type="submit" class="btn btn-primary" name="submit_preferences" value="Login Now"/>
    </a></center>
    </body>
    </html>';

    }
?>
