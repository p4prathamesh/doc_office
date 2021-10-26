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
    <title>Lab Work</title>
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
                <a class="mdl-navigation__link" href="medications.php">Medications</a>
                <a class="mdl-navigation__link" href="labwork.php" style='color:#0767D1'>Lab Work</a>
                <a class="mdl-navigation__link" href="transactions.php">Transactions</a>
                <hr style="background-color:white"><label class="mdl-navigation__label">Others</label>
                <a class="mdl-navigation__link" href="profile.php">Profile</a>
            </nav>
    </div>
    <main class="mdl-layout__content">
        <div class="page-content">
            
            <div class="table-responsive" style="padding:20px">
                <table class="table table-bordered">
                    <tr class="thead-dark">
                        <th>Lab Name</th>
                        <th>Given Work</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    $con = mysqli_connect('localhost','root','');
                    mysqli_select_db($con, 'doc_project');
                    $commands = "select * from labwork";
                    $results = mysqli_query($con, $commands);
                    while($rowss = mysqli_fetch_array($results)):
                    ?>

                    <tr>
                        <th><?php echo $rowss["lab_name"]?></th>
                        <th><?php echo $rowss["given_work"]?></th>
                        <th><?php echo $rowss["status"]?></th>
                        <th>
                            <div>
                                <input type="hidden" class="editl" value="<?php echo $rowss["lab_name"]?>">
                                <input type="hidden" class="edit2" value="<?php echo $rowss["given_work"]?>">
                                <button type="button" class="edit_btn btn btn-outline-success">Edit</button>
                            </div>
                        </th>
                        <th>
                            <div>
                                <input type="hidden" class="dell" value="<?php echo $rowss["lab_name"]?>">
                                <input type="hidden" class="dell1" value="<?php echo $rowss["given_work"]?>">  
                                <input type="hidden" class="dell2" value="<?php echo $rowss["status"]?>"> 
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
            <h5 class="modal-title" id="exampleModalLongTitle">Add LabWork</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="add_labwork.php" method="POST" id="labwork_form">
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">LabName</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="new_labname"
                            id="new_labname">
                    <i class="fa fa-check-circle" id="correct"
                                style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                    <i class="fa fa-exclamation-circle" id="wrong"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="a_problem" style="color:e74c3c"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">GivenWork</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="new_givenwork"
                            id="new_givenwork">
                    <i class="fa fa-check-circle" id="correct1"
                                style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                    <i class="fa fa-exclamation-circle" id="wrong1"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="b_problem" style="color:e74c3c"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                    <select class="form-control" name="status" id="status">
                        <option selected>Select Status...</option>
                        <option value="Received">Received</option>
                        <option value="Pending">Pending</option>
                    </select>
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
            <button type="button" class="btn btn-primary" onclick="labwork_form_submit()">Add</button>
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
    function labwork_form_submit() {
        var new_labname = document.getElementById('new_labname').value;
        var new_givenwork = document.getElementById('new_givenwork').value;
        var status = document.getElementById('status').value;

        if ((new_labname != "") && (new_givenwork != "") && (status != "Select Status...")) {
            document.getElementById("labwork_form").submit();
        }
        else{
            if (new_labname == ""){
                document.getElementById("a_problem").innerHTML = "Please Enter labname!";
                document.getElementById("wrong").style.visibility = "visible";
                document.getElementById("new_labname").style.borderColor = "#e74c3c";
                document.getElementById("a_problem").style.visibility = "visible";
            }else {
                document.getElementById("correct").style.visibility = "visible";
                document.getElementById("new_labname").style.borderColor = "#2ecc71";
                document.getElementById("a_problem").style.visibility = "hidden";
                document.getElementById("wrong").style.visibility = "hidden";
            }

            if (new_givenwork == ""){
                document.getElementById("b_problem").innerHTML = "Please Enter Givenwrok!";
                document.getElementById("wrong1").style.visibility = "visible";
                document.getElementById("new_givenwork").style.borderColor = "#e74c3c";
                document.getElementById("b_problem").style.visibility = "visible";
            }else {
                document.getElementById("correct1").style.visibility = "visible";
                document.getElementById("new_givenwork").style.borderColor = "#2ecc71";
                document.getElementById("b_problem").style.visibility = "hidden";
                document.getElementById("wrong1").style.visibility = "hidden";
            }

            if (status == "Select Status..."){
                document.getElementById("c_problem").innerHTML = "Please Select Status!";
                document.getElementById("wrong2").style.visibility = "visible";
                document.getElementById("status").style.borderColor = "#e74c3c";
                document.getElementById("c_problem").style.visibility = "visible";
            } else {
                document.getElementById("correct2").style.visibility = "visible";
                document.getElementById("status").style.borderColor = "#2ecc71";
                document.getElementById("c_problem").style.visibility = "hidden";
                document.getElementById("wrong2").style.visibility = "hidden";
            }
        }
    }
    </script>

