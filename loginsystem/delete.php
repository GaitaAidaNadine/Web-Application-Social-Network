<?php

ob_start();
session_start();

include 'includes/dbh.inc.php';
		$uid=$_SESSION['u_email'];
		$textVal=mysqli_real_escape_string($conn,$_POST['tweet']);
		
		$sql = "DELETE FROM tweets(tweet, userid) 
					VALUES('$textVal', '$uid');";
					
					mysqli_query($conn, $sql) or die(mysqli_error($conn));
					header("Location: ../Timeline.php");

?>