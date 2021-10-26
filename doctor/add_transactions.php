<?php

session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');

$category = $_POST['category'];
$new_amount = $_POST['new_amount'];

$s = "select * from category where category_name = '$category'";

$result = mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if($num == 1){
    $res1=mysqli_fetch_row($result);
    $new_total_amount=$res1[2]+$new_amount;
    $q1 = "UPDATE category SET amount='$new_total_amount' WHERE category_name='$category'";
    $t="select * from transactions"; 
    $rr = mysqli_query($con,$t);
    $t_query_run = mysqli_fetch_row($rr);
    if($res1[1]==="income"){
        $new_income=$t_query_run[2]+$new_amount;
        $new_balance=$t_query_run[3]+$new_amount;
        $q2 = "UPDATE transactions SET income='$new_income', balance='$new_balance' WHERE ref=101";
        $q2_query_run = mysqli_query($con, $q2);
    }else{
        $new_expense=$t_query_run[1]+$new_amount;
        $new_balance1=$t_query_run[3]-$new_amount;
        $q3 = "UPDATE transactions SET expense='$new_expense', balance='$new_balance1' WHERE ref=101";
        $q3_query_run = mysqli_query($con, $q3);
    }
    $q1_query_run = mysqli_query($con, $q1);
    
    if($q1_query_run && ($q2_query_run || $q3_query_run)){
        $_SESSION['status'] = "Transaction added Successfully";
        $_SESSION['status_code'] = "success";
        $_SESSION['button'] = "Ok. Done!";
        header('location:transactions.php');
    }else{
        $_SESSION['status'] = "Failed to add Transaction!";
        $_SESSION['status_code'] = "error";
        $_SESSION['button'] = "Oh. Okay!";
        header('location:transactions.php');
    }
}
else{
    $reg = "insert into category(category_name,type) values ('$new_category','$category_type')";
    $reg_query_run = mysqli_query($con, $reg);
    $_SESSION['status'] = "Failed to add Transaction!";
    $_SESSION['status_code'] = "error";
    $_SESSION['button'] = "Oh. Okay!";
    header('location:transactions.php');
}





?>