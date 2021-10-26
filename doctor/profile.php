<?php
session_start();
$con = mysqli_connect('localhost','root','','doc_project');
$email = $_SESSION['eemail'];
$query = "select * from authentication where email = '$email';";

$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$pass = $row['pass'];

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>

    <link rel="stylesheet" href="navigation.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    .demo-card-wide.mdl-card {
        margin-top: 40px;
        width: 350px;

    }

    .demo-card-wide>.mdl-card__title {
        color: #fff;
        height: 176px;
    }

    .demo-card-wide>.mdl-card__menu {
        color: #fff;
    }


    .inputclass {

        color: #080808;


    }

    .custom-file-upload {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 6px 12px;
        cursor: pointer;
        float: right;
        background-color: #ff3e96;
        color: #ffffff;
        margin-right: 50px;
        margin-top: 80px;
        border-radius: 4px;

    }

    #main {

        margin: 0 auto;
    }

    #sidebar,
    #page-wrap {

        float: left;

        color: white;
    }

    #sidebar {
        width: 350px;
        margin-bottom: 40px
    }

    #page-wrap {
        width: 350px;


    }
    </style>

</head>

<body>
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
                <hr style="background-color:white"><a class="mdl-navigation__link" href="patient.php">Patients</a>
                <hr style="background-color:white"><label class="mdl-navigation__label">Others</label>
                <a class="mdl-navigation__link" style='color:#0767D1' href="profile.php">Profile</a>
            </nav>
        </div>

        <main class="mdl-layout__content">
            <div class="page-content" id="main">
                <div class="demo-card-wide mdl-card mdl-shadow--2dp" id="sidebar" style="margin-left: 50px;">

                    <div class="mdl-card__supporting-text" id="task_title">

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                            <input class="mdl-textfield__input inputclass" type="text" id="usertype"
                                value="<?php echo $_SESSION['type'];?>" readonly>
                            <label class="mdl-textfield__label" for="usertype"><b>Type</b></label>


                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                            <input class="mdl-textfield__input inputclass" type="text"
                                value="<?php echo $_SESSION['eemail'];?>" id="useremail" readonly>
                            <label class="mdl-textfield__label" for="useremail"><b>Email</b></label>


                        </div>

                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">

                            <h5>Profile Picture</h5>
                            <img id="myimg"
                                style="width: 150px; height: 150px; float: left; background-position: center center; background-repeat: no-repeat;">
                            <div class="mdl-spinner mdl-js-spinner is-active" id="loading"
                                style="display: none; margin-left: 175px;"></div><br>

                            <input type="file" name="Update" value="Update" id="filebutton" onclick="upload()"
                                style="height: 30px; display: none ;background-color: #FF0097;">
                            <label for="filebutton" class="custom-file-upload">
                                Update
                            </label>

                        </div>


                    </div>

                </div>

                <div class="demo-card-wide mdl-card mdl-shadow--2dp" id="page-wrap" style="margin-left: 50px;">

                    <div class="mdl-card__supporting-text" id="task_title">
                        <h5 style="color: black">Change Password</h5>
                        <form action="change_pass.php" method="post" id="form">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="oldpass" style="color: black"
                                    required>
                                <label class="mdl-textfield__label" for="sample3">Old Password</label>
                            </div>
                            <p id="wrongpass" style="color:#FF0097; visibility: hidden"></p>


                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="newpass" name="newpass" style="color: black"
                                    required>
                                <label class="mdl-textfield__label" for="sample3">New Password</label>
                            </div>


                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="confirmpass"
                                    style="color: black" required>
                                <label class="mdl-textfield__label" for="sample3">Confirm Password</label>
                            </div>
                            <p id="success" style="color:#FF0097; visibility: hidden"></p>
                        </form>


                        <button
                            class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"
                            onclick="changepass()" style="float: right; margin-top: 20px; margin-bottom: 10px"
                            id="changepass">
                            Change Password
                        </button>

                    </div>

                </div>

            </div>
        </main>

    </div>
    <script type="text/javascript">
    function changepass() {
        var newpass = document.getElementById("newpass").value;
        var confirmpass = document.getElementById("confirmpass").value;
        var oldpass = document.getElementById("oldpass").value;
        var pass = '<?php echo base64_decode($pass) ?>';

        if ((newpass != "") && (confirmpass != "") && (oldpass != "") && (newpass == confirmpass) && (oldpass ==
            pass) && (oldpass != newpass)) {
            document.getElementById("form").submit();
        } else {
            if ((newpass == "") || (confirmpass == "")) {
                document.getElementById("success").innerHTML = "Please Fill Details!";
                document.getElementById("success").style.visibility = "visible";
            } else {
                if (newpass != confirmpass) {
                    document.getElementById("success").innerHTML = "Password Did Not Match!";
                    document.getElementById("success").style.visibility = "visible";
                } else {
                    document.getElementById("success").style.visibility = "hidden";
                }
                if (oldpass == newpass) {
                    document.getElementById("success").innerHTML = "New Password cannot be same as previous!";
                    document.getElementById("success").style.visibility = "visible";
                } else {
                    document.getElementById("success").style.visibility = "hidden";
                }
            }
            if (oldpass == "") {
                document.getElementById("wrongpass").innerHTML = "Enter Old Password!";
                document.getElementById("wrongpass").style.visibility = "visible";
            } else {
                if (oldpass != pass) {
                    document.getElementById("wrongpass").innerHTML = "Wrong Password!";
                    document.getElementById("wrongpass").style.visibility = "visible";
                } else {
                    document.getElementById("wrongpass").style.visibility = "hidden";
                }
            }

        }

    }
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