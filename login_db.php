<?php
session_start();
	if(isset($_POST['username']))
	{

		include("db.php");
		$username=$_POST['username'];
		$password=$_POST['password'];

		$q=mysqli_query($con,"SELECT * FROM users where Username='$username' and Password = '$password'");
		$row=mysqli_fetch_array($q);
		$count=mysqli_num_rows($q);
		if($count>0){
			$type=$row['Type'];

			$_SESSION['username']=$username;
			$_SESSION['user_type']=$type;
		}
		else{
			echo "invalid";
		}

	}
	else{
		header("location:welcome.php");
	}

?>