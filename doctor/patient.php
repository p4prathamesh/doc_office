<?php

session_start();
date_default_timezone_set('UTC');
$today = date("Y-m-d");
?>

<?php

$con = mysqli_connect('localhost','root','','doc_project');

?>

<?php

$query = "SELECT * FROM patients ORDER BY opd DESC LIMIT 1;";

$result = mysqli_query($con, $query);

$row = mysqli_fetch_array($result);

$lastopd = $row['opd'];
if ($lastopd == ""){
    $opd = 1;
}
else{
    // $opd = substr($lastopd,3);
    // $opd = intval($opd);
    $opd = $lastopd + 1;
    
}

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="loader.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <!-- Simple header with fixed tabs. -->
    <div class="loading">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
    <div
        class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-drawer mdl-sidenav-right mdl-layout--fixed-tabs">
        <header class="mdl-layout__header" style="background-color:#4481eb;">
            <div class="mdl-layout__header-row">
                <!-- Title -->
                <span class="mdl-layout-title">Patients Info</span>
                <!-- Right aligned menu below button -->
                <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon"
                    style="position: fixed; top: 20px; right: 20px;">
                    <img src="../img/user.svg" style='height:100%; filter: invert(1);'>
                </button>

                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                    for="demo-menu-lower-right">
                    <li class="mdl-menu__item" style="color:blue"><a href="../logout.php">LOGOUT</a></li>
                </ul>
            </div>
            <!-- Tabs -->
            <div class="mdl-layout__tab-bar mdl-js-ripple-effect" style="background-color: #4481eb;">
                <a href="#fixed-tab-1" class="mdl-layout__tab is-active">RECENT</a>
                <a href="#fixed-tab-2" class="mdl-layout__tab">ALL</a>
            </div>

        </header>
        <div class="mdl-layout__drawer" style="overflow: auto;">
            <span class="mdl-layout-title" style="margin-top:30px">
                <h2>Main Menu</h2>
            </span>
            <nav class="mdl-navigation">
                <hr style="background-color:white">
                <a class="mdl-navigation__link" href="patient.php" style='color:#0767D1'>Patients</a>
                <a class="mdl-navigation__link" href="medications.php">Medications</a>
                <a class="mdl-navigation__link" href="labwork.php">Lab Work</a>
                <a class="mdl-navigation__link" href="transactions.php">Transactions</a>
                <hr style="background-color:white"><label class="mdl-navigation__label">Others</label>
                <a class="mdl-navigation__link" href="profile.php">Profile</a>
            </nav>
        </div>
        <main class="mdl-layout__content">
            <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
                <div class="page-content">

                    <form action="" method="POST" id="s_form" style="padding:20px;">

                        <div class="input-group md-form form-sm form-2 pl-0">
                            <input class="form-control my-0 py-1 lime-border" type="text"
                                placeholder="Search patient..." aria-label="Search" name="id">
                    </form>
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-outline-primary" name="search" value="Search">
                    </div>
                </div>


                <div class="row">
                    <?php

                        // $con = mysqli_connect('localhost','root','','doc_project');
                        if (isset($_POST['search'])){
                            $id = $_POST['id'];
                            $commands = "select * from patients where opd = '$id' or first_name = '$id'";
                            
                            $resultss = mysqli_query($con, $commands);
                            while($rowss = mysqli_fetch_array($resultss)){
                        ?>
                    <div class="column">
                        <div class="card">
                            <form action="select_p.php" method="POST">
                                <input type="text" value="<?php echo $rowss["opd"]; ?>" name="ppp" style="text-decoration: none; font-size:22px; color:black; border: none; text-align:center; background: rgba(0, 0, 0, 0); pointer-events: none;">
                                <p class="title" data-target="name" ><?php echo $rowss["first_name"]; ?>
                                    <?php echo $rowss["last_name"]; ?>
                                </p>
                                <p><button type="submit" style="font-size:18px; text-align:center; color:white;">Select</button></p>
                            </form>
                        </div>
                    </div>
                    <?php
                        }
                         }
                        ?>
                </div>
                <hr style="background-color:black">
                <center>
                    <h3>Today's Data</h3>
                </center>
                <div class="row">
                    <?php

                        // $con = mysqli_connect('localhost','root','','doc_project');
                        $command = "select * from patients where date = '$today' order by opd desc";
                        $results = mysqli_query($con, $command);
                        while($rows = mysqli_fetch_array($results)):                                  
                        ?>
                    <div class="column">
                        <div class="card" id="<?php echo $rows["opd"]; ?>">
                        <form action="select_p.php" method="POST">
                        <input type="text" value="<?php echo $rows["opd"]; ?>" name="ppp" style="text-decoration: none; font-size:22px; color:black; border: none; text-align:center; background: rgba(0, 0, 0, 0); pointer-events: none;">
                            <p class="title" data-target="name" ><?php echo $rows["first_name"]; ?>
                                <?php echo $rows["last_name"]; ?>
                            </p>
                            <p><button type="submit" style="font-size:18px; text-align:center; color:white;">Select</button></p>
                        </form>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        ?>
                </div>
                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
                    data-toggle="modal" data-target="#exampleModalCenter" style="background-color:#4481eb"
                    id="fixedbutton">
                    <i class="material-icons">add</i>
                </button>

    </div>
    </section>
    <section class="mdl-layout__tab-panel" id="fixed-tab-2">
        <div class="page-content">
            <div class="page-content">
                <form action="" method="POST" id="s_form" style="padding:20px;">

                    <div class="input-group md-form form-sm form-2 pl-0">
                        <input class="form-control my-0 py-1 lime-border" type="text" placeholder="Search patient..."
                            aria-label="Search" name="id">
                </form>
                <div class="input-group-append">
                    <input type="submit" class="btn btn-outline-primary" name="search" value="Search">
                </div>
            </div>

            <div class="row">
                <?php

                        // $con = mysqli_connect('localhost','root','','doc_project');
                        if (isset($_POST['search'])){
                            $id = $_POST['id'];
                            $commands = "select * from patients where opd = '$id' or first_name = '$id'";
                            
                            $resultss = mysqli_query($con, $commands);
                            while($rowss = mysqli_fetch_array($resultss)){
                        ?>
                <div class="column">
                    <div class="card">
                        <form action="select_p.php" method="POST">
                        <input type="text" value="<?php echo $rowss["opd"]; ?>" name="ppp" style="text-decoration: none; font-size:22px; color:black; border: none; text-align:center; background: rgba(0, 0, 0, 0); pointer-events: none;">
                            <p class="title" data-target="name" ><?php echo $rowss["first_name"]; ?>
                                <?php echo $rowss["last_name"]; ?>
                            </p>
                            <p><button type="submit" style="font-size:18px; text-align:center; color:white;">Select</button></p>
                        </form>
                    </div>
                </div>
                <?php
                        }
                         }
                        ?>
            </div>
            <hr style="background-color:black">
            <center>
                <h3>All Data</h3>
            </center>
            <div class="row">
                <?php

                    // $con = mysqli_connect('localhost','root','','doc_project');
                    $command = "select * from patients order by opd desc";
                    $results = mysqli_query($con, $command);
                    while($rows = mysqli_fetch_array($results))
                    {                                    
                ?>
                <div class="column">
                    <div class="card">
                    <form action="select_p.php" method="POST">
                        <input type="text" value="<?php echo $rows["opd"]; ?>" name="ppp" style="text-decoration: none; font-size:22px; color:black; border: none; text-align:center; background: rgba(0, 0, 0, 0); pointer-events: none;">
                            <p class="title" data-target="name" ><?php echo $rows["first_name"]; ?>
                                <?php echo $rows["last_name"]; ?>
                            </p>
                            <p><button type="submit" style="font-size:18px; text-align:center; color:white;">Select</button></p>
                        </form></div>
                </div>
                <?php
                    };
                ?>
            </div>
            <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
                style="background-color:#4481eb" id="fixedbutton" data-toggle="modal" data-target="#exampleModalCenter">
                <i class="material-icons">add</i>
            </button>
        </div>
    </section>
    </main>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Patient Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="submit.php" method="post" id="p_form">
                        <input type="hidden" name="action" value="form1" />
                        <div class="form-group row">
                            <label for="opd" class="col-sm-2 col-form-label">OPD</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" value="<?php echo $opd; ?>" name="opdno"
                                    id="opd" style="color:blue;" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="f_name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" id="f_name" name="f_name"
                                            placeholder="First name" required>
                                        <i class="fa fa-check-circle" id="correct"
                                            style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                        <i class="fa fa-exclamation-circle" id="wrong"
                                            style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                        <small id="f_name_problem" style="color:#e74c3c"></small>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="l_name" name="l_name"
                                            placeholder="Last name" required>
                                        <i class="fa fa-check-circle" id="correct9"
                                            style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                        <i class="fa fa-exclamation-circle" id="wrong9"
                                            style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                        <small id="l_name_problem" style="color:red"></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-2 col-form-label">DOB</label>
                            <div class="col-10">
                                <input class="form-control" type="date" id="dob" name="dob" required>
                                <i class="fa fa-check-circle" id="correct1"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrong1"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="dob_problem" style="color:#e74c3c"></small>
                            </div>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male">
                            <label class="form-check-label" for="inlineRadio1">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female">
                            <label class="form-check-label" for="inlineRadio2">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="Other"
                                checked>
                            <label class="form-check-label" for="inlineRadio3">Other</label>
                        </div>
                        <BR></BR>

                        <div class="form-group row">
                            <label for="age" class="col-sm-2 col-form-label">Age</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="age" name="age" placeholder="Age"
                                    required>
                                <i class="fa fa-check-circle" id="correct2"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrong2"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="age_problem" style="color:#e74c3c"></small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-sm-2 col-form-label">Mobile No.</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="tel" placeholder="10 digit mobile number" id="mobile"
                                    name="mobile" required>
                                <i class="fa fa-check-circle" id="correct3"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrong3"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="m_problem" style="color:red"></small>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="o_mobile" class="col-sm-2 col-form-label">Optional Mobile No.</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="tel" placeholder="10 digit mobile number"
                                    id="o_mobile" name="o_mobile" required>
                                <i class="fa fa-check-circle" id="correct4"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrong4"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="om_problem" style="color:red"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="add_1">Address</label>
                            <input type="text" class="form-control" id="add_1" name="add_1" placeholder="1234 Main St"
                                required>
                            <i class="fa fa-check-circle" id="correct5"
                                style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                            <i class="fa fa-exclamation-circle" id="wrong5"
                                style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                            <small id="a_problem" style="color:e74c3c"></small>
                        </div>
                        <div class="form-group">
                            <label for="add_2">Address 2</label>
                            <input type="text" class="form-control" id="add_2" name="add_2"
                                placeholder="Apartment, studio, or floor">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                                <i class="fa fa-check-circle" id="correct6"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrong6"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="c_problem" style="color:red"></small>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="state">State</label>
                                <select id="state" name="state" class="form-control" required>
                                    <option value="d" selected>Choose...</option>
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
                                <i class="fa fa-check-circle" id="correct7"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrong7"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="s_problem" style="color:red"></small>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputZip">Pin Code</label>
                                <input type="number" class="form-control" id="pin" name="pin" required>
                                <i class="fa fa-check-circle" id="correct8"
                                    style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                                <i class="fa fa-exclamation-circle" id="wrong8"
                                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                                <small id="p_problem" style="color:red"></small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="form_submit()">Save</button>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
    document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
            document.querySelector("body").style.visibility = "hidden";
            document.querySelector(".loading").style.visibility = "visible";
        } else {
            document.querySelector(".loading").style.display = "none";
            document.querySelector("body").style.visibility = "visible";
        }
    };
    </script>
    
    <script type="text/javascript">
    function form_submit() {
        var f_name = document.getElementById('f_name').value;
        var l_name = document.getElementById('l_name').value;
        var dob = document.getElementById('dob').value;
        var age = document.getElementById('age').value;
        var mobile = document.getElementById('mobile').value;
        var o_mobile = document.getElementById('o_mobile').value;
        var add_1 = document.getElementById('add_1').value;
        var city = document.getElementById('city').value;
        var state = document.getElementById('state').value;
        var pin = document.getElementById('pin').value;
        var digit = ('' + mobile)[0];
        var digit1 = ('' + o_mobile)[0];
        const getAge = birthDate => Math.floor((new Date() - new Date(birthDate).getTime()) / 3.15576e+10);
        var age_diff = getAge(dob);

        if ((f_name != "") && (l_name != "") && (dob != "") && (mobile != "") && (o_mobile != "") && (add_1 != "") && (
                city != "") && (
                state != "") && (pin != "") && (age == age_diff)) {
            document.getElementById("p_form").submit();
        } else {
            if ((f_name == "") || (f_name.length <= 3)) {
                document.getElementById("f_name_problem").innerHTML = "Please Enter First Name!";
                document.getElementById("wrong").style.visibility = "visible";
                document.getElementById("f_name").style.borderColor = "#e74c3c";
                document.getElementById("f_name_problem").style.visibility = "visible";
                document.getElementById("correct").style.visibility = "hidden";
            } else {
                document.getElementById("correct").style.visibility = "visible";
                document.getElementById("f_name").style.borderColor = "#2ecc71";
                document.getElementById("f_name_problem").style.visibility = "hidden";
                document.getElementById("wrong").style.visibility = "hidden";
            }
            if ((l_name == "") || (l_name.length <= 1)) {
                document.getElementById("l_name_problem").innerHTML = "Please Enter Last Name!";
                document.getElementById("wrong9").style.visibility = "visible";
                document.getElementById("l_name").style.borderColor = "#e74c3c";
                document.getElementById("l_name_problem").style.visibility = "visible";
                document.getElementById("correct9").style.visibility = "hidden";
            } else {
                document.getElementById("correct9").style.visibility = "visible";
                document.getElementById("l_name").style.borderColor = "#2ecc71";
                document.getElementById("l_name_problem").style.visibility = "hidden";
                document.getElementById("wrong9").style.visibility = "hidden";
            }
            if ((dob == "") || (age_diff < 1)) {
                document.getElementById("dob_problem").innerHTML = "Please Enter Valid DOB!";
                document.getElementById("wrong1").style.visibility = "visible";
                document.getElementById("dob").style.borderColor = "#e74c3c";
                document.getElementById("dob_problem").style.visibility = "visible";
                document.getElementById("correct1").style.visibility = "hidden";
            } else {
                document.getElementById("correct1").style.visibility = "visible";
                document.getElementById("dob").style.borderColor = "#2ecc71";
                document.getElementById("dob_problem").style.visibility = "hidden";
                document.getElementById("wrong1").style.visibility = "hidden";
            }
            if ((age == "") || (age.length > 3) || (age != age_diff)) {
                document.getElementById("age_problem").innerHTML = "Please Enter Valid Age!";
                document.getElementById("age_problem").style.visibility = "visible";
                document.getElementById("wrong2").style.visibility = "visible";
                document.getElementById("age").style.borderColor = "#e74c3c";
                document.getElementById("correct2").style.visibility = "hidden";
            } else {
                document.getElementById("correct2").style.visibility = "visible";
                document.getElementById("age").style.borderColor = "#2ecc71";
                document.getElementById("age_problem").style.visibility = "hidden";
                document.getElementById("wrong2").style.visibility = "hidden";
            }
            if ((mobile == "") || (mobile.length != 10) || (digit < 6)) {
                document.getElementById("m_problem").innerHTML = "Please Enter Mobile Number!";
                document.getElementById("m_problem").style.visibility = "visible";
                document.getElementById("wrong3").style.visibility = "visible";
                document.getElementById("mobile").style.borderColor = "#e74c3c";
                document.getElementById("correct3").style.visibility = "hidden";
            } else {
                document.getElementById("correct3").style.visibility = "visible";
                document.getElementById("mobile").style.borderColor = "#2ecc71";
                document.getElementById("m_problem").style.visibility = "hidden";
                document.getElementById("wrong3").style.visibility = "hidden";
            }
            if ((o_mobile == "") || (o_mobile.length != 10) || (digit1 < 6)) {
                document.getElementById("om_problem").innerHTML = "Please Enter Optional Mobile!";
                document.getElementById("om_problem").style.visibility = "visible";
                document.getElementById("wrong4").style.visibility = "visible";
                document.getElementById("o_mobile").style.borderColor = "#e74c3c";
                document.getElementById("correct4").style.visibility = "hidden";
            } else {
                document.getElementById("correct4").style.visibility = "visible";
                document.getElementById("o_mobile").style.borderColor = "#2ecc71";
                document.getElementById("om_problem").style.visibility = "hidden";
                document.getElementById("wrong4").style.visibility = "hidden";
            }
            if (add_1 == "") {
                document.getElementById("a_problem").innerHTML = "Please Enter Address!";
                document.getElementById("a_problem").style.visibility = "visible";
                document.getElementById("wrong5").style.visibility = "visible";
                document.getElementById("add_1").style.borderColor = "#e74c3c";
                document.getElementById("correct5").style.visibility = "hidden";
            } else {
                document.getElementById("correct5").style.visibility = "visible";
                document.getElementById("add_1").style.borderColor = "#2ecc71";
                document.getElementById("a_problem").style.visibility = "hidden";
                document.getElementById("wrong5").style.visibility = "hidden";
            }
            if (city == "") {
                document.getElementById("c_problem").innerHTML = "Please Enter Address!";
                document.getElementById("c_problem").style.visibility = "visible";
                document.getElementById("wrong6").style.visibility = "visible";
                document.getElementById("city").style.borderColor = "#e74c3c";
                document.getElementById("correct6").style.visibility = "hidden";
            } else {
                document.getElementById("correct6").style.visibility = "visible";
                document.getElementById("city").style.borderColor = "#2ecc71";
                document.getElementById("c_problem").style.visibility = "hidden";
                document.getElementById("wrong6").style.visibility = "hidden";
            }
            if ((state == "") || (state == "d")) {
                document.getElementById("s_problem").innerHTML = "Please Select State!";
                document.getElementById("s_problem").style.visibility = "visible";
                document.getElementById("wrong7").style.visibility = "visible";
                document.getElementById("state").style.borderColor = "#e74c3c";
                document.getElementById("correct7").style.visibility = "hidden";
            } else {
                document.getElementById("correct7").style.visibility = "visible";
                document.getElementById("state").style.borderColor = "#2ecc71";
                document.getElementById("s_problem").style.visibility = "hidden";
                document.getElementById("wrong7").style.visibility = "hidden";
            }
            if ((pin == "") || (pin.length != 6)) {
                document.getElementById("p_problem").innerHTML = "Please Enter Pin!";
                document.getElementById("p_problem").style.visibility = "visible";
                document.getElementById("wrong8").style.visibility = "visible";
                document.getElementById("pin").style.borderColor = "#e74c3c";
                document.getElementById("correct8").style.visibility = "hidden";
            } else {
                document.getElementById("correct8").style.visibility = "visible";
                document.getElementById("pin").style.borderColor = "#2ecc71";
                document.getElementById("p_problem").style.visibility = "hidden";
                document.getElementById("wrong8").style.visibility = "hidden";
            }

        }

    }
    </script>

    <!-- <script src="app.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] != '')
    {
      ?>
    <script>
    swal({
        title: "<?php echo $_SESSION['status']; ?>",
        // text: "You clicked the button!",
        icon: "<?php echo $_SESSION['status_code']; ?>",
        button: "<?php echo $_SESSION['button']; ?>",
    });
    </script>
    <?php
      unset($_SESSION['status']);
    }
    ?>

<?php
    if (isset($_SESSION['status1']) && $_SESSION['status1'] != '')
    {
      ?>
    <script>
    swal({
        title: "<?php echo $_SESSION['status1']; ?>",
        // text: "You clicked the button!",
        icon: "<?php echo $_SESSION['status_code1']; ?>",
        button: "<?php echo $_SESSION['button']; ?>",
    });
    </script>
    <?php
      unset($_SESSION['status1']);
    }
    ?>
</body>

</html>