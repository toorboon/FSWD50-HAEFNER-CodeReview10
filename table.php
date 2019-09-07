<?php if (!(isset($_SESSION['userId']))){
		header("Location: index.php");
	}	 ?>
<div id="content-wrapper">
		<!--table for displaying the "small" big-list-->
		<div id="table_container" class="row-fluid">
			<!-- <div id="result"><h1>Test me</h1></div> -->
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
							<?php if (isset($_SESSION['admin'])) {echo'<td>Address</td>';}?>
							<?php if (isset($_SESSION['admin'])) {echo'<td>Size</td>';}?>
							<td>Status</td>
						</tr>
					</thead>

					<tbody id="result">
						<!-- here goes the content, read from the database -->
					</tbody>
				</table>
			</div>
		</div>
	</div>