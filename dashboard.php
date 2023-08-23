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
    <title>Dashboard Page - Hire & Zeek</title>
    <link href="assets/images/favicon.ico" rel="icon" type="image/ico"/>
    <link href="assets/vendor/Bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/vendor/FontAwesome/css/all.min.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
</head>
<body>
<div class="container-fluid">
    <div class="fs-sms-verification">
        <div class="row">
            <div class="col-12" style="display: none">
                <div class="alert alert-warning alert-dismissible fade show fs-dashboard-alert" role="alert">
                    <div class="row">
                        <div class="col-1">
                            <i class="fa-solid fa-phone text-white fa-2x"></i>
                        </div>
                        <div class="col-11 text-white">
                            <strong>Phone verification required</strong><br/>
                            To activate your account, please click verify and go to verification page and verify your
                            phone number.
                            <button aria-label="Close" class="btn-close text-white" data-bs-dismiss="alert"
                                    type="button"></button>

                            <div class="text-end mb-2">
                                <a class="btn fs-btn-resend mt-2" href="#">
                                    Verify
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row login-interface">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <p class="fs-dashboard-total">
                            Total balance: <i class="fa-regular fa-eye"></i>
                        </p>
                        <h2 class="fs-dashboard-title">
                            <span>20,283.00</span> HKD
                        </h2>
                        <p class="mt-5 fs-dashboard-custom text-center">
                            This month you have earned
                        </p>
                    </div>
                    <div class="col-12">
                        <div class="fs-dashboard-money mx-auto">
                            <p>
                                <strong>Cashback</strong><br/>
                                37.45 HKD
                            </p>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-11 mx-auto">
                                <div class="row">
                                    <div class="col-3 mx-auto">
                                        <img alt="" class="img-fluid p-2" src="assets/images/11/2.webp"/>
                                        <p class="fs-dashboard-earn-btn-text">
                                            Set Limit
                                        </p>
                                    </div>
                                    <div class="col-3 mx-auto">
                                        <img alt="" class="img-fluid p-2" src="assets/images/11/3.webp"/>
                                        <p class="fs-dashboard-earn-btn-text">
                                            Add Money
                                        </p>
                                    </div>
                                    <div class="col-3 mx-auto">
                                        <img alt="" class="img-fluid p-2" src="assets/images/11/4.webp"/>
                                        <p class="fs-dashboard-earn-btn-text">
                                            Withdraw
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="fs-dashboard-silver p-5">
                    <h2 class="text-white">
                        SILVER
                    </h2>
                    <input type="range"/>
                    <p class="text-white">
                        get 7,378 more points to unlock Gold Tier Membership
                    </p>
                </div>
                <div class="fs-dashboard-dark p-2">
                    <div class="row">
                        <div class="col-9">
                            <p class="text-white" style="margin-bottom: unset">
                                View Tier Benefits
                            </p>
                        </div>
                        <div class="col-3 text-end">
                            <i class="fa-solid fa-chevron-right text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card fs-transaction-card pb-5 mb-5 mt-5">
                    <div class="row ps-2 pe-2">
                        <div class="col-8">
                            <p>
                                Transactions
                            </p>
                        </div>
                        <div class="col-4 text-end">
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <div class="fs-letter d-flex justify-content-center align-items-center">
                                <h3 class="text-white">
                                    J
                                </h3>
                            </div>
                        </div>
                        <div class="col-6">
                            <h5>
                                Jack***
                            </h5>
                            <p>
                                6 JUNE, 2023 18:00
                            </p>
                        </div>
                        <div class="col-4 text-end">
                            <p>
                                10,437 HKD
                            </p>
                        </div>
                        <div class="col-12">
                            <hr/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row fixed-bottom text-center fs-nav-fixed-bottom">
            <div class="col-2">
                <a href="dashboard.php" class="text-decoration-none text-dark">
                    <i class="fa-solid fa-house fs-primary-color"></i>
                </a>
            </div>
            <div class="col-2">
                <a href="search.php" class="text-decoration-none text-dark">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </div>
            <div class="col-4">
                <a href="job-post.php" class="text-decoration-none text-dark">
                    <div class="fs-plus-circle d-flex justify-content-center align-items-center text-white">
                        <i class="fa-solid fa-plus fa-3x"></i>
                    </div>
                </a>
            </div>
            <div class="col-2">
                <a href="jobs.php" class="text-decoration-none text-dark">
                    <i class="fa-solid fa-briefcase"></i>
                </a>
            </div>
            <div class="col-2">
                <a href="profile.php" class="text-decoration-none text-dark">
                    <i class="fa-solid fa-user"></i>
                </a>
            </div>
        </div>
    </div>
</div>


<script src="assets/vendor/Bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jQuery/jquery-3.6.4.min.js"></script>
<script src="assets/vendor/OwlCarousel/js/owl.carousel.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
