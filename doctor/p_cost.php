<?php
session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');

// $_SESSION["p_id"]=$_POST["ppp"];

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cost</title>
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
    <div class="loading">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>

    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-drawer mdl-sidenav-right mdl-layout--fixed-tabs">
    <header class="mdl-layout__header" style="background-color:#4481eb;">
        <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">OPD-<?php echo $_SESSION["p_id"] ?></span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation. We hide it in small screens. -->
        <nav class="mdl-navigation">
            <!-- <a class="mdl-navigation__link" href="">Link</a> -->
            <button id="demo-menu-lower-right1"
                    class="mdl-button mdl-js-button mdl-button--icon" style="position: fixed; right: 65px;">
            <i class="material-icons">more_vert</i>
            </button>

            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                for="demo-menu-lower-right1" >
                <li class="mdl-menu__item">
                    <a href="patient.php">Patients</a>
                </li>
                <li class="mdl-menu__item">
                    <a href="medications.php">Medications</a>
                </li>
                <li class="mdl-menu__item">
                    <a href="labwork.php">Lab Work</a>
                </li>
                <li class="mdl-menu__item">
                    <a href="transactions.php">Transacions</a>
                </li>
            </ul>
            
            <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon"
                    style="position: fixed; right: 20px;">
                    <img src="../img/user.svg" style='height:100%; filter: invert(1);'>
            </button>

            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                for="demo-menu-lower-right">
                <li class="mdl-menu__item" style="color:blue"><a href="../logout.php">LOGOUT</a></li>
            </ul>
        </nav>
        </div>
    </header>
    <div class="mdl-layout__drawer" style="overflow: auto;">
            <span class="mdl-layout-title" style="margin-top:30px; color:#778899">
                <h2><?php echo $_SESSION["p_id"] ?></h2>
            </span>
            <span class="mdl-layout-title" style="margin-top:10px; color:white;">
                <h2><?php echo $_SESSION["p_f_name"] ?></h2>
            </span>
            <span class="mdl-layout-title" style=" color:white;">
                <h2><?php echo $_SESSION["p_l_name"] ?></h2>
            </span>
            <nav class="mdl-navigation">
                <hr style="background-color:white"><a class="mdl-navigation__link" href="p_alert.php">Alert</a>
                <a class="mdl-navigation__link" href="p_dental_chart.php">Dental Chart</a>
                <a class="mdl-navigation__link" href="p_treatment.php">Treatment</a>
                <a class="mdl-navigation__link" href="p_prescription.php">Prescription</a>
                <a class="mdl-navigation__link" href="p_images.php">Images</a>
                <a class="mdl-navigation__link" href="p_cost.php" style='color:#0767D1'>Cost</a>
                <a class="mdl-navigation__link" href="p_billing.php">Billing</a>
                <hr style="background-color:white"><label class="mdl-navigation__label">Others</label>
                <a class="mdl-navigation__link" href="profile.php">Profile</a>
            </nav>
    </div>
    <main class="mdl-layout__content">
        <div class="page-content">

            <div class="table-responsive" style="padding:20px">
                <table class="table table-bordered">
                    <tr class="thead-dark">
                        <!-- <th>Sr. No.</th> -->
                        <th>Total Estimated Amount</th>
                        <th>Total Amount</th>
                        <th>Paid Amount</th>
                        <th>Remaining Amount</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    $con = mysqli_connect('localhost','root','');
                    mysqli_select_db($con, 'doc_project');
                    $commands = "select * from p_cost where opd='".$_SESSION['p_id']."'";
                    $results = mysqli_query($con, $commands);
                    while($rowss = mysqli_fetch_array($results)):
                    ?>

                    <tr>
                        <th><?php echo $rowss["total_estimated_amount"]?></th>
                        <th><?php echo $rowss["total_amount"]?></th>
                        <th><?php echo $rowss["paid_amount"]?></th>
                        <th><?php echo $rowss["remaining_amount"]?></th>
                        <th>
                            <div>
                                <input type="hidden" class="editl" value="<?php echo $rowss["sr_no"]?>">
                                <button type="button" class="edit_btn btn btn-outline-success">Edit</button>
                            </div>
                        </th>
                        <th>
                            <div>
                                <input type="hidden" class="dell" value="<?php echo $rowss["sr_no"]?>"> 
                                <button class="delete_btn1_ajax btn btn-outline-danger" type="button">Delete</button>
                            </div>
                        </th>
                    </tr>

                    <?php
                    endwhile;
                    ?>
                </table>
            </div>

            <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
                    data-toggle="modal" data-target="#exampleModalCenter" style="background-color:#4481eb"
                    id="fixedbutton">
                <i class="material-icons">add</i>
            </button>
        </div>
    </main>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Cost</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="add_cost.php" method="POST" id="cost_form">
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">Total Estimated Amount</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control"  name="new_tea"
                            id="new_tea">
                    <i class="fa fa-check-circle" id="correct"
                                style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                    <i class="fa fa-exclamation-circle" id="wrong"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="a_problem" style="color:e74c3c"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">Total Amount</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control"  name="new_ta"
                            id="new_ta">
                    <i class="fa fa-check-circle" id="correct1"
                                style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                    <i class="fa fa-exclamation-circle" id="wrong1"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="b_problem" style="color:e74c3c"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">Paid Amount</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control"  name="new_pa"
                            id="new_pa">
                    <i class="fa fa-check-circle" id="correct2"
                                style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                    <i class="fa fa-exclamation-circle" id="wrong2"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="c_problem" style="color:e74c3c"></small>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="cost_form_submit()">Add</button>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Labwork</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="details">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="form_submit1()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
    function cost_form_submit() {
        var new_tea = document.getElementById('new_tea').value;
        var new_ta = document.getElementById('new_ta').value;
        var new_pa = document.getElementById('new_pa').value;
        var new_ra = new_ta - new_pa;

        if ((new_tea != "") && (new_ta != "") && (new_pa != "") && (new_ra>=0)) {
            document.getElementById("cost_form").submit();
        }
        else{
            if (new_tea == ""){
                document.getElementById("a_problem").innerHTML = "Please Enter Total Estimated Amount!";
                document.getElementById("wrong").style.visibility = "visible";
                document.getElementById("new_tea").style.borderColor = "#e74c3c";
                document.getElementById("a_problem").style.visibility = "visible";
            }else {
                document.getElementById("correct").style.visibility = "visible";
                document.getElementById("new_tea").style.borderColor = "#2ecc71";
                document.getElementById("a_problem").style.visibility = "hidden";
                document.getElementById("wrong").style.visibility = "hidden";
            }

            if (new_ta == ""){
                document.getElementById("b_problem").innerHTML = "Please Total Amount!";
                document.getElementById("wrong1").style.visibility = "visible";
                document.getElementById("new_ta").style.borderColor = "#e74c3c";
                document.getElementById("b_problem").style.visibility = "visible";
            }else {
                document.getElementById("correct1").style.visibility = "visible";
                document.getElementById("new_ta").style.borderColor = "#2ecc71";
                document.getElementById("b_problem").style.visibility = "hidden";
                document.getElementById("wrong1").style.visibility = "hidden";
            }

            if ((new_pa == "") || (new_pa>new_ta)){
                document.getElementById("c_problem").innerHTML = "Please Enter Correct Paid Amount!";
                document.getElementById("wrong2").style.visibility = "visible";
                document.getElementById("new_pa").style.borderColor = "#e74c3c";
                document.getElementById("c_problem").style.visibility = "visible";
            }else {
                document.getElementById("correct2").style.visibility = "visible";
                document.getElementById("new_pa").style.borderColor = "#2ecc71";
                document.getElementById("c_problem").style.visibility = "hidden";
                document.getElementById("wrong2").style.visibility = "hidden";
            }
        }
    }
    </script>

