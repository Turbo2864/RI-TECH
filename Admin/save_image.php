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
    $id = $_POST['id'];

      $albumtitle = $_POST['albumtitle'];

    
    

	$date = date('Y-m-d H:i:s');

    function getExtension($str)
    {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
    }


    $image = $_FILES['file']['name'];
    
    if ($image) 
    {
        $filename = stripslashes($_FILES['file']['name']);
        $extension = getExtension($filename);
        $extension = strtolower($extension);
       
            $doc_name=time().'.'.$extension;
            $slidepath="album/".$doc_name;

            $copied = copy($_FILES['file']['tmp_name'], $slidepath);
    }
    

	//Create insert query   
    $sql = "INSERT into album_images (album_id, title, path) values ($id,'$title','$slidepath')";
    $result=mysqli_query($link, $sql) or die(mysqli_error($link));
	
	
	//Check whether the query was successful or not
	if(!$result){
            die("Could not add Image".mysql_error());
                }else{
             echo '<script type="text/javascript">alert("Image uploaded!"); location.href="view_album.php?id='.$id.'&title='.$albumtitle.'";</script>';
			
			exit();
              }

?>