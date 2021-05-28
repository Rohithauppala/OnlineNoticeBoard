<?php
session_start();
if(isset($_SESSION['username']))
{
	$username=$_SESSION['username'];
	$user_type=$_SESSION['user_type'];
	
?>

<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
	function search_notice(){
		var keyword=$("#keyword").val();
		//alert(keyword);
		var datastring="keyword="+keyword;
			
				$.ajax({
				type:"POST",
				url:"search_notice.php",
				data:datastring,
				beforeSend:function()
				{
				$("#message1").html("Processing....");
				},
				success:function(data)
				{
				//alert(data);
				$("#notices").html("data");
				}
			});
	}
	function delete_notice(sno){
		//alert(sno);
		var datastring="sno="+sno;
				$.ajax({
				type:"POST",
				url:"delete_notice.php",
				data:datastring,
				beforeSend:function()
				{
				$("#message1").html("Processing....");
				},
				success:function(data)
				{
				//alert(data);

				if(data=="success")
				{
					$("#"+sno+"").fadeOut(3000);
					$("#"+sno+"").html("<font style='color:green;font-size:15px;font-weight:bold;'>sucessfully notification deleted.</font>");
					window.location='welcome.php';
					$("#"+sno+"").fadeOut(10000);
				}
				else
				{
					
					$("#message1").html("<font style='color:red;font-size:15px;font-weight:bold;'>Something Wrong</font>");
				}
				}
				});
	}	
	function submit()
	{
		var title=$("#title").val();
		var description=$("#description").val();
		if(title=="" && description=="")
		{
			$("#message").html("<p>please fill all the details.</p>");
		}
		else if(title=="")
		{
			$("#message").html("<p>please fill title.</p>");
		}
		else if(description=="")
		{
			$("#message").html("<p>please fill description.</p>");
		}
		else
		{
			var datastring="title="+title+"&description="+description;
			
				$.ajax({
				type:"POST",
				url:"post_notice.php",
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
				$("#message").html("<font style='color:red;font-size:15px;font-weight:bold;'>Something Wrong</font>");
				}
				else
				{
					alert("sucessfully notification added.");
					window.location='welcome.php';
				}
				}
				});

		}
	}
</script>
<body>

<div style="background-color: black;padding: 10px;color: white;text-align: center;" >
	<h2 >Online Notice Board</h2>
	Hello  <?php echo $username;?><a href="logout.php" style="color:white;text-decoration: none;">&nbsp;&nbsp;&nbsp;Logout</a>
</div>
<br><br>
<div class="row">
	<div class="col-md-1"></div>
			
<!-- 			Notificatons table -->
			<div class="col-md-6">
				<div style="text-align: center;">SEARCH:
					<input type="text" id="keyword"  oninput="search_notice();">
				</div><br>
				<div id="notices">
					<div id="message1"></div>
					<table class="table">
					<tr><td>Sno</td><td>Notice Title</td><td>Send By</td><td>Date</td></tr>
					<?php

					include("db.php");
					
					$sno=0;
					$q=mysqli_query($con,"SELECT * FROM `notifications` where `deleted`='N' order by sno desc");
					while($row=mysqli_fetch_array($q))
					{
						$sid=$row['sno'];//database sid;
						$title=$row['Title'];
						$description=$row['Description'];
						$sent_by=$row['sent_by'];
						$date=$row['Date'];
						$sno++;//notice increment

						echo "<tr id='$sid'>
								<td>$sno</td>
								<td>$title</td>
								<td>$sent_by</td>
								<td>$date</td>
								<td><button class='btn btn-danger' onclick='delete_notice($sid)'>Delete</button></td>
								</tr>";
					}
					?>
					</table>
				</div>

			</div>
<!-- 			Login code -->
			<div class="col-md-4">
				
				<div >
						<div id="message"></div>
						<h1>Post a Notice</h1>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Title</label>
					    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
				
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Description</label><br>
					    <textarea class="form-control" id="description" name="description"></textarea>
					  </div>
					 
					  <button type="submit" class="btn btn-primary" onclick="submit();">Submit</button>
					</div>


			</div>
				



				<div class="col-md-1"></div>
</div>
</body>

<?php
}
else
{
	header("location:index.php");
}
?>