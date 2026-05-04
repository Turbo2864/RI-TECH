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
		die('Failed to connect to server: ' . mysqli_connect_error());
	}
	
	//Select database
	$db = mysqli_select_db($link, $mysql_database);
	if(!$db) {
		die("Unable to select database");
	}
	

    $id = $_GET['id'];
    $title = $_GET['title'];


	$sql1 = "SELECT * FROM album_images where id = '$id'";
	$result1 = mysqli_query($link, $sql1);

	while($row = mysqli_fetch_array($result1)) {

         unlink($row['path']);	
	}
   

    //input values from the form    

	$date = date('Y-m-d H:i:s');

    $sql = "DELETE FROM album_images where id = '$id'";
    $result = mysqli_query($link, $sql);

    if(!$result) {
        die("could not delete.". mysqli_error($link));
    }
    else{
        echo "<script> alert('Successfully deleted');
       window.open('gallery.php?id={$id}&title={$title}','_self');
        </script>";

    
		
    }

   

?>