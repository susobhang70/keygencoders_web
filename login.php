<?php
	include('validate.php'); // Includes Login Script

	if(isset($_SESSION['codechefid']))
	{
		if(isset($_SESSION['status'])&& $_SESSION['status']==1)
			header("location: home.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style2.css">
	<title>Log in - KeyGEnCoders</title>
</head>
<body>
	<div id="background"></div>
	<div id="wrapper">
		<header>
			<div id="KGEClogo">
				<img src="images/KgecLogo1.jpg">
			</div>
			<div id="logo">
				<img src="images/logosmall1.jpg">
			</div>
			<div id="cheflogo">
				<a href="http://www.codechef.com" target="_blank"><img src="images/codechef.jpg"></a>
			</div>
			<div id="kgec">
				<a href="http://www.kgec.edu.in/" target="_blank"><img src="images/kgec.jpeg"></a>
			</div>
			<div id="twitter">
				<a href="https://www.facebook.com/KeyGEnCoders" target="_blank"><img src="images/twitter.png" height=48 width=48></a>
			</div>
			<div id="facebook">
				<a href="https://www.facebook.com/KeyGEnCoders" target="_blank"><img src="images/facebook.png"></a>
			</div>
			<div id="headnames">
				<h1 id="headname">KeyGEnCoders</h1>
				<h2 id="head2name">Codechef KGEC Campus Chapter</h2>
			</div>
			
		</header>
		<nav>
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="login.php">Login</a></li>
				<li><a href="register.php">Register</a></li>
				<li><a href="about.html">About Us</a>
					<ul>
						<li><a href="about.html">KeyGEnCoders</a></li>
						<li><a href="http://www.codechef.com/campus_chapter/about" target="_blank">Codechef Campus Chapters</a></li>
						<li><a href="http://www.kgec.edu.in/" target="_blank">KGEC</a></li>
					</ul>
				</li>
				<li><a href="contactus.html">Contact Us</a>
			</ul>
		</nav>
		<br>
	</div>
		<section>
			<div class="login-card">
				<center><h1>Login</h1><center>
  				<form method="POST" action="validate.php">
  					<?php if(isset($_GET['error']) && isset($_GET['error'])==1) 
  					{ ?>
  						<h3 style="color:RED;font-size:14px">Invalid Codechef ID or password</h3>
  						<?php 
  					} ?>
    				<input type="text" name="codechefid" placeholder="Codechef ID">
    				<input type="password" name="password" placeholder="Password">
    				<input type="submit" name="login" class="login login-submit" value="Login">
  				</form>
				<div class="login-help">
    				<a href="register.php">Register</a> &nbsp <a href="recover.php">Forgot Password</a>
 			 	</div>
			</div>
		</section>	
</body>
</html>