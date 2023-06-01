<?php
include 'library/auth.php';

if(isset($_COOKIE['username']) and isset($_COOKIE['token'])){
  $username = $_COOKIE['username'];
  $token = $_COOKIE['token'];

  if(verify_session($username, $token)){
    header("Location: ./home.php");
  }  
}

if(isset($_POST['username']) and isset($_POST['password'])){
  if(do_login($_POST['username'], $_POST['password'])){
    header("Location: ./home.php");
  } else{
    $flag = 0;
  }
  } else{
  $flag = -1;
}
?>
<!doctype html>
<html lang="en">
  <head>
    
    <title>Signin Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
   
  
  <form class="form-signin" action="signin.php" method="POST">
    <?php
   if($flag == 0){
      ?>
      <div class="alert alert-danger" role="alert">
  Your Username Password is not matching... Try Again
      <?php
        if ($flag != -1 ) {
           include '_show_up.php';
         } 
      ?>
</div>
    <?php
    } else if(isset($_GET['signup'])){
      if($_GET['signup'] == 'success'){
        ?>
      <div class="alert alert-success" role="alert">
      Signup success, you can login now!
    </div>
    <?php
      }
    } 
   ?> 
    <img class="mb-4" src="./assets/brand/Guru-Nanak-College-Logo-footer.png" alt="" width="100" height="95">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <div class="form-floating">
      <input name="username" type="text" class="form-control" id="floatingInput" placeholder="Username">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Username">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <a href="./signup.php">No account? Signup</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2022 Department of Computer Science. All rights reserved.</p></p>
  </form>
  </body>
</html>
