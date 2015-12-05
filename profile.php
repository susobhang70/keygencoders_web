<?php
	session_start();
	$nameErr="";
	$passErr="";
	$passnotif="";
	include 'db.php';
	if ((!isset($_SESSION['codechefid']))||$_SESSION['status']==0) 
	{
		header('Location: login.php');
	}
	$codechefid=$_SESSION['codechefid'];
	$query=mysqli_query($connect,"SELECT * FROM coders WHERE codechefid='$codechefid'");
	$c=mysqli_fetch_assoc($query);
	$attr='selected="selected"';
	$name=$c['name'];
	$email=$c['email'];
	$contact=$c['mobile'];
	$gen=$c['gender'];
	if($gen==1)
		$gender="Male";
	else
		$gender="Female";
	$year=$c['year'];
	$stream=$c['stream'];

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(isset($_POST['updateinfo']))
		{
			if(empty($_POST['name']))
			{
				$nameErr="Name cannot be blank!";
			}
			else
			{
				$name=$_POST['name'];
				$contact=$_POST['contact'];
				$year=$_POST['year'];
				$passnotif='Details updated successfully';
				mysqli_query($connect,"UPDATE coders SET name='$name', mobile='$contact', year='$year' WHERE codechefid='$codechefid'");
			}
		}
		else if(isset($_POST['updatepass']))
		{
			if(empty($_POST['oldpass']))
			{
				$passErr="Enter old password!";
			}
			else if(empty($_POST['newpass']))
			{
				$passErr="New Password can't be NULL!";
			}
			else if(empty($_POST['cnewpass'])||($_POST['newpass']!=$_POST['cnewpass']))
			{
				$passErr="Passwords don't match!";
			}
			else
			{
				$oldpass=$_POST['oldpass'];
				$presentpass=$c['password'];
				if($oldpass!=$presentpass)
				{
					$passErr="Present password is incorrect!";
				}
				else
				{
					$passnotif="Password Updated Successfully!";
					$pass=$_POST['newpass'];
					mysqli_query($connect,"UPDATE coders SET password='$pass' WHERE codechefid='$codechefid'");
				}
			}
		}
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style3.css">
		<title><?php echo $codechefid;?> - Profile</title>
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
			<br>
			<div id="profiletable">
				<form method="POST" action="profile.php">
					<center><p class="error"><?php echo $passnotif;?></p></center>
					<center><h1>Personal Details</h1></center>
					<center><p class="error"><?php echo $nameErr;?></p></center>
					<table class="profile">
						<tr class="edit">
							<td>Name: </td>
							<td width='2%'></td>
							<td><input value="<?php echo $name; ?>" type="text" name="name"></td>
						</tr>
						<tr class="readO">
							<td>Email: </td>
							<td></td>
							<td><input value="<?php echo $email; ?>" type="text" readonly></td>
						</tr>
						<tr class="readO">
							<td>Codechef ID: </td>
							<td></td>
							<td><input value="<?php echo $codechefid; ?>" type="text" readonly></td>
						</tr>
						<tr class="readO">
							<td>Gender: </td>
							<td></td>
							<td><input value="<?php echo $gender; ?>" type="text" readonly></td>
						</tr>
						<tr class="readO">
							<td>Stream: </td>
							<td></td>
							<td><input value="<?php echo $stream; ?>" type="text" readonly></td>
						</tr>
						<tr class="edit">
							<td>Year: </td>
							<td></td>
							<td>
								<select name="year" type="text" id="year">
										<option value="First"  <?php echo $year== "First" ? $attr : ''; ?>>First</option>
										<option value="Second"  <?php echo $year== "Second" ? $attr : ''; ?>>Second</option>
										<option value="Third"  <?php echo $year== "Third" ? $attr : ''; ?>>Third</option>
										<option value="Fourth"  <?php echo $year== "Fourth" ? $attr : ''; ?>>Fourth</option>
								</select>
							</td>
						</tr>
						<tr class="edit">
							<td>Contact No.: </td>
							<td></td>
							<td><input value="<?php echo $contact;?>" type="tel" name="contact"></td>
						</tr>
					</table>
					<center><div class="sublog"><input class="submitlogin" type="submit" name="updateinfo" value="Update Details"></div><center>
				</form>
			</div>
			<br>
			<br>
			<div id="changepass">
				<form method="POST" action="profile.php">
					<center><h1>Change Password</h1></center>
					<center><p class="error"><?php echo $passErr; ?></p></center>
					<table class="passwordchange">
						<tr>
							<td>Old Password: </td>
							<td width="2%"></td>
							<td width="66%"><input type="password" name="oldpass"></td>
						</tr>
						<tr>
							<td>New Password: </td>
							<td></td>
							<td><input type="password" name="newpass"></td>
						</tr>
						<tr>
							<td>Confirm New Password: </td>
							<td></td>
							<td><input type="password" name="cnewpass"></td>
						</tr>
					</table>
					<center><div class="sublog"><input class="submitlogin" type="submit" name="updatepass" value="Update Password"></div><center>
				</form>
			</div>
		</section>
	</div>
	</body>
</html>