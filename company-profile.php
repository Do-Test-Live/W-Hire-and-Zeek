<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}
$userId = $_SESSION['userid'];


if (isset($_POST['companyProfile'])) {
    $company_title = $db_handle->checkValue($_POST['company_title']);
    $keywords = $db_handle->checkValue($_POST['keywords']);

    $image = '';
    if (!empty($_FILES['company_image']['name'])) {
        $RandomAccountNumber = mt_rand(1, 99999);
        $file_name = $RandomAccountNumber . "_" . $_FILES['company_image']['name'];
        $file_size = $_FILES['company_image']['size'];
        $file_tmp  = $_FILES['company_image']['tmp_name'];

        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if ($file_type != "jpg" && $file_type != "png" && $file_type != "jpeg") {
            $attach_files = '';
            echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='company-profile.php';
                </script>";

        } else {
            move_uploaded_file($file_tmp, "assets/images/company/" . $file_name);
            $image = "assets/images/company/" . $file_name;
        }
    }else{
        $image = "assets/images/company/def.jpg";
    }


    $inserted_at = date('Y-m-d h:i:s');


    $query = "INSERT INTO `company`(`customer_id`, `name`, `image`, `keywords`, `inserted_at`) VALUES ('$userId','$company_title','$image','$keywords','$inserted_at')";

    $insert = $db_handle->insertQuery($query);

    if ($insert) {
        echo "<script>
                document.cookie = 'alert = 8;';
                window.location.href='profile.php';
                </script>";
    } else {
        echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='company-profile.php';
                </script>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Hirer Profile - Hire & Zeek</title>
    <link href="assets/images/favicon.ico" rel="icon" type="image/ico"/>
    <link href="assets/vendor/Bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/vendor/FontAwesome/css/all.min.css" rel="stylesheet"/>
    <link href="assets/vendor/toastr/css/toastr.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="job-post-main">
        <div class="row pt-5 mb-5 pb-5 login-interface">
            <div class="col-12">
                <div class="text-center">
                    <img alt="" class="img-fluid" src="assets/images/logo.webp"/>
                </div>
                <div class="mt-5">
                    <h3 class="fs-lan-title mt-3 mb-4">
                        Hirer Profile
                    </h3>
                </div>
            </div>
            <div class="col-12">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input class="form-control fs-form-control" placeholder="Hirer Title" type="text"
                               name="company_title" required>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Hirer Image (250X250) Size</label>
                            <input class="form-control" type="file" name="company_image" id="formFile"
                                   accept="image/png, image/jpeg, image/jpg">
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #illustration
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Photography
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #FineArt
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #GraphicDesign
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #WebDevelopment
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #UXDesign
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #UIDesign
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Animation
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Lifestyle
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Film&Video
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Music
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Marketing
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Business&Management
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Productivity
                        </button>

                        <button type="button" class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3"
                                onclick="othersButton(this)">
                            <i class="fa-regular fa-circle"></i> #Others
                        </button>
                        <div class="hidden mt-3" id="othersInput">
                            <input type="text" class="form-control" onkeyup="othersValue(this.value);" onkeydown="othersValue(this.value);" value="" name="others"/>
                        </div>

                        <input type="hidden" id="outputInput" name="keywords" required>
                    </div>
                    <div class="mb-5">
                        <button type="submit" name="companyProfile" class="btn btn-primary fs-lan-primary-btn w-100">Submit
                        </button>
                    </div>
                </form>
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
                <i class="fa-solid fa-user"></i>
            </a>
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
    let selectedValue = '';
    let outputInput = document.getElementById("outputInput");

    function othersValue(val){
        outputInput.value='#'+val.replace(/\s/g, '');
    }

    function othersButton(button) {
        removeAllExpertiseCheckClasses();
        let icon = button.querySelector("i");
        let buttonText = button.textContent.trim();
        let inputField = document.getElementById("othersInput");

        if (button.classList.contains("fs-expertise-check-btn")) {
            button.classList.remove("fs-expertise-check-btn");
            button.classList.add("fs-expertise-check-btn-check");

            icon.classList.remove("fa-regular");
            icon.classList.add("fa-solid");
            icon.classList.remove("fa-circle");
            icon.classList.add("fa-circle-check");

            inputField.style.display = "block";
        } else {
            button.classList.remove("fs-expertise-check-btn-check");
            button.classList.add("fs-expertise-check-btn");

            icon.classList.remove("fa-solid");
            icon.classList.add("fa-regular");
            icon.classList.remove("fa-circle-check");
            icon.classList.add("fa-circle");

            inputField.style.display = "none";
        }

    }


    function toggleButton(button) {
        let inputField = document.getElementById("othersInput");
        removeAllExpertiseCheckClasses();
        let icon = button.querySelector("i");
        let buttonText = button.textContent.trim();

        if (button.classList.contains("fs-expertise-check-btn")) {
            button.classList.remove("fs-expertise-check-btn");
            button.classList.add("fs-expertise-check-btn-check");

            icon.classList.remove("fa-regular");
            icon.classList.add("fa-solid");
            icon.classList.remove("fa-circle");
            icon.classList.add("fa-circle-check");

            outputInput.value = buttonText;
            inputField.style.display = "none";
        } else {
            button.classList.remove("fs-expertise-check-btn-check");
            button.classList.add("fs-expertise-check-btn");

            icon.classList.remove("fa-solid");
            icon.classList.add("fa-regular");
            icon.classList.remove("fa-circle-check");
            icon.classList.add("fa-circle");

            outputInput.value = '';
            inputField.style.display = "none";
        }
    }


    function removeAllExpertiseCheckClasses() {
        const buttons = document.querySelectorAll(".btn.fs-expertise-check-btn-check");

        buttons.forEach(button => {
            let icon = button.querySelector("i");
            button.classList.remove("fs-expertise-check-btn-check");
            button.classList.add("fs-expertise-check-btn");
            icon.classList.remove("fa-solid");
            icon.classList.add("fa-regular");
            icon.classList.remove("fa-circle-check");
            icon.classList.add("fa-circle");
        });
    }

</script>
</body>
</html>
