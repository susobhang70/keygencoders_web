<?php
	include 'db.php';
	session_start();
	$temp = $_SESSION['codechefid'];
	if(isset($_GET['error']) && isset($_GET['error'])==1)
	{
		$query=mysqli_query($connect,"SELECT email FROM coders WHERE codechefid='$temp'");
		$url='reactivate.php';
		$row=mysqli_fetch_assoc($query);
	}
	else if(isset($_POST['resend']))
	{
		$email=$_POST['email'];
		$query2=mysqli_query($connect,"SELECT * FROM coders WHERE codechefid='$temp'");
		$row2=mysqli_fetch_assoc($query2);
		if($email!=$row2['email'])
		{
			$activation=md5($email.time());
			mysqli_query($connect,"UPDATE coders SET email='$email', activation='$activation' WHERE codechefid='$temp'");
		}
		else
		{
			$activation=$row2['activation'];
		}
			$name=$row2['name'];
			include 'smtp/sendmail.php';
			$to=$email;
			$subject="KeyGEnCoders email verification";
			$body='Hi '.$name.', <br> <br/> Thank you for signing up with us. Please click on the link below to verify your account and start using your KeyGEnCoders account <br> <br/> <a href="'.$base_url.'emailactivate/activation/'.$activation.'">'.$base_url.'emailactivate/activation/'.$activation.'</a>';
			$check=Send_Mail($to,$subject,$body);
			if($check==true)
			{
				header("Location: complete.php?code=1");
				session_destroy();
				exit;
			}
			else
			{
				echo "Error sending email";
			}
	}
	else
	{
		session_destroy();
		header("Location: login.php");
	}

?>

<html>
	<head>
		<title>Account not activated</title>
		<link rel="stylesheet" type="text/css" href="style.css">
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

			<section>
				<div id="reactivate">
					<p>Your account has not been activated. Please verify your email by clicking on the verification link sent to your email.</p>
					<p>Didn't recieve verification email? Check your email below to resend verification email</p>
					<br>
					<form method="POST" action="<?php echo $url;?>">
						<input type="text" name="email" placeholder="Email ID" value="<?php echo $row['email'];?>">
						<input class="submitlogin" type="submit" name="resend" value="Resend Mail">
					</form>
				</div>
			</section>
		</div>
	</body>
</html>