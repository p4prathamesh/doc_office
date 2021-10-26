<?php
session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'doc_project');

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
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
                <a class="mdl-navigation__link" href="medications.php">Medications</a>
                <a class="mdl-navigation__link" href="labwork.php">Lab Work</a>
                <a class="mdl-navigation__link" href="transactions.php" style='color:#0767D1'>Transactions</a>
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
                            <th>Expense</th>
                            <th>Income</th>
                            <th>Balance</th>
                            <!-- <th>Total</th> -->
                        </tr>
                        <?php
                        $con = mysqli_connect('localhost','root','');
                        mysqli_select_db($con, 'doc_project');
                        // $total=0;
                        $commands = "select * from transactions ";
                        $results = mysqli_query($con, $commands);
                        while($rowss = mysqli_fetch_array($results)):
                            // $total=$total+$rowss["cost"];
                        ?>

                        <tr>
                            <th><?php echo $rowss["expense"]?></th>
                            <th><?php echo $rowss["income"]?></th>
                            <th>
                            <?php echo $rowss["balance"]?>
                            </th>
                            <!-- <th></th> -->
                        </tr>
                        <?php
                        endwhile;
                        ?>
                        
                    </table>
                </div> 

                <center>
                <h3>Income</h3>
                </center>
                    
                <div class="table-responsive" style="padding:20px">
                    <table class="table table-bordered">
                        <tr class="thead-light">
                            <!-- <th>Sr. No.</th> -->
                            <th>Sr. No</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        $con = mysqli_connect('localhost','root','');
                        mysqli_select_db($con, 'doc_project');
                        $total=0;
                        $commands = "select * from category where type='income' ";
                        $results = mysqli_query($con, $commands);
                        while($rows = mysqli_fetch_array($results)):
                            $total=$total+1;
                        ?>

                        <tr>
                            <th><?php echo $total?></th>
                            <th><?php echo $rows["category_name"]?></th>
                            <th>
                            <?php echo $rows["amount"]?>
                            </th>
                            <th>
                                <div>
                                    <input type="hidden" class="dell" value="<?php echo $rows["category_name"]?>">
                                    <input type="hidden" class="dell1" value="<?php echo $rows["amount"]?>">  
                                    <input type="hidden" class="dell2" value="<?php echo $rows["type"]?>"> 
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
                <h3>Expense</h3>
                </center>

                <div class="table-responsive" style="padding:20px">
                    <table class="table table-bordered">
                        <tr class="thead-light">
                            <!-- <th>Sr. No.</th> -->
                            <th>Sr. No</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        $con = mysqli_connect('localhost','root','');
                        mysqli_select_db($con, 'doc_project');
                        $total1=0;
                        $commands = "select * from category where type='expense' ";
                        $results = mysqli_query($con, $commands);
                        while($rowss = mysqli_fetch_array($results)):
                            $total1=$total1+1;
                        ?>

                        <tr>
                            <th><?php echo $total1?></th>
                            <th><?php echo $rowss["category_name"]?></th>
                            <th>
                            <?php echo $rowss["amount"]?>
                            </th>
                            <th>
                                <div>
                                    <input type="hidden" class="ddell" value="<?php echo $rowss["category_name"]?>">
                                    <input type="hidden" class="ddell1" value="<?php echo $rowss["amount"]?>">  
                                    <input type="hidden" class="ddell2" value="<?php echo $rowss["type"]?>"> 
                                    <button class="delete_btn_ajax btn btn-outline-danger" type="button">Delete</button>
                                </div>
                            </th>
                        </tr>
                        <?php
                        endwhile;
                        ?>
                        
                    </table>
                </div>
                
                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
                    data-toggle="modal" data-target="#exampleModalCenter1" style="background-color:red;position:fixed;bottom:20px;right:80px;"
                        id="fixedbutton1">
                    <i class="material-icons">add</i>
                </button>
                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
                    data-toggle="modal" data-target="#exampleModalCenter2" style="background-color:#00d451;position:fixed;bottom:20px;right:140px;"
                        id="fixedbutton2">
                    <i class="material-icons">add</i>
                </button>
                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored"
                    data-toggle="modal" data-target="#exampleModalCenter" style="background-color:#4481eb"
                        id="fixedbutton">
                    <i class="material-icons">add</i>
                </button>
            </div>

        </main>

    </div>

    <!-- modal-category_loss -->
    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle1">Add Category for Expense</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="add_category.php" method="POST" id="category_form_expense">
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">Expense Category Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="new_category"
                            id="new_category" style="color:blue;">
                        <input type="hidden" name="category_type" id="category_type" value="expense">
                    <i class="fa fa-exclamation-circle" id="wrong"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="a_problem" style="color:e74c3c"></small>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="expense_form_submit()">Add</button>
        </div>
        </div>
    </div>
    </div>

    <!-- modal-category_profit -->
    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle2">Add Category for Income</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="add_category.php" method="POST" id="category_form_income">
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">Income Category Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control"  name="new_category"
                            id="new_category1" style="color:blue;">
                        <input type="hidden" name="category_type" id="category_type" value="income">
                    <i class="fa fa-exclamation-circle" id="wrong1"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="b_problem" style="color:e74c3c"></small>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="income_form_submit()">Add</button>
        </div>
        </div>
    </div>
    </div>

    <!-- modal-trasactions -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Transactions</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="add_transactions.php" method="POST" id="transactions_form">
                <div class="form-group row">
                    <label for="opd" class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control"  name="new_amount"
                            id="new_amount" style="color:blue;">
                    <i class="fa fa-check-circle" id="correct2"
                        style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                    <i class="fa fa-exclamation-circle" id="wrong2"
                        style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                    <small id="c_problem" style="color:e74c3c"></small>
                    </div>
                </div>
                <?php
                $query="select * from category";
                $result = mysqli_query($con, $query);
                // $num = mysqli_num_rows($result);
                ?>
                <select name="category" id="category" class="form-control medicine_select">
                        <option value="">Select Category...</option>
                    <?php while($row = mysqli_fetch_array($result)):; ?>
                        <option value="<?php echo $row["category_name"]; ?>">
                        <?php echo $row["category_name"]; ?> -- <?php echo  $row["type"]; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <i class="fa fa-check-circle" id="correct3"
                        style="position:absolute; right:20px; color:#2ecc71; visibility:hidden;"></i>
                <i class="fa fa-exclamation-circle" id="wrong3"
                    style="position:absolute; right:20px; color:#e74c3c; visibility:hidden;"></i>
                <small id="d_problem" style="color:#e74c3c"></small>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="transactions_form_submit()">Submit</button>
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
        function expense_form_submit() {
            var new_category = document.getElementById('new_category').value;
            var category_type = document.getElementById('category_type').value;
            if (new_category != "") {
                document.getElementById("category_form_expense").submit();
            }
            else{
                document.getElementById("a_problem").innerHTML = "Please Enter Category!";
                document.getElementById("wrong").style.visibility = "visible";
                document.getElementById("new_category").style.borderColor = "#e74c3c";
                document.getElementById("a_problem").style.visibility = "visible";
            }
        }

        function income_form_submit() {
            var new_category1 = document.getElementById('new_category1').value;
            var category_type = document.getElementById('category_type').value;
            if (new_category1 != "") {
                document.getElementById("category_form_income").submit();
            }
            else{
                document.getElementById("b_problem").innerHTML = "Please Enter Category!";
                document.getElementById("wrong1").style.visibility = "visible";
                document.getElementById("new_category1").style.borderColor = "#e74c3c";
                document.getElementById("b_problem").style.visibility = "visible";
            }
        }

        function transactions_form_submit() {
            var category = document.getElementById('category').value;
            var new_amount = document.getElementById('new_amount').value;
            if (new_amount != "" && category!="") {
                document.getElementById("transactions_form").submit();
            }
            else{
                if(new_amount == ""){
                    document.getElementById("c_problem").innerHTML = "Please Enter Amount!";
                    document.getElementById("wrong2").style.visibility = "visible";
                    document.getElementById("new_amount").style.borderColor = "#e74c3c";
                    document.getElementById("c_problem").style.visibility = "visible";
                }else{
                    document.getElementById("correct2").style.visibility = "visible";
                    document.getElementById("new_amount").style.borderColor = "#2ecc71";
                    document.getElementById("c_problem").style.visibility = "hidden";
                    document.getElementById("wrong2").style.visibility = "hidden";
                }
                if(category==""){
                    document.getElementById("d_problem").innerHTML = "Please Select Category!";
                    document.getElementById("wrong3").style.visibility = "visible";
                    document.getElementById("category").style.borderColor = "#e74c3c";
                    document.getElementById("d_problem").style.visibility = "visible";
                }else{
                    document.getElementById("correct3").style.visibility = "visible";
                    document.getElementById("category").style.borderColor = "#2ecc71";
                    document.getElementById("d_problem").style.visibility = "hidden";
                    document.getElementById("wrong3").style.visibility = "hidden";
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
                        var deleteid2 = $(this).closest("div").find('.dell2').val();
                        
                        swal({
                            title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover Category!",
                            icon: "warning",
                            buttons: ["No, Cancel","Yes, Delete"],
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                        if (willDelete) {
                                $.ajax({
                                    type: "POST",
                                    url: "delete_category.php",
                                    data: {
                                        "delete_btn1_set": 1,
                                        "deleteid": deleteid,
                                        "deleteid1": deleteid1,
                                        "deleteid2": deleteid2,
                                    },
                                    success: function (response) {
                                        swal("Category Deleted Successfully.!", {
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

                $('.delete_btn_ajax').click(function (e) {
                    e.preventDefault();
                        var deleteid = $(this).closest("div").find('.ddell').val();
                        var deleteid1 = $(this).closest("div").find('.ddell1').val();
                        var deleteid2 = $(this).closest("div").find('.ddell2').val();
                        
                        swal({
                            title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover Category!",
                            icon: "warning",
                            buttons: ["No, Cancel","Yes, Delete"],
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                        if (willDelete) {
                                $.ajax({
                                    type: "POST",
                                    url: "delete_category.php",
                                    data: {
                                        "delete_btn_set": 1,
                                        "deleteid": deleteid,
                                        "deleteid1": deleteid1,
                                        "deleteid2": deleteid2,
                                    },
                                    success: function (response) {
                                        swal("Category Deleted Successfully.!", {
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