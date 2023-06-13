<?php
error_reporting(0);
require_once "hospitalhelper.php";

$helper = new HospitalHelper();
if($_POST)
{
    $r = $helper->checkReceptionLogin();
    if($r)
    {
        if($r->status)
        {
            $_SESSION['ruserid']     = $r->id;
            $_SESSION['rusername']   = $r->username;
            header("Location:reception_dashboard.php");
        }
        else
        {
            $_SESSION['ruserid']='';
            $_SESSION['rusername']='';
            header("Location:reception_login.php?error=2");
        }
    }
    else
    {
        $_SESSION['ruserid']='';
        $_SESSION['rusername']='';
        header("Location:reception_login.php?error=1");
    }
}
?>    

