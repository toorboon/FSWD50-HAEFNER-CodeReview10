<?php 
		
		include("media.php");
		
		if(isset($_POST["submit"])){
			if ($_POST["title"] && 
				$_POST["isbn"] && 
				$_POST["publish_date"] && 
				$_POST["type"] &&
				$_POST["status"] &&
				$_POST["author"] &&
				$_POST["publisher"] &&
				$_POST["size"]){
				
				$title = $_POST["title"];
				
				$isbn = $_POST["isbn"];
				$short_description = $_POST["short_description"];
				$publish_date = $_POST["publish_date"];
				$type = $_POST["type"];
				$status = $_POST["status"];
				$author = $_POST["author"];
				$publisher = $_POST["publisher"];
				$address = $_POST["address"];
				$size = $_POST["size"];
				if(isset($_FILES['uploadFile']['name']) && !empty($_FILES['uploadFile']['name'])) {
			        //Allowed file type
			        $allowed_extensions = array("jpg","jpeg","png","gif");
			         //File extension
			        $ext = strtolower(pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION));
			    
			        //Check extension
			        if(in_array($ext, $allowed_extensions)) {
			           //Convert image to base64
			           $encoded_image = base64_encode(file_get_contents($_FILES['uploadFile']['tmp_name']));
			           $encoded_image = 'data:image/' . $ext . ';base64,' . $encoded_image;
			       }
			   }

				$newMedia = new Media(
					$media_id,
					$title, 
					$encoded_image, 
					$isbn, 
					$short_description,
					$publish_date,
					$type,
					$status,
					$author,
					$publisher,
					$address,
					$size
					);
				
				$newMedia->writeDatabase();
			}
		}

		if(isset($_GET)){
			$temp = $_GET['delete'];
			$row_id = $_GET['id'];
			if($temp==1){
				//$newDeleteRow = new Media();
				Media::deleteInDatabase($row_id);
			}
		}
		
?>
 