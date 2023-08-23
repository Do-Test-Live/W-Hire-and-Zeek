<?php
session_start();
require_once ('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
if(isset($_POST['login'])){
    $email = strtolower($db_handle->checkValue($_POST['email']));
    $password = $db_handle->checkValue($_POST['password']);
    $log_in = $db_handle->runQuery("select * from customer where email = '$email' and password = '$password'");
    $log_in_no = $db_handle->numRows("select * from customer where email = '$email' and password = '$password'");
    if($log_in_no == 1){

        $_SESSION['userid'] = $log_in[0]["id"];

        if($log_in[0]["role"]=='Applicant'){
            echo "<script>
                document.cookie = 'alert = 1;';
                window.location.href='jobs.php';
                </script>";
        }else{
            echo "<script>
                document.cookie = 'alert = 1;';
                window.location.href='job-post.php';
                </script>";
        }
    } else{
        echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='login.php';
                </script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Login Page - Hire & Zeek</title>
    <link href="assets/images/favicon.ico" rel="icon" type="image/ico"/>
    <link href="assets/vendor/Bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/vendor/FontAwesome/css/all.min.css" rel="stylesheet"/>
    <link href="assets/vendor/toastr/css/toastr.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
</head>
<body>
<div class="container-fluid">
    <div class="login-main">
        <div class="row pt-5 login-interface">
            <div class="col-12">
                <div class="text-center">
                    <img alt="" class="img-fluid" src="assets/images/logo.webp"/>
                </div>
                <div class="mt-5">
                    <h3 class="fs-lan-title mt-3">
                        Welcome back,
                    </h3>
                    <p class="fs-lan-caption mt-3 mb-4">
                        We happy to see you here again, Enter you email address and password
                    </p>
                </div>
            </div>
            <div class="col-12">
                <form method="post" action="">
                    <div class="mb-3">
                        <input class="form-control fs-form-control" placeholder="Email or Username" type="email" name="email">
                    </div>
                    <div class="mb-4">
                        <input class="form-control fs-form-control" placeholder="Password" type="password" name="password">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="login" class="btn btn-primary fs-lan-primary-btn w-100">Log In</button>
                    </div>
                </form>
                <div class="mb-3 text-center">
                    <a href="#" class="text-decoration-none text-dark">Forgot password?</a>
                </div>
                <div class="mb-3 mt-4">
                    <p class="fs-login-horizonal-line"><span>OR</span></p>
                </div>
                <div class="mb-3 mt-4">
                    <a href="signup.php" class="btn btn-primary fs-secondary-btn w-100">Create an Account</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="assets/vendor/Bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jQuery/jquery-3.6.4.min.js"></script>
<script src="assets/vendor/OwlCarousel/js/owl.carousel.min.js"></script>
<script src="assets/vendor/toastr/js/toastr.min.js" type="text/javascript"></script>
<script src="assets/js/toastr-init.js" type="text/javascript"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
