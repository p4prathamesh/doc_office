<?php
if(isset($_POST["patient_id"])){
    $sample = '';
    $con = mysqli_connect('localhost','root','','doc_project');
    $query = "SELECT * FROM patients WHERE opd = '".$_POST["patient_id"]."'";
    $result = mysqli_query($con,$query);
    while($row = mysqli_fetch_array($result))
    {
        $sample .='
                    <form action="edit.php" method="post" id="e_form">
                        <div class="form-group row">
                            <label for="opd" class="col-sm-2 col-form-label">OPD</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" value="'.$row["opd"].'" name="opdno1"
                                    id="opd" style="color:blue;" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="f_name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" id="f_name1" name="f_name1"
                                            placeholder="First name" value="'.$row["first_name"].'" required>
                                        <i class="fa fa-check-circle" id="corrrect"
                                            style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                        <i class="fa fa-exclamation-circle" id="wrrong"
                                            style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                        <small id="f_name_prroblem" style="color:#e74c3c"></small>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="l_name1" name="l_name1"
                                            placeholder="Last name" value="'.$row["last_name"].'" required>
                                        <i class="fa fa-check-circle" id="corrrect9"
                                            style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                        <i class="fa fa-exclamation-circle" id="wrrong9"
                                            style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                        <small id="l_name_prroblem" style="color:red"></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-2 col-form-label">DOB</label>
                            <div class="col-10">
                                <input class="form-control" type="date" id="dob1" name="dob1" value="'.$row["dob"].'" required>
                                <i class="fa fa-check-circle" id="corrrect1"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrrong1"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="dob_prroblem" style="color:#e74c3c"></small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="gender1" name="gender1" placeholder="Gender"
                                value="'.$row["gender"].'" required>
                                <i class="fa fa-check-circle" id="corrrect99"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrrong99"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="gender_prroblem" style="color:#e74c3c"></small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="age" class="col-sm-2 col-form-label">Age</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="age1" name="age1" placeholder="Age"
                                value="'.$row["age"].'" required>
                                <i class="fa fa-check-circle" id="corrrect2"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrrong2"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="age_prroblem" style="color:#e74c3c"></small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-sm-2 col-form-label">Mobile No.</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="tel" placeholder="10 digit mobile number" id="mobile1"
                                    name="mobile1" value="'.$row["mobile"].'" required>
                                <i class="fa fa-check-circle" id="corrrect3"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrrong3"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="m_prroblem" style="color:red"></small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="o_mobile" class="col-sm-2 col-form-label">Optional Mobile No.</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="tel" placeholder="10 digit mobile number"
                                    id="o_mobile1" name="o_mobile1" value="'.$row["o_mobile"].'" required>
                                <i class="fa fa-check-circle" id="corrrect4"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrrong4"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="om_prroblem" style="color:red"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="add_1">Address</label>
                            <input type="text" class="form-control" id="add_11" name="add_11" placeholder="1234 Main St"
                            value="'.$row["add_1"].'" required>
                            <i class="fa fa-check-circle" id="corrrect5"
                                style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                            <i class="fa fa-exclamation-circle" id="wrrong5"
                                style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                            <small id="a_prroblem" style="color:e74c3c"></small>
                        </div>
                        <div class="form-group">
                            <label for="add_2">Address 2</label>
                            <input type="text" class="form-control" id="add_21" name="add_21"
                                placeholder="Apartment, studio, or floor" value="'.$row["add_2"].'">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city1" name="city1" value="'.$row["city"].'" required>
                                <i class="fa fa-check-circle" id="corrrect6"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrrong6"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="c_prroblem" style="color:red"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="state">State</label>
                                <select id="state1" name="state1" class="form-control" required>
                                    <option value="'.$row["state"].'" selected>'.$row["state"].'</option>
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <option value="Assam">Assam</option>
                                    <option value="Bihar">Bihar</option>
                                    <option value="Chandigarh">Chandigarh</option>
                                    <option value="Chhattisgarh">Chhattisgarh</option>
                                    <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                    <option value="Daman and Diu">Daman and Diu</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Lakshadweep">Lakshadweep</option>
                                    <option value="Puducherry">Puducherry</option>
                                    <option value="Goa">Goa</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Haryana">Haryana</option>
                                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                    <option value="Jharkhand">Jharkhand</option>
                                    <option value="Karnataka">Karnataka</option>
                                    <option value="Kerala">Kerala</option>
                                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Manipur">Manipur</option>
                                    <option value="Meghalaya">Meghalaya</option>
                                    <option value="Mizoram">Mizoram</option>
                                    <option value="Nagaland">Nagaland</option>
                                    <option value="Odisha">Odisha</option>
                                    <option value="Punjab">Punjab</option>
                                    <option value="Rajasthan">Rajasthan</option>
                                    <option value="Sikkim">Sikkim</option>
                                    <option value="Tamil Nadu">Tamil Nadu</option>
                                    <option value="Telangana">Telangana</option>
                                    <option value="Tripura">Tripura</option>
                                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    <option value="Uttarakhand">Uttarakhand</option>
                                    <option value="West Bengal">West Bengal</option>
                                </select>
                                <i class="fa fa-check-circle" id="corrrect7"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrrong7"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="s_prroblem" style="color:red"></small>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Pin Code</label>
                                <input type="number" class="form-control" id="pin1" name="pin1" value="'.$row["pin"].'" required>
                                <i class="fa fa-check-circle" id="corrrect8"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrrong8"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="p_prroblem" style="color:red"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="saved_by">Saved by</label>
                            <input type="text" class="form-control" id="saved_by" name="saved_by"
                            value="'.$row["saved_by"].'" readonly>
                        </div>
                        <div class="form-group">
                            <label for="edited_by">Edited by</label>
                            <input type="text" class="form-control" id="edited_by" name="edited_by"
                            value="'.$row["edited_by"].'" readonly>
                        </div>
                    </form>
        ';
        
    }
    echo $sample;
}
?>