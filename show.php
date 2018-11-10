<?php 

class Content{

	public function showContent(){
		//connect the database
		include("dbconnect.php");
		$connection = new Database();
		$conn = $connection->connectDB();

		//create the query for selecting the "small" big-list
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
    		p.size ";

		$sql_select .= "
		FROM media m
			left join author a
			on a.media_id=m.id
			left join publisher p
			on p.media_id=m.id 
		";

		$sql_select .= "
		ORDER BY m.id
		;";

		$resultset = mysqli_query($conn,$sql_select);
		$result_array = $resultset->fetch_all(MYSQLI_ASSOC);
		
		/*//for testing issues
		print_r($result_array);*/

		//print the list on the screen
		foreach( $result_array as $column){
			echo '<tr>';
			echo '<td>'.$column["id"].'</td>';
			echo '<td>'.$column["title"].'</td>';
			echo '<td><img class="media_photo" src="'.$column["image"].'" alt="No pic"></td>';
			echo '<td>'.$column["isbn"].'</td>';
			echo '<td>'.$column["short_description"].'</td>';
			echo '<td>'.$column["publish_date"].'</td>';
			echo '<td>'.$column["type"].'</td>';
			echo '<td>'.$column["author"].'</td>';
			echo '<td>'.$column["publisher"].'</td>';
			echo '<td>'.$column["address"].'</td>';
			echo '<td>'.$column["size"].'</td>';
			echo '<td>'.$column["status"].'</td>';
			echo '<td><div class="btn-group"><a class="btn btn-danger btn-sm" href="action.php?delete=1&id='.$column["id"].'">Delete</a><a class="btn btn-success btn-sm" href="index.php?update=1&id='.$column["id"].'">Edit</a></div></td>';
			echo '</tr>';
		}
		//close connection
		mysqli_close($conn);	
	}
}
?>
