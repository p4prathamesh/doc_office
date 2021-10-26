<?php

$db = new PDO("mysql:host=localhost;dbname=doc_images","root","");
if(isset($_GET['sr_no'])){
    $sr_no = $_GET['sr_no'];
    $stat = $db->prepare("select * from images where sr_no=?");
    $stat->bindParam(1, $sr_no);
    $stat->execute();
    $data = $stat->fetch();

    $file = 'media/'.$data['name_image'];

    if(file_exists($file)){
        header('Content-Disposition: '.$data['type'].'; filename="'.basename($file).'"');
        header('Content-Length: '.filesize($file));
        readfile($file);
        exit;
    }
}

?>