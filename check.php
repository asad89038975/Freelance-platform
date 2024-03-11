<?php
	include_once("connection.php");
	if (isset($_POST["email"])) {
		$sql = "SELECT * From remoteuser WHERE email = '".$_POST['email']."'";
		$result = mysqli_query($connection, $sql);
		if (mysqli_num_rows($result) > 0) {
			echo("<span id='availability' class='text-danger'>Email Already exist</span>");
		}else{
			echo("<span id='availability' class='text-success'>Email Available</span>");
		}
		
	}
?>