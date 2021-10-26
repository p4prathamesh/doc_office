<?php

session_start();
date_default_timezone_set('UTC');
$today = date("Y-m-d");

$con = mysqli_connect('localhost','root','','doc_project');

// if(isset($_POST['action']) && $_POST['action'] == 'form1') {
$opdno = $_POST['opdno'];
$f_name = $_POST['f_name'];
$l_name = $_POST['l_name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$mobile = $_POST['mobile'];
$o_mobile = $_POST['o_mobile'];
$add_1 = $_POST['add_1'];
$add_2 = $_POST['add_2'];
$city = $_POST['city'];
$state = $_POST['state'];
$pin = $_POST['pin'];
$save_name=$_SESSION['eemail'];

if(!$con){
    die("connection failed " . mysqli_connect_error());
}
else{
    $sql = "insert into patients(opd,first_name,last_name,dob,gender,age,mobile,o_mobile,add_1,add_2,city,state,pin,date,saved_by) VALUES ('$opdno','$f_name','$l_name','$dob','$gender','$age','$mobile','$o_mobile','$add_1','$add_2','$city','$state','$pin','$today','$save_name')";
    $reg_query_run = mysqli_query($con,$sql);
    if($reg_query_run){
        $_SESSION['status'] = "Patient Added Successfully";
        $_SESSION['status_code'] = "success";
        $_SESSION['button'] = "Ok! Cool";
        header('location:patient.php');
    }
    else{
        $_SESSION['status'] = "Failed to Add Patient";
        $_SESSION['status_code'] = "error";
        $_SESSION['button'] = "Oh! Okay";
        header('location:patient.php');
    }
    // echo "<meta http-equiv='refresh' content='0'>";
}
// }

?>