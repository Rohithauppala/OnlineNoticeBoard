<?php
session_start();
if(isset($_SESSION['username']))
{
	header("location:welcome.php");	
}
else
{
?>
<html>
<head>
<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<script type="text/javascript">
	function submit()
	{
		var username=$("#username").val();
		var password=$("#password").val();
		if(username=="" && password=="")
		{
			$("#message").html("<p>please fill all the details.</p>");
		}
		else if(username=="")
		{
			$("#message").html("<p>please fill username.</p>");
		}
		else if(password=="")
		{
			$("#message").html("<p>please fill password</p>");
		}
		else
		{
			var datastring="username="+username+"&password="+password;
			
				$.ajax({
				type:"POST",
				url:"login_db.php",
				data:datastring,
				beforeSend:function()
				{
				$("#message").html("Processing....");
				},
				success:function(data)
				{
				alert(data);

				if(data=="invalid")
				{
				$("#message").html("<font style='color:red;font-size:15px;font-weight:bold;'>Invalid Credentials</font>");
				}
				else
				{
					window.location='welcome.php';
				}
				}
				});

		}
	}
</script>
</head>

<body>
<div style="background-color: black;padding: 10px;">
	<h2 style="color: white;text-align: center;	">Online Notice Board</h2>
</div>
<br><br>
<div class="row">
	<div class="col-md-1"></div>
			
<!-- 			Notificatons table -->
			<div class="col-md-6">
				<table class="table">
				<tr><td>Sno</td><td>Notice Title</td><td>Send By</td><td>Date</td></tr>
				<?php

				include("db.php");
				
				$sno=0;
				$q=mysqli_query($con,"SELECT * FROM `notifications`  order by sno desc");
				while($row=mysqli_fetch_array($q))
				{
					$title=$row['Title'];
					$description=$row['Description'];
					$sent_by=$row['sent_by'];
					$date=$row['Date'];
					$sno++;
					echo "<tr><td>$sno</td><td>$title</td><td>$sent_by</td><td>$date</td>";
				}
				?>
				</table>



			</div>
<!-- 			Login code -->
			<div class="col-md-4">
				
				<div >
						<div id="message"></div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Username</label>
					    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
				
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" class="form-control" name="password" id="password">
					  </div>
					 
					  <button type="submit" class="btn btn-primary" onclick="submit();">Login</button>
					</div>


			</div>
				



				<div class="col-md-1"></div>
</div>
</body>
</html>
<?php
}
?>