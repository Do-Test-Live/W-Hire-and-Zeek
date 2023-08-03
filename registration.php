<?php
require_once ('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
if(isset($_POST['submit'])){
    $email = $db_handle->checkValue($_POST['email']);
    $password = $db_handle->checkValue($_POST['password']);
    $surname = $db_handle->checkValue($_POST['surname']);
    $fname = $db_handle->checkValue($_POST['fname']);
    $mname = $db_handle->checkValue($_POST['mname']);
    $dob = $db_handle->checkValue($_POST['dob']);
    $gender = $db_handle->checkValue($_POST['gender']);
    $region = $db_handle->checkValue($_POST['region']);
    $inserted_at=date('Y-m-d h:i:s');


    $query="INSERT INTO `customer`(`fname`, `mname`, `surname`, `email`, `password`, `dob`, `gender`, `region`, `inserted_at`) VALUES ('$fname','$mname','$surname','$email','$password','$dob','$gender','$region','$inserted_at')";

    $insert = $db_handle->insertQuery($query);

    if($insert){
        echo "<script>
                document.cookie = 'alert = 6;';
                window.location.href='login.php';
                </script>";
    }else{
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
    <title>Registration Page - Hire & Zeek</title>
    <link href="assets/images/favicon.ico" rel="icon" type="image/ico"/>
    <link href="assets/vendor/Bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/vendor/FontAwesome/css/all.min.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
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
                <form action="" method="post">
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
                            <div class="col-6 pe-2">
                                <input class="form-control fs-form-control" name="surname" placeholder="Surname" type="text" required/>
                            </div>
                            <div class="col-6 ps-1">
                                <input class="form-control fs-form-control" name="fname" placeholder="First name" type="text" required/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6 pe-1">
                                <input class="form-control fs-form-control" placeholder="Middle name" name="mname" type="text"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6 pe-1">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="fs-registration-label">Gender</label>
                                    </div>
                                    <div class="col-8">
                                        <input class="form-control fs-registration-control" name="gender" placeholder="M/F" type="text" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 ps-1">
                                <div class="row">
                                    <div class="col-6">
                                        <label class="fs-registration-label">Date of birth</label>
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control fs-registration-control" name="dob" placeholder="YY/MM/DD" type="text" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if(isset($_POST['registration'])){
                        ?>
                        <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>" required/>
                        <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>" required/>
                    <?php
                    }else{
                        ?>
                        <script>
                            window.location.href='signup.php';
                        </script>
                    <?php
                    }
                    ?>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-6 pe-1">
                                <div class="row">
                                    <div class="col-4">
                                        <label class="fs-registration-label">Region</label>
                                    </div>
                                    <div class="col-8">
                                        <input class="form-control fs-registration-control" name="region" placeholder="" type="text" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 pt-5">
                        <button type="submit" name="submit" class="btn btn-secondary fs-next-button w-100">Submit</button>
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