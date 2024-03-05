<?php
	include "connection.php";

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$user_email = $_POST['user_email'];
	 	$fullname = $_POST['fullname'];
	 	$email = $_POST['email'];
	 	$contact = $_POST['contact'];
	 	$address = $_POST['address'];
	 	$gender = $_POST['gender'];
	 	$designation = $_POST['designation'];
	 	$skill_desc = $_POST['skill_desc'];

	 	$sql = "UPDATE remoteuser SET fullname = '$fullname', email = '$email', contact = '$contact', address = '$address', gender = '$gender', designation = '$designation', skill_desc = '$skill_desc' WHERE email = '$user_email'";

	 	if (mysqli_query($connection, $sql)) {
	 		header("location: profile.php?status=1");
	 	}
	 	else{
	 		echo "Error updating record: " . mysqli_error($connection);
	 		header("location: profile.php?status=2");
	 	}

	 } else{
	 	echo "Invalid Response";
	 }
?>