<?php
	$message="Your registration was successful. Please confirm your email and login.";
	if(isset($_GET['code'])&&$_GET['code']==1)
	{
		$message="Your verification mail has been resent. Please check your mail and verify your account";
		session_start();
		session_destroy();
	}
	else if(isset($_GET['code'])&&$_GET['code']==2)
	{
		$message="Check your Email! We just sent instructions for completing your password reset to the email address you used to set up your KeyGEnCoders Account.<br><br/>If you don't see it in your inbox within the next few minutes, try looking in your spam folder.";
	}
	else if(isset($_GET['code'])&&$_GET['code']==3)
	{
		$message="Wrong reset code";
	}
	else if(isset($_GET['code'])&&$_GET['code']==4)
	{
		$message="Password has been updated successfully. Please log in to continue.";
	}
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>KeyGEnCoders - Codechef KGEC Campus Chapter</title>
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
				<li><a href="contact.html">Contact Us</a>
			</ul>
		</nav>
		<section>
			<center><h1><?php echo $message; ?></h1></center>
		</section>
	</div>
</body>
</html>