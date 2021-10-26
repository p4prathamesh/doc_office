<?php

session_start();

$con = mysqli_connect('localhost','root','','doc_project');

// if(isset($_POST['action']) && $_POST['action'] == 'form1') {
$edit_labname = $_POST['edit_labname'];
$edit_givenwork = $_POST['edit_givenwork'];
$edit_status = $_POST['edit_status'];

if(!$con){
    die("connection failed " . mysqli_connect_error());
}
else{
    $sql = "UPDATE labwork SET lab_name='$edit_labname', given_work='$edit_givenwork', status='$edit_status'  WHERE lab_name='$edit_labname' AND given_work='$edit_givenwork' ";
    $reg_query_run = mysqli_query($con,$sql);
    if($reg_query_run){
        $_SESSION['status'] = "Labwork Details Changed Successfully";
        $_SESSION['status_code'] = "success";
        $_SESSION['button'] = "Ok! Cool";
        header('location:labwork.php');
    }
    else{
        $_SESSION['status'] = "Failed to Change Labwork";
        $_SESSION['status_code'] = "error";
        $_SESSION['button'] = "Oh! Okay";
        header('location:labwork.php');
    }
    // echo "<meta http-equiv='refresh' content='0'>";
}
// }

?>