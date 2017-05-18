<?php
include 'connection.php';
$bookname='';
$author='';
$publisher='';
$edition='';
if (isset($_POST['book_name'])) {
	$bookname=$_POST['book_name'];
	$author=$_POST['author'];
	$publisher=$_POST['publisher'];
	$edition=$_POST['edition'];
	$sql="INSERT INTO `books`(`name`, `author`, `publisher`, `edition`) VALUES ('$bookname','$author','$publisher','$edition')";
	if ($conn->query($sql)=== true) {
		
		header('Location:/library/index.php?msg=Book inserted Succesfully');
	}
	else
	{
		
		 header('Location:/library/index.php?msg=error has occured');
	}

}
	
?>