<?php 

	if (!(isset($_SESSION['admin']))){
		header("Location: ../index.php");
	}
	
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
	
	//create an object of the type media
	function __construct($media_id = null, $title, $image = null, $isbn, $short_description = null, $publish_date, $type, $status = 'available', $author = null, $publisher = null){
		
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
	}

	public function writeMedia(){
		
		//connect the database
		//include("dbconnect.php");
		$connection = $connection ?? null;
		if ($connection){
			$conn = $connection->connectDB();
		} else {
			$connection = new Database();
			$conn = $connection->connectDB();
		}

		//query for writing into the database
		$sql_insert_media = "INSERT INTO library_media (
			title, 
			image, 
			isbn, 
			short_description,
			publish_date,
			type,
			status,
			author_id,
			publisher_id
		)";

		$sql_insert_media .= " VALUES (
			'$this->title',
			'$this->image',
			'$this->isbn',
			'$this->short_description',
			'$this->publish_date',
			'$this->type',
			'$this->status',
			'$this->author',
			'$this->publisher'
		);";
		
		if (mysqli_query($conn, $sql_insert_media)) {
	   		header("location:../index.php?msg=Record Inserted Sucessfully");
	   		
		} else {
	  		echo "Error inserting data: ";
		}
		
		//close connection
		mysqli_close($conn);	
	}

	public static function deleteMedia($row_id){
		//connect the database
		//include("dbconnect.php");
		if ($connection){
			$conn = $connection->connectDB();
		} else {
			$connection = new Database();
			$conn = $connection->connectDB();
		}	

		//query for writing into the database
		$sql_delete = "
			DELETE FROM library_media 
			";

		$sql_delete .= "
			WHERE id = $row_id
			;";	

		if (mysqli_query($conn, $sql_delete)) {
	   		header("location:../index.php?msg=Record Deleted Sucessfully");
	   		sleep(1); //this is necessary to keep the refresh from refreshing BEFORE the database is done with deleting
		} else {
	  		echo "Error deleting data: ";
		}

		//close connection
		mysqli_close($conn);	
	}

	public static function fetchMedia($row_id){
		//connect the database
		//require("dbconnect.php");
		$connection = $connection ?? null;
		if ($connection){
			$conn = $connection->connectDB();
		} else {
			$connection = new Database();
			$conn = $connection->connectDB();
		}

		//query for fetching the correct row from the database
		$sql_select_one = "
			SELECT * 
			";
		$sql_select_one .= "
			FROM library_media 
			";
		$sql_select_one .= "
			WHERE id = ".$row_id;
		
		

   		$resultset = mysqli_query($conn,$sql_select_one);
		$result_array = $resultset->fetch_all(MYSQLI_ASSOC);
		
		//close connection
		mysqli_close($conn);

		return $result_array;	

	}

	public function updateMedia(){
		//connect the database
		$connection = $connection ?? null;
		if ($connection){
			$conn = $connection->connectDB();
		} else {
			$connection = new Database();
			$conn = $connection->connectDB();
		}

		//query for writing into the database
		if (!($this->image)) {
			$image_condition = '';
		} else {
			$image_condition = "image = '$this->image',";
		}
		$sql_update = "
			UPDATE library_media 
			";

		$sql_update .= "
			SET	title = '$this->title',
				".$image_condition."
				isbn = '$this->isbn',
				short_description = '$this->short_description',
				publish_date = '$this->publish_date',
				type = '$this->type',
				status = '$this->status' 
			";

		$sql_update .= "
			WHERE id = $this->media_id;
			";	

		//echo "<br>".$sql_update."<br>";

		if (mysqli_query($conn, $sql_update)) {
	   		header("location:../index.php?msg=Record Updated Sucessfully");
		} else {
	  		echo "Error Updating data: " . mysqli_error($connection);
		}

		//close connection
		mysqli_close($conn);	
	}
}
?>
