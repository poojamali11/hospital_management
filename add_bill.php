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
            var amount          = document.getElementById("amount").value;
            
            if(amount=='')
            {
                alert("Please Enter Amount.");
                return false;
            }
        }
    </script>
    <?php
    require_once "hospitalhelper.php";
    $helper = new HospitalHelper();
    
    if(!$_SESSION['ruserid'] && !$_SESSION['duserid'])
    {
        echo "<script>window.location = 'index.php';</script>";
    }
    
    $msg = '';
    
    if($_POST)
    {
        $msg = $helper->updateAppointmentBill();
    }
    
    $id = $_REQUEST['id'];
    $data = array();
    if($id)
    {
        $data = $helper->getAppointmentInfo($id);
    }
    
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
                <li class="breadcrumb-item active" aria-current="page">Update Appointment Bill</li>
              </ol>
            </nav>
            <h1 class="font-weight-normal">Update Appointment Bill</h1>
          </div> <!-- .container -->
        </div> <!-- .banner-section -->
      </div> <!-- .page-banner -->

      <div class="page-section pb-0">
        <div class="container">
          <div class="row align-items-center mb-5">
            <div class="col-lg-12" style="">
              <?php
                if($msg)
                {
                    ?>
                    <div class="alert alert-info">
                        <p><?php echo $msg;?></p>
                    </div>
                    <?php
                }
                ?>
                <form action="" name="sentMessage" id="contactForm" novalidate="novalidate" onsubmit="return validate_form();" method="post">
                    <div class="form-row">
                        <div class="col-sm-4 control-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount" value="<?php echo round($data->amount,2);?>" placeholder="Amount"/>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" id="id" name="id" value="<?php echo $data->id; ?>" />
                        <button class="btn btn-primary" type="submit" id="sendMessageButton">Update Appointment Bill</button>
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