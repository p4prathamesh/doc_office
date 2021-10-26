<?php

session_start();
date_default_timezone_set('UTC');
$today = date("Y-m-d");

$con = mysqli_connect('localhost','root','','doc_project');

// if(isset($_POST['action']) && $_POST['action'] == 'form1') {
$opdno1 = $_POST['opdno1'];
$f_name1 = $_POST['f_name1'];
$l_name1 = $_POST['l_name1'];
$dob1 = $_POST['dob1'];
$gender1 = $_POST['gender1'];
$age1 = $_POST['age1'];
$mobile1 = $_POST['mobile1'];
$o_mobile1 = $_POST['o_mobile1'];
$add_11 = $_POST['add_11'];
$add_21 = $_POST['add_21'];
$city1 = $_POST['city1'];
$state1 = $_POST['state1'];
$pin1 = $_POST['pin1'];
$edited_by = $_SESSION['eemail'];

if(!$con){
    die("connection failed " . mysqli_connect_error());
}
else{
    $sql = "UPDATE patients SET edited_by='$edited_by', first_name='$f_name1', last_name='$l_name1', dob='$dob1', gender='$gender1', age='$age1', mobile='$mobile1', o_mobile='$o_mobile1', add_1='$add_11', add_2='$add_21', city='$city1', state='$state1', pin='$pin1' WHERE opd='$opdno1'";
    $reg_query_run = mysqli_query($con,$sql);
    if($reg_query_run){
        $_SESSION['status1'] = "Details Changed Successfully";
        $_SESSION['status_code1'] = "success";
        $_SESSION['button'] = "Ok! Cool";
        header('location:patient.php');
    }
    else{
        $_SESSION['status1'] = "Failed to Change Patient";
        $_SESSION['status_code1'] = "error";
        $_SESSION['button'] = "Oh! Okay";
        header('location:patient.php');
    }
    // echo "<meta http-equiv='refresh' content='0'>";
}
// }

?>