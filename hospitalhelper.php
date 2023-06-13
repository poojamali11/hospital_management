<?php
error_reporting(0);
session_start();

require_once "inc/config.php";
require_once "inc/dbhelper.php";

class HospitalHelper
{
    function checkReceptionLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db=new Database();
        $db->open();
        $sql="SELECT * FROM `reception` WHERE `username` ='".$username."' AND `password`='".$password."' AND `status` = 1";
        $result=$db->query($sql);
        $row=$db->fetchobject($result);
        return $row; 
    }
    
    function checkDoctorLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db=new Database();
        $db->open();
        $sql="SELECT * FROM `doctor` WHERE `username` ='".$username."' and `password`='".$password."' AND `status` = 1";
        $result=$db->query($sql);
        $row=$db->fetchobject($result);
        return $row;   
    }
    
    public function makeAppointment()
    {
        $date           = $_POST['date'];
        $time_slot_id   = $_POST['time_slot_id'];
        $patient_name   = $_POST['patient_name'];
        $patient_phone  = $_POST['patient_phone'];
        $gender         = $_POST['gender'];
        $dob            = $_POST['dob'];
        
        $db=new Database();
        $db->open();
        
        $sql    = "SELECT id FROM `patients` WHERE `patient_name` LIKE '%".trim($patient_name)."%' AND `patient_phone` = '".$patient_phone."' ";
        $result = $db->query($sql);
        $row    = $db->fetchobject($result);
        
        if(!$row->id)
        {
            $sql = "INSERT INTO `patients` (`id`, `patient_name`, `patient_phone`, `gender`, `dob`) 
                    VALUES (NULL, '".$patient_name."', '".$patient_phone."', '".$gender."', '".$dob."');";
            $result     = $db->query($sql);
            $patient_id = $db->lastinsered();
            
            $sql    = "SELECT id FROM `appointments` WHERE `date` = '".$date."' AND `time_slot_id` = '".$time_slot_id."'";
            $result = $db->query($sql);
            $row    = $db->fetchobject($result);
            
            if(!$row->id)
            {
                $sql = "INSERT INTO `appointments` (`id`, `date`, `time_slot_id`, `patient_id`, `weight`, `bp`, `temperature`, `spo2`) 
                        VALUES (NULL, '".$date."', '".$time_slot_id."', '".$patient_id."', '".$weight."', '".$bp."', '".$temperature."', '".$spo2."');";
                $result = $db->query($sql);
                
                if($result)
                {
                    return "Appointment added successfully.";
                }
                else
                {
                    return "Appointment not added.";
                }
            }
            else
            {
                return "Appointment already exists.";
            }
            
        }
        else
        {
            $patient_id = $row->id;
            
            $sql    = "SELECT id FROM `appointments` WHERE `date` = '".$date."' AND `time_slot_id` = '".$time_slot_id."'";
            $result = $db->query($sql);
            $row    = $db->fetchobject($result);
            
            if(!$row->id)
            {
                $sql = "INSERT INTO `appointments` (`id`, `date`, `time_slot_id`, `patient_id`, `weight`, `bp`, `temperature`, `spo2`) 
                        VALUES (NULL, '".$date."', '".$time_slot_id."', '".$patient_id."', '".$weight."', '".$bp."', '".$temperature."', '".$spo2."');";
                $result = $db->query($sql);
                
                if($result)
                {
                    return "Appointment added successfully.";
                }
                else
                {
                    return "Appointment not added.";
                }
            }
            else
            {
                return "Appointment already exists.";
            }
        }
    }
    
    public function addPatient()
    {
        $id             = $_POST['id'];
        $patient_name   = $_POST['patient_name'];
        $patient_phone  = $_POST['patient_phone'];
        $gender         = $_POST['gender'];
        $dob            = $_POST['dob'];
        
        $db=new Database();
        $db->open();
        
        if($id)
        {
            $sql = "UPDATE `patients` SET `patient_name`='".$patient_name."', `patient_phone`='".$patient_phone."', `gender`='".$gender."', `dob`='".$dob."' WHERE `id` = ".$id;
            $result = $db->query($sql);
            
            if($result)
            {
                return "Patient updated successfully.";
            }
            else
            {
                return "Patient not updated.";
            }
        }
        else
        {
            $sql    = "SELECT id FROM `patients` WHERE `patient_name` LIKE '%".trim($patient_name)."%' AND `patient_phone` = '".$patient_phone."' ";
            $result = $db->query($sql);
            $row    = $db->fetchobject($result);
            
            if(!$row->id)
            {
                $sql = "INSERT INTO `patients` (`id`, `patient_name`, `patient_phone`, `gender`, `dob`) 
                        VALUES (NULL, '".$patient_name."', '".$patient_phone."', '".$gender."', '".$dob."');";
                $result = $db->query($sql);
                
                if($result)
                {
                    return "Patient added successfully.";
                }
                else
                {
                    return "Patient not added.";
                }
            }
            else
            {
                return "Patient already exists.";
            }
        }
    }
    
    public function getPatients()
    {
        $patient_name  = $_POST['patient_name'];
        $patient_phone = $_POST['patient_phone'];
        
        $db=new Database();
        $db->open();
        
        $extraSql = '';
        
        if($patient_name!='')
        {
            $extraSql .= " AND a.`patient_name` LIKE '%".trim($patient_name)."%'";
        }
        
        if($patient_phone!='')
        {
            $extraSql .= " AND a.`patient_phone` LIKE '%".trim($patient_phone)."%'";
        }
        
        $sql="SELECT a.* FROM `patients` as a WHERE 1 ".$extraSql." ORDER BY a.id DESC";
        $result=$db->query($sql);
        
        
        ?>
        <table class="table table-bordered mb-5">
            <tr>
                <th>Patient ID</th>
                <th>Patint Name</th>
                <th>Patint Phone</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th width="10%">Actions</th>
            </tr>
            <?php
            $gender_array = array('1'=>'Male','2'=>'Female');
            $i = 0;
            while($row=$db->fetcharray($result))
            {
                ?>
                <tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['patient_name'];?></td>
                    <td><?php echo $row['patient_phone'];?></td>
                    <td><?php echo $gender_array[$row['gender']];?></td>
                    <td><?php echo ($row['dob']!=null) ? date('d/m/Y',strtotime($row['dob'])) : '';?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="add_patient.php?id=<?php echo $row['id'];?>" title="Edit Patient">Edit Patient</a>
                                <a class="dropdown-item" href="add_appointment.php?patient_id=<?php echo $row['id'];?>">Add Appointment</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo $url;?>?id=<?php echo $row['id'];?>&task=remove">Remove Patient</a>
                            </div>
                        </div>

                    </td>
                </tr>
                <?php
                $i++;
            }
            
            if($i==0)
            {
                ?>
                <tr>
                    <td class="text-center" colspan="6">No Patients</td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
        
    }
    
    function getPatientInfo($id)
    {
        $db=new Database();
        $db->open();
        $sql="SELECT * FROM `patients` WHERE `id` = ".$id;
        $result=$db->query($sql);
        $row=$db->fetchobject($result);
        return $row;   
    }
    
    function delete_patient($id)
    {
        $db=new Database();
        $db->open();
        $sql="DELETE FROM `patients` WHERE `id` = ".$id;
        $result=$db->query($sql);
        
        if($result)
        {
            return "Patient Deleted";
        }  
        else
        {
            return "Patient Not Deleted";
        } 
    }
    
    
    public function getTimeslots($id = '')
    {
        $db=new Database();
        $db->open();
        
        $sql="SELECT * FROM `time_slots` ORDER BY id ASC";
        $result=$db->query($sql);
        
        ?>
        <select id="time_slot_id" name="time_slot_id" class="form-control">
            <option value="">Select</option>
            <?php
            while($row = $db->fetcharray($result))
            {
                $selected = '';
                if($id == $row['id'])
                {
                    $selected = 'selected="selected"';
                }
                ?>
                <option value="<?php echo $row['id'];?>" <?php echo $selected;?>><?php echo $row['time_slot_name'];?></option>
                <?php
            }
            ?>
        </select>
        <?php
    }
    
    public function addAppointment()
    {
        $id             = $_POST['id'];
        $date           = $_POST['date'];
        $time_slot_id   = $_POST['time_slot_id'];
        $patient_id     = $_POST['patient_id'];
        $weight         = $_POST['weight'];
        $bp             = $_POST['bp'];
        $temperature    = $_POST['temperature'];
        $spo2           = $_POST['spo2'];
        
        $db=new Database();
        $db->open();
        
        if($id)
        {
            $sql    = "SELECT id FROM `appointments` WHERE `date` = '".$date."' AND `time_slot_id` = '".$time_slot_id."' AND `id` !=".$id;
            $result = $db->query($sql);
            $row    = $db->fetchobject($result);
            
            if(!$row->id)
            {
                $sql = "UPDATE `appointments` SET `date`='".$date."', `time_slot_id`='".$time_slot_id."', `patient_id`='".$patient_id."', `weight`='".$weight."', `bp`='".$bp."', `temperature`='".$temperature."', `spo2`='".$spo2."' 
                        WHERE `id` = ".$id;
                $result = $db->query($sql);
                
                if($result)
                {
                    return "Appointment updated successfully.";
                }
                else
                {
                    return "Appointment not updated.";
                }
            }
            else
            {
                return "Appointment already exists.";
            }
        }
        else
        {
            $sql    = "SELECT id FROM `appointments` WHERE `date` = '".$date."' AND `time_slot_id` = '".$time_slot_id."'";
            $result = $db->query($sql);
            $row    = $db->fetchobject($result);
            
            if(!$row->id)
            {
                $sql = "INSERT INTO `appointments` (`id`, `date`, `time_slot_id`, `patient_id`, `weight`, `bp`, `temperature`, `spo2`) 
                        VALUES (NULL, '".$date."', '".$time_slot_id."', '".$patient_id."', '".$weight."', '".$bp."', '".$temperature."', '".$spo2."');";
                $result = $db->query($sql);
                
                if($result)
                {
                    return "Appointment added successfully.";
                }
                else
                {
                    return "Appointment not added.";
                }
            }
            else
            {
                return "Appointment already exists.";
            }
        }
    }
    
    public function updateAppointmentBill()
    {
        $db=new Database();
        $db->open();
        
        $id     = $_POST['id'];
        $amount = $_POST['amount'];
        
        if($id)
        {
            $sql = "UPDATE `appointments` SET `amount`='".$amount."' WHERE `id` = ".$id;
            $result = $db->query($sql);
            
            if($result)
            {
                return "Appointment Bill updated successfully.";
            }
            else
            {
                return "Appointment Bill not updated.";
            }
        }
        else
        {
            return "An issue occured.";
        }
    }
    
    public function getAppointments($today = '')
    {
        $db=new Database();
        $db->open();
        
        $extraSql = '';
        $url      = 'appointments.php';
        
        if($today!='')
        {
            $extraSql .= ' AND a.date = "'.$today.'"';
            
            $sql="SELECT a.*, .b.time_slot_name, c.patient_name, c.patient_phone, c.gender, c.dob FROM `appointments` as a 
                  LEFT JOIN `time_slots` as b ON a.time_slot_id = b.id 
                  LEFT JOIN `patients` as c ON a.patient_id = c.id
                  WHERE 1 ".$extraSql."
                  ORDER BY a.date, a.time_slot_id ASC";
            $result=$db->query($sql);
            
            $url = 'todays_appointments.php';
        }
        else
        {
            $sql="SELECT a.*, .b.time_slot_name, c.patient_name, c.patient_phone, c.gender, c.dob FROM `appointments` as a 
              LEFT JOIN `time_slots` as b ON a.time_slot_id = b.id 
              LEFT JOIN `patients` as c ON a.patient_id = c.id
              WHERE 1 ".$extraSql."
              ORDER BY a.id DESC";
            $result=$db->query($sql);
        }
        
        ?>
        <table class="table table-bordered mb-5">
            <tr>
                <th>Date</th>
                <th>Time Slot</th>
                <th>Patint Name</th>
                <th>Patint Phone</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Weight</th>
                <th>BP</th>
                <th>Temp.</th>
                <th>Oxygen</th>
                <th>Bill</th>
                <th width="10%">Actions</th>
            </tr>
            <?php
            $gender_array = array('1'=>'Male','2'=>'Female');
            $i = 0;
            while($row=$db->fetcharray($result))
            {
                ?>
                <tr>
                    <td><?php echo date('d/m/Y',strtotime($row['date']));?></td>
                    <td><?php echo $row['time_slot_name'];?></td>
                    <td><?php echo $row['patient_name'];?></td>
                    <td><?php echo $row['patient_phone'];?></td>
                    <td><?php echo $gender_array[$row['gender']];?></td>
                    <td><?php echo ($row['dob']!=null) ? date('d/m/Y',strtotime($row['dob'])) : '';?></td>
                    <td><?php echo $row['weight'];?></td>
                    <td><?php echo $row['bp'];?></td>
                    <td><?php echo $row['temperature'];?></td>
                    <td><?php echo $row['spo2'];?></td>
                    <td><?php echo round($row['amount'],2);?></td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="add_appointment.php?id=<?php echo $row['id'];?>&patient_id=<?php echo $row['patient_id'];?>" title="Edit Appointment">Edit Appointment</a>
                                <a class="dropdown-item" href="add_bill.php?id=<?php echo $row['id'];?>">Update Bill</a>
                                <div class="dropdown-divider"></div>
                                <?php if($_SESSION['duserid']) { ?>
                                
                                <a class="dropdown-item" href="medicines.php?appointment_id=<?php echo $row['id'];?>&patient_id=<?php echo $row['patient_id'];?>" title="Medicines">Medicines</a>
                                 
                                <div class="dropdown-divider"></div>
                                <?php } ?>
                                
                                <a class="dropdown-item" href="<?php echo $url;?>?id=<?php echo $row['id'];?>&task=remove">Remove Appointment</a>
                            </div>
                        </div>

                    </td>
                </tr>
                <?php
                $i++;
            }
            
            if($i==0)
            {
                ?>
                <tr>
                    <td class="text-center" colspan="11">No Appointments</td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
        
    }
    
    function getAppointmentInfo($id)
    {
        $db=new Database();
        $db->open();
        $sql="SELECT * FROM `appointments` WHERE `id` = ".$id;
        $result=$db->query($sql);
        $row=$db->fetchobject($result);
        return $row;   
    }
    
    function delete_appointment($id)
    {
        $db=new Database();
        $db->open();
        $sql="DELETE FROM `appointments` WHERE `id` = ".$id;
        $result=$db->query($sql);
        
        if($result)
        {
            return "Appointment Deleted";
        }  
        else
        {
            return "Appointment Not Deleted";
        } 
    }
    
    function addMedicine()
    {
        $db=new Database();
        $db->open();
        
        $patient_id     = $_POST['patient_id'];
        $date           = $_POST['date'];
        $medicine_name  = $_POST['medicine_name'];
        $quantity       = $_POST['quantity'];
        $schedule       = $_POST['schedule'];
        $schedule       = implode(",",$schedule);
        $created_by     = $_SESSION['userid'];
        $created_date   = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO `patient_medicines` (`id`, `patient_id`, `date`, `medicine_name`, `quantity`, `schedule`) 
                VALUES (NULL, '".$patient_id."', '".$date."', '".$medicine_name."', '".$quantity."', '".$schedule."')";
        $result = $db->query($sql);
        $id     = $db->lastinsered();
        
        if($id)
        {
            return "Medicine saved successfully.";
        }
        else
        {
            return "Medicine not saved successfully.";
        }       
    }
    
    function getMedicines($date, $patient_id)
    {
        $db=new Database();
        $db->open();
        
        $sql    = "SELECT * FROM `patient_medicines` WHERE `date` = '".$date."' AND `patient_id` ='".$patient_id."' ORDER BY id ASC";
        $result = $db->query($sql);
        
        ?>
        <table class="table table-bordered" border="1" cellpadding="5">
            <tr>
                <th width="10%">Date</th>
                <th>Medicine Name</th>
                <th>Quantity</th>
                <th>Schedule</th>
            </tr>
            <?php
            $schedule_array = array('1'=>'Morning','2'=>'After Noon','3'=>'Night');
            $i = 0;
            while($row = $db->fetcharray($result))
            {
                ?>
                <tr>
                    <td><?php echo date('d/m/Y',strtotime($row['date']));?></td>
                    <td><?php echo $row['medicine_name'];?></td>
                    <td><?php echo $row['quantity'];?></td>
                    <td>
                        <?php 
                        $schedule = explode(",",$row['schedule']);
                        if($schedule)
                        {
                            $i = 0;
                            foreach($schedule as $s)
                            {
                                echo $schedule_array[$s];
                                $i++;
                                if($i < count($schedule))
                                {
                                    echo " - ";
                                }
                                
                            }
                        }
                        ?>
                    </td>
                </tr>
                <?php
                $i++;
            } 
            
            if($i == 0)
            {
                ?>
                <tr>
                    <td class="text-center" colspan="4">No Medicines Added Yet</td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
}
?>