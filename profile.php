<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}

if (isset($_POST['uploadPhoto'])) {
    $profile_id = $_POST['profile_id'];
    $contact_number = $_POST['contact_number'];

    $image = '';
    $query_extend = '';
    $i = 0;

    if (!empty($_FILES['customer_image']['name'])) {
        $RandomAccountNumber = mt_rand(1, 99999);
        $file_name = $RandomAccountNumber . "_" . $_FILES['customer_image']['name'];
        $file_size = $_FILES['customer_image']['size'];
        $file_tmp = $_FILES['customer_image']['tmp_name'];

        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg") {
            $attach_files = '';
            echo "<script>
                alert('Image format not work.');
                window.location.href='profile.php';
                </script>";

        } else {
            move_uploaded_file($file_tmp, "assets/images/customer_profile/" . $file_name);
            $image = "assets/images/customer_profile/" . $file_name;

            $i = 1;
        }
    } else {
        $image = "assets/images/company/def.jpg";
    }

    $c=0;
    if ($contact_number != '') {
        $c = 1;
    }

    $query = '';

    if ($c == 1 && $i == 1) {
        $query = "UPDATE `customer` SET `image`='$image',phone_number='$contact_number' WHERE id='$profile_id'";
    } else if ($i ==1) {
        $query = "UPDATE `customer` SET `image`='$image' WHERE id='$profile_id'";
    } else if ($c == 1) {
        $query = "UPDATE `customer` SET phone_number='$contact_number' WHERE id='$profile_id'";
    }


    $insert = $db_handle->insertQuery($query);

    if ($insert) {
        echo "<script>
                alert('Data Updated.');
                window.location.href='profile.php';
                </script>";
    } else {
        echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='profile.php';
                </script>";
    }
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

    <style>
        .image-container {
            position: relative;
            display: inline-block; /* Adjust display property as needed */
        }

        .icon-link {
            position: absolute;
            top: -6px;
            right: -10px;
            padding: 8px;
            text-decoration: none;
            color: #fff;
            background-color: #007c4c;
            border-radius: 50%;
            font-size: 10px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="fs-profile pb-5">
        <div class="row pt-5">
            <div class="col-12">
                <div class="fs-dashboard-alert">
                    <div class="row text-white p-3">
                        <div class="col-6 text-center mx-auto">

                            <?php
                            if ($fetch_user[0]['image'] == '') {
                                ?>
                                <div class="image-container">

                                    <i class="fa-solid fa-circle-user fa-5x mx-auto"></i>

                                    <!-- Clickable Pen Icon -->
                                    <a class="icon-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fas fa-pen-to-square fa-2x"></i>
                                    </a>
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="image-container">

                                    <img src="<?php echo $fetch_user[0]['image']; ?>" class="img-fluid rounded-circle"
                                         alt=""/>
                                    <!-- Clickable Pen Icon -->
                                    <a class="icon-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <i class="fas fa-pen-to-square fa-2x"></i>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>

                            <h5>
                                <?php echo $fetch_user[0]['fname']; ?><?php echo $fetch_user[0]['surname']; ?>
                            </h5>
                            <p>
                                @<?php echo $fetch_user[0]['username']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background: White">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Image</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" name="profile_id" value="<?php echo $fetch_user[0]['id']; ?>"
                                   required/>

                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="customer_image">
                                <label class="input-group-text">Upload</label>
                            </div>
                            <div class="input-group mb-3">
                                <input class="form-control" type="tel" name="contact_number" value="<?php echo $fetch_user[0]['phone_number']; ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="uploadPhoto" class="btn btn-primary">Update</button>
                        </div>
                    </form>
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
                    <div class="col-7">
                        <p>
                            Balance
                        </p>
                    </div>
                    <div class="col-4 text-end">
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
                <?php
                $fetch_company = $db_handle->runQuery("select * from company where customer_id = '$userId'");
                if (isset($fetch_company)) {
                    ?>
                    <hr/>
                    <div class="row">
                        <div class="col-12 mt-3 mb-2">
                            <h5 class="text-center">Hirer Profile</h5>
                        </div>
                        <?php
                        $query = "select * from company where customer_id = '$userId'";
                        $data = $db_handle->runQuery($query);
                        $row_count = $db_handle->numRows($query);
                        for ($i = 0; $i < $row_count; $i++) {
                            ?>
                            <div class="col-1">
                                <i class="fa-solid fa-business-time"></i>
                            </div>
                            <div class="col-8">
                                <a href="company.php?company_id=<?php echo $fetch_company[$i]['id']; ?>"
                                   style="text-decoration: none; color: #01a862;">
                                    <p>
                                        <?php echo $fetch_company[$i]['name']; ?>
                                    </p>
                                </a>
                            </div>
                            <div class="col-3 text-end">
                                <a href="company.php?company_id=<?php echo $fetch_company[$i]['id']; ?>"
                                   style="text-decoration: none; color: #01a862;">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="col-12 mt-3 text-center">
                            <a href="company-profile.php" class="btn btn-success fs-button-apply">Add New Hirer</a>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <hr/>
                <div class="row">
                    <div class="col-1">
                        <i class="fa-regular fa-circle-question"></i>
                    </div>
                    <div class="col-8">
                        <a href="mailto:support@hireandzeek.com" style="text-decoration: none; color: #01a862;">
                            <p>
                                Support
                            </p>
                        </a>
                    </div>
                    <div class="col-3 text-end">
                        <a href="mailto:support@hireandzeek.com" style="text-decoration: none; color: #01a862;">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <p class="mt-3">
                            <i class="fa-solid fa-globe"></i>
                        </p>
                    </div>
                    <div class="col-7">
                        <p class="mt-3">
                            Language
                        </p>
                    </div>
                    <div class="col-4 text-end">
                        <select class="form-select fs-select-control" aria-label="Default select example">
                            <option selected>English</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3 mb-2">
                    <div class="col-1">
                        <p class="mt-3">
                            <i class="fa-solid fa-sitemap"></i>
                        </p>
                    </div>
                    <div class="col-6">
                        <p class="mt-3">
                            Select Mode
                        </p>
                    </div>
                    <div class="col-5 text-end">
                        <select class="form-select fs-select-control" aria-label="Default select example">
                            <option selected>Applicant</option>
                            <option>Hirer</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1">
                        <i class="fa-regular fa-file-lines"></i>
                    </div>
                    <div class="col-8">
                        <a href="termsandcondition.php" style="text-decoration: none; color: #01a862;">
                            <p>
                                Terms and conditions
                            </p>
                        </a>
                    </div>
                    <div class="col-3 text-end">
                        <a href="termsandcondition.php" style="text-decoration: none; color: #01a862;">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
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
                        <a href="logout.php" style="text-decoration: none; color: #01a862;">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
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
                    <i class="fa-solid fa-user fs-primary-color"></i>
                </a>
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
