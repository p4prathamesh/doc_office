<?php

session_start();


$con = mysqli_connect('localhost','root','','doc_project');

if(isset($_POST['delete_btn1_set']))
{
    $tooth_no = $_POST["deleteid"];
    $tooth_name = $_POST["deleteid1"];
    $opd = $_SESSION["p_id"];
    if(!$con){
        die("connection failed " . mysqli_connect_error());
    }
    else{
        $sql = "DELETE FROM p_dental_treatment WHERE opd ='$opd' AND tooth_number='$tooth_no' ";
        $reg_query_run = mysqli_query($con,$sql);
    }
}

?>