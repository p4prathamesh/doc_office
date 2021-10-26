<?php

session_start();
date_default_timezone_set('UTC');
$today = date("Y-m-d");

$con = mysqli_connect('localhost','root','','doc_project');

if(isset($_POST['delete_btn_set']))
{
    $opd_p_alert = $_SESSION["p_id"];
    $alertt = $_POST["deleteid1"];
    if(!$con){
        die("connection failed " . mysqli_connect_error());
    }
    else{
        $sql = "DELETE FROM p_alert WHERE opd='$opd_p_alert' and alert='$alertt'";
        $reg_query_run = mysqli_query($con,$sql);
    }
}

if(isset($_POST['delete_btn1_set']))
{
    $alertname = $_POST["deleteid"];
    if(!$con){
        die("connection failed " . mysqli_connect_error());
    }
    else{
        $sql = "DELETE FROM alert WHERE name='$alertname'";
        $reg_query_run = mysqli_query($con,$sql);
    }
}

?>