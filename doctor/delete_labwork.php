<?php

session_start();


$con = mysqli_connect('localhost','root','','doc_project');

if(isset($_POST['delete_btn1_set']))
{
    $lab_name = $_POST["deleteid"];
    $given_work = $_POST["deleteid1"];
    $status = $_POST["deleteid2"];
    if(!$con){
        die("connection failed " . mysqli_connect_error());
    }
    else{
        $sql = "DELETE FROM labwork WHERE lab_name='$lab_name' AND given_work='$given_work'";
        $reg_query_run = mysqli_query($con,$sql);
    }
}

?>