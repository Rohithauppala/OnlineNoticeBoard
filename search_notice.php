<?php
session_start();
if(isset($_POST['keyword']))
{

	include("db.php");

	$keyword=$_POST['keyword'];
?>
	<table class="table">
				<tr><td>Sno</td><td>Notice Title</td><td>Send By</td><td>Date</td></tr>
				<?php

				
				$sno=0;
				$q=mysqli_query($con,"SELECT * FROM `notifications` where Title like '%{$keyword}' order by sno desc");
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
<?php
}
else
{
	header("locaton:index.php");
}
?>