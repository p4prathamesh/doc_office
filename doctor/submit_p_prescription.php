<?php

session_start();

$con = mysqli_connect('localhost','root','','doc_project');

if(isset[$_POST["item_name"]])
{
    for($count = 0; $count < count($_POST["item_name"]); $count++)
    {
        $query = "
        Insert into 
        ";
    }
}

?>