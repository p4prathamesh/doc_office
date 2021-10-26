<?php
session_start();
$email = $_SESSION['eemail'];
$con = mysqli_connect('localhost','root','','doc_project');
$newpass = $_POST['newpass'];
$encode_newpass = base64_encode($newpass);
$query = "UPDATE `authentication` SET `pass` = '$encode_newpass' WHERE `authentication`.`email` = '$email'";
$result = mysqli_query($con, $query);
if($result){
    $_SESSION['status'] = "Password Changed Successfully";
    $_SESSION['status_code'] = "success";
    $_SESSION['button'] = "Ok. Done!";
    header('location:profile.php');
}
else{
    $_SESSION['status'] = "Error in Changing Password!";
    $_SESSION['status_code'] = "error";
    $_SESSION['button'] = "Oh. Okay!";
    header('location:profile.php');
}
?>