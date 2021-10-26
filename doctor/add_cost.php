<?php

session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');

$opd = $_SESSION['p_id'];
$new_tea = $_POST['new_tea'];
$new_ta = $_POST['new_ta'];
$new_pa = $_POST['new_pa'];
$new_ra = $new_ta - $new_pa;

$q="select * from p_cost ORDER BY sr_no DESC LIMIT 1;";
$results = mysqli_query($con, $q);
$row = mysqli_fetch_array($results);

$lastsr = $row['sr_no'];
if ($lastsr == ""){
    $sr_no = 1;
}
else{
    $sr_no = $lastsr + 1;
}

$reg = "insert into p_cost(sr_no,opd,	total_estimated_amount,	total_amount,paid_amount,remaining_amount) values ('$sr_no','$opd','$new_tea','$new_ta','$new_pa','$new_ra')";
$reg_query_run = mysqli_query($con, $reg);
if($reg_query_run){
    $_SESSION['status'] = "Cost added Successfully";
    $_SESSION['status_code'] = "success";
    $_SESSION['button'] = "Ok. Done!";
    header('location:p_cost.php');
}else{
    $_SESSION['status'] = "Failed to add cost!";
    $_SESSION['status_code'] = "error";
    $_SESSION['button'] = "Oh. Okay!";
    header('location:p_cost.php');
}



?>