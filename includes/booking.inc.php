<?php 
	session_start();
	if (!(isset($_SESSION['userId']))){
		header("Location: ../index.php");
	}

	require("dbconnect.inc.php");

	$connection = $connection ?? null;
	//connect the database
	//include("dbconnect.php");
	if ($connection){
		$conn = $connection->connectDB();
	} else {
		$connection = new Database();
		$conn = $connection->connectDB();
	}

	$booked_media_id = $_POST["media_id"];
	$user_id = $_SESSION["userId"];

	$sql_select = "SELECT * FROM library_media WHERE id = ".$booked_media_id;

	$result = mysqli_query($conn, $sql_select);
	$result_set = mysqli_fetch_array($result);
	
	if (mysqli_num_rows($result) > 0) {
		if ($result_set['status'] == 'booked'){
			$status = 'available';
			$user_id = 0;
		} else {
			$status = 'booked';
		}
	} else {
		echo "<script>swal('No media found in database! Contact the system administrator')</script>";
	}

	$sql_update = "
		UPDATE library_media ";

	$sql_update .= "
		SET user_id = ".$user_id." ";

	$sql_update .= "
		WHERE id = ".$booked_media_id.";";

	$sql_update .= "
		UPDATE library_media ";

	$sql_update .= "
		SET status = '".$status."' ";

	$sql_update .= "
		WHERE id = ".$booked_media_id.";";

	if(mysqli_multi_query($conn, $sql_update) == TRUE){
		echo $status;
	} else {
		echo("sql_query couldn't run as expected!");
		echo($sql_update);
		print_r($_SESSION);
	}

	//close connection
	mysqli_close($conn);
 ?>