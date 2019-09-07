<?php  
session_start();
?>


<?php 
  include("includes/dbconnect.inc.php");
  include("head.php");
?>

  <title>New Library</title>

  </head>
  <body>
  	
  <!--navbar comes here-->
  <?php include("header.php"); ?>
  
	<!-- Modal with form for creating new books!-->
	<?php if (isset($_SESSION['admin'])) {include("form.php");} ?>

  <!-- Modal with signup for creating new users!-->
  <?php if (isset($_SESSION['admin'])) {include("signup.php");} ?>

	<!-- table for showing the "big-list" comes here-->
	<?php if (isset($_SESSION['userId'])) {include("table.php");} ?>

  <?php 
  if (!(isset($_SESSION['userId']))) { 
  ?>
    
      <div class="d-flex flex-column align-items-center mt-5">
      <div class="container">
        <div class="jumbotron text-center text-dark">
          <h1 class="display-4">Welcome to the New Library!</h1>
          <p class="lead">This is a simple library database, where you can handle your books, dvds and such!</p>
          <hr class="my-4">
          <p>Ask an admin to sign up!</p>
          <p>User-Login: marcouser pw: test</p>
          <p>Admin-Login: marco pw: test</p>
        </div>
      </div>
      </div>
    
  <?php
    }
  ?>

<!-- Bootstrap scripts comes here -->
<?php include("footer_scripts.php"); ?>

 </body>
</html>