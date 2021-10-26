<?php

session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_images');

$q="select * from images ORDER BY sr_no DESC LIMIT 1;";
$results = mysqli_query($con, $q);
$row = mysqli_fetch_array($results);

$lastsr = $row['sr_no'];
if ($lastsr == ""){
    $sr_no = 1;
}
else{
    $sr_no = $lastsr + 1;
}

$opd=$_SESSION["p_id"];

if(count($_FILES) > 0) {
    if(isset($_POST["insert1"])){
        $file = addslashes(file_get_contents($_FILES["exampleFormControlFile2"]["tmp_name"]));
        $reg = "INSERT INTO images(sr_no,opd,name_image,type) VALUES ('$sr_no','$opd','{$file}','x-ray')";
        $reg_query_run = mysqli_query($con, $reg);
        if($reg_query_run){
            $_SESSION['status'] = "Image added Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['button'] = "Ok. Done!";
            header('location:p_images.php');
        }else{
            $_SESSION['status'] = "Failed to add Image!";
            $_SESSION['status_code'] = "error";
            $_SESSION['button'] = "Oh. Okay!";
            header('location:p_images.php');
        }
    }
}

?>