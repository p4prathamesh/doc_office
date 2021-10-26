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
                <a class="mdl-navigation__link" href="p_cost.php">Cost</a>
                <a class="mdl-navigation__link" href="p_billing.php" style='color:#0767D1'>Billing</a>
                <hr style="background-color:white"><label class="mdl-navigation__label">Others</label>
                <a class="mdl-navigation__link" href="profile.php">Profile</a>
            </nav>
    </div>
    <main class="mdl-layout__content">
        <div class="page-content">
                <?php
                $con = mysqli_connect('localhost','root','');
                mysqli_select_db($con, 'doc_project');
                // $total=0;
                $commandds = "select * from header";
                $resultts = mysqli_query($con, $commandds);
                while($ros = mysqli_fetch_array($resultts)):
                    // $total=$total+$rowss["cost"];
                ?>
                <form action="add_header.php" method="POST" id="page_header">
                <input type="text" class="form-control" id="clinic_name" name="clinic_name" value="<?php echo $ros["clinic_name"] ?>" style="text-align:center; border:none; font-weight:bold; font-size:40px; ">
                <div class="form-group row no-gutters">

                    <div class="col no-gutters">
                        <div class="leftside" style="height:100%;">
                            <div style="padding:20px">
                            <input type="text" class="form-control" id="dr_name" name="dr_name" value="<?php echo $ros["dr_name"] ?>" style="font-size:25px;border:none;font-weight: bold;">
                            <input type="text" class="form-control" id="dr_designation" name="dr_designation" value="<?php echo $ros["dr_designation"] ?>" style="font-size:15px;border:none;">
                            <input type="text" class="form-control" id="add1" name="add1" value="<?php echo $ros["add1"] ?>" style="font-size:15px;border:none;">
                            <input type="text" class="form-control" id="add2" name="add2" value="<?php echo $ros["add2"] ?>" style="font-size:15px;border:none;">
                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $ros["mobile"] ?>" style="font-size:15px;border:none;">
                            </div>
                        </div>
                    </div>

                    <div class="col no-gutters">
                        <div class="middleside" style="height:100%;">
                            <div style="padding:20px">
                                <img src="https://i.ibb.co/5BH8P9z/doc-logo1.jpg" alt="" style="margin-left:50px;height:150px; width:150px">
                            </div>
                        </div>
                    </div>

                    <div class="col no-gutters">
                        <div class="rightside" style="height:100%;">
                            <div style="padding:20px">
                                <input type="text" class="form-control" id="extra1" name="extra1" value="<?php echo $ros["extra1"] ?>" style="font-size:15px;border:none;">
                                <input type="text" class="form-control" id="extra2" name="extra2" value="<?php echo $ros["extra2"] ?>" style="font-size:15px;border:none;">
                                <input type="text" class="form-control" id="timing" name="timing" value="<?php echo $ros["timing"] ?>" style="font-size:15px;border:none;text-align: right;">
                                <input type="text" class="form-control" id="time1" name="time1" value="<?php echo $ros["time1"] ?>" style="font-size:15px;border:none;text-align: right;">
                                <input type="text" class="form-control" id="time2" name="time2" value="<?php echo $ros["time2"] ?>" style="font-size:15px;border:none;text-align: right;">
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <?php
                endwhile;
                ?>

                <hr style="display: block;height: 1px;border: 1;border-top: 1px solid;">

                <div class="input-group mb-3" style="padding:20px">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="pointer-events: none;"><b>Pt. Name : </b></span>
                    </div>
                    <input type="text" value="<?php echo $_SESSION["p_f_name"] ?> <?php echo $_SESSION["p_l_name"] ?>" class="form-control" style="pointer-events: none;">
                    <div class="input-group-append">
                        <span class="input-group-text" style="pointer-events: none;"><?php echo $today;?></span>
                    </div>
                </div>

                <div class="table-responsive" style="padding:20px">
                    <table class="table table-bordered">
                        <tr class="thead-dark">
                            <!-- <th>Sr. No.</th> -->
                            <th>Treatment</th>
                            <th>Cost</th>
                            <th>Edit</th>
                            <!-- <th>Total</th> -->
                        </tr>
                        <?php
                        $con = mysqli_connect('localhost','root','');
                        mysqli_select_db($con, 'doc_project');
                        $total=0;
                        $commands = "select * from p_dental_treatment where opd='".$_SESSION['p_id']."' and treatment<>'' ";
                        $results = mysqli_query($con, $commands);
                        while($rowss = mysqli_fetch_array($results)):
                            $total=$total+$rowss["cost"];
                        ?>

                        <tr>
                            <th><?php echo $rowss["treatment"]?></th>
                            <th><?php echo $rowss["cost"]?></th>
                            <th>
                                <div>
                                    <input type="hidden" class="editl" value="<?php echo $rowss["treatment"]?>">
                                    <input type="hidden" class="edit2" value="<?php echo $rowss["tooth_number"]?>">
                                    <button type="button" class="edit_btn btn btn-outline-success">Edit</button>
                                </div>
                            </th>
                            <!-- <th></th> -->
                        </tr>
                        <?php
                        endwhile;
                        ?>
                        <tr class="thead-light">
                            <th>Total</th>
                            <th><?php echo $total ?></th>
                            <th></th>
                        </tr>
                    </table>
                </div>

        </div>
        <button type="button" class="btn btn-outline-success" style="margin:20px; position: absolute; left: 0; max-width:30%" onclick="save_header()">Save Header</button>
        <button type="button" class="btn btn-outline-primary" style="margin:20px; position: absolute; right: 0; max-width:30%" id="print">Print</button>
    </main>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Bill</h5>
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

    <script src="..\assets\js\printThis.js"></script>
    <script>
        $('#print').click(function(){
            $('.page-content').printThis({
                debug: false,               // show the iframe for debugging
                importCSS: true,            // import parent page css
                importStyle: false,         // import style tags
                printContainer: true,       // print outer container/$.selector
                loadCSS: "",                // path to additional css file - use an array [] for multiple
                pageTitle: "",              // add title to print page
                removeInline: false,        // remove inline styles from print elements
                removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
                printDelay: 333,            // variable print delay
                header: null,               // prefix to html
                footer: null,               // postfix to html
                base: false,                // preserve the BASE tag or accept a string for the URL
                formValues: true,           // preserve input/form values
                canvas: false,              // copy canvas content
                doctypeString: '<!DOCTYPE html>', // enter a different doctype for older markup
                removeScripts: false,       // remove script tags from print content
                copyTagClasses: false,      // copy classes from the html & body tag
                beforePrintEvent: null,     // callback function for printEvent in iframe
                beforePrint: null,          // function called before iframe is filled
                afterPrint: null            // function called before iframe is removed
            });
        })
    </script>

    <script>
    function save_header(){
        // var extra1 = document.getElementById('extra1').value;
        
        // console.log("ANS"+extra1+"YES");
        document.getElementById("page_header").submit();
    }
    </script>

    <script type="text/javascript">
    function form_submit1() {
        var edit_treatmentt = document.getElementById('edit_treatmentt').value;
        var edit_cost = document.getElementById('edit_cost').value;
        var ed_tno = document.getElementById('ed_tno').value;
        

        if ((edit_treatmentt != "") && (edit_cost > 0)) {
            document.getElementById("edit_billing").submit();
        }
        else{
            if (edit_treatmentt == ""){
                document.getElementById("a1_problem").innerHTML = "Please Enter Treatment!";
                document.getElementById("wrong00").style.visibility = "visible";
                document.getElementById("edit_treatmentt").style.borderColor = "#e74c3c";
                document.getElementById("a1_problem").style.visibility = "visible";
            }else {
                document.getElementById("correct00").style.visibility = "visible";
                document.getElementById("edit_treatmentt").style.borderColor = "#2ecc71";
                document.getElementById("a1_problem").style.visibility = "hidden";
                document.getElementById("wrong00").style.visibility = "hidden";
            }

            if (edit_cost <= 0){
                document.getElementById("b1_problem").innerHTML = "Please Enter Amount!";
                document.getElementById("wrong11").style.visibility = "visible";
                document.getElementById("edit_cost").style.borderColor = "#e74c3c";
                document.getElementById("b1_problem").style.visibility = "visible";
            }else {
                document.getElementById("correct11").style.visibility = "visible";
                document.getElementById("edit_cost").style.borderColor = "#2ecc71";
                document.getElementById("b1_problem").style.visibility = "hidden";
                document.getElementById("wrong11").style.visibility = "hidden";
            }
        }
    }
    </script>

    <script>
        $(document).ready(function() {
            $('.edit_btn').click(function (e) {
                e.preventDefault();
                var edit_treatment = $(this).closest("div").find('.editl').val();
                var edit_tooth_number = $(this).closest("div").find('.edit2').val();
                
                $.ajax({
                    url: "edit_billing.php",
                    method: "post",
                    data: {
                        edit_treatment: edit_treatment,
                        edit_tooth_number: edit_tooth_number,
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

</body>
</html>
