<?php

session_start();


$con = mysqli_connect('localhost','root','','doc_project');

if(isset($_POST['delete_btn1_set']))
{
    $opd = $_POST["deleteid"];
    $name = $_POST["deleteid1"];
    // $opd = $_SESSION["p_id"];
    if(!$con){
        die("connection failed " . mysqli_connect_error());
    }
    else{
        $sql = "DELETE FROM p_prescription WHERE opd ='$opd' AND medicine_name='$name' ";
        $reg_query_run = mysqli_query($con,$sql);
    }
}

?>