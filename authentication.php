<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style1.css" />
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Lato|Quicksand'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css'>
    <title>Log in & Sign up</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="validation.php" class="sign-in-form" method="POST">
                    <h2 class="title">Log in</h2>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" id="email" name="login_email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" id="password" name="login_pass" required />
                        <div id="toggle" onclick="showHide();"></div>
                        <script type="text/javascript">
                        const password = document.getElementById('password');
                        const toggle = document.getElementById('toggle');

                        function showHide() {
                            if (password.type == 'password') {
                                password.setAttribute('type', 'text');
                                toggle.classList.add('hide')
                            } else {
                                password.setAttribute('type', 'password');
                                toggle.classList.remove('hide')
                            }
                        }
                        </script>
                    </div>
                    <input type="submit" value="Login" class="btn solid" />
                </form>
                <form action="registration.php" class="sign-up-form" method="POST">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" placeholder="Name" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" placeholder="Email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="pass" id="pass" placeholder="Password" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="c_pass" id="c_pass" placeholder="Confirm Password" required />
                        <!-- <div id="show" onclick="show();"></div>
                        <script type="text/javascript">
                        const pass = document.getElementById('pass');
                        const c_pass = document.getElementById('c_pass');
                        const show = document.getElementById('show');

                        function show() {
                            if (c_pass.type == 'password') {
                                c_pass.setAttribute('type', 'text');
                                show.classList.add('hide')
                            } else {
                                c_pass.setAttribute('type', 'password');
                                show.classList.remove('hide')
                            }
                        }
                        </script> -->
                    </div>
                    <div class="sel sel--black-panther">
                        <select name="select-profession" id="select-profession" required>
                            <option value="" disabled>Who are you?</option>
                            <option value="Doctor">Doctor</option>
                            <option value="Receptionist">Receptionist</option>
                        </select>
                    </div>
                    <input type="submit" class="btn" value="Sign up" />
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>New here ?</h3>
                    <p>
                        
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="img/log1.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>

                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Log in
                    </button>
                </div>
                <img src="img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>
    <script src="assets/js/app.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
    <script src="assets/js/index.js"></script>
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
    <?php
    if (isset($_SESSION['status1']) && $_SESSION['status1'] != '')
    {
      ?>
        <script>
          swal({
              title: "<?php echo $_SESSION['status1']; ?>",
              // text: "You clicked the button!",
              icon: "<?php echo $_SESSION['status_code1']; ?>",
              button: "<?php echo $_SESSION['button1']; ?>",
          });
        </script>
      <?php
      unset($_SESSION['status1']);
    }
    ?>
</body>

</html>