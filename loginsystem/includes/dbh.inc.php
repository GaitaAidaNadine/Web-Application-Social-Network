<?php

//We are going to create four variables which are going to be the connection to the database
//Information we need:
//Server name: because we run a local server we need to write "localhost"
$dbServername="localhost";

//Username
$dbUsername="root";

//Password
$dbPassword="";

//Database name
$dbName="loginsystem";

//php function that activates the connection
$conn=mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName) or die(mysqli_error());