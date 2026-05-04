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
	

   $id = $_POST['id'];

   

    //input values from the form
	$title = $_POST['title'];
    $desc = $_POST['description'];
    $imglink = $_POST['link'];
	
    

	$date = date('Y-m-d H:i:s');

    $sql = "UPDATE slider set title = '$title', description = '$desc', link = '$imglink', time_updated=Now() where id = '$id'";

    $result = mysqli_query($link, $sql);

    if(!$result) {
        die("could not update.". mysqli_error($link));
    }
    else{
        echo "<script> alert('Successfully Updated');
        window.open('update_slide.php?id={$id}&update=success','_self');
        </script>";
    }

   

?>