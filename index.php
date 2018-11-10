<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <title>New Library</title>
  </head>
  <body>
  	<!--navbar comes here-->
    <nav class="sticky-top navbar navbar-dark bg-site-greennav">
	  <div>
	  	<img id="icon" src="" alt="">
	  	<a class="navbar-brand">New Library</a>
	  </div>
	  <form class="form-inline">
	    <div class="mr-2">
	    	<button type="button" class="btn btn-sm btn-outline-secondary" id="register_button"   data-toggle="modal" data-target="#register_book_form">New Book</button>
	    	<!--Not needed for actual approach
	    	<button id="login_button" class="btn btn-sm btn-outline-secondary" type="button">Publisher Page</button>-->
	    </div>
	    
	    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
	    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	  </form>
	</nav>

	<!-- Modal with form for creating new books!-->
	<div class="modal fade" id="register_book_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Add New Media Here!</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form  action="action.php" method="POST" accept-charset="utf-8">
					<div class="form-group">
						<input hidden class="form-control" type="text" name="id" placeholder="ID"
						<?php 
							if(isset($_GET['update'])){
								$row_id = $_GET['id'] ?? null;
								$fetched_data = Media::fetchFromDatabase($row_id);
							}
						 ?>
						 >
					</div>
					<div class="form-group">
						<label>Title</label>
						<input class="form-control" type="text" name="title" placeholder="Title" value="Die Reisen des John Doe">
					</div>
					<div class="form-group">
						<label>Image</label>
						<input class="form-control" type="text" name="image" placeholder="Image" value="img/no.svg">
					</div>
					<div class="form-group">
						<label>ISBN</label>
						<input class="form-control" type="text" name="isbn" placeholder="ISBN" value="1234567890">
					</div>
					<div class="form-group">
						<label>Short Description</label>
						<input class="form-control" type="text" name="short_description" placeholder="Short Description" value="test">
					</div>
					<div class="d-flex justify-content-between align-items-end form-group">
						<div class="inline">
							<label>Publish Date</label>
							<input class="form-control" type="date" name="publish_date" placeholder="Publish Date" value="2018-11-09">
						</div>

						<div class="inline">
							<select class="custom-select form-control" name="type" required>
								<option value="" selected disabled>Choose type</option>
								<option value="Book">Book</option>
								<option value="CD">CD</option>
								<option value="DVD">DVD</option>
							</select>
						</div>
						<div class="inline">
							<select class="custom-select form-control" name="status" required>
								<option value="" selected disabled>Choose status</option>
								<option value="available">available</option>
								<option value="rented">rented</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label>Author</label>
						<input class="form-control" type="text" name="author" placeholder="Author" value="Horst Peter">
					</div>
					<div class="form-group">
						<label>Publisher</label>
						<input class="form-control" type="text" name="publisher" placeholder="Publisher" value="Horst Wald Verlag">
					</div>
					<div class="form-group">
						<label>Publisher Address</label>
						<input class="form-control" type="text" name="address" placeholder="Publisher Address" value="Horstgasse 1, 1210, Wien">
					</div>
					<div class="form-group">
						<select class="custom-select form-control" name="size" required>
							<option value="" selected disabled>Choose size</option>
							<option value="Large">Large</option>
							<option value="Medium">Medium</option>
							<option value="Small">Small</option>
						</select>
					</div>
					<div class="d-flex justify-content-center btn-group">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						<input class="btn btn-success" type="submit" name="submit" id="btn">
					</div>
			</form>
	      </div>
	    </div>
	  </div>
	</div>

	<div id="content-wrapper">
		<!--table for displaying the "small" big-list-->
		<div id="table_container" class="row-fluid">
			<div class=" bg-light p-1">
				<table class="table-dark  table-bordered table-hover ">
					<thead>
						<tr>
							<td>ID</td>
							<td>Title</td>
							<td>Image</td>
							<td>ISBN</td>
							<td>Short Description</td>
							<td>Publish Date</td>
							<td>Type</td>
							<td>Author</td>
							<td>Publisher</td>
							<td>Address</td>
							<td>Size</td>
							<td>Status</td>
						</tr>
					</thead>

					<tbody id="main_table">
						<?php 
							include("show.php");
							$new_session = new Content();
							$new_session->showContent();
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
	src="https://code.jquery.com/jquery-3.3.1.min.js"
	integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <script src="js/index.js" type="text/javascript" charset="utf-8" async defer></script>
  </body>
</html>