<?php
session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');
date_default_timezone_set('Asia/Kolkata');
$today = date("d-m-y");

// $_SESSION["p_id"]=$_POST["ppp"];

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing</title>
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
        <div class="mdl-layout__tab-bar mdl-js-ripple-effect" style="background-color: #4481eb;">
            <a href="#fixed-tab-1" class="mdl-layout__tab is-active">Intral-Oral</a>
            <a href="#fixed-tab-2" class="mdl-layout__tab">X-ray</a>
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
                <a class="mdl-navigation__link" href="p_images.php" style='color:#0767D1'>Images</a>
                <a class="mdl-navigation__link" href="p_cost.php">Cost</a>
                <a class="mdl-navigation__link" href="p_billing.php">Billing</a>
                <hr style="background-color:white"><label class="mdl-navigation__label">Others</label>
                <a class="mdl-navigation__link" href="profile.php">Profile</a>
            </nav>
    </div>
    <main class="mdl-layout__content">
        <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
            <div class="page-content">
                <div class="row">
                    <?php
                        $con = mysqli_connect('localhost','root','','doc_images');
                        $opd=$_SESSION["p_id"];
                        $command = "select * from images where opd = '$opd' and type='intra-oral'";
                        $results = mysqli_query($con, $command);
                        $c=0;
                        while($rows = mysqli_fetch_array($results)): 
                            $c=$c+1;                                 
                        ?>
                    <div class="column">
                        <div class="card" id="<?php echo $rows["opd"]; ?>">
                            <h1 data-target="opd"><?php echo $c ?></h1>
                            
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $rows['name_image'] ).'" />'; ?>
                            <div style="padding:5px">
                                <input type="hidden" value="<?php echo $rows["sr_no"]; ?>" class="dell">
                                <!-- <a href="download.php?id="><button type="button" class="btn btn-primary" >Download</button></a> -->
                                <button type="button" class="delete_btn1_ajax btn btn-outline-danger" >Delete</button>
                            </div>
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
                <div class="row">
                    <?php
                        $con = mysqli_connect('localhost','root','','doc_images');
                        $opd=$_SESSION["p_id"];
                        $command = "select * from images where opd = '$opd' and type='x-ray'";
                        $results = mysqli_query($con, $command);
                        $c=0;
                        while($rows = mysqli_fetch_array($results)):
                            $c=$c+1;                                 
                        ?>
                    <div class="column">
                        <div class="card" id="<?php echo $rows["opd"]; ?>">
                            <h1 data-target="opd"><?php echo $c ?></h1>
                            
                            <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $rows['name_image'] ).'" />'; ?>
                            <div style="padding:5px">
                                <input type="hidden" value="<?php echo $rows["sr_no"]; ?>" class="dell">
                                <!-- <a href="download.php?id="><button type="button" class="btn btn-primary" >Download</button></a> -->
                                <button type="button" class="delete_btn1_ajax btn btn-outline-danger" >Delete</button>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        ?>
                </div>
                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
                        data-toggle="modal" data-target="#exampleModalCenter1" style="background-color:#4481eb"
                        id="fixedbutton">
                    <i class="material-icons">add</i>
                </button>
            </div>
        </section>
    </main>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Intra-oral image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="add_intra_image.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleFormControlFile1">Upload image input</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="exampleFormControlFile1" required>
                    <i class="fa fa-exclamation-circle" id="wrong"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="a_problem" style="color:e74c3c"></small>
                </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" value="Insert" id="insert" name="insert" class="btn btn-primary" style="width:50%">
        </div>
        </form>
        </div>
    </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add X-ray image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="add_xray_image.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleFormControlFile2">Upload image input</label>
                    <input type="file" class="form-control-file" id="exampleFormControlFile2" name="exampleFormControlFile2" required>
                    <i class="fa fa-exclamation-circle" id="wrong1"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="a1_problem" style="color:e74c3c"></small>
                </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" value="Insert" id="insert1" name="insert1" class="btn btn-primary" style="width:50%">
        </div>
        </form>
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
        $(document).ready(function () {

            $('.delete_btn1_ajax').click(function (e) {
                e.preventDefault();
                    var deleteid = $(this).closest("div").find('.dell').val();
                    // console.log(deleteid);
                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover Image!",
                        icon: "warning",
                        buttons: ["No, Cancel","Yes, Delete"],
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                            $.ajax({
                                type: "POST",
                                url: "delete_p_image.php",
                                data: {
                                    "delete_btn1_set": 1,
                                    "deleteid": deleteid,
                                },
                                success: function (response) {
                                    swal("Image Deleted Successfully.!", {
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
        $(document).ready(function(){
            $('#insert1').click(function(){
                var image_name = $('#exampleFormControlFile2').val();

                // console.log(image_name);
                var extension = $('#exampleFormControlFile2').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(extension, ['gif','png','jpg','jpeg'])==-1) {
                    $('#exampleFormControlFile2').val('');
                    return false;
                }
            });
        });
    </script>

    <script>
    // function intra_image_form_submit() {
        $(document).ready(function(){
            $('#insert').click(function(){
                var image_name = $('#exampleFormControlFile1').val();

                // console.log(image_name);
                var extension = $('#exampleFormControlFile1').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(extension, ['gif','png','jpg','jpeg'])==-1) {
                    $('#exampleFormControlFile1').val('');
                    return false;
                }
            });
        });
    //     var extension = $('#exampleFormControlFile1').val().split('.').pop().toLowerCase();
    //     if (jQuery.inArray(extension, ['gif','png','jpg','jpeg'])==-1) {
    //         document.getElementById("a_problem").innerHTML = "Please Choose Valid format!";
    //         document.getElementById("wrong").style.visibility = "visible";
    //         document.getElementById("exampleFormControlFile1").style.borderColor = "#e74c3c";
    //         document.getElementById("a_problem").style.visibility = "visible";
            
    //     }
    //     else{
    //         document.getElementById("intra_image_form").submit();
    //     }
    // }
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

</body>
</html>
