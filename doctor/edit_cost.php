<?php
session_start();
$opd=$_SESSION["p_id"];
if(isset($_POST["edit_srno"])){
    $sample = '';
    $con = mysqli_connect('localhost','root','','doc_project');
    $query = "SELECT * FROM p_cost WHERE sr_no = '".$_POST["edit_srno"]."' AND opd='".$opd."' ";
    $result = mysqli_query($con,$query);
    while($row = mysqli_fetch_array($result))
    {
        $sample .='
        <form action="edit_cost_form.php" method="POST" id="edit_cost">
            <div class="form-group row">
                <label for="opd" class="col-sm-2 col-form-label">Total Estimated Amount</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control"  name="edit_tea"
                        id="edit_tea" value="'.$row["total_estimated_amount"].'">
                <i class="fa fa-check-circle" id="correct00"
                            style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                <i class="fa fa-exclamation-circle" id="wrong00"
                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                <small id="a1_problem" style="color:e74c3c"></small>
                </div>
            </div>
            <div class="form-group row">
                <label for="opd" class="col-sm-2 col-form-label">Total Amount</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control"  name="edit_ta"
                        id="edit_ta" value="'.$row["total_amount"].'">
                <i class="fa fa-check-circle" id="correct11"
                            style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                <i class="fa fa-exclamation-circle" id="wrong11"
                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                <small id="b1_problem" style="color:e74c3c"></small>
                </div>
            </div>
            <div class="form-group row">
                <label for="opd" class="col-sm-2 col-form-label">Paid Amount</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control"  name="edit_pa"
                        id="edit_pa" value="'.$row["paid_amount"].'">
                <i class="fa fa-check-circle" id="correct21"
                            style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                <i class="fa fa-exclamation-circle" id="wrong21"
                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                <small id="c1_problem" style="color:e74c3c"></small>
                </div>
            </div>
            <input type="hidden" name="ed_sr" id="ed_sr" value="'.$row["sr_no"].'">
        </form>     
        ';
        
    }
    echo $sample;
}
?>