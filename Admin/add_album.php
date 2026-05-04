<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('../config/config.php');
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysqli_connect($mysql_host, $mysql_user, $mysql_password);
	if(!$link) {
		die('Failed to connect to server: ' . mysqli_error());
	}
	
	//Select database
	$db = mysqli_select_db($link, $mysql_database);
	if(!$db) {
		die("Unable to select database");
	}
	
    //input values from the form
	$title = $_POST['title'];
   
    

	//$date = date('Y-m-d H:i:s');

	//Create insert query   
    $sql = "INSERT into album (title) values ('$title')";
    $result=mysqli_query($link, $sql) or die(mysqli_error($link));
	
	
	//Check whether the query was successful or not
	if(!$result){
            die("Could not add Album".mysql_error());
                }else{
             echo '<script type="text/javascript">alert("Album Added!"); location.href="gallery.php";</script>';
			
			exit();
              }

?>