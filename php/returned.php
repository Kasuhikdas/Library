<?php
include 'connection.php';
if (isset($_POST['id'])) {
	$id=$_POST['id'];
	$fine=$_POST['fine'];
	$book_id=$_POST['book_id'];
	$sql="UPDATE `withdrawal` SET `fine`='$fine',`status`='Completed' WHERE id='$id' ";
	if ($conn->query($sql)===true) {
		
		$sql2="UPDATE `books` SET `status`='Available' WHERE id=$book_id";
		if ($conn->query($sql2)===true) {
			header('Location:/library/index.php?msg=Book Recieved');
		}
		else
		{
			
			echo $sql2;
			echo $conn->error;
		}
	}
	else
	{
		echo $conn->error;
	}
}
?>