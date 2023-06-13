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
    <script type="text/javascript">
        function validate_form()
        {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            
            if(username=='')
            {
                alert("Please Enter User Name.");
                return false;
                
            }
            else if(password=='')
            {
                alert("Please Enter Password.");
                return false;
                
            }
        }
    </script>
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
                <li class="breadcrumb-item active" aria-current="page">Reception Login</li>
              </ol>
            </nav>
            <h1 class="font-weight-normal">Reception Login</h1>
          </div> <!-- .container -->
        </div> <!-- .banner-section -->
      </div> <!-- .page-banner -->

      <div class="page-section pb-0">
        <div class="container">
          <div class="row align-items-center mb-5">
            <div class="col-lg-5" >
                <?php
                if($_GET['error']==1)
                {
                    ?>
                    <div class="alert alert-warning">
                        <p>Please enter valid login details.</p>
                    </div>
                    <?php
                }
                else if($_GET['error']==2)
                {
                    ?>
                    <div class="alert alert-warning">
                        <p>Your account is inactive.</p>
                    </div>
                    <?php
                }
                ?>
                <form action="check_reception.php" name="sentMessage" id="contactForm" novalidate="novalidate" onsubmit="return validate_form();" method="post">
                    <div class="form-row">
                        <div class="col-sm-12 control-group">
                            <input type="text" class="form-control p-4" id="username" name="username" placeholder="User Name"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="col-sm-12 control-group">
                            <input type="password" class="form-control p-4" id="password" name="password" placeholder="Password"/>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary btn-block" type="submit" id="sendMessageButton">Login</button>
                    </div>
                </form>
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