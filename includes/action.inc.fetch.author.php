<?php 
	session_start();
	if (!(isset($_SESSION['userId']))){
		header("Location: ../index.php");
	}	
	
	require("dbconnect.inc.php");

	fetchAuthor();

	function fetchAuthor(){
		$connection = $connection ?? null;
		//connect the database
		//include("dbconnect.php");
		if ($connection){
			$conn = $connection->connectDB();
		} else {
			$connection = new Database();
			$conn = $connection->connectDB();
		}

	 	$sql_read_author = '
	 		SELECT 
	 			id,
	 			name
	 		FROM library_author;';

	 	$return = mysqli_query($conn, $sql_read_author);
		
		$result = $return->fetch_all(MYSQLI_ASSOC);
		if (mysqli_num_rows($return) > 0) {
			echo json_encode($result);
		}else{
			echo 'No authors in Database!';
		}
	}