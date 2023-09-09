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
            window.location.href='jobs.php';
            </script>";

}

if (isset($_POST['favourite'])) {
    $job_id = $_POST['job_id'];
    $inserted_at = date('Y-m-d h:i:s');

    $query = "INSERT INTO `favorite`( `customer_id`, `job_id`, `inserted_at`) VALUES ('$userId','$job_id','$inserted_at')";
    $data = $db_handle->insertQuery($query);
    echo "<script>
                alert('Favourite Changed');
                window.location.href='jobs.php';
                </script>";

}
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
    <link href="assets/vendor/toastr/css/toastr.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <style>
        .card {
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

        .card-body {
            border-top: 1px solid white;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="fs-job">
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
        <div class="container" style="margin-bottom: 105px">
            <div class="row">
                <div class="col-12">
                    <img class="img-fluid heading-banner" src="assets/images/12/5.webp">
                </div>
            </div>
            <div class="row text-center mt-3" style="margin: 0 25px;">
                <div class="col-3">
                    <a href="jobs.php?job_type=Full-Time">
                        <img class="icons" alt="" src="assets/images/12/3.webp"/>
                    </a>
                </div>
                <div class="col-3">
                    <a href="jobs.php?job_type=Part-Time">
                        <img class="icons" alt="" src="assets/images/12/4.webp"/>
                    </a>
                </div>
                <div class="col-3">
                    <a href="jobs.php?job_type=Freelance">
                        <img class="icons" alt="" src="assets/images/12/2.webp"/>
                    </a>
                </div>
                <div class="col-3">
                    <a href="jobs.php?job_type=Project-Based">
                        <img class="icons" alt="" src="assets/images/12/1.webp"/>
                    </a>
                </div>
            </div>
            <div class="row text-center" style="margin: 0 25px;">
                <div class="col-3">
                    <a class="text-decoration-none" href="jobs.php?job_type=Full-Time">
                        <p class="icon-text text-dark">Full-Time</p>
                    </a>
                </div>
                <div class="col-3">
                    <a class="text-decoration-none" href="jobs.php?job_type=Part-Time">
                        <p class="icon-text text-dark">Part-Time</p>
                    </a>
                </div>
                <div class="col-3">
                    <a class="text-decoration-none" href="jobs.php?job_type=Freelance">
                        <p class="icon-text text-dark">Freelance</p>
                    </a>
                </div>
                <div class="col-3">
                    <a class="text-decoration-none" href="jobs.php?job_type=Project-Based">
                        <p class="icon-text text-dark">Project Based</p>
                    </a>
                </div>
            </div>

            <div class="row ms-1 me-1">
                <div class="mt-5 text-center">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation" style="width: 150px">
                            <a aria-controls="tab1" aria-selected="true" class="nav-link active" data-bs-toggle="tab"
                               href="#tab1"
                               id="tab1-tab" role="tab">
                                <?php
                                $query = "SELECT * FROM `customer` where id='$userId'";
                                $data = $db_handle->runQuery($query);

                                $keywords = $data[0]['keywords'];
                                ?>
                                All
                            </a>
                        </li>
                        <li class="nav-item" role="presentation" style="width: 100px">
                            <a aria-controls="tab2" aria-selected="false" class="nav-link" data-bs-toggle="tab"
                               href="#tab2"
                               id="tab2-tab" role="tab">Favorites</a>
                        </li>
                        <li class="nav-item" role="presentation" style="width: 100px">
                            <a aria-controls="tab3" aria-selected="false" class="nav-link" data-bs-toggle="tab"
                               href="#tab3"
                               id="tab3-tab" role="tab">Applied Job</a>
                        </li>
                    </ul>
                    <div class="mb-3">
                        <select class="form-select fs-form-control" aria-label="Default select example" name="keywords"
                                onchange="changeClass(this.value);" required>
                            <option value="All" selected>#HashTag</option>
                            <option value="illustration">#illustration</option>
                            <option value="Photography">#Photography</option>
                            <option value="FineArt">#FineArt</option>
                            <option value="GraphicDesign">#GraphicDesign</option>
                            <option value="WebDevelopment">#WebDevelopment</option>
                            <option value="UXDesign">#UXDesign</option>
                            <option value="UIDesign">#UIDesign</option>
                            <option value="Animation">#Animation</option>
                            <option value="Lifestyle">#Lifestyle</option>
                            <option value="Film&Video">#Film&Video</option>
                            <option value="Music">#Music</option>
                            <option value="Marketing">#Marketing</option>
                            <option value="Business&Management">#Business&Management</option>
                            <option value="Productivity">#Productivity</option>
                        </select>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div aria-labelledby="tab1-tab" class="tab-pane fade show active" id="tab1" role="tabpanel">
                            <div class="row">
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
                                        <div class="col-6 mt-3 all <?php echo ltrim($data[$i]["keywords"], $data[$i]["keywords"][0]); ?>">
                                            <div class="card <?php echo ltrim($data[$i]["keywords"], $data[$i]["keywords"][0]); ?>">
                                                <input type="checkbox" class="card-checkbox"
                                                       value="<?php echo $data[$i]["id"]; ?>">
                                                <div class="p-3">
                                                    <img alt="" class="card-img-top fs-job-card-img"
                                                         src="<?php echo $data[$i]["image"]; ?>">
                                                    <p class="card-text card-sub-heading mt-2"><?php echo $data[$i]["name"]; ?></p>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title card-heading"><?php echo $data[$i]["job_title"]; ?></h5>
                                                    <p class="card-text"><small
                                                                class="text-muted">$<?php echo $data[$i]["salary"]; ?>
                                                            HKD/<?php echo strtolower($data[$i]["salary_rate"]); ?></small></p>
                                                    <div class="text-center mt-2">
                                                        <button type="button" name="submit"
                                                                class="btn btn-outline-success fs-skills-next-btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#staticBackdrop<?php echo $data[$i]["id"]; ?>">
                                                            Detail
                                                        </button>
                                                    </div>

                                                    <div class="modal fade"
                                                         id="staticBackdrop<?php echo $data[$i]["id"]; ?>"
                                                         data-bs-backdrop="static"
                                                         data-bs-keyboard="false" tabindex="-1"
                                                         aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header justify-content-center align-items-center">
                                                                    <a class="text-decoration-none text-white card-checkbox"
                                                                       data-bs-dismiss="modal"
                                                                       aria-label="Close"><i
                                                                                class="fa-solid fa-chevron-left"></i></a>
                                                                    <?php
                                                                    $favourite = $db_handle->numRows("select * from favorite where job_id={$data[$i]['id']}");
                                                                    ?>
                                                                    <form action="" method="post">
                                                                        <input type="hidden" name="job_id"
                                                                               value="<?php echo $data[$i]["id"]; ?>"
                                                                               required>
                                                                        <button type="submit" name="favourite"
                                                                                class="card-heart"><i
                                                                                    class="fas fa-heart <?php if ($favourite % 2 == 1) echo 'text-danger'; ?>"></i>
                                                                        </button>
                                                                    </form>
                                                                    <div class="row">
                                                                        <div class="col-12 text-center">
                                                                            <img src="<?php echo $data[$i]["image"]; ?>"
                                                                                 class="img-fluid" alt=""
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
                                                                    <div class="text-start">
                                                                        <p>
                                                                            <span class="badge text-bg-success">Salary/Rate:</span>
                                                                            $<?php echo $data[$i]["salary"]; ?> HKD per
                                                                            <?php echo strtolower($data[$i]["salary_rate"]); ?>
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
                                                                        <input type="hidden" name="job_id"
                                                                               value="<?php echo $data[$i]["id"]; ?>"
                                                                               required>
                                                                        <button type="submit"
                                                                                class="btn btn-success fs-button-apply"
                                                                                name="apply">Apply
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

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
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } ?>
                            </div>
                        </div>
                        <div aria-labelledby="tab2-tab" class="tab-pane fade" id="tab2" role="tabpanel">
                            <div class="row">
                                <?php
                                $query = "SELECT * FROM company as c,job_post as j where c.id=j.company_id order by j.id desc";
                                $data = $db_handle->runQuery($query);
                                $row_count = $db_handle->numRows($query);
                                for ($i = 0; $i < $row_count; $i++) {

                                    $apply_job = $db_handle->numRows("select * from job_apply where job_id={$data[$i]['id']} and customer_id='{$userId}'");
                                    $favourite = $db_handle->numRows("select * from favorite where job_id={$data[$i]['id']} and customer_id='{$userId}'");

                                    if ($apply_job == 0 && $favourite % 2 == 1) {
                                        ?>
                                        <div class="col-6 mt-3 all <?php echo ltrim($data[$i]["keywords"], $data[$i]["keywords"][0]); ?>">
                                            <div class="card <?php echo ltrim($data[$i]["keywords"], $data[$i]["keywords"][0]); ?>">
                                                <input type="checkbox" class="card-checkbox"
                                                       value="<?php echo $data[$i]["id"]; ?>">
                                                <div class="p-3">
                                                    <img alt="" class="card-img-top fs-job-card-img"
                                                         src="<?php echo $data[$i]["image"]; ?>">
                                                    <p class="card-text card-sub-heading mt-2"><?php echo $data[$i]["name"]; ?></p>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title card-heading"><?php echo $data[$i]["job_title"]; ?></h5>
                                                    <p class="card-text"><small
                                                                class="text-muted">$<?php echo $data[$i]["salary"]; ?>
                                                            HKD/<?php echo strtolower($data[$i]["salary_rate"]); ?></small></p>
                                                    <div class="text-center mt-2">
                                                        <button type="button" name="submit"
                                                                class="btn btn-outline-success fs-skills-next-btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#staticBackdrop<?php echo $data[$i]["id"]; ?>">
                                                            Detail
                                                        </button>
                                                    </div>

                                                    <div class="modal fade"
                                                         id="staticBackdrop<?php echo $data[$i]["id"]; ?>"
                                                         data-bs-backdrop="static"
                                                         data-bs-keyboard="false" tabindex="-1"
                                                         aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header justify-content-center align-items-center">
                                                                    <a class="text-decoration-none text-white card-checkbox"
                                                                       data-bs-dismiss="modal"
                                                                       aria-label="Close"><i
                                                                                class="fa-solid fa-chevron-left"></i></a>
                                                                    <?php
                                                                    $favourite = $db_handle->numRows("select * from favorite where job_id={$data[$i]['id']}");
                                                                    ?>
                                                                    <form action="" method="post">
                                                                        <input type="hidden" name="job_id"
                                                                               value="<?php echo $data[$i]["id"]; ?>"
                                                                               required>
                                                                        <button type="submit" name="favourite"
                                                                                class="card-heart"><i
                                                                                    class="fas fa-heart <?php if ($favourite % 2 == 1) echo 'text-danger'; ?>"></i>
                                                                        </button>
                                                                    </form>
                                                                    <div class="row">
                                                                        <div class="col-12 text-center">
                                                                            <img src="<?php echo $data[$i]["image"]; ?>"
                                                                                 class="img-fluid" alt=""
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
                                                                    <div class="text-start">
                                                                        <p>
                                                                            <span class="badge text-bg-success">Salary/Rate:</span>
                                                                            $<?php echo $data[$i]["salary"]; ?> HKD per
                                                                            <?php echo strtolower($data[$i]["salary_rate"]); ?>
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
                                                                        <input type="hidden" name="job_id"
                                                                               value="<?php echo $data[$i]["id"]; ?>"
                                                                               required>
                                                                        <button type="submit"
                                                                                class="btn btn-success fs-button-apply"
                                                                                name="apply">Apply
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="job_id"
                                                               value="<?php echo $data[$i]["id"]; ?>" required>
                                                        <button type="submit" name="favourite" class="card-heart"><i
                                                                    class="fas fa-heart text-danger"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } ?>
                            </div>
                        </div>
                        <div aria-labelledby="tab3-tab" class="tab-pane fade" id="tab3" role="tabpanel">
                            <div class="row">
                                <?php
                                $query = "SELECT * FROM company as c,job_post as j where c.id=j.company_id order by j.id desc";
                                $data = $db_handle->runQuery($query);
                                $row_count = $db_handle->numRows($query);
                                for ($i = 0; $i < $row_count; $i++) {

                                    $apply_job = $db_handle->numRows("select * from job_apply where job_id={$data[$i]['id']} and customer_id='{$userId}'");
                                    $favourite = $db_handle->numRows("select * from favorite where job_id={$data[$i]['id']} and customer_id='{$userId}'");

                                    if ($apply_job == 1) {
                                        ?>
                                        <div class="col-6 mt-3 all <?php echo ltrim($data[$i]["keywords"], $data[$i]["keywords"][0]); ?>">
                                            <div class="card <?php echo ltrim($data[$i]["keywords"], $data[$i]["keywords"][0]); ?>">
                                                <input type="checkbox" class="card-checkbox"
                                                       value="<?php echo $data[$i]["id"]; ?>" disabled>
                                                <div class="p-3">
                                                    <img alt="" class="card-img-top fs-job-card-img"
                                                         src="<?php echo $data[$i]["image"]; ?>">
                                                    <p class="card-text card-sub-heading mt-2"><?php echo $data[$i]["name"]; ?></p>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title card-heading"><?php echo $data[$i]["job_title"]; ?></h5>
                                                    <p class="card-text"><small
                                                                class="text-muted">$<?php echo $data[$i]["salary"]; ?>
                                                            HKD/<?php echo strtolower($data[$i]["salary_rate"]); ?></small></p>
                                                    <div class="text-center mt-2">
                                                        <button type="button" name="submit"
                                                                class="btn btn-outline-success fs-skills-next-btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#staticBackdrop<?php echo $data[$i]["id"]; ?>">
                                                            Detail
                                                        </button>
                                                    </div>

                                                    <div class="modal fade"
                                                         id="staticBackdrop<?php echo $data[$i]["id"]; ?>"
                                                         data-bs-backdrop="static"
                                                         data-bs-keyboard="false" tabindex="-1"
                                                         aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header justify-content-center align-items-center">
                                                                    <a class="text-decoration-none text-white card-checkbox"
                                                                       data-bs-dismiss="modal"
                                                                       aria-label="Close"><i
                                                                                class="fa-solid fa-chevron-left"></i></a>
                                                                    <?php
                                                                    $favourite = $db_handle->numRows("select * from favorite where job_id={$data[$i]['id']}");
                                                                    ?>
                                                                    <form action="" method="post">
                                                                        <input type="hidden" name="job_id"
                                                                               value="<?php echo $data[$i]["id"]; ?>"
                                                                               required>
                                                                        <button type="submit" name="favourite"
                                                                                class="card-heart"><i
                                                                                    class="fas fa-heart <?php if ($favourite % 2 == 1) echo 'text-danger'; ?>"></i>
                                                                        </button>
                                                                    </form>
                                                                    <div class="row">
                                                                        <div class="col-12 text-center">
                                                                            <img src="<?php echo $data[$i]["image"]; ?>"
                                                                                 class="img-fluid" alt=""
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
                                                                    <div class="text-start">
                                                                        <p>
                                                                            <span class="badge text-bg-success">Salary/Rate:</span>
                                                                            $<?php echo $data[$i]["salary"]; ?> HKD per
                                                                            <?php echo strtolower($data[$i]["salary_rate"]); ?>
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
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row fixed-bottom text-center fs-nav-apply">
            <div class="col-12 d-none">
                <div style="background: rgba(255,255,255,0.85);border-top: 5px solid rgba(0,148,14,0.3);">
                    <div class="row pt-3 pb-3 ps-2 pe-2">
                        <div class="col-7 fs-url" id="result">
                            0 selected task
                        </div>
                        <div class="col-5 text-end">
                            <form action="" method="post">
                                <input type="hidden" id="job_post" name="job_post" required>
                                <button type="submit" class="btn btn-success fs-button-apply" name="apply">Apply
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center fs-nav-fixed-bottom" style="padding-top: 30px">
                <div class="row">
                    <div class="col-2">
                        <a href="dashboard.php" class="text-decoration-none text-dark">
                            <i class="fa-solid fa-house"></i>
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
                            <i class="fa-solid fa-briefcase fs-primary-color"></i>
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
</div>


<script src="assets/vendor/Bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jQuery/jquery-3.6.4.min.js"></script>
<script src="assets/vendor/OwlCarousel/js/owl.carousel.min.js"></script>
<script src="assets/vendor/toastr/js/toastr.min.js" type="text/javascript"></script>
<script src="assets/js/toastr-init.js" type="text/javascript"></script>
<script src="assets/js/main.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const checkboxes = document.querySelectorAll("input[type='checkbox']");
        const resultDisplay = document.getElementById("result");

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener("change", function () {
                const selectedCheckboxes = document.querySelectorAll("input[type='checkbox']:checked");
                const selectedCount = selectedCheckboxes.length;
                resultDisplay.textContent = `${selectedCount} selected task`;

                const selectedValues = Array.from(selectedCheckboxes).map(cb => cb.value);
                document.getElementById("job_post").value = selectedValues.join(', ');

                console.log(`Selected option values: ${selectedValues.join(', ')}`);
            });
        });
    });

    function changeClass(selectedKeyword) {
        var col6Divs = document.querySelectorAll('.col-6'); // Select all col-6 divs

        col6Divs.forEach(function (col) {
            var card = col.querySelector('.card'); // Find the card within the col-6 div
            var cardKeywords = card.classList; // Get the classes of the card

            if (selectedKeyword === 'All' || cardKeywords.contains(selectedKeyword)) {
                col.style.display = 'block'; // Show the col-6 div if it doesn't contain the selected keyword
            } else {
                col.style.display = 'none'; // Hide the col-6 div if it contains the selected keyword
            }
        });

        console.log(selectedKeyword);
    }
</script>
</body>
</html>
