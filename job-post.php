<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}
$userId = $_SESSION['userid'];

$company = $db_handle->numRows("SELECT * FROM `company` WHERE customer_id = '$userId'");

if($company==0){
    echo "<script>
                alert('Create Hirer profile First for post Job.');
                window.location.href='company-profile.php';
                </script>";
}

if (isset($_POST['jobPost'])) {
    $job_title = $db_handle->checkValue($_POST['job_title']);
    $job_description = $db_handle->checkValue($_POST['job_description']);
    $salary = $db_handle->checkValue($_POST['salary']);
    $job_type = $db_handle->checkValue($_POST['job_type']);
    $name = $db_handle->checkValue($_POST['name']);
    $address = $db_handle->checkValue($_POST['address']);
    $contact = $db_handle->checkValue($_POST['contact']);
    $keywords = $db_handle->checkValue($_POST['keywords']);

    $company_id=$db_handle->checkValue($_POST['company']);;

    $inserted_at = date('Y-m-d h:i:s');


    $query = "INSERT INTO `job_post`(`customer_id`,`company_id`,`job_title`, `job_description`, `salary`, `job_type`, `contact_name`, `address`, `contact`, `keywords`, `inserted_at`) VALUES ('$userId','$company_id','$job_title','$job_description','$salary','$job_type','$name','$address','$contact','$keywords','$inserted_at')";

    $insert = $db_handle->insertQuery($query);

    if ($insert) {
        echo "<script>
                document.cookie = 'alert = 7;';
                window.location.href='jobs.php';
                </script>";
    } else {
        echo "<script>
                document.cookie = 'alert = 5;';
                window.location.href='job-post.php';
                </script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Job Post- Hire & Zeek</title>
    <link href="assets/images/favicon.ico" rel="icon" type="image/ico"/>
    <link href="assets/vendor/Bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/vendor/FontAwesome/css/all.min.css" rel="stylesheet"/>
    <link href="assets/vendor/toastr/css/toastr.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
</head>
<body>
<div class="container-fluid">
    <div class="job-post-main">
        <div class="row pt-5 login-interface">
            <div class="col-12">
                <div class="text-center">
                    <img alt="" class="img-fluid" src="assets/images/logo.webp"/>
                </div>
                <div class="mt-5">
                    <h3 class="fs-lan-title mt-3 mb-4">
                        Job Post
                    </h3>
                </div>
            </div>
            <div class="col-12">
                <form method="post" action="">
                    <div class="mb-3">
                        <input class="form-control fs-form-control" placeholder="Job Title" type="text" name="job_title" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control fs-form-control" name="job_description" placeholder="Job Description..." rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <input class="form-control fs-form-control" placeholder="Salary/Rate" type="number" name="salary" required>
                    </div>
                    <div class="mb-3">
                        <select class="form-select fs-form-control" aria-label="Default select example" name="job_type" required>
                            <option value="Full-Time" selected>Full-Time</option>
                            <option value="Part-Time">Part-Time</option>
                            <option value="Freelance">Freelance</option>
                            <option value="Project-Based">Project Based</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select class="form-select fs-form-control" aria-label="Default select example" name="company" required>
                            <?php
                            $query = "select * from company where customer_id = '$userId'";
                            $data = $db_handle->runQuery($query);
                            $row_count = $db_handle->numRows($query);
                            for ($i = 0; $i < $row_count; $i++) {
                            ?>
                                <option value="<?php echo $data[$i]['id']; ?>"><?php echo $data[$i]['name']; ?></option>
                                <?php

                            } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <input class="form-control fs-form-control" placeholder="Contact Name" type="text" name="name" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control fs-form-control" placeholder="Contact Address" type="text" name="address" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control fs-form-control" placeholder="Contact Number" type="text" name="contact" required>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #illustration
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Photography
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Fine Art
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Graphic Design
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Web Development
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #UX Design
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #UI Design
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Animation
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Lifestyle
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Film & Video
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Music
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Marketing
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Business & Management
                        </button>

                        <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3" type="button" onclick="toggleButton(this)">
                            <i class="fa-regular fa-circle"></i> #Productivity
                        </button>

                        <input type="hidden" id="outputInput" name="keywords" required>
                    </div>
                    <div class="mb-5 pb-5">
                        <button type="submit" name="jobPost" class="btn btn-primary fs-lan-primary-btn w-100">Submit</button>
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
    let buttonTexts = [];
    let outputInput = document.getElementById("outputInput");

    function toggleButton(button) {
        let icon = button.querySelector("i");
        let buttonText = button.textContent.trim();

        if (button.classList.contains("fs-expertise-check-btn")) {
            button.classList.remove("fs-expertise-check-btn");
            button.classList.add("fs-expertise-check-btn-check");

            icon.classList.remove("fa-regular");
            icon.classList.add("fa-solid");
            icon.classList.remove("fa-circle");
            icon.classList.add("fa-circle-check");

            buttonTexts.push(buttonText);
        } else {
            button.classList.remove("fs-expertise-check-btn-check");
            button.classList.add("fs-expertise-check-btn");

            icon.classList.remove("fa-solid");
            icon.classList.add("fa-regular");
            icon.classList.remove("fa-circle-check");
            icon.classList.add("fa-circle");

            let index = buttonTexts.indexOf(buttonText);
            if (index !== -1) {
                buttonTexts.splice(index, 1);
            }
        }

        if (buttonTexts.length > 2) {
            alert("You can select up to three keywords. Currently selected: " + buttonTexts.length);
        } else {
            updateInputValue();
        }
    }

    function updateInputValue() {
        outputInput.value = buttonTexts.join(", ");
    }

</script>
</body>
</html>
