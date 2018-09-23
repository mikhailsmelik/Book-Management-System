<?php
    session_save_path('/webpages/msmelik/sessions');
    ini_set('session.gc_probability',1);
    session_start(); #new

    require "dbconfig.php";

    // Parse the SQL query
    $username = $_POST['username'];
    $password = md5($_POST['pass_word']);
    $query = oci_parse($conn, "SELECT * FROM Login WHERE upper(username) = upper(:username)");

    oci_bind_by_name($query, ':username', $username);

    // Execute the query
    oci_execute($query);

    echo '<b>';
    $row = oci_fetch_array($query);

    if(strcmp($row[1],$password) == 0) {
        $_SESSION['user'] = $username;
	$_SESSION['type'] = $row[2];
	if(strcmp($_SESSION['type'], 'Admin') == 0) {
	    $_SESSION['id'] = $row[3];
		header("Location: main_menu.php");
die();	
}
	elseif(strcmp($_SESSION['type'], 'Student') == 0) {
	    $_SESSION['id'] = $row[3];
		header("Location: main_menu.php");
die();	
}
	elseif(strcmp($_SESSION['type'], 'Teacher')==0) {
		header("Location: main_menu.php");
die();	
}
    }
    else {
	header("Location: loginf.html");
die();    
}


    #setting admin session
   # if(strcmp($row[2], 'Admin') == 0){ 
    #    $_SESSION['user'] = $username; 
     #   $_SESSION['type'] = $row[2];

      #      if(strcmp($row[1],$password) == 0) {
       #         echo '<script type="text/javascript">
        #                window.location = "http://students.engr.scu.edu/~msmelik/main_menu.php"
         #               </script>';
          #          }
          #  else {
          #          echo '<script type="text/javascript">
          #                       window.location = "http://students.engr.scu.edu/~msmelik/loginf.html"
          #                     </script>';
          #      }
   # }
    #setting student session 
   # elseif(strcmp($row[2], 'Student') == 0){
   #     $_SESSION['user'] = $username; #this sets the session to the username 
   #     $_SESSION['type'] = $row[2];
   #      if(strcmp($row[1],$password) == 0) {
   #             echo '<script type="text/javascript">
   #                     window.location = "http://students.engr.scu.edu/~msmelik/main_menu.php"
   #                     </script>';
   #                 }
   #         else {
   #                 echo '<script type="text/javascript">
   #                              window.location = "http://students.engr.scu.edu/~msmelik/loginf.html"
   #                            </script>';
   #             }

   # }




    

    #if(strcmp($row[1],$password) == 0) {
	#echo '<script type="text/javascript">
    #                            window.location = "http://students.engr.scu.edu/~msmelik/main_menu.php"
    #                            </script>';
    #}
    #else {
    #    echo '<script type="text/javascript">
    #                             window.location = "http://students.engr.scu.edu/~msmelik/loginf.html"
    #                           </script>';

 //        echo "Fail";
	// echo '<script type="text/javascript">
 //                                window.location = "http://students.engr.scu.edu/~msmelik/loginBEST.html"
 //                                </script>';
    

