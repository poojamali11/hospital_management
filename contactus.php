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

    <div class="page-banner overlay-dark bg-image" style="background-image: url(img/bg_image_1.jpg);">
        <div class="banner-section">
          <div class="container text-center wow fadeInUp">
            <nav aria-label="Breadcrumb">
              <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
              </ol>
            </nav>
            <h1 class="font-weight-normal">Contact Us</h1>
          </div> <!-- .container -->
        </div> <!-- .banner-section -->
      </div> <!-- .page-banner -->

      <div class="page-section">
        <div class="container">
          <div class="row justify-content-center" style="min-height:350px;">
            <div class="col-lg-12">
            <h5 align="center">Pooja Mali</h5> <h5 align="center">Phone.no +91 9108350557</h5>
            <br />
            <h5 align="center">Sneha Mali</h5> <h5 align="center">Phone.no +91 8548830989</h5>
            <br />
            <h5 align="center">Pooja patil</h5> <h5 align="center">Phone.no +91 9964989551</h5>
            <br />
            <h5 align="center">Swayam patil</h5> <h5 align="center">Phone.no +91 6364482737</h5>

            </div>
        </div>
    </div>
</div>

  
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