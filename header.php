
<nav class="sticky-top navbar navbar-dark bg-site-greennav">
  <div class="w-100">  
    <div class="d-flex <?php if (!(isset($_SESSION['userId']))){ echo 'justify-content-between';} ?>">
      <div>
        <i class="fas fa-book-reader"></i>
      	<a class="navbar-brand">New Library</a>
      </div>
      
      <div class="d-flex <?php if (isset($_SESSION['userId'])){ echo 'flex-grow-1';} ?>">
<?php
  if (isset($_SESSION['admin'])) {
?>
                <button type="button" class="btn btn-outline-secondary mx-1" id="register_button"   data-toggle="modal" data-target="#register_book_form">New Book</button>
<?php
  }
  if (isset($_SESSION['userId'])) {
?>
                <!-- This is for the search bar -->
                <input id="search_text" class="form-control mx-1" name="search_text" type="search" placeholder="Search by Title/ Author/ ISBN" aria-label="Search">
      </div>
              
      <div class="d-flex">  
        <?php if(isset($_SESSION['admin'])){echo'<button class="btn btn-outline-success mx-1" type="button" data-toggle="modal" data-target="#signup_user">Signup</button>';}?>
        <!-- <form class="form" action="includes/logout.inc.php" method="POST" accept-charset="utf-8"> -->
          <button id="logout" class="btn btn-outline-success mx-1" type="submit" name="logout-submit">Logout</button>
       <!--  </form> -->
<?php

  echo '</div>';} else {
?>           
        <div class="d-flex">
          <?php 
            $login = '';
            
            if (isset($_GET['error'])){
              if ($_GET['error'] == "sqlerror") {
                echo "<p class='text-danger my-auto'>SQL Error!</p>";
                if (isset($_GET['uid'])){
                  $login = $_GET['uid'];
                }

              } else if ($_GET['error'] == "wrongpwd"){
                echo "<p class='text-danger  my-auto'>Password is wrong!</p>";  
                if (isset($_GET['uid'])){
                  $login = $_GET['uid'];
                }

              } else if ($_GET['error'] == "nouser"){
                echo "<p class='text-danger my-auto'>There is no user with this username!</p>";
              }
            }
          ?>
        </div>
        <form class="d-flex form" action="includes/login.inc.php" method="POST" accept-charset="utf-8">
          <!-- <div class="g-signin2 my-auto" data-onsuccess="onSignIn">Google</div> -->
          <input class="mx-1" type="text" name="mailuid" placeholder="Username/E-Mail..." value="<?php if($login){echo $login;} ?>">
          <input class="mx-1" type="password" name="pwd" placeholder="Password...">
          <button class="btn btn-outline-success mx-1" type="submit" name="login-submit">Login</button>
          
        </form>
       <!--  <div class="g-signin2" data-onsuccess="onSignIn">Google</div> -->
      </div>
<?php      
  }
?>
    </div>
  </div>
</nav>
