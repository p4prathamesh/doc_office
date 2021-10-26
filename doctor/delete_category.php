<?php

session_start();


$con = mysqli_connect('localhost','root','','doc_project');

if(isset($_POST['delete_btn1_set']))
{
    $category_name = $_POST["deleteid"];
    $amount = $_POST["deleteid1"];
    $type = $_POST["deleteid2"];
    if(!$con){
        die("connection failed " . mysqli_connect_error());
    }
    else{
        $query = "select * from transactions";
        $query_run = mysqli_query($con,$query);
        $r = mysqli_fetch_row($query_run);
        $new_balance = $r[3]-$amount;
        $new_income = $r[2]-$amount;
        $q1 = "UPDATE transactions SET balance='$new_balance',income='$new_income' WHERE ref=101 ";
        $q1_query_run = mysqli_query($con, $q1);
        $sql = "DELETE FROM category WHERE category_name='$category_name' AND type='$type'";
        $reg_query_run = mysqli_query($con,$sql);
    }
}

if(isset($_POST['delete_btn_set']))
{
    $category_name1 = $_POST["deleteid"];
    $amount1 = $_POST["deleteid1"];
    $type1 = $_POST["deleteid2"];
    if(!$con){
        die("connection failed " . mysqli_connect_error());
    }
    else{
        $query1 = "select * from transactions";
        $query_run1 = mysqli_query($con,$query1);
        $r1 = mysqli_fetch_row($query_run1);
        $new_balance1 = $r1[3]+$amount1;
        $new_expense1 = $r1[1]+$amount1;
        $q2 = "UPDATE transactions SET balance='$new_balance1',expense='$new_expense1' WHERE ref=101 ";
        $q1_query_run1 = mysqli_query($con, $q2);
        $sql1 = "DELETE FROM category WHERE category_name='$category_name1' AND type='$type1'";
        $reg_query_run1 = mysqli_query($con,$sql1);
    }
}

?>