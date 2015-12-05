<?php
	include 'db.php';
	$flag=0;
	$nameErr = $emailErr = $passwordErr = $codechefidErr = $cpasswordErr=$genderErr=$yearErr=$streamErr="";
	$name = $email = $gender = $mobile = $codechefid = $stream = $year =  $password =$cpassword ="";
	$attr = 'selected="selected"';
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
	   	if (empty($_POST["name"])) 
	   	{
	     	$nameErr = "Name is required";
	     	$flag=1;
	   	} 
	   	else 
	   	{
	     	$name = test_input($_POST["name"]);
	     	if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
	     	{
      			$nameErr = "Only letters and white space allowed";
      			$flag=1; 
    		}
	   	}
	   
	   if (empty($_POST["email"])) 
	   {
	     	$emailErr = "Email is required";
	     	$flag=1;
	   } 
	   else 
	   {
	     	$email = test_input($_POST["email"]);
	     	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	     	{
      			$emailErr = "Invalid email format"; 
      			$flag=1;
    		}
	   }
	   if (empty($_POST["pass"])) 
	   {
	     	$passwordErr = "Password is required";
	     	$flag=1;
	   } 
	   else 
	   {
	     	$password = $_POST["pass"];
	   }
	   $gender=$_POST["gender"];
	   if($gender=="selected")
	   {
	   		$gender="";
	   		$genderErr="Select Gender!";
	   		$flag=1;
	   }
	   if (empty($_POST["cpass"])) 
	   {
	     	$cpasswordErr = "Confirm Password!";
	     	$flag=1;
	   } 
	   else 
	   {
	   		if ($_POST["pass"] == $_POST["cpass"]) 
	   		{
   				$cpassword = $_POST["cpass"];
			}
	     	else
	     	{
	     		$cpasswordErr = "Passwords don't match";
	     		$password="";
	     		$flag=1;
	     	}
	   }
	   if (empty($_POST["codechefid"])) 
	   {
	     	$codechefidErr = <<<EOD
	     	Codechef ID is required. If you don't have one, register <a href="http://www.codechef.com/user/register" target="_blank">here</a> 
EOD;
	     	$flag=1;
	   }
	   else
	   {
	   		$codechefid = $_POST["codechefid"];
	   }
	   $year = $_POST["year"];
	   $stream = $_POST["stream"];
	   $mobile = $_POST["mobile"];
	   if($stream=="selected")
	   {
	   		$stream="";
	   		$streamErr="Select Stream!";
	   		$flag=1;
	   }
	   if($year=="selected")
	   {
	   		$year="";
	   		$yearErr="Select Year!";
	   		$flag=1;
	   }
	}

	function test_input($data) 
	{
	   $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	if($flag==0 && $_SERVER["REQUEST_METHOD"] == "POST")
	{
		$querycodechefid = mysqli_query($connect,"SELECT codechefid FROM coders WHERE codechefid='$codechefid'");
		$queryemail = mysqli_query($connect,"SELECT email FROM coders WHERE email='$email'");

		if($querycodechefid==false)
		{
			echo mysql_error();
		}

		if(mysqli_num_rows($querycodechefid) != 0)
		{
			$codechefidErr="Codechef ID already registered!";
			$flag=1;

		}
		if(mysqli_num_rows($queryemail) != 0)
		{
			$emailErr="Email has been registered already!";
			$flag=1;
		}
		if($flag==0)
		{
			$genderid=0;
			if($gender=="male")
			{
				$genderid=1;
			}
			$activation=md5($email.time());
			$query = "INSERT INTO coders (password,email,codechefid,mobile,gender,stream,year,name,activation) VALUES ('$password','$email','$codechefid','$mobile','$genderid','$stream','$year','$name','$activation')";
			$data = mysqli_query($connect,$query)or die(mysql_error()); 
			if($data) 
			{ 
				include 'smtp/sendmail.php';
				$to=$email;
				$subject="KeyGEnCoders email verification";
				$body='Hi '.$name.', <br> <br/> Thank you for signing up with us. Please click on the link below to verify your account and start using your KeyGEnCoders account <br> <br/> <a href="'.$base_url.'emailactivate/activation/'.$activation.'">'.$base_url.'emailactivate/activation/'.$activation.'</a>';
				$check=Send_Mail($to,$subject,$body);
				if($check==true)
				{
					header("Location: complete.php");
					exit;
				}
				else
				{
					echo "Error sending email";
				}
			}
		}
		mysqli_close($connect);
	}
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Register - KeyGEnCoders</title>
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
		<section>
			<div id="register"> 
				
					<center><h1>Registration Form</h1><center>
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<table class="registertable"> 
						<tr> 
							
							<td width="60%"><input type="text" name="name" value="<?php echo $name;?>" placeholder="Name"></td>
							<td width="2%"></td>
							<td style="color:RED"><span class="error"><?php echo $nameErr;?></span></td>
						</tr> 

						<tr> 
							<td>
								<select name="gender" type="text" id="gender">
										<option value="selected"  <?php echo $gender == "" ? $attr : ''; ?>>---Select Gender---</option>
										<option value="male" <?php echo $gender == "male" ? $attr : ''; ?>>Male</option>
										<option value="female" <?php echo $gender== "female" ? $attr : ''; ?>>Female</option>
								</select>
							</td>
							<td width="2%"></td>
							<td style="color:RED"><span class="error"><?php echo $genderErr;?></span></td>

						</tr> 

						<tr> 
							<td>
								<select name="stream" type="text" id="stream">
										<option value="selected" <?php echo $stream == "" ? $attr : ''; ?>>---Select Stream---</option>
										<option value="CSE" <?php echo $stream == "CSE" ? $attr : ''; ?>>CSE</option>
										<option value="IT" <?php echo $stream == "IT" ? $attr : ''; ?>>IT</option>
										<option value="ECE" <?php echo $stream == "ECE" ? $attr : ''; ?>>ECE</option>
										<option value="EE" <?php echo $stream == "EE" ? $attr : ''; ?>>EE</option>
										<option value="ME" <?php echo $stream== "ME" ? $attr : ''; ?>>ME</option>
										<option value="MCA" <?php echo $stream == "MCA" ? $attr : ''; ?>>MCA</option>
								</select>
							</td>
							<td width="2%"></td>
							<td style="color:RED"><span class="error"><?php echo $streamErr;?></span></td>
						</tr> 

						<tr> 
							<td>
								<select name="year" type="text" id="year">
										<option value="selected"  <?php echo $year== "" ? $attr : ''; ?>>---Select Year---</option>
										<option value="First"  <?php echo $year== "First" ? $attr : ''; ?>>First</option>
										<option value="Second"  <?php echo $year== "Second" ? $attr : ''; ?>>Second</option>
										<option value="Third"  <?php echo $year== "Third" ? $attr : ''; ?>>Third</option>
										<option value="Fourth"  <?php echo $year== "Fourth" ? $attr : ''; ?>>Fourth</option>
								</select>
							</td>
							<td width="2%"></td>
							<td style="color:RED"><span class="error"><?php echo $yearErr;?></span></td>
						</tr> 

						<tr> 
							<td><input type="tel" name="mobile" value="<?php echo $mobile;?>" placeholder="Contact Number"></td>
							<td width="2%"></td>
						</tr> 
						<tr> 
							<td><input type="text" name="codechefid" value="<?php echo $codechefid;?>" placeholder="Codechef ID"></td>
							<td width="2%"></td>
							<td style="color:RED"><span class="error"><?php echo $codechefidErr;?></span></td>
						</tr>
						<tr> 
							<td><input type="text" name="email" value="<?php echo $email;?>" placeholder="Email"></td>
							<td width="2%"></td>
							<td style="color:RED"><span class="error"><?php echo $emailErr;?></span></td>
						</tr>  
						<tr>  
							<td><input type="password" name="pass" placeholder="Password"></td>
							<td width="2%"></td>
							<td style="color:RED"><span class="error"><?php echo $passwordErr;?></span></td> 
						</tr> 
						<tr> 
							<td><input type="password" name="cpass" placeholder="Confirm Password"></td> 
							<td width="2%"></td>
							<td style="color:RED"><span class="error"><?php echo $cpasswordErr;?></span></td>
						</tr> 														
				</table> 
				<center><div class="sublog"><input class="submitlogin" type="submit" name="submit" value="Register"></div><center>
				</form> 
			
		</div>
		</section>
	</div>
</body>
</html>