<?php 

class Media {

	public $media_id;
	public $title;
	public $image;
	public $isbn;
	public $short_description;
	public $publish_date;
	public $type;
	public $status;
	public $author;
	public $publisher;
	public $address;
	public $size;
	

	//create an object of the type media
	function __construct($media_id = null, $title, $image = null, $isbn, $short_description = null, $publish_date, $type, $status = 'available', $author = null, $publisher = null, $address = null, $size = null){
		
		$this->media_id = $media_id;
		$this->title = $title;
		$this->image = $image;
		$this->isbn = $isbn;
		$this->short_description = $short_description;
		$this->publish_date = $publish_date;
		$this->type = $type;
		$this->status = $status;
		$this->author = $author;
		$this->publisher = $publisher;
		$this->address = $address;
		$this->size = $size;
	}

	public function writeDatabase(){
		
		//connect to database
		include("dbconnect.php");
		$connection = new Database();
		$conn = $connection->connectDB();

		//query for writing into the database
		$sql_insert1 = "INSERT INTO media (
			title, 
			image, 
			isbn, 
			short_description,
			publish_date,
			type,
			status)";

		$sql_insert1 .= " VALUES (
			'$this->title',
			'$this->image',
			'$this->isbn',
			'$this->short_description',
			'$this->publish_date',
			'$this->type',
			'$this->status'
		); ";

		if ($conn->query($sql_insert1) === TRUE) {
		    $last_media_id = $conn->insert_id;
		    echo "New record created successfully."; 
		}

		$sql_insert2 .= "INSERT INTO author (
			name, 
			media_id)";

		$sql_insert2 .= " VALUES (
			'$this->author',
			'$last_media_id'
		); ";

		$sql_insert2 .= "INSERT INTO publisher (
			name,
			address,
			size, 
			media_id)";

		$sql_insert2 .= " VALUES (
			'$this->publisher',
			'$this->address',
			'$this->size',
			'$last_media_id'
		);";

		/*//for testing issues FUCK XAMPP
		echo $sql_insert.'<br>';
		echo $sql_insert2.'<br>';
		echo $this->title.'<br>';
		echo $this->image.'<br>';
		echo $this->isbn.'<br>';
		echo $this->short_description.'<br>';
		echo $this->publish_date.'<br>';
		echo $this->type.'<br>';
		echo $this->author.'<br>';*/
		
		if (mysqli_multi_query($conn, $sql_insert2)) {
	   		header("location:index.php?msg=Record Inserted Sucessfully");
	   		
		} else {
	  		echo "Error inserting data: ";
		}
		
		//close connection
		mysqli_close($conn);	
	}

	public static function deleteInDatabase($row_id){
		//connect to database
		include("dbconnect.php");
		$connection = new Database();
		$conn = $connection->connectDB();
		

		//query for writing into the database
		$sql_delete = "
			DELETE FROM publisher 
			";

		$sql_delete .= "
			WHERE media_id = $row_id
			;";	

		$sql_delete .= "
			DELETE FROM author 
			";

		$sql_delete .= "
			WHERE media_id = $row_id
			;";	

		$sql_delete .= "
			DELETE FROM media 
			";

		$sql_delete .= "
			WHERE id = $row_id
			; ";

		if (mysqli_multi_query($conn, $sql_delete)) {
	   		header("location:index.php?msg=Record Deleted Sucessfully");
	   		sleep(1); //this is necessary to keep the refresh from refreshing BEFORE the database is done with deleting
		} else {
	  		echo "Error deleting data: ";
		}

		//close connection
		mysqli_close($conn);	
	}

	public static function fetchFromDatabase($row_id){
		//connect to database
		include("dbconnect.php");
		//$connection = new Database();
		$conn = $connection->connectDB();

		/*//query for fetching the correct row from the database
		$sql_select_one = "
			SELECT * 
			";
		$sql_select_one .= "
			FROM media;
			";
		$sql_select_one .= "
			WHERE id = $row_id;
			";
		

		
   		$resultset = mysqli_query($conn,$sql_select_one);
		$result_array = $resultset->fetch_all(MYSQLI_ASSOC);
		
		//for testing issues
		print_r($result_array);
		

		//close connection
		mysqli_close($conn);	
*/
	}

	public static function updateInDatabase($row_id){
		//connect to database
		include("dbconnect.php");
		$connection = new Database();
		$conn = $connection->connectDB();

		//query for writing into the database
		$sql_update = "
			UPDATE media 
			";

		$sql_update .= "
			SET 
			'$this->media_id',
			'$this->title',
			'$this->image',
			'$this->isbn',
			'$this->short_description',
			'$this->publish_date',
			'$this->type',
			'$this->status' 
			";

		$sql_update .= "
			WHERE id = $row_id;
			";	

		if (mysqli_query($conn, $sql_update)) {
	   		header("location:index.php?msg=Record Deleted Sucessfully");
		} else {
	  		echo "Error deleting data: " . mysqli_error($connection);
		}

		//close connection
		mysqli_close($conn);	
	}
}
?>
