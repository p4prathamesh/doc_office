<?php
session_start();
if(isset($_POST["edit_labname"])){
    $sample = '';
    $con = mysqli_connect('localhost','root','','doc_project');
    $query = "SELECT * FROM labwork WHERE lab_name = '".$_POST["edit_labname"]."' AND given_work = '".$_POST["edit_givenwork"]."' ";
    $result = mysqli_query($con,$query);
    while($row = mysqli_fetch_array($result))
    {
        $sample .='
            <form action="edit_labwork_form.php" method="POST" id="edit_labwork">
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">LabName</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="edit_labname"
                            id="edit_labname" value="'.$row["lab_name"].'">
                    <i class="fa fa-check-circle" id="correct00"
                                style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                    <i class="fa fa-exclamation-circle" id="wrong00"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="a1_problem" style="color:e74c3c"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">GivenWork</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="edit_givenwork"
                            id="edit_givenwork" value="'.$row["given_work"].'">
                    <i class="fa fa-check-circle" id="correct11"
                                style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                    <i class="fa fa-exclamation-circle" id="wrong11"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="b1_problem" style="color:e74c3c"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                    <select class="form-control" name="edit_status" id="edit_status">
                        <option selected>Select Status...</option>
                        <option value="Received">Received</option>
                        <option value="Pending">Pending</option>
                    </select>
                    <i class="fa fa-check-circle" id="correct21"
                                style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                    <i class="fa fa-exclamation-circle" id="wrong21"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="c1_problem" style="color:e74c3c"></small>
                    </div>
                </div>
            </form>     
        ';
        
    }
    echo $sample;
}
?>