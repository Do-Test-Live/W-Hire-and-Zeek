<?php
require_once('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");

if (isset($_POST['jobPost'])) {
    $job_title = $db_handle->checkValue($_POST['job_title']);
    $job_description = $db_handle->checkValue($_POST['job_description']);
    $salary = $db_handle->checkValue($_POST['salary']);
    $job_type = $db_handle->checkValue($_POST['job_type']);
    $address = $db_handle->checkValue($_POST['address']);
    $contact = $db_handle->checkValue($_POST['contact']);
    $keywords = $db_handle->checkValue($_POST['keywords']);

    $inserted_at = date('Y-m-d h:i:s');


    $query = "INSERT INTO `job_post`(`company_id`,`job_title`, `job_description`, `salary`, `job_type`, `address`, `contact`, `keywords`, `inserted_at`) VALUES ('2','$job_title','$job_description','$salary','$job_type','$address','$contact','$keywords','$inserted_at')";

    $insert = $db_handle->insertQuery($query);

    if ($insert) {
        echo "<script>
                document.cookie = 'alert = 7;';
                window.location.href='job-post.php';
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
    <title>Login Page - Hire & Zeek</title>
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
                        <input class="form-control fs-form-control" placeholder="Job type" type="text" name="job_type" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control fs-form-control" placeholder="Address" type="text" name="address" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control fs-form-control" placeholder="Contact" type="text" name="contact" required>
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
                    <div class="mb-3">
                        <button type="submit" name="jobPost" class="btn btn-primary fs-lan-primary-btn w-100">Submit</button>
                    </div>
                </form>
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