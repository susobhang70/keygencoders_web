<?php
	include 'db.php';
	session_start();
	if (isset($_POST['login'])) 
	{
		if(empty($_POST["codechefid"]) || empty($_POST["password"]))
		{
			header("location:login.php?error=1");
		}
		$codechefid=$_POST["codechefid"];
		$password=$_POST["password"];
		$codechefid = stripslashes($codechefid);
		$password = stripslashes($password);
		$codechefid = mysqli_real_escape_string($connect,$codechefid);
		$password = mysqli_real_escape_string($connect,$password);
		$query=mysqli_query($connect,"SELECT * from coders WHERE codechefid='$codechefid' AND password='$password'");
		if(mysqli_num_rows($query)==0)
		{	
			header("location:login.php?error=1");
		}
		else
		{
			$count=mysqli_query($connect, "SELECT * from coders WHERE codechefid='$codechefid' AND password='$password' AND status='1'");
			if(mysqli_num_rows($count)==0)
			{
				mysqli_close();
				$_SESSION['codechefid'] = $_POST['codechefid'];
				$_SESSION['status']=0;
				header("location:reactivate.php?error=1");
			}
			else
			{
				mysqli_close();
				$_SESSION['codechefid'] = $_POST['codechefid'];
				$_SESSION['status']=1;
				header("location:home.php");
			}
		}
	}
?>