<?php
session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medications</title>
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
    <!-- Simple header with scrollable tabs. -->
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-drawer">
        <header class="mdl-layout__header" style="background-color:#4481eb;">
            <div class="mdl-layout__header-row">
                <!-- Title -->

                <span class="mdl-layout-title"><?php echo $_SESSION['useremail']; ?></span>

                <button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon"
                    style="position: fixed; top: 20px; right: 20px;">
                    <img src="../img/user.svg" style='height:100%; filter: invert(1);'>
                </button>

                <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                    for="demo-menu-lower-right">
                    <li class="mdl-menu__item" style="color:blue"><a href="../logout.php">LOGOUT</a></li>
                </ul>

            </div>


        </header>


        <div class="mdl-layout__drawer" style="overflow: auto;">
            <span class="mdl-layout-title" style="margin-top:30px">
                <h2>Main Menu</h2>
            </span>
            <nav class="mdl-navigation">
                <hr style="background-color:white">
                <a class="mdl-navigation__link" href="patient.php">Patients</a>
                <a class="mdl-navigation__link" href="medications.php" style='color:#0767D1'>Medications</a>
                <a class="mdl-navigation__link" href="labwork.php">Lab Work</a>
                <a class="mdl-navigation__link" href="transactions.php">Transactions</a>
                <hr style="background-color:white"><label class="mdl-navigation__label">Others</label>
                <a class="mdl-navigation__link" href="profile.php">Profile</a>
            </nav>
        </div>

        <main class="mdl-layout__content">
            <div class="page-content">

                <form action="" method="POST" style="padding:20px;">
                    <?php
                    // $con = mysqli_connect('localhost','root','','doc_project');
                    $command = "select * from medications";
                    $results = mysqli_query($con, $command);
                    while($rows = mysqli_fetch_array($results)):                                  
                    ?> 
                    <div class="input-group">    
                        <input type="text" class="form-control" aria-label="Text input with radio button" value="<?php echo $rows["medicine"]?>" style="pointer-events: none;">
                        <div class="input-group-append">
                            <input type="hidden" class="dell" value="<?php echo $rows["medicine"]?>"> 
                            <button class="delete_btn1_ajax btn btn-outline-danger" type="button" style="width:70px">Delete</button>
                        </div>
                    </div>
                    <?php
                    endwhile;
                    ?>
                    
                </form>

                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
                    data-toggle="modal" data-target="#exampleModalCenter" style="background-color:#4481eb"
                        id="fixedbutton">
                    <i class="material-icons">add</i>
                </button>
            </div>

        </main>

    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Medicine</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="add_medication.php" method="POST" id="medicine_form">
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">Medicine</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="new_medicine"
                            id="new_medicine" style="color:blue;">
                    <i class="fa fa-exclamation-circle" id="wrong"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="a_problem" style="color:e74c3c"></small>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="medicine_form_submit()">Add</button>
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
        function medicine_form_submit() {
            var new_alert = document.getElementById('new_medicine').value;
            if (new_alert != "") {
                document.getElementById("medicine_form").submit();
            }
            else{
                document.getElementById("a_problem").innerHTML = "Please Enter Alert!";
                document.getElementById("wrong").style.visibility = "visible";
                document.getElementById("new_medicine").style.borderColor = "#e74c3c";
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
                                    url: "delete_medications.php",
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