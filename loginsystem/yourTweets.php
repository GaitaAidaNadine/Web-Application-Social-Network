
<!DOCTYPE html>

<html class="no-js"  lang="en">
<head>
 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<title>Your Tweets</title>

<!-- Normalize -->

<link rel="stylesheet" href="css/assets/normalize.css" type="text/css">

<!-- Bootstrap -->

<link href="css/assets/bootstrap.min.css" rel="stylesheet" type="text/css">

<!-- Font-awesome.min -->

<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- Effet -->

<link rel="stylesheet" href="css/gallery/foundation.min.css"  type="text/css">
<link rel="stylesheet" type="text/css" href="css/gallery/set1.css" />

<!-- Main Style -->

<link rel="stylesheet" href="css/main.css" type="text/css">

<!-- Responsive Style -->

<link href="css/responsive.css" rel="stylesheet" type="text/css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

<!--[if lt IE 9]>

      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>

      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

<script src="js/assets/modernizr-2.8.3.min.js" type="text/javascript"></script>
</head>
<style>

.delete-form{
	color:hsl(0, 80%, 50%);
	font-family: Arial;
	background-color: white;
    
}

.delete-form button:hover{
	opacity:1;
}

.button {
  padding: 4px 17px;
  font-size: 15px;
  text-align: right;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #7d82a5;
  border: none;
  border-radius: 15px;
  box-shadow: 0 5px #999;
}

.button:hover {background-color: #666699}

.button:active {
  background-color: #666699;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}

.tweet{
		border: 1px solid grey;
		border-radius: 5px;
		padding: 5px;
		margin: 5px;
		
	}
	
	.time{
		
		color: black;
	}
</style>

<body>

<!-- header -->

<header id="header" class="header">
  <div class="container-fluid">
    <hgroup>
      
      <!-- nav -->
      
     <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
	  <li class="nav-item">
        <a class="nav-link" href="http://localhost/loginsystem/Timeline.php"><strong>Your Timeline&nbsp&nbsp&nbsp&nbsp</strong></a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="http://localhost/loginsystem/yourTweets.php"><strong>Your Tweets&nbsp&nbsp&nbsp&nbsp&nbsp</strong></a>
      </li>
	  <li class="nav-item">
        <button class="button"><a class="nav-link" href="http://localhost/loginsystem/logout.php">Log Out</a></button>
      </li>
    </ul>
  </div>
</nav>
      
      <!-- nav --> 
      
    </hgroup>
  </div>
</header>

<!-- header -->

<main class="main-wrapper" id="container"> 
  
  <!-- image Gallery -->
  
  <div class="wrapper">
    <div class="">
      <h2>Your Tweets</h2>
		<div class="row">
			<div class="col-sm-8">
			<br>
			<?php
			ob_start();
			session_start();

			  if( !isset($_SESSION['u_email']) ) {
				header("Location: introduction.php");
				exit;
			  }
			$link = mysqli_connect("localhost", "root", "", "loginsystem");
			
			function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;

    if( $estimate_time < 1 )
    {
        return '1 second';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' );
        }
    }
}
			function displayTweets() {
				
				global $link;
				
				$query="SELECT * FROM tweets WHERE userid='".$_SESSION['u_email']."' ORDER BY datetime DESC";
				$result=mysqli_query($link,$query);
				if(mysqli_num_rows($result)==0){
					echo "There are no tweets to display";
				}else{
					
					while ($row= mysqli_fetch_assoc($result)){
						
						
						
						$userQuery="SELECT * FROM users WHERE email = '" . mysqli_real_escape_string($link, $row['userid']) . "' LIMIT 1";
						$userQueryResult= mysqli_query($link, $userQuery) or die(mysqli_error($link));
						$user=mysqli_fetch_assoc($userQueryResult);
						
						
						echo "<div class='tweet'><p>".$user['email']." <span class='time'><strong>&nbsp&nbsp&nbsp&nbsp&nbsp".get_timeago(strtotime($row['datetime']))." ago</strong></span>&nbsp:</p>";
						echo "<p>".$row['tweet']."</p>
							<form class='delete-form' method='POST' action='".deleteComments($link)."'>
								<input type='hidden' name='tid' value='".$row['id']."'>
								<br><button type='submit' name='commentDelete'><strong>DELETE</strong></button>
							</form></div><br>";
						
						
						
					}
				}
			}
			displayTweets();
			
			function deleteComments($link){
				if(isset($_POST['commentDelete'])){
					$tid=$_POST['tid'];
					
					$sql="DELETE FROM tweets WHERE id='$tid'";
					$result=$link->query($sql);
					header("Location: yourTweets.php");
				}
			}
			?>
			</div>
		</div>
    </div>
  </div>
</main>

<!-- Image Gallery --> 

<!-- footer -->

<footer class="footer">
  <h3>See what's happening in the WORLD!<br>Stay connected with us</h3>
  
  <div class="container footer-bot">
    <div class="row"> 
      
      <!-- social -->
      
      <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 padding-top">
        <ul class="social">
          <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-tripadvisor" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-delicious" aria-hidden="true"></i></a></li>
        </ul>
		
        <p class="made-by">Made with <i class="fa fa-heart" aria-hidden="true"></i> by Aida Nadine
        <p> 
      </div>
      
      <!-- social --> 
      
    </div>
  </div>
</footer>

<!-- footer --> 

<!-- jQuery --> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script> 
<script>window.jQuery || document.write('<script src="js/assets/jquery.min.js"><\/script>')</script> 
<script src="js/assets/plugins.js" type="text/javascript"></script> 
<script src="js/assets/bootstrap.min.js" type="text/javascript"></script> 
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script> 
<script src="js/maps.js" type="text/javascript"></script> 
<script src="js/custom.js" type="text/javascript"></script> 
<script src="js/jquery.contact.js" type="text/javascript"></script> 
<script src="js/main.js" type="text/javascript"></script> 
<script src="js/gallery/masonry.pkgd.min.js" type="text/javascript"></script> 
<script src="js/gallery/imagesloaded.pkgd.min.js" type="text/javascript"></script> 
<script src="js/gallery/jquery.infinitescroll.min.js" type="text/javascript"></script> 
<script src="js/gallery/main.js" type="text/javascript"></script> 
<script src="js/jquery.nicescroll.min.js" type="text/javascript"></script>
</body>
</html>