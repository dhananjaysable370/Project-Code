<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/admin_style.css" />
    <script src="./js/admin_login.js"></script>
    <title>Admin Sign in & Sign up Form</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="admin_login.php" class="sign-in-form" method="post" id="admin_login" name="admin_login">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="email" placeholder="Email" id="email" name="email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" id="pass" name="pass" required />
                    </div>
                    <a href="#" class="forgotPass">Forgot Password?</a>
                    <input type="submit" name="login" id="login" value="Login" class="btn solid" />
                </form>
                <form action="./admin_login.php" method="post" class="sign-up-form" style="margin-top: 35px;">
                    <h3 class="title">Sign up</h3>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" id="username" placeholder="Username" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="rgEmail" id="rgEmail" placeholder="Email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="rgPasswd" name="rgPasswd" placeholder="Password" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="rgconfirmPasswd" name="rgconfirmPasswd"
                            placeholder="Confirm Password" required />
                    </div>
                    <input type="submit" name="register" id="register" class="btn" value="Sign up" />
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel" style="margin-top: 30px;">
                <img src="./img/logo-white.png" class="signupimg content" alt="" id="logopngleft">
                <div class="content">
                    <h3>New to our community?</h3>
                    <p>
                        "Take the Leap, Join Our Network Today!
                        Connect, Collaborate, and Propel Your Career Forward.
                        Your Next Opportunity Awaits – Join Now!"
                    </p>
                    <button class="btn transparent unhidebtn" id="sign-up-btn">
                        Sign up
                    </button>
                </div>
                <img src="https://i.ibb.co/6HXL6q1/Privacy-policy-rafiki.png" class="image" alt="">
            </div>
            <div class="panel right-panel">
                <img src="./img/logo-white.png" class="signinimg content" alt="" id="logopngright">
                <div class="content">
                    <h3>One of Our Valued Members</h3>
                    <p>
                        Thank you for being part of our community. Your presence enriches our
                        shared experiences. Let's continue this journey together!
                    </p>
                    <button class="btn transparent hidebtn" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <img src="https://i.ibb.co/nP8H853/Mobile-login-rafiki.png" class="image" alt="">
            </div>
        </div>
    </div>

    <script src="./js/admin_script.js"></script>

</body>

</html>

<?php
include("../connection/db.php");

if (isset($_POST['register'])) {
    $rgUsername = $_POST['username'];
    $rgEmail = $_POST['rgEmail'];
    $rgPasswd = $_POST['rgPasswd'];
    $rgConfirmPasswd = $_POST['rgconfirmPasswd'];


    $sql = "INSERT INTO `admin_register` (`id`, `username`, `email`, `password`) VALUES (NULL, '$rgUsername', '$rgEmail', '$rgConfirmPasswd')";

    $sql2 = "INSERT INTO `admin_login`(`id`,`admin_email`,`admin_pass`,`admin_username`) VALUES(NULL,'$rgEmail','$rgPasswd','$rgUsername')";

    if ($rgConfirmPasswd === $rgPasswd) {
        if (($con->query($sql) === TRUE) && ($con->query($sql2) === TRUE)) {
            $_SESSION['username'] = $rgUsername;
            echo "<script>alert('Registered successfully...');</script>";
        } else {
            echo "<script>alert('Registration unsuccessful!');</script>";
        }
    } else {
        echo
        "<script>alert('Registration unsuccessful!');</script>";
    }
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $query = mysqli_query($con, "select * from admin_login where 
    admin_email = '$email' and admin_pass='$pass'");
    $query2 = mysqli_query($con, "select * from admin_register where email='$email' and password='$pass';");
    if ($query) {
        if ((mysqli_num_rows($query) > 0) && (mysqli_num_rows($query2) > 0)) {
            $_SESSION['email'] = $email;
            echo "<script>window.location.href='./admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Email or password invalid! Please try again.')</script>";
        }
    }
}
?>