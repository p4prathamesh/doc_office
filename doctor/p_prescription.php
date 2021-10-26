<?php
session_start();

$con = mysqli_connect('localhost','root','');

mysqli_select_db($con, 'doc_project');
date_default_timezone_set('UTC');
$today = date("d-m-y");

$qry = "select * from medications";
$result = mysqli_query($con,$qry);


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="loader.css">
    <!-- <style>
        th.medicine_name_c {
            width:"40%";
        }
    </style> -->
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
                <a class="mdl-navigation__link" href="p_treatment.php">Treatment</a>
                <a class="mdl-navigation__link" href="p_prescription.php" style='color:#0767D1'>Prescription</a>
                <a class="mdl-navigation__link" href="p_images.php">Images</a>
                <a class="mdl-navigation__link" href="p_cost.php">Cost</a>
                <a class="mdl-navigation__link" href="p_billing.php">Billing</a>
                <hr style="background-color:white"><label class="mdl-navigation__label">Others</label>
                <a class="mdl-navigation__link" href="profile.php">Profile</a>
            </nav>
    </div>
    <main class="mdl-layout__content">
        <div class="page-content">

                <!-- <img id="myimg" src="https://www.logodesign.net/logo/cross-made-of-molecular-bonds-4028ld.png" style="margin-top:55px; margin-left:10px; width: 150px; height: 180px; float: left; background-position: center center; background-repeat: no-repeat; padding:10px"> -->
                
                <?php
                $con = mysqli_connect('localhost','root','');
                mysqli_select_db($con, 'doc_project');
                // $total=0;
                $commandds = "select * from header";
                $resultts = mysqli_query($con, $commandds);
                while($ros = mysqli_fetch_array($resultts)):
                    // $total=$total+$rowss["cost"];
                ?>
                <form action="add_header_p.php" method="POST" id="page_header">
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

                <div class="row no-gutters" style="height:100%">

                    <div class="leftside" style="height:100%;padding:20px">
                        <h3><u><b>FACILITIES</b></u></H3>
                        <ul>
                            <li><h5>X-Ray Unit</h5></li>
                            <li><h5>Root Canal Treatment</h5></li>
                            <li><h5>Tooth Coloured Filings</h5></li>
                            <li><h5>Dental Surgery</h5></li>
                            <li><h5>Ultra Sonic Scaling</h5></li>
                            <li><h5>Fixed Metal Bridges</h5></li>
                            <li><h5>Fixed Ceramic Bridges</h5></li>
                            <li><h5>Imported Complete Dentures</h5></li>
                            <li><h5>Gum Surgery</h5></li>
                            <li><h5>Fractures Treatment</h5></li>
                            <li><h5>Orthodontic Treatment</h5></li>
                            <li><h5>Dental Implants</h5></li>
                        </ul>
                        <h3><u><b>ORAL FINDINGS</b></u></H3>
                    </div>
                    
                    <div class="vl" style="border-left: 1px solid black;height: 1000px;"></div>

                    <div class="col no-gutters">
                        <div class="rightside" style="height:100%;">
                            <div class="input-group mb-3" style="padding:20px">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="pointer-events: none;"><b>Pt. Name : </b></span>
                                </div>
                                <input type="text" value="<?php echo $_SESSION["p_f_name"] ?> <?php echo $_SESSION["p_l_name"] ?>" class="form-control" style="pointer-events: none;">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="pointer-events: none;"><?php echo $today;?></span>
                                </div>
                            </div>
                            <div style="padding:20px">
                                <h3>R<sub>x</sub></h3>
                            </div>
                        
                            <div style="padding:20px">
                                <!-- <form method="POST" id="insert_prescription"> -->
                                    <div class="table-responsive">
                                    <!-- <span id="error"></span> -->
                                        <table class="table table-bordered" id="item_table">
                                        <!-- <thead class="thead-light"> -->
                                            <tr class="thead-dark">
                                                <th scope="col" style="width:40%">Medicine Name    </th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Days</th>
                                                <th scope="col">Dosage</th>
                                                <!-- <th scope="col">Afternoon</th>
                                                <th scope="col">Evening</th> -->
                                                <!-- <th scope="col">When</th> -->
                                                <th scope="col">
                                                    <button type="button" id="add_row" class="btn btn-outline-danger btn-sm add" style="border:0px">
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                </th>
                                            </tr>
                                            <?php
                                            $con = mysqli_connect('localhost','root','');
                                            mysqli_select_db($con, 'doc_project');
                                            // $total=0;
                                            $opd=$_SESSION["p_id"];
                                            $commands = "select * from p_prescription where opd='".$_SESSION['p_id']."' ";
                                            $results = mysqli_query($con, $commands);
                                            while($rowss = mysqli_fetch_array($results)):
                                                // $total=$total+$rowss["cost"];
                                            ?>
                                            <tr>
                                            <th><?php echo $rowss["medicine_name"]?></th>
                                            <th><?php echo $rowss["quantity"]?></th>
                                            <th><?php echo $rowss["days"]?></th>
                                            <th><?php echo $rowss["dosage"]?></th>
                                            <!-- <th></th>
                                            <th></th> -->
                                            <th>
                                            <div>
                                                <input type="hidden" class="dell" value="<?php echo $opd ?>">
                                                <input type="hidden" class="dell1" value="<?php echo $rowss["medicine_name"]?>">  
                                                <button type="button" class="delete_btn1_ajax btn btn-outline-danger" style="border:0px"><i class="material-icons">close</i></button>
                                            </div>
                                            </th>
                                            </tr>
                                            <?php
                                            endwhile;
                                            ?>
                                        </table>
                                        <br />
                                        <div>
                                            <p style="position: absolute; right: 20 ; bottom: 15; font-size:20px">Sign & Stamp</p>
                                        </div>
                                    </div>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>

                </div>
                
        </div>
        <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
                data-toggle="modal" data-target="#exampleModalCenter" style="background-color:#4481eb"
                id="fixedbutton">
            <i class="material-icons">add</i>
        </button>
        <button type="button" class="btn btn-outline-success" style="margin:20px; position: absolute; left: 0; max-width:30%" onclick="save_header()">Save Header</button>
        <button type="button" class="btn btn-outline-primary" style="margin:20px; position: absolute; right: 0; max-width:30%" id="print">Print</button>
    </main>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Prescription</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="add_prescription.php" method="POST" id="prescription_form">
                
                <select name="medicine_select" id="medicine_select" class="form-control medicine_select">
                        <option value="">Select Medicine</option>
                    <?php while($row = mysqli_fetch_array($result)):; ?>
                        <option value="<?php echo $row["medicine"]; ?>"><?php echo $row["medicine"]; ?></option>
                    <?php endwhile; ?>
                </select><br>
                <i class="fa fa-check-circle" id="correct2"
                        style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                <i class="fa fa-exclamation-circle" id="wrong2"
                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                <small id="c_problem" style="color:#e74c3c"></small>

                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control"  name="new_quantity"
                            id="new_quantity">
                    <i class="fa fa-check-circle" id="correct"
                        style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                    <i class="fa fa-exclamation-circle" id="wrong"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="a_problem" style="color:e74c3c"></small>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">Days</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control"  name="new_days"
                            id="new_days">
                    <i class="fa fa-check-circle" id="correct1"
                        style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                    <i class="fa fa-exclamation-circle" id="wrong1"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="b_problem" style="color:e74c3c"></small>
                    </div>
                </div>

                <input type="checkbox" name="dose[]" value="Morning"> Morning 
                <input type="checkbox" name="dose[]" value="Afternoon"> Afternoon 
                <input type="checkbox" name="dose[]" value="Evening"> Evening 
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="prescription_form_submit()">Add</button>
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
    function prescription_form_submit() {
            var medicine_select = document.getElementById('medicine_select').value;
            var new_quantity = document.getElementById('new_quantity').value;
            var new_days = document.getElementById('new_days').value;
            
            if (medicine_select != "" && new_quantity!="" && new_days!="") {
                document.getElementById("prescription_form").submit();
            }
            else{
                if(medicine_select == ""){
                    document.getElementById("c_problem").innerHTML = "Please Select Medicine!";
                    document.getElementById("wrong2").style.visibility = "visible";
                    document.getElementById("medicine_select").style.borderColor = "#e74c3c";
                    document.getElementById("c_problem").style.visibility = "visible";
                }else{
                    document.getElementById("correct2").style.visibility = "visible";
                    document.getElementById("medicine_select").style.borderColor = "#2ecc71";
                    document.getElementById("c_problem").style.visibility = "hidden";
                    document.getElementById("wrong2").style.visibility = "hidden";
                }
                if(new_quantity==""){
                    document.getElementById("a_problem").innerHTML = "Please Enter Quantity!";
                    document.getElementById("wrong").style.visibility = "visible";
                    document.getElementById("new_quantity").style.borderColor = "#e74c3c";
                    document.getElementById("a_problem").style.visibility = "visible";
                }else{
                    document.getElementById("correct").style.visibility = "visible";
                    document.getElementById("new_quantity").style.borderColor = "#2ecc71";
                    document.getElementById("a_problem").style.visibility = "hidden";
                    document.getElementById("wrong").style.visibility = "hidden";
                }
                if(new_days==""){
                    document.getElementById("b_problem").innerHTML = "Please Enter Days!";
                    document.getElementById("wrong1").style.visibility = "visible";
                    document.getElementById("new_days").style.borderColor = "#e74c3c";
                    document.getElementById("b_problem").style.visibility = "visible";
                }else{
                    document.getElementById("correct1s").style.visibility = "visible";
                    document.getElementById("new_days").style.borderColor = "#2ecc71";
                    document.getElementById("b_problem").style.visibility = "hidden";
                    document.getElementById("wrong1").style.visibility = "hidden";
                }
                
            }
        }
        </script>

    <script>
    function save_header(){
        document.getElementById("page_header").submit();
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
        $(document).ready(function () {

            $('.delete_btn1_ajax').click(function (e) {
                e.preventDefault();
                    var deleteid = $(this).closest("div").find('.dell').val();
                    var deleteid1 = $(this).closest("div").find('.dell1').val();
                    // var deleteid2 = $(this).closest("div").find('.dell2').val();
                    
                    // console.log(deleteid);
                    // console.log(deleteid1);

                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover Prescription!",
                        icon: "warning",
                        buttons: ["No, Cancel","Yes, Delete"],
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                            $.ajax({
                                type: "POST",
                                url: "delete_prescription.php",
                                data: {
                                    "delete_btn1_set": 1,
                                    "deleteid": deleteid,
                                    "deleteid1": deleteid1,
                                    // "deleteid2": deleteid2,
                                },
                                success: function (response) {
                                    swal("Prescription Deleted Successfully.!", {
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
    <!-- <script>
        $(document).ready(function(){
            $('#add_row').click(function(){
                var table = document.getElementById('myTable');
                console.log("hi");
                var ht = '';
                ht += '<tr>';
                ht += '<th scope="row"><select name="medicine_select[]" class="form-control medicine_select"><option value="">Select Medicine</option><?php while($row = mysqli_fetch_array($result)):; ?><option value="<?php echo $row["medicine"]; ?>"><?php echo $row["medicine"]; ?></option><?php endwhile; ?></select></td>';
                ht += '<th><input type="text" name="quantity[]" class="form-control quantity" /></td>';
                ht += '<th><input type="text" name="days[]" class="form-control days" /></td>';
                ht += '<th><input type="checkbox" name="dose[]" value="Morning"></td>';
                ht += '<th><input type="checkbox" name="dose[]" value="Afternoon"></td>';
                ht += '<th><input type="checkbox" name="dose[]" value="Evening"></td>';
                // ht += '<th><select name="when[]" class="form-control when"><option value="">When to have</option><option value="Before Meal">Before Meal</option><option value="After Meal">After Meal</option></select></td>';
                ht += '<th><button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="material-icons">close</i></button></td></tr>';
                table.innerHTML += ht;
            });

            $(document).on('click', '.remove', function(){
                $(this).closest('tr').remove();
            });

            $('##insert_prescription').on('submit', function(event){
                event.preventDefault();
                var form_data = $(this).serialize();

                $.ajax({
                    url:"submit_p_prescription.php",
                    method:"POST",
                    data:form_data,
                    success:function(data){
                        if(data == 'ok'){
                            $('#item_table').find("tr:gt(0)").remove();
                            $('error').html('<div class="alert alert-success">Item Details Saved</div>');
                        }
                    }
                });
            });
        });
    </script> -->
</body>
</html>
