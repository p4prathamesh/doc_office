<?php

session_start();

$con = mysqli_connect('localhost','root','','doc_project');


if(isset($_POST["teeths"]){

    $opd_p_dental = $_SESSION["p_id"];
    $teeths = $_POST["teeths"];
    // $teeth_names = $_POST["teeth_names"];

    foreach ($teeth_nos as $key => $value){
        $save = "INSERT INTO p_dental_treatment (opd,tooth_number,tooth_name) 
        VALUES ('".$opd_p_dental."', '".$value."', '".$teeth_names[$key]."')";
        $query = mysqli_query($con, $save);
    }

    // $query='';
    // for($count = 0; $count<count($teeth_numbers); $count++){
    //     $teeth_number_clean = mysqli_real_escape_string($con, $teeth_numbers[$count]);
    //     $teeth_name_clean = mysqli_real_escape_string($con, $teeth_names[$count]);
    //     if($teeth_number_clean != '' && $teeth_name_clean != ''){
    //         $query .='insert into p_dental_treatment(opd,tooth_number,tooth_name) values ("'.$opd_p_dental.'","'.$teeth_number_clean.'","'.$teeth_name_clean.'");';
    //     }
    // }
    // if($query!=''){
    //     if(mysqli_multi_query($con,$query))
    //     {
    //         $_SESSION['status'] = "Alert Added Successfully";
    //         $_SESSION['status_code'] = "success";
    //         $_SESSION['button'] = "Ok! Cool";
    //         header('location:p_dental_chart.php');
    //     }
    //     else
    //     {
    //         $_SESSION['status'] = "Failed to Add Alert";
    //         $_SESSION['status_code'] = "error";
    //         $_SESSION['button'] = "Oh! Okay";
    //         header('location:p_dental_chart.php');
    //     }
    // }
    // else{
    //     $_SESSION['status'] = "Failed to Add Alert";
    //     $_SESSION['status_code'] = "error";
    //     $_SESSION['button'] = "Oh! Okay";
    //     header('location:p_dental_chart.php');
    // }
    // $reg_query_run = ;

}
// $_SESSION['status'] = "Failed to Add Alert";
// $_SESSION['status_code'] = "error";
// $_SESSION['button'] = "Oh! Okay";
// header('location:p_dental_chart.php');



?>