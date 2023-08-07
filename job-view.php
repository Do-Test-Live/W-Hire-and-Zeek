<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Hire & Zeek</title>
    <link href="assets/images/favicon.ico" rel="icon" type="image/ico"/>
    <link href="assets/vendor/Bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/vendor/FontAwesome/css/all.min.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
</head>
<body class="page-13">
<div class="container-fluid">
    <div class="row mb-3 head-banner p-2 flex align-items-center justify-content-center">
        <div class="col-2">
            <img class="img-fluid" src="assets/images/13/menu.webp" style="width: 29px;">
        </div>
        <div class="col-8 pe-3">
            <div class="form-group has-search">
                <span class="fa fa-search form-control-feedback"></span>
                <input class="form-control" placeholder="Search an Applicant" type="text">
            </div>
        </div>
        <div class="col-1">
            <img src="assets/images/13/info.webp" style="width: 20px">
        </div>
        <div class="col-1">
            <img src="assets/images/13/notification.webp" style="width: 20px">
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img class="img-fluid heading-banner" src="assets/images/12/5.webp">
            </div>
        </div>
        <div class="row text-center mt-3" style="margin: 0 25px;">
            <div class="col-3">
                <img class="icons" src="assets/images/12/3.webp">
            </div>
            <div class="col-3">
                <img class="icons" src="assets/images/12/4.webp">
            </div>
            <div class="col-3">
                <img class="icons" src="assets/images/12/2.webp">
            </div>
            <div class="col-3">
                <img class="icons" src="assets/images/12/1.webp">
            </div>
        </div>
        <div class="row text-center" style="margin: 0 25px;">
            <div class="col-3">
                <p class="icon-text">Full-Time</p>
            </div>
            <div class="col-3">
                <p class="icon-text">Part-Time</p>
            </div>
            <div class="col-3">
                <p class="icon-text">Freelance</p>
            </div>
            <div class="col-3">
                <p class="icon-text">Project Based</p>
            </div>
        </div>

        <?php
        $query="SELECT * FROM company as c,job_post as j where c.id=j.company_id order by j.id desc";
        $data = $db_handle->runQuery($query);
        $row_count = $db_handle->numRows($query);
        for ($i = 0; $i < $row_count; $i++) {
        ?>

        <div class="row ms-1 me-1">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-4" style="padding-left: 0 !important;">
                        <img alt="..." class="" src="<?php echo $data[$i]["image"]; ?>">
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data[$i]["job_title"]; ?></h5>
                            <p class="card-text"><small class="text-muted"><img alt="Flag of Country"
                                                                                src="assets/images/12/hk.webp"
                                                                                style="width: 15px;"> <?php echo $data[$i]["address"]; ?></small>
                            </p>
                            <p class="card-text"><span class="price">$<?php echo $data[$i]["salary"]; ?> HKD</span><small class="text-muted"> per
                                hour</small></p>
                            <p class="card-text"><small class="text-muted"><?php echo $data[$i]["keywords"]; ?></small></p>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button class="btn price-button" type="button">Detail</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php } ?>

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
                <a href="job-view.php" class="text-decoration-none text-dark">
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