<script type="text/javascript">
    function form_submit1() {
        var edit_labname = document.getElementById('edit_labname').value;
        var edit_givenwork = document.getElementById('edit_givenwork').value;
        var edit_status = document.getElementById('edit_status').value;

        if ((edit_labname != "") && (edit_givenwork != "") && (edit_status != "Select Status...")) {
            document.getElementById("edit_labwork").submit();
        }
        else{
            if (edit_labname == ""){
                document.getElementById("a1_problem").innerHTML = "Please Enter Labname!";
                document.getElementById("wrong00").style.visibility = "visible";
                document.getElementById("edit_labname").style.borderColor = "#e74c3c";
                document.getElementById("a1_problem").style.visibility = "visible";
            }else {
                document.getElementById("correct00").style.visibility = "visible";
                document.getElementById("edit_labname").style.borderColor = "#2ecc71";
                document.getElementById("a1_problem").style.visibility = "hidden";
                document.getElementById("wrong00").style.visibility = "hidden";
            }

            if (edit_givenwork == ""){
                document.getElementById("b1_problem").innerHTML = "Please Enter Givenwork!";
                document.getElementById("wrong11").style.visibility = "visible";
                document.getElementById("edit_givenwork").style.borderColor = "#e74c3c";
                document.getElementById("b1_problem").style.visibility = "visible";
            }else {
                document.getElementById("correct11").style.visibility = "visible";
                document.getElementById("edit_givenwork").style.borderColor = "#2ecc71";
                document.getElementById("b1_problem").style.visibility = "hidden";
                document.getElementById("wrong11").style.visibility = "hidden";
            }

            if (edit_status == "Select Status..."){
                document.getElementById("c1_problem").innerHTML = "Please Select status!";
                document.getElementById("wrong21").style.visibility = "visible";
                document.getElementById("edit_status").style.borderColor = "#e74c3c";
                document.getElementById("c1_problem").style.visibility = "visible";
            } else {
                document.getElementById("correct21").style.visibility = "visible";
                document.getElementById("edit_status").style.borderColor = "#2ecc71";
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
            var edit_labname = $(this).closest("div").find('.editl').val();
            var edit_givenwork = $(this).closest("div").find('.edit2').val();
        
            $.ajax({
                url: "edit_labwork.php",
                method: "post",
                data: {
                    edit_labname: edit_labname,
                    edit_givenwork: edit_givenwork
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
                    var deleteid1 = $(this).closest("div").find('.dell1').val();
                    var deleteid2 = $(this).closest("div").find('.dell2').val();
                    // console.log(deleteid);
                    swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover Labwork!",
                        icon: "warning",
                        buttons: ["No, Cancel","Yes, Delete"],
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                            $.ajax({
                                type: "POST",
                                url: "delete_labwork.php",
                                data: {
                                    "delete_btn1_set": 1,
                                    "deleteid": deleteid,
                                    "deleteid1": deleteid1,
                                    "deleteid2": deleteid2,
                                },
                                success: function (response) {
                                    swal("Labwork Deleted Successfully.!", {
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
