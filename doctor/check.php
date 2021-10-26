<?php

session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');

$tooth_send = $_POST['tooth_send'];
$opd=$_SESSION["p_id"];
if($tooth_send=="18" || $tooth_send=="28" || $tooth_send=="38" || $tooth_send=="48"){
    $tooth_name="3rd Molar";
}else if($tooth_send=="17" || $tooth_send=="27" || $tooth_send=="37" || $tooth_send=="47" || $tooth_send=="55" || $tooth_send=="65" || $tooth_send=="75" || $tooth_send=="85"){
    $tooth_name="2nd Molar";
}else if($tooth_send=="16" || $tooth_send=="26" || $tooth_send=="36" || $tooth_send=="46" || $tooth_send=="54" || $tooth_send=="64" || $tooth_send=="74" || $tooth_send=="84"){
    $tooth_name="1st Molar";
}else if($tooth_send=="17" || $tooth_send=="27" || $tooth_send=="37" || $tooth_send=="47"){
    $tooth_name="2nd Molar";
}else if($tooth_send=="15" || $tooth_send=="25" || $tooth_send=="35" || $tooth_send=="45"){
    $tooth_name="2nd Bicuspid";
}
else if($tooth_send=="14" || $tooth_send=="24" || $tooth_send=="34" || $tooth_send=="44"){
    $tooth_name="1st Bicuspid";
}
else if($tooth_send=="13" || $tooth_send=="23" || $tooth_send=="33" || $tooth_send=="43" || $tooth_send=="53" || $tooth_send=="63" || $tooth_send=="73" || $tooth_send=="83"){
    $tooth_name="Cuspid";
} 
else if($tooth_send=="12" || $tooth_send=="22" || $tooth_send=="32" || $tooth_send=="42" || $tooth_send=="52" || $tooth_send=="62" || $tooth_send=="72" || $tooth_send=="82"){
    $tooth_name="Lateral incisor";
}
else{
    $tooth_name="Central incisor";
}

$s = "select * from p_dental_treatment where opd = '$opd' and tooth_number = '$tooth_send'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num >= 1){
    $_SESSION['status'] = "Tooth already found!";
    $_SESSION['status_code'] = "error";
    $_SESSION['button'] = "Oh. Okay!";
    header('location:p_dental_chart.php');

}else{
    $reg = "insert into p_dental_treatment(opd,tooth_number,tooth_name) values ('$opd','$tooth_send','$tooth_name')";
    $reg_query_run = mysqli_query($con, $reg);
    if($reg_query_run){
        $_SESSION['status'] = "Tooth added Successfully";
        $_SESSION['status_code'] = "success";
        $_SESSION['button'] = "Ok. Done!";
        header('location:p_dental_chart.php');
    }else{
        $_SESSION['status'] = "Failed to add Tooth!";
        $_SESSION['status_code'] = "error";
        $_SESSION['button'] = "Oh. Okay!";
        header('location:p_dental_chart.php');
    }
}


?>