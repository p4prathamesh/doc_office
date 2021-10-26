<?php

session_start();
date_default_timezone_set('UTC');
$today = date("Y-m-d");

$con = mysqli_connect('localhost','root','','doc_project');

if(isset($_POST['delete_btn1_set']))
{
    $medicinename = $_POST["deleteid"];
    if(!$con){
        die("connection failed " . mysqli_connect_error());
    }
    else{
        $sql = "DELETE FROM medications WHERE medicine='$medicinename'";
        $reg_query_run = mysqli_query($con,$sql);
    }
}

?>