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
    <title>Treatment</title>
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
                <hr style="background-color:white">
                <a class="mdl-navigation__link" href="p_alert.php">Alert</a>
                <a class="mdl-navigation__link" href="p_dental_chart.php">Dental Chart</a>
                <a class="mdl-navigation__link" href="p_treatment.php" style='color:#0767D1'>Treatment</a>
                <a class="mdl-navigation__link" href="p_prescription.php">Prescription</a>
                <a class="mdl-navigation__link" href="p_images.php">Images</a>
                <a class="mdl-navigation__link" href="p_cost.php">Cost</a>
                <a class="mdl-navigation__link" href="p_billing.php">Billing</a>
                <hr style="background-color:white"><label class="mdl-navigation__label">Others</label>
                <a class="mdl-navigation__link" href="profile.php">Profile</a>
            </nav>
    </div>
    <main class="mdl-layout__content">
        <div class="page-content">
            
            <center>
                <h3>Edit Treatment</h3>
            </center>

            <div class="table-responsive" style="padding:20px">
                <table class="table table-bordered">
                    <tr class="thead-dark">
                        <th>Tooth Number</th>
                        <th>Tooth Name</th>
                        <th>Treatment</th>
                        <th>Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    $con = mysqli_connect('localhost','root','');
                    mysqli_select_db($con, 'doc_project');
                    $opd=$_SESSION["p_id"];
                    $commands = "select * from p_dental_treatment where opd ='$opd'";
                    $results = mysqli_query($con, $commands);
                    while($rowss = mysqli_fetch_array($results)):
                    ?>

                    <tr>
                        <th><?php echo $rowss["tooth_number"]?></th>
                        <th><?php echo $rowss["tooth_name"]?></th>
                        <th><?php echo $rowss["treatment"]?></th>
                        <th><?php echo $rowss["descr"]?></th>
                        <th>
                            <div>
                                <input type="hidden" class="editl" id="editl" value="<?php echo $rowss["tooth_number"]?>">
                                <input type="hidden" class="edit2" value="<?php echo $rowss["tooth_name"]?>">
                                <button type="button" class="edit_btn btn btn-outline-success">Edit</button>
                            </div>
                        </th>
                        <th>
                            <div>
                                <input type="hidden" class="dell" value="<?php echo $rowss["tooth_number"]?>">
                                <input type="hidden" class="dell1" value="<?php echo $rowss["tooth_name"]?>">  
                                <!-- <input type="hidden" class="dell2" value="<?php echo $rowss["status"]?>">  -->
                                <button class="delete_btn1_ajax btn btn-outline-danger" type="button">Delete</button>
                            </div>
                        </th>
                    </tr>

                    <?php
                    endwhile;
                    ?>
                </table>
            </div>

            <center>
                <h3>Treatments</h3>
            </center>
            
            <div style="padding:20px">
                <?php
                // $con = mysqli_connect('localhost','root','','doc_project');
                $command = "select * from treatment";
                $results = mysqli_query($con, $command);
                while($rows = mysqli_fetch_array($results)):                                  
                ?> 
                <div class="input-group">
                    <input type="text" class="form-control" aria-label="Text input with radio button" value="<?php echo $rows["treatment_name"]?>" style="pointer-events: none;">
                    <div class="input-group-append">
                        <input type="hidden" class="dell3" value="<?php echo $rows["treatment_name"]?>"> 
                        <button class="delete_btn2_ajax btn btn-outline-danger" type="button" style="width:70px">Delete</button>
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
    </main>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Treatment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="add_treatment.php" method="POST" id="treatment_form">
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">Treatment</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="new_treatment"
                            id="new_treatment" style="color:blue;">

                    <i class="fa fa-exclamation-circle" id="wrong"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="a_problem" style="color:e74c3c"></small>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="treatment_form_submit()">Add</button>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Treatment</h5>
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

    <script>
        $(document).ready(function() {
            $('.edit_btn').click(function (e) {
                e.preventDefault();
                var edit_tooth_no = $(this).closest("div").find('.editl').val();
                
                $.ajax({
                    url: "edit_treatment.php",
                    method: "post",
                    data: {
                        edit_tooth_no: edit_tooth_no,
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
    function treatment_form_submit() {
        var new_treatment = document.getElementById('new_treatment').value;
        if (new_treatment != "") {
            document.getElementById("treatment_form").submit();
        }
        else{
            document.getElementById("a_problem").innerHTML = "Please Enter Treatment!";
            document.getElementById("wrong").style.visibility = "visible";
            document.getElementById("new_treatment").style.borderColor = "#e74c3c";
            document.getElementById("a_problem").style.visibility = "visible";
        }
    }
    </script>
    
    <script type="text/javascript">
    function form_submit1() {
        var edit_tooth_number = document.getElementById('edit_tooth_number').value;
        var edit_tooth_name = document.getElementById('edit_tooth_name').value;
        var edit_treatment = document.getElementById('edit_treatment').value;
        var edit_descr = document.getElementById('edit_descr').value;

        if ((edit_tooth_number != "") && (edit_tooth_name != "") && (edit_treatment != "Select Treatment...") ) {
            document.getElementById("edit_treatment_details").submit();
        }
        else{
            if (edit_tooth_number == ""){
                document.getElementById("a1_problem").innerHTML = "Please Enter Valid Tooth Number!";
                document.getElementById("wrong00").style.visibility = "visible";
                document.getElementById("edit_tooth_number").style.borderColor = "#e74c3c";
                document.getElementById("a1_problem").style.visibility = "visible";
            }else {
                document.getElementById("correct00").style.visibility = "visible";
                document.getElementById("edit_tooth_number").style.borderColor = "#2ecc71";
                document.getElementById("a1_problem").style.visibility = "hidden";
                document.getElementById("wrong00").style.visibility = "hidden";
            }

            if (edit_tooth_name == ""){
                document.getElementById("b1_problem").innerHTML = "Please Enter Valid Tooth Name!";
                document.getElementById("wrong11").style.visibility = "visible";
                document.getElementById("edit_tooth_name").style.borderColor = "#e74c3c";
                document.getElementById("b1_problem").style.visibility = "visible";
            }else {
                document.getElementById("correct11").style.visibility = "visible";
                document.getElementById("edit_tooth_name").style.borderColor = "#2ecc71";
                document.getElementById("b1_problem").style.visibility = "hidden";
                document.getElementById("wrong11").style.visibility = "hidden";
            }

            if (edit_treatment == "Select Treatment..."){
                document.getElementById("c1_problem").innerHTML = "Please Select Treatment!";
                document.getElementById("wrong21").style.visibility = "visible";
                document.getElementById("edit_treatment").style.borderColor = "#e74c3c";
                document.getElementById("c1_problem").style.visibility = "visible";
            } else {
                document.getElementById("correct21").style.visibility = "visible";
                document.getElementById("edit_treatment").style.borderColor = "#2ecc71";
                document.getElementById("c1_problem").style.visibility = "hidden";
                document.getElementById("wrong21").style.visibility = "hidden";
            }
        }
    }
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
                    var deleteid1 = $(this).closest("div").find('.dell1').val();
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
                                url: "delete_p_treatment.php",
                                data: {
                                    "delete_btn1_set": 1,
                                    "deleteid": deleteid,
                                    "deleteid1": deleteid1,
                                },
                                success: function (response) {
                                    swal("Treatment Deleted Successfully.!", {
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

<script>
        $(document).ready(function () {

            $('.delete_btn2_ajax').click(function (e) {
                e.preventDefault();
                    var deleteid3 = $(this).closest("div").find('.dell3').val();
                    // var deleteid1 = $(this).closest("div").find('.dell1').val();
                    // console.log(deleteid);
                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover Treatment!",
                        icon: "warning",
                        buttons: ["No, Cancel","Yes, Delete"],
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                            $.ajax({
                                type: "POST",
                                url: "delete_treatment.php",
                                data: {
                                    "delete_btn2_set": 1,
                                    "deleteid3": deleteid3,
                                    // "deleteid1": deleteid1,
                                },
                                success: function (response) {
                                    swal("Treatment Deleted Successfully.!", {
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
