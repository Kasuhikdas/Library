<?php
include 'connection.php';
$bookid='';
$roll='';
$name='';
$std='';
$section='';
if (isset($_POST['book_id'])) {
	$bookid=$_POST['book_id'];
	$roll=$_POST['roll'];
	$name=$_POST['name'];
	$std=$_POST['std'];
	$section=$_POST['section'];
	$date=date("Y-m-d");
	$return_date=date("Y-m-d ",strtotime($date. ' + 14 days'));
	$find="SELECT status FROM books where id=$bookid and status='Available'";
	$result=$conn->query($find);
	$numrow=mysqli_num_rows($result);
	$status='';
	
	if ($numrow==1) {
		
		$row=mysqli_fetch_assoc($result);
		
			$sql="INSERT INTO `withdrawal`( `book_Id`, `student_roll`, `student_name`, `student_class`, `student_section`, `booking_date`, `due_date`) VALUES ('$bookid','$roll','$name',$std,'$section','$date','$return_date')";
			if ($conn->query($sql)===true) {
				$last_id = $conn->insert_id;
				$sql2="UPDATE `books` SET `status`='Borrowed' WHERE id=$bookid";
				if ($conn->query($sql2)===true) {
					/*$sql3="SELECT id FROM withdrawal order by id limit 1";
					$result3=$conn->query($sql3);
						$row=mysqli_fetch_assoc($result3);*/
						
						echo $last_id;
					
					header('Location:/library/index.php?return_date='.$return_date.' &issue=1&id='.$last_id.'');
				}
				else
				{
					echo "Error:".$conn->error;
				}
			}
			else
			{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			

		}
			
	
	else
	{
		header('Location:/library/index.php?msg=Book Not available');
	}

}
else
{
	header('Location:/library/index.php?msg=Variable not recieved');
}

	
?>