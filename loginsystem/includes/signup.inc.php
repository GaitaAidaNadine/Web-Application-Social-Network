<?php

$first="";
$last="";
$email="";
$uid="";
$pwd="";
$errors=array();

if(isset($_POST['submit']))
{
	include_once 'dbh.inc.php';
	
	$first=mysqli_real_escape_string($conn,$_POST['first']);
	$last=mysqli_real_escape_string($conn,$_POST['last']);
	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$uid=mysqli_real_escape_string($conn,$_POST['uid']);
	$pwd=mysqli_real_escape_string($conn,$_POST['pwd']);
	
	//Error handlers
	//Check for empty fields
	
	if(empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd)){
		header("Location: ../Sign up on WOW.php?signup=empty");
		exit();
	}else{
		//Check if input characters are valid
		if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
			header("Location: ../Sign up on WOW.php?signup=invalid");
			exit();
		}else{
			//Check if email is valid
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				header("Location: ../Sign up on WOW.php?signup=email");
				exit();
			}else{
				$sql="SELECT * FROM users WHERE uid='$uid'";
				
				$result=mysqli_query($conn, $sql) or die(mysqli_error($conn));
				$resultCheck=mysqli_num_rows($result);
				
				if($resultCheck > 0){
					header("Location: ../Sign up on WOW.php?signup=usertaken");
					exit();
				}else{
					//Hashing the password
					$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
					//Insert the user into the database
					$sql = "INSERT INTO users(first, last, email, uid, pwd) 
					VALUES('$first', '$last', '$email', '$uid', '$hashedPwd');";
					
					mysqli_query($conn, $sql) or die(mysqli_error($conn));
					header("Location: ../introduction.php?signup=success");
					exit();
				}
			}
		}
	}
}
else{
	header("Location: ../Sign up on WOW.php");
	exit();
}