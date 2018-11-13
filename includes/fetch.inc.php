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
	

	//fetch data
	$output = '';
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
		FROM media m
			left join author a
			on a.id = m.author_id
			left join publisher p
			on p.id = m.publisher_id 
	";

	$sql_select .= "
		WHERE title LIKE '%".$_POST["search"]."%' 
	";

	$sql_select .= "
		ORDER BY m.id
	;";

	$result = mysqli_query($conn, $sql_select);
	if (mysqli_num_rows($result) > 0) {
		
		while($row = mysqli_fetch_array($result)){
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
					<td>'.$row["address"].'</td>
					<td>'.$row["size"].'</td>
					<td>'.$row["status"].'</td>
					<td><div class="btn-group"><a class="btn btn-danger btn-sm" href="includes/action.inc.php?delete=1&id='.$row["id"].'">Delete</a><a class="btn btn-success btn-sm" href="index.php?update=1&id='.$row["id"].'">Edit</a></div></td>
				<tr>';
		} 
		echo $output;

	} else {
			echo 'Data not found!';
	}
	
 ?>