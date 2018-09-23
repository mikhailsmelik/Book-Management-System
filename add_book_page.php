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
            <h1>Add Book</h1>
                 <br>
         <center>
         <form action="add_book.php" method="post">
            <table>
               <col width="250">
               <col width="250">
               <tr>
                  <th align="left">Title: </th><th class="fontColor"><input required name="add_title" size="50" maxlength="50"/></th>
               </tr>
               <tr>
                  <th align="left">Author First Name:</th><th class="fontColor"><input required name="add_first" size="50" maxlength="15"/></th>
               </tr>
               <tr>
                  <th align="left">Author Last Name:</th><th class="fontColor"><input required name="add_last" size="50" maxlength="15"/></th>
               </tr>
               <tr>
                  <th align="left">Copyright:</th><th class="fontColor"><input type="number" name="add_copyright" size="50" max="9999" min="0"/></th>
               </tr>
               <tr>
                  <th align="left">Lexile:</th><th class="fontColor"><input required type="number" name="add_lexile" size="50" max="9999" min="0"/></th>
               </tr>
               <tr>
                  <th align="left">Pages:</th><th class="fontColor"><input required type="number" name="add_pages" size="50" max="99999" min="1"/></th>
               </tr>
               <tr>
                  <th align="left">Recommended: </th><th><input type="radio" name="add_recommended" value="Y"> Yes<br><input type="radio" name="add_recommended" value="N" checked> No</th>
               </tr>
               <tr>
                  <th align="left">Topic:</th><th class="fontColor"><input required name="add_topic" size="50" maxlength="25"/></th>
               </tr>
      	</center>
               <tr>
                  <th align="right">Primary Protagonist Nature:</th><th class="fontColor"><input name="add_primary" size="50" maxlength="25"/></th>
               </tr>
               <tr>
                  <th text-align="right">Secondary Protagonist Nature:</th><th class="fontColor"><input name="add_secondary" size="50" maxlength="20"/></th>
               </tr>
            </table>
            <br>

            <input type="submit" class="btn btn-primary" name="add_book_submit_button" value="Add Book"/>
         </form>
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
      <strong>You do not have access to view this page!</strong> Please login to view this page.
    </div></center>
    <center><a href="loginBEST.html">
    <input type="submit" class="btn btn-primary" name="submit_preferences" value="Login Now"/>
    </a></center>
    </body>
    </html>';

    }
?>
