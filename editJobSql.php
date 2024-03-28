<?php
	include "connection.php";

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
		$user_email = $_POST['user_email'];
	 	$jobId = $_POST['jobId'];
	 	$userId = $_POST['userId'];
	 	$cover_letter = $_POST['cover_letter'];

	 	// File upload handling
	 	$targetDirectory = "assets/images/";
	 	$targetFile = $targetDirectory . basename($_FILES["related_work"]["name"]);
	 	$fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

	 	// Delete existing related work file
	 	$sql_select = "SELECT related_work FROM apply_job WHERE user_email = '$user_email' AND user_id = '$userId' AND job_id = '$jobId'";
	 	$result_select = mysqli_query($connection, $sql_select);
	 	$row = mysqli_fetch_assoc($result_select);
	 	$existingFile = $row['related_work'];
	 	if (file_exists($existingFile)) {
	 		unlink($existingFile); // Delete existing file
	 	}

	 	// Allow only specific file types
	 	$allowedTypes = array('jpg', 'jpeg', 'png', 'gif', 'pdf', 'mp4', 'mov');
	 	if (in_array($fileType, $allowedTypes)) {
	 		if (move_uploaded_file($_FILES["related_work"]["tmp_name"], $targetFile)) {
	 			// Update the database with new cover letter, work, and related work file
	 			$sql = "UPDATE apply_job SET cover_letter = '$cover_letter', related_work = '$related_work', related_work = '$targetFile' WHERE user_email = '$user_email' AND user_id = '$userId' AND job_id = '$jobId'";
	 			if (mysqli_query($connection, $sql)) {
	 				header("location: editJob.php?status=1&jobId=$jobId&userId=$userId");
	 			} else {
	 				echo "Error updating record: " . mysqli_error($connection);
	 				header("location: editJob.php?status=0&jobId=$jobId&userId=$userId");
	 			}
	 		} else {
	 			echo "Error uploading file.";
	 			header("location: editJob.php?status=0&jobId=$jobId&userId=$userId");
	 		}
	 	} else {
	 		echo "Invalid file type. Allowed types are jpg, jpeg, png, gif, pdf, mp4, mov.";
	 		header("location: editJob.php?status=0");
	 	}
	} else {
	 	echo "Invalid Response";
	}
?>
