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
            var date            = document.getElementById("date").value;
            var time_slot_id    = document.getElementById("time_slot_id").value;
            var weight          = document.getElementById("weight").value;
            var bp              = document.getElementById("bp").value;
            var temperature     = document.getElementById("temperature").value;
            var spo2            = document.getElementById("spo2").value;
            
            if(date=='')
            {
                alert("Please Enter Date.");
                return false;
            }
            else if(time_slot_id=='')
            {
                alert("Please Select Time Slot.");
                return false;
            }
            else if(weight=='')
            {
                alert("Please Enter Weight.");
                return false;
            }
            else if(bp=='')
            {
                alert("Please Enter Blood Pressure.");
                return false;
            }
            else if(temperature=='')
            {
                alert("Please Enter Temperature.");
                return false;
            }
            else if(spo2=='')
            {
                alert("Please Enter Oxygen saturation (SpO2).");
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
    
    $patient_info = array();
    $patient_id = $_REQUEST['patient_id'];
    if(!$patient_id)
    {
        echo "<script>window.location = 'patients.php';</script>";
    }
    else
    {
        $patient_info = $helper->getPatientInfo($patient_id);
    }
    
    $msg = '';
    
    if($_POST)
    {
        $msg = $helper->addAppointment();
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
                <li class="breadcrumb-item active" aria-current="page"><?php echo (!$data->id) ? 'Add' : 'Edit'; ?> Appointment</li>
              </ol>
            </nav>
            <h1 class="font-weight-normal"><?php echo (!$data->id) ? 'Add' : 'Edit'; ?> Appointment</h1>
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
                            <label>Appointment Date (DD/MM/YYYY)</label>
                            <input type="date" class="form-control" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $data->date; ?>" placeholder="Date"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="col-sm-4 control-group">
                            <label>Time Slot</label>
                            <?php
                            $helper->getTimeslots($data->time_slot_id);
                            ?>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="col-sm-4 control-group">
                            <label>Patient Name</label>
                            <input type="text" class="form-control" id="patient_name" name="patient_name" value="<?php echo $patient_info->patient_name;?>" placeholder="Patient Name" readonly=""/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="col-sm-4 control-group">
                            <label>Weight</label>
                            <input type="text" class="form-control" id="weight" name="weight" value="<?php echo $data->weight;?>" placeholder="Weight"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="col-sm-4 control-group">
                            <label>Blood Pressure</label>
                            <input type="text" class="form-control" id="bp" name="bp" value="<?php echo $data->bp;?>" placeholder="Blood Pressure"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="col-sm-4 control-group">
                            <label>Temperature</label>
                            <input type="text" class="form-control" id="temperature" name="temperature" value="<?php echo $data->temperature;?>" placeholder="Temperature"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="col-sm-4 control-group">
                            <label>Oxygen saturation (SpO2)</label>
                            <input type="text" class="form-control" id="spo2" name="spo2" value="<?php echo $data->spo2;?>" placeholder="Oxygen saturation (SpO2)"/>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>" />
                        <input type="hidden" id="id" name="id" value="<?php echo $data->id; ?>" />
                        <button class="btn btn-primary" type="submit" id="sendMessageButton"><?php echo (!$data->id) ? 'Save' : 'Update'; ?> Appointment</button>
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