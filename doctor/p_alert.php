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
    <title>Alert</title>
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
        
            <!-- Right aligned menu below button -->
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
                <hr style="background-color:white"><a class="mdl-navigation__link" href="p_alert.php"
                    style='color:#0767D1'>Alert</a>
                <a class="mdl-navigation__link" href="p_dental_chart.php">Dental Chart</a>
                <a class="mdl-navigation__link" href="p_treatment.php">Treatment</a>
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
                <h3>Selected Alert</h3>
            </center>

            
            
            <div style="padding:20px">
            <?php
            $opdd=$_SESSION["p_id"];
            // $con = mysqli_connect('localhost','root','','doc_project');
            $commands = "select * from p_alert where opd=$opdd";
            $resultss = mysqli_query($con, $commands);
            while($rowss = mysqli_fetch_array($resultss)):                                  
            ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="selected_alert" value="<?php echo $rowss["alert"]?>" aria-label="Recipient's username" aria-describedby="basic-addon2" style="pointer-events: none;">
                    <div class="input-group-append">
                        <input type="text" class="dell101" value="<?php echo $rowss["alert"]?>" hidden>
                        <button class="delete_btn_ajax btn btn-outline-danger" type="button" style="width:70px">Delete</button>
                    </div>
                </div>
            <?php
            endwhile;
            ?>
            </div>
            
            
            <hr style="background-color:black">

            <center>
                <h3>Select Alert</h3>
            </center>

            <form action="submit_p_alert.php" method="POST" style="padding:20px;">
                <?php
                // $con = mysqli_connect('localhost','root','','doc_project');
                $command = "select * from alert";
                $results = mysqli_query($con, $command);
                while($rows = mysqli_fetch_array($results)):                                  
                ?> 
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="radio" aria-label="Radio button for following text input" value="<?php echo $rows["name"]?>" name="alert_name" required>
                        </div>
                    </div>
                <input type="text" class="form-control" aria-label="Text input with radio button" value="<?php echo $rows["name"]?>" style="pointer-events: none;">
                <div class="input-group-append">
                    <input type="hidden" class="dell" value="<?php echo $rows["name"]?>"> 
                    <button class="delete_btn1_ajax btn btn-outline-danger" type="button" style="width:70px">Delete</button>
                </div>
                </div>
                <?php
                endwhile;
                ?>
                <button type="submit" class="btn btn-outline-primary" style="margin:20px; position: absolute; right: 0; max-width:30%">Submit</button>
            </form>

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
            <h5 class="modal-title" id="exampleModalLongTitle">Add Alert</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="add_alert.php" method="POST" id="alert_form">
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">Alert</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="new_alert"
                            id="new_alert" style="color:blue;">

                    <i class="fa fa-exclamation-circle" id="wrong"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="a_problem" style="color:e74c3c"></small>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="alert_form_submit()">Add</button>
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
    function alert_form_submit() {
        var new_alert = document.getElementById('new_alert').value;
        if (new_alert != "") {
            document.getElementById("alert_form").submit();
        }
        else{
            document.getElementById("a_problem").innerHTML = "Please Enter Alert!";
            document.getElementById("wrong").style.visibility = "visible";
            document.getElementById("new_alert").style.borderColor = "#e74c3c";
            document.getElementById("a_problem").style.visibility = "visible";
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

            $('.delete_btn_ajax').click(function (e) {
                e.preventDefault();
                    var deleteid1 = $(this).closest("div").find('.dell101').val();
                    // console.log("Hello");
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
                                url: "delete_p_alert.php",
                                data: {
                                    "delete_btn_set": 1,
                                    "deleteid1": deleteid1
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
                                url: "delete_p_alert.php",
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
