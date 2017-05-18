<?php
include 'connection.php';
$date=date("Y-m-d");
$return_date='';
$fine='';
if (isset($_POST['issue_id'])) {
	$issue_id=$_POST['issue_id'];
	$sql="SELECT * FROM `withdrawal` WHERE id=$issue_id and status='Active'";
	$result=$conn->query($sql);
	$numrow=mysqli_num_rows($result);
	
	
	if ($numrow==1) {
		$row=mysqli_fetch_assoc($result);
		$return_date=date_create($row['due_date']);
		$current_date=date_create($date);
		if ($date>$row['due_date']) {
			$interval = date_diff($current_date, $return_date);
		$fine= $interval->format('%a') *5;
		}
		else{
			$fine=0;
		}
		
		$name=$row['student_name'];
		$book=$row['book_Id'];
		
		header("Location:/library/index.php?return_id=$issue_id&name=$name&fine=$fine&book_id=$book");
	}
	else
	{
			header('Location:/library/index.php?msg=Invalid Issue id or Already Completed');
	}
}
else
{

}
?>