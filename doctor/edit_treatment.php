<?php
session_start();
$opd=$_SESSION["p_id"];
if(isset($_POST["edit_tooth_no"])){
    $sample = '';
    $con = mysqli_connect('localhost','root','','doc_project');
    $q="SELECT * FROM TREATMENT";
    $query = "SELECT * FROM p_dental_treatment WHERE tooth_number = '".$_POST['edit_tooth_no']."' AND opd = '".$opd."' ";
    $result = mysqli_query($con,$query);
    $r = mysqli_query($con,$q);
    $row = mysqli_fetch_array($result);
    //
    // {
        $sample .='
        <form action="edit_treatment_form.php" method="POST" id="edit_treatment_details">
        <div class="form-group row">
            <label for="opd" class="col-sm-2 col-form-label">Tooth Number</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="edit_tooth_number"
                    id="edit_tooth_number" value="'.$row["tooth_number"].'" style="pointer-events: none;" readonly>
            <i class="fa fa-check-circle" id="correct00"
                        style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
            <i class="fa fa-exclamation-circle" id="wrong00"
                style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
            <small id="a1_problem" style="color:e74c3c"></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="opd" class="col-sm-2 col-form-label">Tooth Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="edit_tooth_name"
                    id="edit_tooth_name" value="'.$row["tooth_name"].'">
            <i class="fa fa-check-circle" id="correct11"
                        style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
            <i class="fa fa-exclamation-circle" id="wrong11"
                style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
            <small id="b1_problem" style="color:e74c3c"></small>
            </div>
        </div> 
        <div class="form-group row">
            <label for="opd" class="col-sm-2 col-form-label">Treatment</label>
            <div class="col-sm-10">
            <select class="form-control" name="edit_treatment" id="edit_treatment">
                <option selected>Select Treatment...</option>
        ';

        while($rr=mysqli_fetch_array($r)){
        $sample .='
                <option value="'.$rr["treatment_name"].'">
                '.$rr["treatment_name"].' 
        ';
        }

        $sample .= '
                    </option>
            </select>
            <i class="fa fa-check-circle" id="correct21"
                        style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
            <i class="fa fa-exclamation-circle" id="wrong21"
                style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
            <small id="c1_problem" style="color:e74c3c"></small>
            </div>
        </div> 
        <div class="form-group row">
            <label for="opd" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="edit_descr"
                    id="edit_descr" value="'.$row["descr"].'">
            <i class="fa fa-check-circle" id="correct31"
                        style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
            <i class="fa fa-exclamation-circle" id="wrong31"
                style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
            <small id="d1_problem" style="color:e74c3c"></small>
            </div>
        </div>
        </form> 
        ';
        
    echo $sample;
}
?>