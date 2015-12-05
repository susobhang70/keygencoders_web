<?php
	session_start();
	if ((!isset($_SESSION['codechefid']))||$_SESSION['status']==0) 
	{
		header('Location: login.php');
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>KeyGEnCoders</title>
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
				<li><a href="home.php">Home</a></li>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="about.php">About Us</a>
					<ul>
						<li><a href="about.php">KeyGEnCoders</a></li>
						<li><a href="http://www.codechef.com/campus_chapter/about" target="_blank">Codechef Campus Chapters</a></li>
						<li><a href="http://www.kgec.edu.in/" target="_blank">KGEC</a></li>
					</ul>
				</li>
				<li><a href="contactus.php">Contact Us</a></li>
				<li><a href="logout.php">Log out</a></li>
			</ul>
		</nav>
	
		<section>
			<div id="message">
				<p>This is secured page with session: <b><?php echo $_SESSION['codechefid']; ?></b>
			</div>
		</section>
	</div>
	</body>
</html>