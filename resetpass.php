<?php
	include 'db.php';
	session_start();
	$msg="";
	$password =$cpassword =$temp ="";
	$passwordErr =$cpasswordErr ="";
	if(!empty($_GET['code']) && isset($_GET['code']))
	{
		$code=mysqli_real_escape_string($connect,$_GET['code']);
		$c=mysqli_query($connect,"SELECT * FROM coders WHERE resetpassword='$code'");
		if(mysqli_num_rows($c) == 0)
		{
			header("Location:/complete.php?code=3");
		}
		else
		{
			$row=mysqli_fetch_assoc($c);
			$_SESSION['codechefid']=$row['codechefid'];
		}
	}
	else if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$password=$_POST['pass'];
		$cpassword=$_POST['cpass'];
		$temp=$_SESSION['codechefid'];
		if($password!=$cpassword)
		{
			$cpasswordErr="Passwords don't match!";
		}
		else if(empty($_POST["pass"]))
		{
			$passwordErr="Enter password!";
		}
		else
		{
			$resetcode=md5($temp.time());
			mysqli_query($connect,"UPDATE coders SET password='$password', resetpassword='$resetcode' WHERE codechefid='$temp'");
			session_destroy();
			header("Location: complete.php?code=4");
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/style.css">
	<title>Reset Password - KeyGEnCoders</title>
</head>
<body>
	<div id="background"></div>
	<div id="wrapper">
		<header>
			<div id="KGEClogo">
				<img src="/images/KgecLogo1.jpg">
			</div>
			<div id="logo">
				<img src="/images/logosmall1.jpg">
			</div>
			<div id="cheflogo">
				<a href="http://www.codechef.com" target="_blank"><img src="/images/codechef.jpg"></a>
			</div>
			<div id="kgec">
				<a href="http://www.kgec.edu.in/" target="_blank"><img src="/images/kgec.jpeg"></a>
			</div>
			<div id="twitter">
				<a href="https://www.facebook.com/KeyGEnCoders" target="_blank"><img src="/images/twitter.png" height=48 width=48></a>
			</div>
			<div id="facebook">
				<a href="https://www.facebook.com/KeyGEnCoders" target="_blank"><img src="/images/facebook.png"></a>
			</div>
			<div id="headnames">
				<h1 id="headname">KeyGEnCoders</h1>
				<h2 id="head2name">Codechef KGEC Campus Chapter</h2>
			</div>
			
		</header>
		<nav>
			<ul>
				<li><a href="/index.html">Home</a></li>
				<li><a href="/login.php">Login</a></li>
				<li><a href="/register.php">Register</a></li>
				<li><a href="/about.html">About Us</a>
					<ul>
						<li><a href="/about.html">KeyGEnCoders</a></li>
						<li><a href="http://www.codechef.com/campus_chapter/about" target="_blank">Codechef Campus Chapters</a></li>
						<li><a href="http://www.kgec.edu.in/" target="_blank">KGEC</a></li>
					</ul>
				</li>
				<li><a href="/contactus.html">Contact Us</a>
			</ul>
		</nav>
		<br>
		<section>
			<div id="reset"> 
					<center><h1>Reset Your Password</h1><center>
					<form method="POST" action="/resetpass.php">
					<table class="resettable"> 
						<tr>  
							<td width="60%"><input type="password" name="pass" placeholder="Password"></td>
							<td width="2%"></td>
							<td style="color:RED"><span class="error"><?php echo $passwordErr;?></span></td> 
						</tr> 
						<tr> 
							<td><input type="password" name="cpass" placeholder="Confirm Password"></td> 
							<td width="2%"></td>
							<td style="color:RED"><span class="error"><?php echo $cpasswordErr;?></span></td>
						</tr> 														
				</table> 
				<center><div class="chngps"><input class="submitlogin" type="submit" name="changepass" value="Change Password"></div><center>
				</form> 
			
		</div>
		</section>
	</div>
</body>
</html>