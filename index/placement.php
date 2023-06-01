<!doctype html>
  <html lang="en">
  <head>
       <title>Carousel Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/carousel/">  
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
      img.rounded-corners {
       border-radius: 100px;
     }
   </style>


   <!-- Custom styles for this template -->
   <link href="carousel.css" rel="stylesheet">
 </head>
 <body>

  <header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Our Faculties</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./faculties.php">Faculties</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main>

    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <!-- Dummy carousel for spacing -->
    </div>
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="../assets/brand/placementicon.png" class="card-img-top" alt="Cat">
            <div class="card-body">
              <h5 class="card-title">2016-2019 BATCH</h5>
              <p class="card-text">70 students where placed in various companies.</p>
              <a href="../assets/brand/placement/2016-2019 BATCH.pdf" class="btn btn-primary">View</a>
            </div>
          </div>
        </div>
                <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="../assets/brand/placementicon.png" class="card-img-top" alt="Cat">
            <div class="card-body">
              <h5 class="card-title">2017-2020 BATCH</h5>
              <p class="card-text">64 students where placed in various companies.</p>
              <a href="../assets/brand/placement/2017-2020 BATCH.pdf" class="btn btn-primary">View</a>
            </div>
          </div>
        </div>
                <div class="col">
          <div class="card" style="width: 18rem;">
            <img src="../assets/brand/placementicon.png" class="card-img-top" alt="Cat">
            <div class="card-body">
              <h5 class="card-title">2018-2021 BATCH</h5>
              <p class="card-text">35 students where placed in various companies.</p>
              <a href="../assets/brand/placement/2018-2021 BATCH.pdf" class="btn btn-primary">View</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FOOTER -->
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
  </main>
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
