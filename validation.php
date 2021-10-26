<?php

session_start();

$con = mysqli_connect('localhost','root','');

mysqli_select_db($con, 'doc_project');

$email = $_POST['login_email'];
$pass = $_POST['login_pass'];
$decode_pass = base64_encode($pass);

$s = "select * from authentication where email = '$email' and pass = '$decode_pass'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

$row = mysqli_fetch_array($result);

if(($num == 1) && ($row['type']=="Receptionist")){
    $_SESSION['useremail'] = $row['name'];
    $_SESSION['eemail'] = $row['email'];
    $_SESSION['type'] = $row['type'];
    header('location:attender/patient.php');
}
elseif(($num == 1) && ($row['type']=="Doctor")){
    $_SESSION['useremail'] = $row['name'];
    $_SESSION['eemail'] = $row['email'];
    $_SESSION['type'] = $row['type'];
    header('location:doctor/patient.php');
}
else{
    $_SESSION['status1'] = "Invalid Details!";
    $_SESSION['status_code1'] = "error";
    $_SESSION['button1'] = "Oh. Okay!";
    header('location:authentication.php');
}

?>