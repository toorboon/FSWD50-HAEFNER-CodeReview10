<!-- This code is for the form which registers new media -->
<?php 
	if (!(isset($_SESSION['userId']))){
		header("Location: index.php");
	}	
		if(isset($_GET['update'])){
			$row_id = $_GET['id'] ?? null;
			include("includes/media.inc.php");
			
			echo "<script>$(document).ready(function(){
		  		$('#register_book_form').modal('show')
		  		})
		  	</script>";
			$new_session = Media::fetchFromDatabase($row_id);
		}
			// print_r($new_session);
			$media_id = $new_session[0]["id"] ?? NULL;
			$title = $new_session[0]["title"] ?? "Die Reisen des John Doe";
			$image = $new_session[0]["image"] ?? "img/default.jpg";
			$isbn = $new_session[0]["isbn"] ?? "1234567890";
			$short_description = $new_session[0]["short_description"] ?? "Some short description about this book";
			$publish_date = $new_session[0]["publish_date"] ?? "2018-11-09";
			$type = $new_session[0]["type"] ?? NULL;
			$status = $new_session[0]["status"] ?? NULL;
			$author = $new_session[0]["author"] ?? "Horst Peter";
			$publisher = $new_session[0]["publisher"] ?? "Horst Wald Verlag";
			$address = $new_session[0]["address"] ?? "Horstgasse 1, 1210, Wien";
			$size = $new_session[0]["size"] ?? NULL;
			
?>

<div class="modal fade" id="register_book_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">
	        	<?php if($media_id){echo("Change the Media here!");}else{echo("Add New Media Here!");} ?>
	        </h5>
	        <button type="button" class="close close_button" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form  action="includes/action.inc.php" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
					<div class="form-group">
						<input  class="form-control" type="text" name="id" placeholder="ID" value="<?php echo $media_id; ?>">
					</div>
					<div class="form-group">
						<label>Title</label>
						<input class="form-control" type="text" name="title" placeholder="Title" value="<?php echo $title; ?>">
					</div>
					<div class="form-group">
						<label>Upload Image</label>
						<input class="d-block" type="file" name="uploadFile"value="<?php echo $image; ?>">
					</div>
					<div class="form-group">
						<label>ISBN</label>
						<input class="form-control" type="text" name="isbn" placeholder="ISBN" value="<?php echo $isbn; ?>">
					</div>
					<div class="form-group">
						<label>Short Description</label>
						<input class="form-control" type="text" name="short_description" placeholder="Short Description" value="<?php echo $short_description; ?>">
					</div>
					<div class="d-flex justify-content-between align-items-end form-group">
						<div class="inline">
							<label>Publish Date</label>
							<input class="form-control" type="date" name="publish_date" placeholder="Publish Date" value="<?php echo $publish_date; ?>">
						</div>

						<div class="inline">
							<select class="custom-select form-control" name="type" required value="<?php echo $type; ?>">
								<option value=""  disabled>Choose type</option>
								<option value="Book" selected>Book</option>
								<option value="CD">CD</option>
								<option value="DVD">DVD</option>
							</select>
						</div>
						<div class="inline">
							<select class="custom-select form-control" name="status" required value="<?php echo $status; ?>">
								<option value=""  disabled>Choose status</option>
								<option value="available" selected>available</option>
								<option value="rented">rented</option>
							</select>
						</div>
					</div>
					<div class="form-group" <?php if($media_id){echo"hidden";} ?>>
						<label>Author</label>
						<input class="form-control" type="text" name="author" placeholder="Author" value="<?php echo $author; ?>">
					</div>
					<div class="form-group" <?php if($media_id){echo"hidden";} ?>>
						<label>Publisher</label>
						<input class="form-control" type="text" name="publisher" placeholder="Publisher" value="<?php echo $publisher; ?>">
					</div>
					<div class="form-group" <?php if($media_id){echo"hidden";} ?>>
						<label>Publisher Address</label>
						<input class="form-control" type="text" name="address" placeholder="Publisher Address" value="<?php echo $address; ?>">
					</div>
					<div class="form-group" <?php if($media_id){echo"hidden";} ?>>
						<select class="custom-select form-control" name="size" required value="<?php echo $size; ?>">
							<option value=""  disabled>Choose size</option>
							<option value="Large" selected>Large</option>
							<option value="Medium">Medium</option>
							<option value="Small">Small</option>
						</select>
					</div>
					<div class="d-flex justify-content-center btn-group">
						<button type="button" class="btn btn-danger close_button" data-dismiss="modal">Close</button>
						<input class="btn btn-success" type="submit" name="submit" value="<?php if($media_id){echo"Update";} else {echo"Insert";}?>" id="btn">
					</div>
			</form>
	      </div>
	    </div>
	  </div>
	</div>