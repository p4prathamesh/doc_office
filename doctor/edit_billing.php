<?php
session_start();
$opd=$_SESSION["p_id"];
if(isset($_POST["edit_tooth_number"])){
    $sample = '';
    $con = mysqli_connect('localhost','root','','doc_project');
    $query = "SELECT * FROM p_dental_treatment WHERE tooth_number = '".$_POST["edit_tooth_number"]."' AND opd='".$opd."' ";
    $result = mysqli_query($con,$query);
    while($row = mysqli_fetch_array($result))
    {
        $sample .='
        <form action="edit_billing_form.php" method="POST" id="edit_billing">
            <div class="form-group row">
                <label for="opd" class="col-sm-2 col-form-label">Treatment</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  name="edit_treatmentt"
                        id="edit_treatmentt" value="'.$row["treatment"].'">
                <i class="fa fa-check-circle" id="correct00"
                            style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                <i class="fa fa-exclamation-circle" id="wrong00"
                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                <small id="a1_problem" style="color:e74c3c"></small>
                </div>
            </div>
            <div class="form-group row">
                <label for="opd" class="col-sm-2 col-form-label">Cost</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control"  name="edit_cost"
                        id="edit_cost" value="'.$row["cost"].'">
                <i class="fa fa-check-circle" id="correct11"
                            style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                <i class="fa fa-exclamation-circle" id="wrong11"
                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                <small id="b1_problem" style="color:e74c3c"></small>
                </div>
            </div>
            <input type="hidden" name="ed_tno" id="ed_tno" value="'.$row["tooth_number"].'">
        </form>     
        ';
        
    }
    echo $sample;
}
?>