<?php
	include '../db.php';
	$msg='';
	if(!empty($_GET['code']) && isset($_GET['code']))
	{
		$code=mysqli_real_escape_string($connect,$_GET['code']);
		$c=mysqli_query($connect,"SELECT codechefid FROM coders WHERE activation='$code'");

		if(mysqli_num_rows($c) > 0)
		{
			$count=mysqli_query($connect,"SELECT codechefid FROM coders WHERE activation='$code' and status='0'");

			if(mysqli_num_rows($count) == 1)
			{
				mysqli_query($connect,"UPDATE coders SET status='1' WHERE activation='$code'");
				header("Location:/emailverified.html");
			}
			else
			{
				header("Location:/login.php");
			}
		}
		else
		{
			$msg ="Wrong activation code.";
		}

	}
?>
<?php echo $msg; ?>