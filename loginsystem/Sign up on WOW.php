<!DOCTYPE html>
<html lang="en-US">

<head>
	<title>Sign up on WOW</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="http://localhost/loginsystem/css/signupstyle.css">
</head>


<body>
 <div class="box">
	<form action="includes/signup.inc.php" method="POST">
		<div class="container">
			<h1 style="text-align:center;">Sign Up</h1>
			<p style="text-align:center;">Sign up to see what's happening in the<br>Wide Online World!</p>
			<hr style="color:yellow;">
			<label for="firstname"><b></b></label>
			<input type="text" placeholder="First name" name="first" required>
			<label for="lastname"><b></b></label>
			<input type="text" placeholder="Last name" name="last" required>
			<label for="email"><b></b></label>
			<input type="text" placeholder="E-mail" name="email" required>
			<label for="username"><b></b></label>
			<input type="text" placeholder="Username" name="uid" required>
			<label for="psw"><b></b></label>
			<input type="password" placeholder="Password" name="pwd" required>

		<div class="clearfix">
			<button type="submit" class="signupbtn" name="submit">Sign Up</button>
		</div>
		</div>
	</form>
 </div> 
</body>
</html>