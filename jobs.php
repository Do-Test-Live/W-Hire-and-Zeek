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

            <div class="row ms-1 me-1">
                <div class="mt-5 text-center">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation" style="width: 100px">
                            <a aria-controls="tab1" aria-selected="true" class="nav-link active" data-bs-toggle="tab"
                               href="#tab1"
                               id="tab1-tab" role="tab">All 10</a>
                        </li>
                        <li class="nav-item" role="presentation" style="width: 100px">
                            <a aria-controls="tab2" aria-selected="false" class="nav-link" data-bs-toggle="tab"
                               href="#tab2"
                               id="tab2-tab" role="tab">Favorites</a>
                        </li>
                        <li class="nav-item" role="presentation" style="width: 100px">
                            <a aria-controls="tab3" aria-selected="false" class="nav-link" data-bs-toggle="tab"
                               href="#tab3"
                               id="tab3-tab" role="tab">Recently Viewed</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div aria-labelledby="tab1-tab" class="tab-pane fade show active" id="tab1" role="tabpanel">
                            <div class="row">
                                <?php
                                $query="SELECT * FROM company as c,job_post as j where c.id=j.company_id order by j.id desc";
                                $data = $db_handle->runQuery($query);
                                $row_count = $db_handle->numRows($query);
                                for ($i = 0; $i < $row_count; $i++) {
                                ?>
                                <div class="col-6 mt-3">
                                    <div class="card">
                                        <input type="checkbox" class="card-checkbox" value="<?php echo $data[$i]["id"]; ?>">
                                        <div class="p-3">
                                            <img alt="" class="card-img-top fs-job-card-img"
                                                 src="<?php echo $data[$i]["image"]; ?>">
                                             <p class="card-text card-sub-heading mt-2"><?php echo $data[$i]["name"]; ?></p>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title card-heading"><?php echo $data[$i]["job_title"]; ?></h5>
                                            <p class="card-text"><small class="text-muted">$<?php echo $data[$i]["salary"]; ?> HKD/hr</small></p>
                                            <button class="card-heart"><i class="fas fa-heart"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div aria-labelledby="tab2-tab" class="tab-pane fade" id="tab2" role="tabpanel">

                        </div>
                        <div aria-labelledby="tab3-tab" class="tab-pane fade" id="tab3" role="tabpanel">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row fixed-bottom text-cente fs-nav-apply">
            <div class="col-12">
                <div style="background: rgba(255,255,255,0.85);border-top: 5px solid rgba(0,148,14,0.3);">
                    <div class="row pt-3 pb-3 ps-2 pe-2">
                        <div class="col-7 fs-url" id="result">
                            0 selected task
                        </div>
                        <div class="col-5 text-end">
                            <button type="button" class="btn btn-success fs-button-apply">Apply</button>
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
                console.log(`Selected option values: ${selectedValues.join(', ')}`);
            });
        });
    });
</script>
</body>
</html>
