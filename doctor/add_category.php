<?php

session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');

$new_category = $_POST['new_category'];
$category_type = $_POST['category_type'];

$s = "select * from category where category_name = '$new_category' and type='$category_type'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
    $_SESSION['status'] = "Category already found!";
    $_SESSION['status_code'] = "error";
    $_SESSION['button'] = "Oh. Okay!";
    header('location:transactions.php');
}else{
    $reg = "insert into category(category_name,type) values ('$new_category','$category_type')";
    $reg_query_run = mysqli_query($con, $reg);
    if($reg_query_run){
        $_SESSION['status'] = "Category added Successfully";
        $_SESSION['status_code'] = "success";
        $_SESSION['button'] = "Ok. Done!";
        header('location:transactions.php');
    }else{
        $_SESSION['status'] = "Failed to add Category!";
        $_SESSION['status_code'] = "error";
        $_SESSION['button'] = "Oh. Okay!";
        header('location:transactions.php');
    }
}

?>