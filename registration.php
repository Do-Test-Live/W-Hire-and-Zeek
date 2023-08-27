<?php
require_once('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Registration Page - Hire & Zeek</title>
    <link href="assets/images/favicon.ico" rel="icon" type="image/ico"/>
    <link href="assets/vendor/Bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/vendor/FontAwesome/css/all.min.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
    <style>
        /* Apply padding to the input field */
        .form-control[type="date"] {
            padding-left: 10px; /* Adjust the padding as needed */
            padding-right: 10px; /* Adjust the padding as needed */
        }

        /* Adjust the padding for the month and day parts of the input */
        .form-control[type="date"]::-webkit-inner-spin-button,
        .form-control[type="date"]::-webkit-clear-button,
        .form-control[type="date"]::-webkit-calendar-picker-indicator {
            padding: 0; /* Reset padding for these elements */
        }

    </style>
</head>
<body>
<div class="container-fluid">
    <div class="registration-main">
        <div class="row pt-3 login-interface">
            <div class="col-12">
                <div class="mt-3">
                    <i class="fa-solid fa-chevron-left text-white"></i>
                </div>
            </div>
            <div class="col-12">
                <div class="mt-5 text-center mb-5">
                    <div class="fs-user-panel d-flex justify-content-center align-items-center">
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <form action="username.php" method="post">
                    <div class="mb-3">
                        <h3 class="fs-lan-title mt-3">
                            What is your name?
                        </h3>
                        <p class="fs-lan-caption mt-3 mb-4">
                            Please Use your real name as this will be required for identity verification
                        </p>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6 pe-1">
                                <input class="form-control fs-form-control" name="fname" placeholder="First name"
                                       type="text" required/>
                            </div>
                            <div class="col-6 ps-1">
                                <input class="form-control fs-form-control" name="surname" placeholder="Last Name"
                                       type="text" required/>
                            </div>
                        </div>
                    </div>
                    <!--<div class="mb-3">
                        <div class="row">
                            <div class="col-6 pe-1">
                                <input class="form-control fs-form-control" placeholder="Middle name" name="mname"
                                       type="text"/>
                            </div>
                        </div>
                    </div>-->
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fs-registration-label">Gender</label>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="Male" name="gender" id="flexRadioDefault1" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Male
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="Female" name="gender" id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fs-registration-label">Date of birth</label>
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control fs-registration-control" name="dob"
                                               type="date" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (isset($_POST['registration'])) {

                        $email = $db_handle->checkValue($_POST['email']);
                        $password = $db_handle->checkValue($_POST['password']);
                        $code = $db_handle->checkValue($_POST['code']);
                        $one = $db_handle->checkValue($_POST['one']);
                        $two = $db_handle->checkValue($_POST['two']);
                        $three = $db_handle->checkValue($_POST['three']);
                        $four = $db_handle->checkValue($_POST['four']);

                        $fetch_customer = $db_handle->runQuery("select * from customer where email = '$email'");
                        $fetch_customer_no = $db_handle->numRows("select * from customer where email = '$email'");

                        $new_code = $one . $two . $three . $four;
                        if ($code != $new_code) {
                            echo "<script>
                                            alert('Code not match. Please put email again.');
                                            window.location.href='signup.php';
                                            </script>";
                        }

                        if($fetch_customer_no>0){
                            echo "<script>
                                        alert('Email already registered.');
                                        window.location.href='signup.php';
                                    </script>";
                        }

                        ?>
                    <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>" required/>
                    <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>" required/>
                    <?php
                    }else{
                    ?>
                        <script>
                            alert('Invalid Page');
                            window.location.href = 'signup.php';
                        </script>
                        <?php
                    }
                    ?>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fs-registration-label">Region</label>
                                    </div>
                                    <div class="col-6">
                                        <select class="form-control fs-registration-control" name="region" required>
                                            <option value="中西區">中西區</option>
                                            <option value="東區">東區</option>
                                            <option value="南區">南區</option>
                                            <option value="灣仔區">灣仔區</option>
                                            <option value="九龍區">九龍區</option>
                                            <option value="觀塘區">觀塘區</option>
                                            <option value="深水埗區">深水埗區</option>
                                            <option value="黃大仙區">黃大仙區</option>
                                            <option value="油尖旺區">油尖旺區</option>
                                            <option value="離島區">離島區</option>
                                            <option value="葵青區">葵青區</option>
                                            <option value="北區">北區</option>
                                            <option value="西貢區">西貢區</option>
                                            <option value="沙田區">沙田區</option>
                                            <option value="大埔區">大埔區</option>
                                            <option value="荃灣區">荃灣區</option>
                                            <option value="屯門區">屯門區</option>
                                            <option value="元朗區">元朗區</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 pt-5">
                        <button type="submit" name="submit" class="btn btn-secondary fs-lan-primary-btn w-100">Submit
                        </button>
                    </div>
                </form>
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
