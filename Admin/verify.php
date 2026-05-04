<?php
	session_start();

	require_once('../config/config.php');
	
	$link = mysqli_connect($mysql_host, $mysql_user, $mysql_password);
	if(!$link) {
		die('Failed to connect to server: ' . mysqli_error($link));
	}
	
	$db = mysqli_select_db($link, $mysql_database);
	if(!$db) {
		die("Unable to select database");
	}
	
	$username = $link->real_escape_string($_POST['username']);
	$password = $_POST['password'];

	$qry = "SELECT * FROM users WHERE username='$username'";
	$result = mysqli_query($link, $qry) or die(mysqli_error($link));
    
	if($result) {

		if(mysqli_num_rows($result) === 1) {

			$row = mysqli_fetch_assoc($result);

			if(password_verify($password, $row['password'])) {

				$_SESSION['username'] = $row['username'];

				// ✅ REDIRECT PROPERLY
				header("Location: dashboard.php");
				exit();

			} else {

				echo '<script>alert("Wrong password!"); window.location="login.php";</script>';
				exit();

			}

		} else {

			echo '<script>alert("User not found!"); window.location="login.php";</script>';
			exit();

		}

	} else {
		echo "Failed to execute query";
		exit();
	}
?>