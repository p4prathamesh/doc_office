<?php

session_start();

$con = mysqli_connect('localhost','root','','doc_project');

// if(isset($_POST['action']) && $_POST['action'] == 'form1') {
$edit_tooth_number = $_POST['edit_tooth_number'];
$edit_tooth_name = $_POST['edit_tooth_name'];
$edit_treatment = $_POST['edit_treatment'];
$edit_descr = $_POST['edit_descr'];
$opd=$_SESSION["p_id"];

if(!$con){
    die("connection failed " . mysqli_connect_error());
}
else{
    $sql = "UPDATE p_dental_treatment SET tooth_number='$edit_tooth_number', tooth_name='$edit_tooth_name', treatment='$edit_treatment', descr='$edit_descr'  WHERE tooth_number='$edit_tooth_number' AND opd='$opd' ";
    $reg_query_run = mysqli_query($con,$sql);
    if($reg_query_run){
        $_SESSION['status'] = "Treatment Details Changed Successfully";
        $_SESSION['status_code'] = "success";
        $_SESSION['button'] = "Ok! Cool";
        header('location:p_treatment.php');
    }
    else{
        $_SESSION['status'] = "Failed to Change Treatment";
        $_SESSION['status_code'] = "error";
        $_SESSION['button'] = "Oh! Okay";
        header('location:p_treatment.php');
    }
    // echo "<meta http-equiv='refresh' content='0'>";
}
// }

?>