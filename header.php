

<nav class="sticky-top navbar navbar-dark bg-site-greennav">
  <div>
  	<img id="icon" src="" alt="">
    <i class="fas fa-book-reader"></i>
  	<a class="navbar-brand">New Library</a>
  </div>
  
  <div>
      <?php
        if (isset($_SESSION['userId'])) {
          echo '
            <form class="form" action="includes/logout.inc.php" method="POST" accept-charset="utf-8">
              <button class="btn btn-sm btn-outline-success" type="submit" name="logout-submit">Logout</button>
            </form>
             ';
         } else {
          echo ' 
            <form class="form" action="includes/login.inc.php" method="POST" accept-charset="utf-8">
              <input type="text" name="mailuid" placeholder="Username/E-Mail...">
              <input type="password" name="pwd" placeholder="Password...">
              <button class="btn btn-sm btn-outline-success" type="submit" name="login-submit">Login</button>
              <button class="btn btn-sm btn-outline-success" type="button" data-toggle="modal" data-target="#signup_user">Signup</button>
            </form>
            ';
         }
      ?>
  </div>
  <?php
    if (isset($_SESSION['userId'])) {
      echo '
        <div class="mr-2">
        	<button type="button" class="btn btn-sm btn-outline-secondary" id="register_button"   data-toggle="modal" data-target="#register_book_form">New Book</button>
        	<!--Not needed for actual approach
        	<button id="login_button" class="btn btn-sm btn-outline-secondary" type="button">Publisher Page</button>-->
        </div>
    
        <input id="search_text" class="form-control mr-sm-2" name="search_text" type="search" placeholder="Search by Title" aria-label="Search">
        ';
    }
  ?>
    
  
</nav>