<script type="text/javascript">
    function form_submit1() {
        var ed_sr = document.getElementById('ed_sr').value;
        var edit_tea = document.getElementById('edit_tea').value;
        var edit_ta = document.getElementById('edit_ta').value;
        var edit_pa = document.getElementById('edit_pa').value;
        var edit_ra = edit_ta - edit_pa;

        if ((edit_tea != "") && (edit_ta != "") && (edit_pa != "") && (edit_ra>=0)) {
            document.getElementById("edit_cost").submit();
        }
        else{
            if (edit_tea == ""){
                document.getElementById("a1_problem").innerHTML = "Please Enter Total Estimated Amount!";
                document.getElementById("wrong00").style.visibility = "visible";
                document.getElementById("edit_tea").style.borderColor = "#e74c3c";
                document.getElementById("a1_problem").style.visibility = "visible";
            }else {
                document.getElementById("correct00").style.visibility = "visible";
                document.getElementById("edit_tea").style.borderColor = "#2ecc71";
                document.getElementById("a1_problem").style.visibility = "hidden";
                document.getElementById("wrong00").style.visibility = "hidden";
            }

            if (edit_ta == ""){
                document.getElementById("b1_problem").innerHTML = "Please Total Amount!";
                document.getElementById("wrong11").style.visibility = "visible";
                document.getElementById("edit_ta").style.borderColor = "#e74c3c";
                document.getElementById("b1_problem").style.visibility = "visible";
            }else {
                document.getElementById("correct11").style.visibility = "visible";
                document.getElementById("edit_ta").style.borderColor = "#2ecc71";
                document.getElementById("b1_problem").style.visibility = "hidden";
                document.getElementById("wrong11").style.visibility = "hidden";
            }

            if ((edit_pa == "") || (edit_pa>edit_ta)){
                document.getElementById("c1_problem").innerHTML = "Please Enter Correct Paid Amount!";
                document.getElementById("wrong21").style.visibility = "visible";
                document.getElementById("edit_pa").style.borderColor = "#e74c3c";
                document.getElementById("c1_problem").style.visibility = "visible";
            }else {
                document.getElementById("correct21").style.visibility = "visible";
                document.getElementById("edit_pa").style.borderColor = "#2ecc71";
                document.getElementById("c1_problem").style.visibility = "hidden";
                document.getElementById("wrong21").style.visibility = "hidden";
            }
        }
    }
    </script>

    <script>
        $(document).ready(function() {
            $('.edit_btn').click(function (e) {
                e.preventDefault();
                var edit_srno = $(this).closest("div").find('.editl').val();
            
                $.ajax({
                    url: "edit_cost.php",
                    method: "post",
                    data: {
                        edit_srno: edit_srno,
                    },
                    success: function(data) {
                        $('#details').html(data);
                        $('#exampleModalCenter1').modal("show");
                    }
                });

            });
        });
    </script>
    
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
    

    <script>
        $(document).ready(function () {

            $('.delete_btn1_ajax').click(function (e) {
                e.preventDefault();
                    var deleteid = $(this).closest("div").find('.dell').val();
                    // console.log(deleteid);
                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover Alert!",
                        icon: "warning",
                        buttons: ["No, Cancel","Yes, Delete"],
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                            $.ajax({
                                type: "POST",
                                url: "delete_p_cost.php",
                                data: {
                                    "delete_btn1_set": 1,
                                    "deleteid": deleteid,
                                },
                                success: function (response) {
                                    swal("Alert Deleted Successfully.!", {
                                        icon: "success",
                                    }).then((result) => {
                                        location.reload();
                                    });
                                    
                                }            
                            });
                        }
                    });
            });
        });
      
    </script>

</body>
</html>
