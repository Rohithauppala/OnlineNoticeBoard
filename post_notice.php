<?php
session_start();
if(isset($_POST['title']))
{

	include("db.php");
	
	$send_by=$_SESSION['username'];

	$title=$_POST['title'];
	$description=$_POST['description'];

	$date=date("Y-m-j");

	$q=mysqli_query($con,"INSERT INTO `notifications` (`Title`,`Description`,`sent_by`,`Date`) values ('$title','$description','$send_by','$date')");
	
}
else
{
	header("locaton:index.php");
}
?>