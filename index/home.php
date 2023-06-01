<?php
include_once 'library/posts.php';
require 'vendor/autoload.php';
use Carbon\Carbon;

if(isset($_COOKIE['username']) and isset($_COOKIE['token'])){
  $username = $_COOKIE['username'];
  $token = $_COOKIE['token'];

  if(!verify_session($username, $token)){
    header("Location: ./signin.php");
  }
} else {
  header("Location: ./signin.php");
}

if(isset($_GET['post'])){
  if(isset($_POST['edit']) and isset($_POST['content'])){
    edit_post($_POST['edit'], $_POST['content']);
  } else if(isset($_POST['content']) and isset($_FILES['image'])){
    $target_directory = 'image/';
    $target_file = $target_directory . basename($_FILES['image']['name']);
    $imageFiletype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if($imageFiletype == 'jpg' or $imageFiletype == 'jpeg' or $imageFiletype == 'png'){
      if(file_exists($target_file)){
        die('File already exists..');
      } else {
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
        do_post($_POST['content'], "\\".$target_file);
      }
    } else{
      die("Invalid format");
    }
  }
}

if(isset($_GET['like'])){
  like_post($_GET['like']);
}

if(isset($_GET['delete'])){
  delete_post($_GET['delete']);
}
?>

<!doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Home_Page</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">
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
  </head>
  <body>
    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">Vision</h4>
              <p class="text-muted">To create a unique and futuristic space in imparting quality of higher education in Computer Science in the International arena and to augment a pool of knowledge base for the uplift of the Indian society and to manifest the perfection and quality in the mankind.</p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Welcome <?=get_current_username()?></h4>
              <ul class="list-unstyled">
                <li class="nav-item mb-2"><a href="./logout.php" class="nav-link p-0 text-white">Logout</a></li>
                <li class="nav-item mb-2"><a href="./faculties.php" class="nav-link p-0 text-white">Faculties</a></li>
                <li class="nav-item mb-2"><a href="./placement.php" class="nav-link p-0 text-white">Placement Deatils</a></li>
                <li class="nav-item mb-2"><a href="./about.php" class="nav-link p-0 text-white">About</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
          <a href="#" class="navbar-brand d-flex align-items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
            <strong>Home</strong>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main>

      <section class="py-5 text-center container">
        <div class="row py-lg-5">
          <div class="col-lg-6 col-md-8 mx-auto">
            
            <?php 
            if(!isset($_GET['edit'])){
              ?>
              <form action="home.php?post" method="POST" enctype="multipart/form-data">
                <div class="mb-3">

                  <input type="textarea" name="content" class="form-control" placeholder="Whats on your mind?" rows="5"></textarea>
                </div>
                <div class="mb-3">

                  <input class="form-control" type="file" id="formFile" name="image">
                </div>
                <div class="mb-3">
                 <button type="submit" class="btn btn-primary mb-3">Post!</button>
               </div>
             </form>
             <?php
           } else {
            $post = get_post($_GET['edit']);
            ?>
            <form action="home.php?post" method="POST" enctype="multipart/form-data">
              <div class="mb-3">

                <input type="textarea" name="content" class="form-control" placeholder="<?=$post['content']?>" rows="5"></textarea>
              </div>
              <?php 
              if(isset($_GET['edit'])){
                ?>
                <input class="form-control" type="hidden" id="formFile" name="edit" value="<?=$_GET['edit']?>">
                <?php
              }
              ?>
              <div class="mb-3">
               <button type="submit" class="btn btn-primary mb-3">Post!</button>
             </div>

           </form>
           <?php
         }
         ?>
       </div>
     </section>

     <div class="album py-5 bg-light">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <?php 
          $posts = get_all_post();
          foreach ($posts as $post) {
            $carbonTime = Carbon::parse($post['posted_on']);
            $humanDiff = $carbonTime->subMinute(270)->diffForHumans();
            ?>
            <div class="col">
              <div class="card shadow-sm">
                <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="<?=$post['image']?>">
                <div class="card-body">
                  <p class="card-text"><?=$post['content']?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="home.php?like=<?=$post['post_id']?>"  class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="<?=get_likes_count($post['post_id'])?> Liked">
                        <?php
                        if(has_liked($post['post_id'])){
                          echo "Liked";
                        } else{
                          echo "Like";
                        }
                        ?>
                      </a>
                      <?php
                      if($post['posted_by'] == $_COOKIE['username']){
                        ?>

                        <a href="home.php?edit=<?=$post['post_id']?>" class="btn btn-sm btn-outline-secondary">Edit</a>


                        <?php
                      } 
                      ?>
                      
                    </div>
                    <small class="text-muted"><?=$humanDiff ?></small>
                  </div><br>
                  <div class="d-flex justify-content-between align-items-center">
                    <?php
                    if($post['posted_by'] == $_COOKIE['username']){
                      ?>
                      <div class="btn-group">
                        <a href="home.php?delete=<?=$post['post_id']?>" class="btn btn-sm btn-secondary">Delete</a>

                      </div>
                      <?php
                    } 
                    ?>
                    <small class="text-muted">Posted By: <?=$post['posted_by']?></small>
                  </div>
                </div>
              </div>
            </div>
            <?php 
          }
          ?>
        </div>
      </div>
    </div>

  </main>

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
  <link href="footers.css" rel="stylesheet">
</head>
<body>


  <!-- Footer -->

  <div class="b-example-divider"></div>
  <div class="container">
    <footer class="py-5">
      <div class="row">
        <h5>Quick Links</h5>
        <div class="col-2">
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="./home.php" class="nav-link p-0 text-muted">Home</a></li>
            <li class="nav-item mb-2"><a href="./faculties.php" class="nav-link p-0 text-muted">Faculties Details</a></li>
            <li class="nav-item mb-2"><a href="./placement.php" class="nav-link p-0 text-muted">Placement Deatils</a></li>
            <li class="nav-item mb-2"><a href="./about.php" class="nav-link p-0 text-muted">About</a></li>
          </ul>
        </div>
        <div class="col-2">
        </div>
        <div class="col-2">
        </div>
        <div class="col-4 offset-1">

            <h5>Department of Computer Science</h5>
            <p>Guru Nanak College (Autonomous),Chennai<br>Affiliated to University of Madras,<br>Re-accredited at &apos;A&apos; Grade by NAAC&nbsp;</p>
            <p><strong>Contact info:</strong></p>
            <div><i> <a href="mailto:bsccsshift2.hod@gurunanakcollege.edu.in"> 
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chat-left-text-fill" viewBox="0 0 16 16">
                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"></path>
              </svg></a>
            </i>

            <i> <a href="https://www.instagram.com/infinit_2k22/">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
              </svg></a> 
            </i>
          </div>
      </div>

      <div class="d-flex justify-content-between py-4 my-4 border-top">
        <p>&copy; 2022 Department of Computer Science. All rights reserved.</p>

      </div>
    </footer>
  </div> 
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  </script>
</body>
</html>
