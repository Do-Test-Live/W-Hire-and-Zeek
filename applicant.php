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
    $job_id = $_POST['job_post'];
    $inserted_at = date('Y-m-d h:i:s');

    if ($job_id != '') {
        $array = explode(', ', $job_id);
        foreach ($array as $value) //loop over values
        {
            $query = "INSERT INTO `job_apply`(`job_id`, `customer_id`, `inserted_at`) VALUES ('$value','$userId','$inserted_at')";
            $data = $db_handle->insertQuery($query);
        }

        echo "<script>
                alert('Job Applied');
                window.location.href='jobs.php';
                </script>";
    } else {
        echo "<script>
                alert('Job not selected');
                window.location.href='jobs.php';
                </script>";
    }
}

if (isset($_POST['favourite'])) {
    $company_id = $_POST['company_id'];
    $job_id = $_POST['job_id'];
    $inserted_at = date('Y-m-d h:i:s');

    $query = "INSERT INTO `favorite`( `customer_id`, `job_id`, `inserted_at`) VALUES ('$userId','$job_id','$inserted_at')";
    $data = $db_handle->insertQuery($query);
    echo "<script>
                alert('Favourite Changed');
                window.location.href='company.php?company_id=$company_id';
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
            <div class="row ms-1 me-1">
                <div class="mt-5 text-center">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div aria-labelledby="tab1-tab" class="tab-pane fade show active" id="tab1" role="tabpanel">
                            <div class="row">
                                <?php
                                if (isset($_GET['job_id'])) {

                                    $query = "SELECT * FROM `customer` as c, `job_apply` as j where j.customer_id=c.id and j.job_id={$_GET['job_id']} order by j.id desc";
                                    $data = $db_handle->runQuery($query);
                                    $row_count = $db_handle->numRows($query);
                                    for ($i = 0; $i < $row_count; $i++) {
                                        ?>
                                        <div class="col-6 mt-3">
                                            <div class="card">
                                                <div class="p-3">
                                                    <img alt="" class="card-img-top fs-job-card-img"
                                                         src="assets/images/company/def.jpg">
                                                    <p class="card-text card-sub-heading mt-2"><?php echo $data[$i]["fname"]; ?> <?php echo $data[$i]["surname"]; ?></p>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title card-heading">@<?php echo $data[$i]["username"]; ?></h5>
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
                                                                    <div class="row">
                                                                        <div class="col-12 text-center">
                                                                            <img src="assets/images/company/def.jpg"
                                                                                 class="img-fluid" alt=""
                                                                                 style="border: 3px solid white;border-radius: 15px;"/>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <h1 class="text-center text-white mt-3"
                                                                                style="font-family: 'DMSans-Bold', serif;"><?php echo $data[$i]["fname"]; ?> <?php echo $data[$i]["surname"]; ?></h1>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h2 class="text-center">@<?php echo $data[$i]["username"]; ?></h2>
                                                                    <div class="text-start">
                                                                        <p>
                                                                            <span class="badge text-bg-success">Date of Birth:</span> <?php echo $data[$i]["dob"]; ?>
                                                                        </p>
                                                                        <p>
                                                                            <span class="badge text-bg-success">Gender:</span> <?php echo $data[$i]["gender"]; ?>
                                                                        </p>
                                                                        <p>
                                                                            <span class="badge text-bg-success">Email:</span> <?php echo $data[$i]["email"]; ?>
                                                                        </p>
                                                                        <p>
                                                                            <span class="badge text-bg-success">Contact:</span> <?php echo $data[$i]["phone_number"]; ?>
                                                                        </p>
                                                                        <p>
                                                                            <span class="badge text-bg-success">Region:</span> <?php echo $data[$i]["region"]; ?>
                                                                        </p>
                                                                        <p>
                                                                            <span class="badge text-bg-success">Keywords:</span> <?php echo $data[$i]["keywords"]; ?>
                                                                        </p>
                                                                        <p>
                                                                            <span class="badge text-bg-success">Job Category:</span> <?php echo $data[$i]["job_category"]; ?>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
</script>
</body>
</html>
