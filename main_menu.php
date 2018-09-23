<?php
	session_save_path('/webpages/msmelik/sessions');
    ini_set('session.gc_probability',1);
	session_start();
	if (isset($_SESSION['user']) && (strcmp($_SESSION['type'], 'Admin')==0 || strcmp($_SESSION['type'], 'Teacher')==0)){ #checking for admin access
		echo'
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
						<li><a href='add_teacher_page.php'>ADD TEACHER</a></li>";
					}
                        echo"
			                        <li><a href='add_student_page.php'>ADD STUDENT</a></li>
						<li><a href='show_students.php'>STUDENT LIST</a></li>
						<li><a href='add_book_page.php'>ADD BOOK</a></li>
						<li><a href='modify_book_page.php'>MODIFY BOOK</a></li>
						<li><a href='delete_book_page.php'>DELETE BOOK</a></li>";
                                        if (strcmp($_SESSION['type'], 'Admin')==0) {
                                                echo"
						<li><a href='parameter_choice.php'>SEARCH</a></li>";
					}
			echo"
						<li><a href='logout.php'>LOGOUT</a></li>
				    </ul>
			    </nav>
			</div>
		</nav>
		";
		echo'
		<div id = "break"></div>
		<h1>List of Books</h1>
	        <br>
		<center style="padding-left: 20px; padding-right: 20px;">
		';
		include 'show_books.php';
		echo"
				</center>
				</body>
			</html>";
	}
	elseif (isset($_SESSION['user']) && strcmp($_SESSION['type'], 'Student')==0) { #if user is not admin 
		header("Location: parameter_choice.php");
		die();         
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

		/*echo '
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

			#Remove add and modifiy books later 
				    echo "
						<li><a href='parameter_choice.php'>SEARCH</a></li>
						<li><a href='logout.php'>LOGOUT</a></li>
				    </ul>
			    </nav>
			</div>
		</nav>
		";
		echo'
		<div id = "break"></div>
				</center>
				</body>
			</html>';
	}

*/
		/*echo 
		

	else {
		
*/
	?>
	

