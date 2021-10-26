<?php

session_start();

$con = mysqli_connect('localhost','root','','doc_project');

// if(isset($_POST['action']) && $_POST['action'] == 'form1') {
$ed_sr = $_POST['ed_sr'];
$edit_tea = $_POST['edit_tea'];
$edit_ta = $_POST['edit_ta'];
$edit_pa = $_POST['edit_pa'];
$edit_ra = $edit_ta - $edit_pa;
$opd=$_SESSION["p_id"];

if(!$con){
    die("connection failed " . mysqli_connect_error());
}
else{
    $sql = "UPDATE p_cost SET total_estimated_amount='$edit_tea', total_amount='$edit_ta', paid_amount='$edit_pa', remaining_amount='$edit_ra'  WHERE sr_no='$ed_sr' AND opd='$opd' ";
    $reg_query_run = mysqli_query($con,$sql);
    if($reg_query_run){
        $_SESSION['status'] = "Cost Details Changed Successfully";
        $_SESSION['status_code'] = "success";
        $_SESSION['button'] = "Ok! Cool";
        header('location:p_cost.php');
    }
    else{
        $_SESSION['status'] = "Failed to Change Cost Details";
        $_SESSION['status_code'] = "error";
        $_SESSION['button'] = "Oh! Okay";
        header('location:p_cost.php');
    }
}

?>