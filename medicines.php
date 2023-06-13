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
    
    if(!$_SESSION['duserid'])
    {
        echo "<script>window.location = 'doctor_login.php';</script>";
    }
    
    $msg = '';
    
    $appointment_id = $_REQUEST['appointment_id'];
    $patient_id = $_REQUEST['patient_id'];
    $patient_data = $appointment_data = array();
    
    if($patient_id)
    {
        $patient_data = $helper->getPatientInfo($patient_id);
    }
    
    if($appointment_id)
    {
        $appointment_data = $helper->getAppointmentInfo($appointment_id);
    }
    
    if($_POST)
    {
        $helper->addMedicine();
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
                <li class="breadcrumb-item active" aria-current="page">Medicines</li>
              </ol>
            </nav>
            <h1 class="font-weight-normal">Medicines</h1>
          </div> <!-- .container -->
        </div> <!-- .banner-section -->
      </div> <!-- .page-banner -->

      <div class="page-section pb-0">
        <div class="container">
          <div class="row mb-5">
            <div class="col-lg-4" style="min-height: 350px;">
                <h5>Add Medicine</h5>
                <hr />
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
                        <div class="col-sm-12 control-group">
                            <label>Date</label>
                            <input type="date" class="form-control" value="<?php echo $appointment_data->date; ?>" placeholder="Date" readonly=""/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="col-sm-12 control-group">
                            <label>Patient Name</label>
                            <input type="text" class="form-control" value="<?php echo $patient_data->patient_name;?>" readonly="" placeholder="Patient Name"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="col-sm-12 control-group">
                            <label>Medicine Name</label>
                            <input type="text" class="form-control" id="medicine_name" name="medicine_name" value="" placeholder="Medicine Name"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="col-sm-12 control-group">
                            <label>Medicine Quantity</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" value="" placeholder="Medicine Quantity"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="col-sm-12 control-group">
                            <label>Medicine Schedule</label>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="schedule[]" name="schedule[]" class="" value="1"/> Morning
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="schedule[]" name="schedule[]" class="" value="2"/> After Noon
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="schedule[]" name="schedule[]" class="" value="3"/> Night
                                </label>
                            </div>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" id="date" name="date" value="<?php echo $appointment_data->date; ?>" />
                        <input type="hidden" id="patient_id" name="patient_id" value="<?php echo $patient_data->id; ?>" />
                        <button class="btn btn-primary" type="submit" id="sendMessageButton">Add</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-8" style="min-height: 350px;">
                <h5 class="float-left">Medicine List</h5>
                <button class="float-right btn btn-primary btn-sm" onclick="PrintElem('#prescription');">Print</button>
                <div class="clearfix"></div>
                <hr />
                <div id="prescription">
                    <p>Date: <b><?php echo date('d/m/Y',strtotime($appointment_data->date)); ?></b> Patient Name: <b><?php echo $patient_data->patient_name;?></b></p>
                    <?php
                    $helper->getMedicines($appointment_data->date, $patient_data->id);
                    ?>
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