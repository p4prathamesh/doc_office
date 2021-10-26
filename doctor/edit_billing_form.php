<?php

session_start();

$con = mysqli_connect('localhost','root','','doc_project');

// if(isset($_POST['action']) && $_POST['action'] == 'form1') {
$edit_treatmentt = $_POST['edit_treatmentt'];
$edit_cost = $_POST['edit_cost'];
$ed_tno = $_POST['ed_tno'];
$opd=$_SESSION["p_id"];

if(!$con){
    die("connection failed " . mysqli_connect_error());
}
else{
    $sql = "UPDATE p_dental_treatment SET cost='$edit_cost', treatment='$edit_treatmentt'  WHERE tooth_number='$ed_tno' AND opd='$opd' ";
    $reg_query_run = mysqli_query($con,$sql);
    if($reg_query_run){
        $_SESSION['status'] = "Billing Details Changed Successfully";
        $_SESSION['status_code'] = "success";
        $_SESSION['button'] = "Ok! Cool";
        header('location:p_billing.php');
    }
    else{
        $_SESSION['status'] = "Failed to Change Billing Details";
        $_SESSION['status_code'] = "error";
        $_SESSION['button'] = "Oh! Okay";
        header('location:p_billing.php');
    }
}

?>