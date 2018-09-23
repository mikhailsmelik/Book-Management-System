<?php
  session_save_path('/webpages/msmelik/sessions');
    ini_set('session.gc_probability',1);
  session_start();
  if (isset($_SESSION['user']) && (strcmp($_SESSION['type'], 'Admin')==0 || strcmp($_SESSION['type'], 'Teacher')==0)){ #checking for admin access
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
             <ul class="nav navbar-nav navbar-right">  
               <li><a href="main_menu.php">MAIN MENU</a></li>
               <li><a href="loginBEST.html">LOGOUT</a></li>
             </ul>
          </nav>
      </div>
   </nav>
      <div id = "break"></div>
      <h1>Modify Book</h1>
           <br>
   <center>';
    require "dbconfig.php";

    // Parse the SQL query
    $title = $_POST['chosen_title'];
    $query = oci_parse($conn, "SELECT * FROM Books WHERE upper(title) = upper(:title)");

    oci_bind_by_name($query,':title',$title);

    // Execute the query
    oci_execute($query);

    echo '<b>';
    $row = oci_fetch_array($query);

    echo '<form action="change_book.php" method="post">';

    echo '<table border="1">';
    echo '<table style="padding: 20px 20px 20px 20px">';
        echo '<col width="250">';
        echo '<col width="250">';
        echo '<tr>';
            echo "<th align='left'>Title: </th><th class='fontColor'><input readonly='readonly' name='modify_title' size='50' maxlength='50' value='$row[0]'/></th>";
        echo '</tr>';
        echo ' <tr>';
            echo "<th align='left'>Author First Name:</th><th class='fontColor'><input name='modify_first' size='50' maxlength='15' required value='$row[1]'/></th>";
        echo ' </tr>';
        echo ' <tr>';
            echo "<th align='left'>Author Last Name:</th><th class='fontColor'><input name='modify_last' size='50' maxlength='15' required value='$row[2]'/></th>";
        echo '</tr>';
        echo ' <tr>';
        echo"
	<tr>
	    <th align='left'>Copyright:</th><th class='fontColor'><input type='number' name='modify_copyright' size='50' max='9999' min='0' value='$row[3]'/></th>
	</tr>
	<tr>
	    <th align='left'>Lexile:</th><th class='fontColor'><input type='number' name='modify_lexile' size='50' max='9999' min='1' required value='".intval(substr($row[4],0,-1))."'/></th>
	</tr>
	<tr>
	    <th align='left'>Pages:</th><th class='fontColor'><input type='number' name='modify_pages' size='50' max='99999' min='1' required value='$row[5]'/></th>
	</tr>
	<tr>
	    <th align='left'>Recommended:</th><th>";
	    if (strcmp($row[6],'Y') == 0) {
		echo"<input type='radio' name='modify_recommended' value='Y' checked> Yes<br><input type='radio' name='modify_recommended' value='N'> &nbsp;No</th>";
	    }
	    else {
		echo"<input type='radio' name='modify_recommended' value='Y'> Yes<br><input type='radio' name='modify_recommended' value='N' checked> &nbsp;No</th>";
	    }
	echo"<tr>
            <th align='left'>Topic:</th><th class='fontColor'><input name='modify_topic' size='50' maxlength='25' required value='$row[7]'/></th>
         </tr>
         <tr>
            <th align='left'>Primary Protagonist Nature:</th><th class='fontColor'><input name='modify_primary' size='50' maxlength='25' value='$row[8]'/></th>
         </tr>
         <tr>
            <th align='left'>Secondary Protagonist Nature:</th><th class='fontColor'><input name='modify_secondary' size='50' maxlength='20' value='$row[9]'/></th>
         </tr>
      </table>";

      echo '<br>';

      echo '<input type="submit" name="change_book_button" class="btn btn-primary" value="Modify Book"/>';
    echo '</form>';

    echo '<br>';

    echo '<form action="modify_book_page.php">
      <input type="submit" class="btn btn-primary" name="modify_book_page_button" value="Return"/>
   </form>';
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
