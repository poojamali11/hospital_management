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
    
    if(!$_SESSION['ruserid'] && !$_SESSION['duserid'])
    {
        echo "<script>window.location = 'index.php';</script>";
    }
    
    $msg = '';
    
    if($_POST)
    {
        $msg = $helper->addPatient();
    }
    
    $id = $_REQUEST['id'];
    $data = array();
    if($id)
    {
        $data = $helper->getPatientInfo($id);
    }
    
    ?>
    <script type="text/javascript">
        function validate_form()
        {
            var patient_name    = document.getElementById("patient_name").value;
            var patient_phone   = document.getElementById("patient_phone").value;
            var gender          = document.getElementById("gender").value;
            var dob             = document.getElementById("dob").value;
            
            var validchar = /^[A-Z a-z]+$/;
            
            if(patient_name=='')
            {
                alert("Please Enter Patient Name.");
                return false;
            }
            else if(!validchar.test(patient_name))
            {
                alert("Patient Name should not be numeric.");
                return false;
            }
            else if(patient_phone=='')
            {
                alert("Please Enter Phone Number.");
                return false;
            }
            else if(isNaN(patient_phone))
            {
                alert("Phone Number should be numeric.");
                return false;  
            }
            else if(checkInternationalPhone(patient_phone)==false)
            {
                alert("Please Enter a Valid Phone Number");
        		return false;
            }
            else if(gender=='')
            {
                alert("Please Select Gender.");
                return false;
            }
            else if(dob=='')
            {
                alert("Please Enter Date of Birth.");
                return false;
            }
        }
        
        // Declaring required variables
        var digits = "0123456789";
        // non-digit characters which are allowed in phone numbers
        var phoneNumberDelimiters = "()- ";
        // characters which are allowed in international phone numbers
        // (a leading + is OK)
        var validWorldPhoneChars = phoneNumberDelimiters + "+";
        // Minimum no of digits in an international phone no.
        var minDigitsInIPhoneNumber = 10;
        
        function isInteger(s)
        {   var i;
            for (i = 0; i < s.length; i++)
            {   
                // Check that current character is number.
                var c = s.charAt(i);
                if (((c < "0") || (c > "9"))) return false;
            }
            // All characters are numbers.
            return true;
        }
        
        function trim(s)
        {   var i;
            var returnString = "";
            // Search through string's characters one by one.
            // If character is not a whitespace, append to returnString.
            for (i = 0; i < s.length; i++)
            {   
                // Check that current character isn't whitespace.
                var c = s.charAt(i);
                if (c != " ") returnString += c;
            }
            return returnString;
        }
        
        function stripCharsInBag(s, bag)
        {   var i;
            var returnString = "";
            // Search through string's characters one by one.
            // If character is not in bag, append to returnString.
            for (i = 0; i < s.length; i++)
            {   
                // Check that current character isn't whitespace.
                var c = s.charAt(i);
                if (bag.indexOf(c) == -1) returnString += c;
            }
            return returnString;
        }
        
        function checkInternationalPhone(strPhone){
            var bracket=3;
            strPhone=trim(strPhone);
            if(strPhone.indexOf("+")>1) return false;
            if(strPhone.indexOf("-")!=-1)bracket=bracket+1;
            if(strPhone.indexOf("(")!=-1 && strPhone.indexOf("(")>bracket)return false;
            var brchr=strPhone.indexOf("(");
            if(strPhone.indexOf("(")!=-1 && strPhone.charAt(brchr+2)!=")")return false;
            if(strPhone.indexOf("(")==-1 && strPhone.indexOf(")")!=-1)return false;
            s=stripCharsInBag(strPhone,validWorldPhoneChars);
            return (isInteger(s) && s.length >= minDigitsInIPhoneNumber);
        }
    </script>
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
                <li class="breadcrumb-item active" aria-current="page"><?php echo (!$data->id) ? 'Add' : 'Edit'; ?> Patient</li>
              </ol>
            </nav>
            <h1 class="font-weight-normal"><?php echo (!$data->id) ? 'Add' : 'Edit'; ?> Patient</h1>
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
                            <label>Patient Name</label>
                            <input type="text" class="form-control" id="patient_name" name="patient_name" value="<?php echo $data->patient_name;?>" placeholder="Patient Name"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="col-sm-4 control-group">
                            <label>Phone Number</label>
                            <input type="text" class="form-control" id="patient_phone" name="patient_phone" maxlength="10" value="<?php echo $data->patient_phone;?>" placeholder="Patient Phone"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="col-sm-4 control-group">
                            <label>Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="">Select</option>
                                <option value="1" <?php echo ($data->gender==1) ? 'selected="selected"' : '';?>>Male</option>
                                <option value="2" <?php echo ($data->gender==2) ? 'selected="selected"' : '';?>>Female</option>
                            </select>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="col-sm-4 control-group">
                            <label>Date of Birth (DD/MM/YYYY)</label>
                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $data->dob;?>" placeholder="Date of Birth (DD/MM/YYYY)"/>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div>
                        <input type="hidden" id="id" name="id" value="<?php echo $data->id; ?>" />
                        <button class="btn btn-primary" type="submit" id="sendMessageButton"><?php echo (!$data->id) ? 'Save' : 'Update'; ?> Patient</button>
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