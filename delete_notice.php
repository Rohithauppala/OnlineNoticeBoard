<?php
session_start();
if(isset($_POST['sno']))
{

	include("db.php");

	$sno=$_POST['sno'];

	$q=mysqli_query($con,"DELETE FROM `notifications` where sno='$sno'");
	$q=mysqli_query($con,"UPDATE `notifications` SET `deleted`='Y' where sno='$sno'");
	if($q)
	{
		echo "success";
	}
	else
	{
		echo "invalid";
	}

}
else
{
	header("locaton:index.php");
}
?>