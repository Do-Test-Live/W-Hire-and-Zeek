<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}
$userId = $_SESSION['userid'];

$fetch_user = $db_handle->runQuery("select * from customer where id = '$userId'");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Profile Page - Hire & Zeek</title>
    <link href="assets/images/favicon.ico" rel="icon" type="image/ico"/>
    <link href="assets/vendor/Bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/vendor/FontAwesome/css/all.min.css" rel="stylesheet"/>
    <link href="assets/vendor/toastr/css/toastr.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
</head>
<body>
<div class="container-fluid">
    <div class="fs-sms-verification pb-5">
        <div class="row pt-5">
            <div class="col-12">
                <div class="fs-dashboard-alert">
                    <div class="row text-white p-3">
                        <div class="col-3">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <div class="col-6 text-center">
                            <i class="fa-solid fa-circle-user fa-5x mx-auto"></i>
                            <h5>
                                <?php echo $fetch_user[0]['fname'];?> <?php echo $fetch_user[0]['mname'];?> <?php echo $fetch_user[0]['surname'];?>
                            </h5>
                            <p>
                                @<?php echo $fetch_user[0]['fname'];?> <?php echo $fetch_user[0]['mname'];?> <?php echo $fetch_user[0]['surname'];?>
                            </p>
                        </div>
                        <div class="col-3 text-end">
                            <p>
                                View Profile
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row login-interface">
            <div class="col-12 fs-primary-color pb-5">
                <div class="row">
                    <div class="col-1">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                    <div class="col-8">
                        <p>
                            Settings
                        </p>
                    </div>
                    <div class="col-3 text-end">
                        <i class="fa-solid fa-angle-right"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <i class="fa-solid fa-circle-dollar-to-slot"></i>
                    </div>
                    <div class="col-8">
                        <p>
                            Balance
                        </p>
                    </div>
                    <div class="col-3 text-end">
                        <p>
                            $0.00 HKD
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <i class="fa-regular fa-credit-card"></i>
                    </div>
                    <div class="col-8">
                        <p>
                            Add funds
                        </p>
                    </div>
                    <div class="col-3 text-end">
                        <i class="fa-solid fa-angle-right"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div class="col-8">
                        <p>
                            Withdraw funds
                        </p>
                    </div>
                    <div class="col-3 text-end">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <div class="col-8">
                        <p>
                            Transaction History
                        </p>
                    </div>
                    <div class="col-3 text-end">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-1">
                        <i class="fa-regular fa-circle-question"></i>
                    </div>
                    <div class="col-8">
                        <p>
                            Support
                        </p>
                    </div>
                    <div class="col-3 text-end">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <div class="col-8">
                        <p>
                            Language
                        </p>
                    </div>
                    <div class="col-3 text-end">
                        <select class="form-select fs-select-control" aria-label="Default select example">
                            <option selected>English</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <i class="fa-regular fa-file-lines"></i>
                    </div>
                    <div class="col-8">
                        <p>
                            Terms and conditions
                        </p>
                    </div>
                    <div class="col-3 text-end">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </div>
                </div>
                <div class="row pb-5">
                    <div class="col-1">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </div>
                    <div class="col-8">
                        <a href="logout.php" style="text-decoration: none; color: #01a862;">
                            <p>
                                Logout
                            </p>
                        </a>
                    </div>
                    <div class="col-3 text-end">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </div>
                    <div class="col-8 mt-5 mx-auto text-center">
                        <small>
                            Version: 4.9.32 (1680654530/2023-04-05)
                            App: 3f082a1 (1681907643 / 2023-04-19)
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row fixed-bottom text-center fs-nav-fixed-bottom">
            <div class="col-2">
                <i class="fa-solid fa-house"></i>
            </div>
            <div class="col-2">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
            <div class="col-4">
                <div class="fs-plus-circle d-flex justify-content-center align-items-center text-white">
                    <i class="fa-solid fa-plus fa-3x"></i>
                </div>
            </div>
            <div class="col-2">
                <i class="fa-solid fa-briefcase"></i>
            </div>
            <div class="col-2">
                <i class="fa-solid fa-user"></i>
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
