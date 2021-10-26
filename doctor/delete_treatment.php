<?php

session_start();


$con = mysqli_connect('localhost','root','','doc_project');

if(isset($_POST['delete_btn2_set']))
{
    $treatment = $_POST["deleteid3"];
    // $tooth_name = $_POST["deleteid1"];
    $opd = $_SESSION["p_id"];
    if(!$con){
        die("connection failed " . mysqli_connect_error());
    }
    else{
        $sql = "DELETE FROM treatment WHERE treatment_name='$treatment' ";
        $reg_query_run = mysqli_query($con,$sql);
    }
}

?>