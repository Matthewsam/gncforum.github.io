<?php
include 'library/auth.php';


if(isset($_COOKIE['username']) and isset($_COOKIE['token'])){
  $username = $_COOKIE['username'];
  $token = $_COOKIE['token'];

  if(verify_session($username, $token)){
    header("Location: ./home.php");
  } 
} 

$flag = 0;
if(!isset($_GET['verify'])  and isset($_POST['username']) and isset($_POST['password']) and isset($_POST['cpassword'])){
  $username = $_POST['username'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  if($password == $cpassword){
  if(do_signup($username, $password) == 1){
    header("Location: ./signup.php?verify=$username");
  }else{
    $flag = -2; 
  }
  } else{
    $flag = -1; //password and cpassword not match
  }

}
if(isset($_GET['verify']) or isset($_POST['otp'])){
  //global $otp;
  $otp = $_POST['otp'];
  //global $username; 
  $username = $_GET['verify'];
  if (isset($_POST['otp'])) {
    if(do_verify_signup($username, $otp)){
        header("Location: ./signin.php?signup=success");
        exit();
    } else {
      $flag = -3;
    }
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Signup Template </title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">
    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

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
    <?php if(isset($_GET['verify'])) { ?>
   <form class="form-signin" action="signup.php?verify=<?php echo $username;?>" method="POST">
    <?php
    if($flag == -3) {
      ?>
      <div class="alert alert-danger" role="alert">
      Invalid OTP, try again
      </div>
    <?php
    } 
   ?> 
         
    <img class="mb-4" src="../assets/brand/Guru-Nanak-College-Logo-footer.png" alt="" width="100" height="95">
    <h1 class="h3 mb-3 fw-normal">Please verify</h1>

    <div class="form-floating">
      <input name="otp" type="text" class="form-control" id="floatingInput" placeholder="Enter 6 digit OTP">
      <label for="floatingInput">Enter 6 digit OTP</label>
    </div> 
    </div>
    <input type="hidden" id="form_id" name="form_id" value="otp_form">
    <br>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Verify</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
  </form>
<?php } else{ ?>
  <form class="form-signin" action="signup.php" method="POST">
         <?php
    if($flag == -1) {
      ?>
      <div class="alert alert-danger" role="alert">
      Password and confirm password do not match"
      </div>
    <?php
    } else if($flag == -2){
      ?>
      <div class="alert alert-danger" role="alert">
      Cannot Signup, username already taken.
      </div>
    <?php
    }
   ?> 
    <img class="mb-4" src="../assets/brand/Guru-Nanak-College-Logo-footer.png" alt="" width="100" height="95">
    <h1 class="h3 mb-3 fw-normal">Welcome, Signup</h1>

    <div class="form-floating">
      <input name="username" type="text" class="form-control" id="floatingInput" placeholder="Username">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
      <input name="cpassword" type="password" class="form-control" id="floatingPassword" placeholder="Confirm Password">
      <label for="floatingPassword">Confirm Password</label>
    </div>
    <br>
    <input type="hidden" id="form_id" name="form_id" value="signup_form">
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up</button>
    <a href="./signin.php">Already have an account? Signin</a>
    <p class="mt-5 mb-3 text-muted"><p>&copy; 2022 Department of Computer Science. All rights reserved.</p></p>
  </form>
  <?php } ?>
  </body>
</html>
