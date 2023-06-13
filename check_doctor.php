<?php
error_reporting(0);
require_once "hospitalhelper.php";

$helper = new HospitalHelper();
if($_POST)
{
    $r = $helper->checkDoctorLogin();
    if($r)
    {
        if($r->status)
        {
            $_SESSION['duserid']     = $r->id;
            $_SESSION['dusername']   = $r->username;
            header("Location:doctor_dashboard.php");
        }
        else
        {
            $_SESSION['duserid']='';
            $_SESSION['dusername']='';
            header("Location:doctor_login.php?error=2");
        }
    }
    else
    {
        $_SESSION['duserid']='';
        $_SESSION['dusername']='';
        header("Location:doctor_login.php?error=1");
    }
}
?>    

