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
	<?php if (isset($_SESSION['userId'])) {include("form.php");} ?>

  <!-- Modal with signup for creating new users!-->
  <?php include("signup.php"); ?>

	<!-- table for showing the "big-list" comes here-->
	<?php if (isset($_SESSION['userId'])) {include("table.php");} ?>

<!-- Bootstrap scripts comes here -->
<?php include("footer_scripts.php"); ?>

 </body>
</html>