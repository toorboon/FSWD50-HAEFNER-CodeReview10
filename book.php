<?php 

class User {

	public $user_id;
	public $first_name;
	public $last_name;
	public $nick_name;
	public $password;

	function __construct($first_name, $last_name, $nick_name, $password){
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->nick_name = $nick_name;
		$this->password = $password;
	}

	public function writeDatabase(){
		include("dbconnect.php");
		$connection = new Database();
		$conn = $connection->connectDB();

		$sql_insert = "INSERT INTO user (
			first_name, 
			last_name, 
			nick_name, 
			password)";

		$sql_insert .= "VALUES (
			'$this->first_name',
			'$this->last_name',
			'$this->nick_name',
			'$this->password')";

		if (mysqli_query($conn, $sql_insert)) {
	   		echo "<script>alert('Data inserted successfully!');</script>";
		} else {
	  		echo "Error inserting data: " . mysqli_error($connection);
		}
		//close connection
		mysqli_close($conn);	
	}
}
?>
