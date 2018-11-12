<?php

ob_start();
session_start();

if(isset($_POST['submit'])){
	
	include 'dbh.inc.php';
	
		$uid=$_SESSION['u_email'];
		$textVal=mysqli_real_escape_string($conn,$_POST['tweet']);
		
		if(empty($textVal)){
		$message = "Nothing to be posted!";
		echo "<script type='text/javascript'>alert('$message');</script>";
		exit();
	}
		
		$sql = "INSERT INTO tweets(tweet, userid, datetime) 
					VALUES('$textVal', '$uid',now());";
					
					mysqli_query($conn, $sql) or die(mysqli_error($conn));
					header("Location: ../Timeline.php");

	//Error handlers
	//Check for empty fields
	
}
?>