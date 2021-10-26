<?php

session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');

$medicine_select = $_POST['medicine_select'];
$new_quantity = $_POST['new_quantity'];
$new_days = $_POST['new_days'];
$opd=$_SESSION["p_id"];
$checkbox1=$_POST['dose'];  
$chk="";  
foreach($checkbox1 as $chk1)  
   {  
      $chk .= $chk1.",";  
   }

$reg = "insert into p_prescription(opd,medicine_name,quantity,days,dosage) values ('$opd','$medicine_select','$new_quantity','$new_days','$chk')";
$reg_query_run = mysqli_query($con, $reg);
if($reg_query_run){
    $_SESSION['status'] = "Prescription added Successfully";
    $_SESSION['status_code'] = "success";
    $_SESSION['button'] = "Ok. Done!";
    header('location:p_prescription.php');
}else{
    $_SESSION['status'] = "Failed to add Prescription!";
    $_SESSION['status_code'] = "error";
    $_SESSION['button'] = "Oh. Okay!";
    header('location:p_prescription.php');
}


?>