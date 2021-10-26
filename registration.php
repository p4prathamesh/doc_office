<?php

session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');

$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$c_pass = $_POST['c_pass'];
if($pass!=$c_pass){
    $_SESSION['status'] = "Password & confirm password didnot match";
    $_SESSION['status_code'] = "error";
    $_SESSION['button'] = "Oh. Okay!";
    header('location:authentication.php');
}
else{
    $encode_pass = base64_encode($pass);
    if(isset($_POST['select-profession'])){
        $type = $_POST['select-profession'];
    }
    else{
        $type = "Receptionist";
    }


    $s = "select * from authentication where email = '$email'";

    $result = mysqli_query($con, $s);

    $num = mysqli_num_rows($result);

    if($num == 1){
        $_SESSION['status'] = "Email already taken";
        $_SESSION['status_code'] = "error";
        $_SESSION['button'] = "Oh. Okay!";
        header('location:authentication.php');
    }else{
        $reg = "insert into authentication(name,email,pass,type) values ('$name','$email','$encode_pass','$type')";
        $reg_query_run = mysqli_query($con, $reg);
        if($reg_query_run){
            $_SESSION['status'] = "Registered Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['button'] = "Ok. Done!";
            header('location:authentication.php');
        }
    }
}

?>