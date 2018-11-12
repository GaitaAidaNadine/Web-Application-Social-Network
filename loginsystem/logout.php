<?php

	session_start();
				  if( !isset($_SESSION['u_email']) ) {
				header("Location: introduction.php");
				exit;
			  }
		session_unset();
		session_destroy();
		header("Location: AboutWOW.php");
		exit;
?>