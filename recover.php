<?php
	include 'db.php';
	$emailErr="";
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{	
		$email=$_POST['email'];
		$query=mysqli_query($connect,"SELECT * FROM coders WHERE email='$email'");
		if(mysqli_num_rows($query)==0)
		{
			$emailErr="This Email ID is not associated with any registered account.";
		}
		else
		{
			$resetcode=md5($email.time());
			mysqli_query($connect,"UPDATE coders SET resetpassword='$resetcode' WHERE email='$email'");
			include 'smtp/sendmail.php';
			$row=mysqli_fetch_assoc($query);
			$name=$row['name'];
			$to=$email;
			$subject="KeyGEnCoders password reset email";
			$body='Hi '.$name.', <br> <br/> You are receiving this email because you requested a password reset for your KeyGEnCoders Account. If you did not request this change, you can safely ignore this email. <br> <br/> To choose a new password and complete your request, please follow the link below: <br> <br/> <a href="'.$base_url.'reset/activation/'.$resetcode.'">'.$base_url.'reset/activation/'.$resetcode.'</a>';
			$check=Send_Mail($to,$subject,$body);
			if($check==true)
			{
				header("Location: complete.php?code=2");
				exit;
			}
			else
			{
				echo "Error sending email";
			}
		}
	}
?>
<html>
	<head>
		<title>Recover Your Password</title>
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
					<p>Please enter your Email Address you used to set up your KeyGEnCoders Account.</p>
					<span class="error"><?php echo $emailErr; ?></span>
					<form method="POST" action="recover.php">
						<input type="text" name="email" placeholder="Email ID">
						<input class="submitlogin" type="submit" name="resend" value="Reset">						
					</form>
				</div>
			</section>
		</div>
	</body>
</html>