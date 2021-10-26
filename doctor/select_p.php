<?php

session_start();

$con = mysqli_connect('localhost','root','');

mysqli_select_db($con, 'doc_project');

$query = "SELECT * FROM patients WHERE opd = '".$_POST["ppp"]."'";
$result = mysqli_query($con,$query);

$row = mysqli_fetch_array($result);
$num = mysqli_num_rows($result);

if(isset($_POST["ppp"])){
    $_SESSION['p_id'] = $row["opd"];
    $_SESSION['p_f_name'] = $row["first_name"];
    $_SESSION['p_l_name'] = $row["last_name"];
    header('location:p_alert.php');
}
else{
    header('location:patient.php');
}

?>