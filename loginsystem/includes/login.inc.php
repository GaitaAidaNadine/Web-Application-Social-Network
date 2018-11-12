<?php

session_start();

if(isset($_POST['submit'])){
	
	include 'dbh.inc.php';
	
	$uid=mysqli_real_escape_string($conn,$_POST['uid']);
	$pwd=mysqli_real_escape_string($conn,$_POST['pwd']);
	
	//Error handlers
	//Check if inputs are empty
	if(empty($uid) || empty($pwd)){
		header("Location: ../introduction.php?login=empty");
		exit();
	} else{
		//Check if the username exists inside the database
		$sql = "SELECT * FROM users WHERE uid='$uid'";
		$result=mysqli_query($conn, $sql);
		$resultCheck=mysqli_num_rows($result);
		if($resultCheck < 1){
			header("Location: ../introduction.php?login=error1");
			exit();
		}else{
			//Check if the user didn't type the correct password
			if($row = mysqli_fetch_assoc($result)){
				//De-hashing the password
				$hashedPwdCheck = password_verify($pwd, $row['pwd']);
				if($hashedPwdCheck == false){
					header("Location: ../introduction.php?login=error");
					exit();
				}elseif($hashedPwdCheck == true){
					//Log in the user here
					$_SESSION['u_id'] = $row['id'];
					$_SESSION['u_first'] = $row['first'];
					$_SESSION['u_last'] = $row['last'];
					$_SESSION['u_email'] = $row['email'];
					$_SESSION['u_uid'] = $row['uid'];
					header("Location: ../Timeline.php?login=success");
					exit();
				}
			}
		}
	}
	
	}else{
		header("Location: ../views/home1.php?login=error2");
		exit();
	}
