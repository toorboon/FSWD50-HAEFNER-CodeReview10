<?php 
	session_start();
	if (!(isset($_SESSION['userId']))){
		header("Location: ../index.php");
	}	
	
	require("dbconnect.inc.php");

	$category = $_POST['category'];

	if ($category == 'fetch_all') {
		fetchAll();
	} else {
		fetchAuthorPublisher($category);
	} 

	function fetchAll() {

		$connection = $connection ?? null;
		//connect the database
		//include("dbconnect.php");
		if ($connection){
			$conn = $connection->connectDB();
		} else {
			$connection = new Database();
			$conn = $connection->connectDB();
		}
		

		//fetch data
		$output = '';

		//this if kicks out the books which are already booked and not available anymore (for the user view)
		if (isset($_SESSION['admin'])) { 
			$extra_condition = '';

		} else {
			$extra_condition = ' AND m.status = "available" ';
		}

		$sql_select = "
			SELECT 
				m.id, 				
				m.title ,			
				m.image ,			 
				m.isbn 	,			 
				m.short_description,
				concat(day(m.publish_date),'.',month(m.publish_date),'.',year(m.publish_date)) as publish_date,
				m.type,
				m.status,
				a.name as author,
	    		p.name as publisher,
	    		p.address,
	    		p.size 
		";

		$sql_select .= "
			FROM library_media m
				left join library_author a
				on a.id = m.author_id
				left join library_publisher p
				on p.id = m.publisher_id 
		";

		$sql_select .= "
			WHERE (title LIKE '%".$_POST["search"]."%' 
			OR isbn LIKE '%".$_POST["search"]."%' 
			OR a.name LIKE '%".$_POST["search"]."%') 
			".$extra_condition."
		";

		$sql_select .= "
			ORDER BY m.id
		;";
		
		$result = mysqli_query($conn, $sql_select);
		if (mysqli_num_rows($result) > 0) {
			
			while($row = mysqli_fetch_array($result)){
				if (isset($_SESSION['admin'])) { 
					$delete_button = '<a class="btn btn-danger btn-sm" href="includes/action.inc.php?delete=1&id='.$row["id"].'">Delete</a>';
					$edit_button = '<a class="btn btn-success btn-sm" href="index.php?update=1&id='.$row["id"].'">Edit</a>';
					$address_column = '<td>'.$row["address"].'</td>';
					$size_column = '<td>'.$row["size"].'</td>';
				} else {
					$delete_button = '';
					$edit_button = '';
					$address_column = '';
					$size_column = '';
				}

				$output .= 
					'<tr>
						<td>'.$row["id"].'</td>
						<td>'.$row["title"].'</td>
						<td><img class="media_photo" src="'.$row["image"].'" alt="No pic"></td>
						<td>'.$row["isbn"].'</td>
						<td>'.$row["short_description"].'</td>
						<td>'.$row["publish_date"].'</td>
						<td>'.$row["type"].'</td>
						<td>'.$row["author"].'</td>
						<td>'.$row["publisher"].'</td>
						'.$address_column.
						  $size_column.'
						<td><button id="media_'.$row["id"].'" class="btn btn-sm btn-outline-success book_media">'.$row["status"].'</button></td>
						<td>
							<div class="btn-group">
								'.$edit_button.
								  $delete_button.'
							</div>
						</td>
					<tr>';
			} 
			echo $output;

		} else {
				echo 'Data not found!';
		}
	}
	
	function fetchAuthorPublisher($table) {
		$connection = $connection ?? null;
		$table = 'library_'.$table; // did this because joined databases on server
		
		//connect the database
		//include("dbconnect.php");
		if ($connection){
			$conn = $connection->connectDB();
		} else {
			$connection = new Database();
			$conn = $connection->connectDB();
		}

	 	$sql_read = '
	 		SELECT 
	 			id,
	 			name
	 		FROM '.$table.';';

	 	$return = mysqli_query($conn, $sql_read);
		
		$result = $return->fetch_all(MYSQLI_ASSOC);
		if (mysqli_num_rows($return) > 0) {
			echo json_encode($result);
		}else{
			echo 'No '.$table.' in Database!';
		}	
	}

 ?>