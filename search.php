<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}
$userId = $_SESSION['userid'];

if (isset($_POST['apply'])) {
    $job_id = $_POST['job_id'];
    $inserted_at = date('Y-m-d h:i:s');


    $query = "INSERT INTO `job_apply`(`job_id`, `customer_id`, `inserted_at`) VALUES ('$job_id','$userId','$inserted_at')";
    $data = $db_handle->insertQuery($query);


    echo "<script>
                alert('Job Applied');
                window.location.href='search.php';
                </script>";

}

if (isset($_POST['favourite'])) {
    $job_id = $_POST['job_id'];
    $inserted_at = date('Y-m-d h:i:s');

    $query = "INSERT INTO `favorite`( `customer_id`, `job_id`, `inserted_at`) VALUES ('$userId','$job_id','$inserted_at')";
    $data = $db_handle->insertQuery($query);
    echo "<script>
                alert('Favourite Changed');
                window.location.href='search.php';
                </script>";

}

$query = "SELECT * FROM `customer` where id='$userId'";
$data = $db_handle->runQuery($query);

$keywords = $data[0]['keywords'];
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
    <style>
        .checked {
            color: #059d00;
        }

        .modal-header {
            position: relative;
            background: #1e3932;
        }

        .card-checkbox,
        .card-heart {
            position: absolute;
            top: 10px;
            padding: 5px;
            font-size: 16px;
        }

        .card-checkbox {
            left: 15px;
            top: 19px;
        }

        .card-heart {
            right: 10px;
            color: #f5f5f5;
            background: none;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="fs-search">
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
                    <a href="search.php?job_type=Full-Time">
                        <img class="icons" alt="" src="assets/images/12/3.webp"/>
                    </a>
                </div>
                <div class="col-3">
                    <a href="search.php?job_type=Part-Time">
                        <img class="icons" alt="" src="assets/images/12/4.webp"/>
                    </a>
                </div>
                <div class="col-3">
                    <a href="search.php?job_type=Freelance">
                        <img class="icons" alt="" src="assets/images/12/2.webp"/>
                    </a>
                </div>
                <div class="col-3">
                    <a href="search.php?job_type=Project-Based">
                        <img class="icons" alt="" src="assets/images/12/1.webp"/>
                    </a>
                </div>
            </div>
            <div class="row text-center" style="margin: 0 25px;">
                <div class="col-3">
                    <a class="text-decoration-none" href="search.php?job_type=Full-Time">
                        <p class="icon-text text-dark">Full-Time</p>
                    </a>
                </div>
                <div class="col-3">
                    <a class="text-decoration-none" href="search.php?job_type=Part-Time">
                        <p class="icon-text text-dark">Part-Time</p>
                    </a>
                </div>
                <div class="col-3">
                    <a class="text-decoration-none" href="search.php?job_type=Freelance">
                        <p class="icon-text text-dark">Freelance</p>
                    </a>
                </div>
                <div class="col-3">
                    <a class="text-decoration-none" href="search.php?job_type=Project-Based">
                        <p class="icon-text text-dark">Project Based</p>
                    </a>
                </div>
            </div>

            <?php
            $query_add_on = '';
            if (isset($_GET['job_type'])) {
                $query_add_on = " and j.job_type='{$_GET['job_type']}'";
            }

            $query = "SELECT * FROM company as c,job_post as j where c.id=j.company_id" . $query_add_on . " order by j.id desc";
            $data = $db_handle->runQuery($query);
            $row_count = $db_handle->numRows($query);
            for ($i = 0; $i < $row_count; $i++) {

                $apply_job = $db_handle->numRows("select * from job_apply where job_id={$data[$i]['id']}");

                if ($apply_job == 0) {
                    ?>

                    <div class="row ms-1 me-1">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-4 p-2 d-flex justify-content-center align-items-center"
                                     style="background: #383b40;">
                                    <div>
                                        <img alt="..." class="img-fluid" src="<?php echo $data[$i]["image"]; ?>"
                                             style="border: 3px solid white;border-radius: 15px;">
                                        <p class="text-white text-center mt-2"
                                           style="font-family: 'DMSans-Bold', serif;"><?php echo $data[$i]["name"]; ?></p>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $data[$i]["job_title"]; ?></h5>
                                        <p class="card-text"><small class="text-muted"><img alt="Flag of Country"
                                                                                            src="assets/images/12/hk.webp"
                                                                                            style="width: 15px;"> <?php echo $data[$i]["address"]; ?>
                                            </small>
                                        </p>
                                        <p class="card-text"><span
                                                    class="price">$<?php echo $data[$i]["salary"]; ?> HKD</span><small
                                                    class="text-muted"> per
                                                <?php echo strtolower($data[$i]["salary"]); ?></small></p>
                                        <p class="card-text"><small
                                                    class="text-muted"><?php echo $data[$i]["keywords"]; ?></small></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <button class="btn price-button" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop<?php echo $data[$i]["id"]; ?>">
                                                Detail
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="staticBackdrop<?php echo $data[$i]["id"]; ?>" data-bs-backdrop="static"
                         data-bs-keyboard="false" tabindex="-1"
                         aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header justify-content-center align-items-center">
                                    <a class="text-decoration-none text-white card-checkbox" data-bs-dismiss="modal"
                                       aria-label="Close"><i class="fa-solid fa-chevron-left"></i></a>
                                    <?php
                                    $favourite = $db_handle->numRows("select * from favorite where job_id={$data[$i]['id']}");
                                    ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="job_id"
                                               value="<?php echo $data[$i]["id"]; ?>" required>
                                        <button type="submit" name="favourite" class="card-heart"><i
                                                    class="fas fa-heart <?php if ($favourite % 2 == 1) echo 'text-danger'; ?>"></i>
                                        </button>
                                    </form>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <img src="<?php echo $data[$i]["image"]; ?>" class="img-fluid" alt=""
                                                 style="border: 3px solid white;border-radius: 15px;"/>
                                        </div>
                                        <div class="col-12">
                                            <h1 class="text-center text-white mt-3"
                                                style="font-family: 'DMSans-Bold', serif;"><?php echo $data[$i]["name"]; ?></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <h2 class="text-center"><?php echo $data[$i]["job_title"]; ?></h2>
                                    <p>
                                        <?php echo $data[$i]["job_description"]; ?>
                                    </p>
                                    <div>
                                        <p>
                                            <span class="badge text-bg-success">Salary/Rate:</span>
                                            $<?php echo $data[$i]["salary"]; ?> HKD per <?php echo strtolower($data[$i]["salary"]); ?>
                                        </p>
                                        <p>
                                            <span class="badge text-bg-success">Job type:</span> <?php echo $data[$i]["job_type"]; ?>
                                        </p>
                                        <p>
                                            <span class="badge text-bg-success">Address:</span> <?php echo $data[$i]["address"]; ?>
                                        </p>
                                        <p>
                                            <span class="badge text-bg-success">Contact:</span> <?php echo $data[$i]["contact"]; ?>
                                        </p>
                                        <p>
                                            <span class="badge text-bg-success">Rating:</span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="modal-footer" style="border-top: unset">
                                    <form action="" method="post">
                                        <input type="hidden" name="job_id" value="<?php echo $data[$i]["id"]; ?>"
                                               required>
                                        <button type="submit" class="btn btn-success fs-button-apply" name="apply">Apply
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>

            <div class="row fixed-bottom text-center fs-nav-fixed-bottom">
                <div class="col-2">
                    <a href="dashboard.php" class="text-decoration-none text-dark">
                        <i class="fa-solid fa-house"></i>
                    </a>
                </div>
                <div class="col-2">
                    <a href="search.php" class="text-decoration-none text-dark">
                        <i class="fa-solid fa-magnifying-glass fs-primary-color"></i>
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
</div>


<script src="assets/vendor/Bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jQuery/jquery-3.6.4.min.js"></script>
<script src="assets/vendor/OwlCarousel/js/owl.carousel.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
