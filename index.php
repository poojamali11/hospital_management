<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <meta name="copyright" content="">
    
    <title>Hospital Management</title>
    
    <link rel="stylesheet" href="css/maicons.css">
    
    <link rel="stylesheet" href="css/bootstrap.css">
    
    <link rel="stylesheet" href="vendor/owl-carousel/css/owl.carousel.css">
    
    <link rel="stylesheet" href="vendor/animate/animate.css">
    
    <link rel="stylesheet" href="css/theme.css">

    <?php
    require_once "hospitalhelper.php";
    $helper = new HospitalHelper();
    
    $msg = '';
    
    ?>
</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <!-- Start Header -->
  <?php 
  require_once "header.php";
  ?>
  <!-- End Header --> 

  <div class=" pb-0">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/slide-1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="img/slide-2.jpg" class="d-block w-100" alt="...">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

  </div>

    <div class="page-section  pt-3 pb-3">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 py-3 wow fadeInUp">
            <h2>Welcome to Hospital Management</h2>
            <p class="text-grey mb-4">The purpose of this project is create hospital management system. In this project user can book the online appointment receptions can login to this system and view the appointment list and reception. The major problem for the patient nowadays to get report after consultation, many hospital managing reports in their system but it's not available to the patient when he/she is outside. In this project we are going to provide the extra facility to store the report in the database provider.
            <br />
            <a href="aboutus.php" class="btn btn-primary">Learn More</a>
          </div>
          <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
            <div class="img-place custom-img-1">
              <img src="img/aboutus.jpg" alt="">
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .bg-light -->
  </div> <!-- .bg-light -->


  <!-- Start Foooter -->
  <?php 
  require_once "footer.php";
  ?>
  <!-- End Foooter --> 

    
  <script src="js/jquery-3.5.1.min.js"></script>

  <script src="js/bootstrap.bundle.min.js"></script>

  <script src="vendor/owl-carousel/js/owl.carousel.min.js"></script>

  <script src="vendor/wow/wow.min.js"></script>

  <script src="js/theme.js"></script>
</body>
</html>