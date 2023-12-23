<?php
require_once('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['submit'])) {

    $username = $db_handle->checkValue($_POST['username']);
    $email = $db_handle->checkValue($_POST['email']);
    $password = $db_handle->checkValue($_POST['password']);
    $surname = $db_handle->checkValue($_POST['surname']);
    $fname = $db_handle->checkValue($_POST['fname']);
    $dob = $db_handle->checkValue($_POST['dob']);
    $gender = $db_handle->checkValue($_POST['gender']);
    $region = $db_handle->checkValue($_POST['region']);
    $keywords = $db_handle->checkValue($_POST['keywords']);
    $job_category= $db_handle->checkValue($_POST['job_category']);
    $inserted_at = date('Y-m-d h:i:s');


    $query = "INSERT INTO `customer`(`fname`,  `surname`,`username`, `email`, `password`, `dob`, `gender`, `region`, `keywords`, `job_category`, `inserted_at`) VALUES ('$fname','$surname','$username','$email','$password','$dob','$gender','$region','$keywords','$job_category','$inserted_at')";

    $insert = $db_handle->insertQuery($query);


    $email_to = $db_handle->notify_email();
    $subject = 'Email From Hire and Zeek';



    $messege = "<!DOCTYPE html>
                <html lang='en'>
                    <head>
                        <meta charset='UTF-8'>
                        <title>Registration</title>
                    </head>
                    <body style='font-family: Arial, sans-serif; background-color: #f4f4f4;'>
                        <table cellpadding='0' cellspacing='0' width='100%' style='max-width: 600px; margin: 0 auto;'>
                            <tr>
                                <td bgcolor='#ffffff' style='padding: 20px; text-align: center; color: #ffffff;'>
                                    <img src='https://hireandzeek.com/assets/images/logo.png' alt='' style='max-height:80px'>
                                </td>
                            </tr>
                            <tr>
                                <td style='background-color: #ffffff; padding: 20px;'>
                                    <h1 style='color: #333;text-align: center;'>Thank You for Registering!</h1>
                                    <p style='color: #666;'>Dear User,</p>
                                    <p style='color: #666;'>Thank you for registering on our website. We are excited to have you join our community!</p>
                                    <p style='color: #666;'>Please feel free to explore our website and take advantage of all the features we offer.</p>
                                    <p style='color: #666;'>Best regards,<br/>Hire and Zeek</p>
                                    <p style='color: #940000;text-align: center;margin-top: 3rem'>This email was sent automatically. Please do not reply.</p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor='#007549' style='padding: 20px; text-align: center; color: #ffffff;'>
                                    <p>Email: <a href='mailto:business@hireandzeek.com' style='text-decoration: none;color: white;'>business@hireandzeek.com</a></p>
                                    <p>Copyright 2023 by Hire and ZeeK | Powered by <a href='https://ngt.hk' style='text-decoration: none;color: white;'>ngt-tech.io</a></p>
                                </td>
                            </tr>
                        </table>
                    </body>
                </html>
                ";

    $sender_name = "Hire and Zeek";
    $sender_email = "business@hireandzeek.com";
//
    $username = "business@hireandzeek.com";
    $password = "c131?6m~1rmq";
//
    $receiver_email = $email_to;


    $mail = new PHPMailer(true);
    $mail->isSMTP();

    $mail->Host = 'mail.hireandzeek.com';

    $mail->SMTPAuth = true;

    $mail->SMTPSecure = 'ssl';

    $mail->Port = 465;

    $mail->setFrom($sender_email, $sender_name);
    $mail->Username = $username;
    $mail->Password = $password;

    $mail->Subject = $subject;
    $mail->msgHTML($messege);
    $mail->addAddress($receiver_email);


    if ($mail->send()&&$insert) {
        echo "<script>
                document.cookie = 'alert = 6;';
                window.location.href='login.php';
                </script>";
    } else {
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
    <title>Skills Page - Hire & Zeek</title>
    <link href="assets/images/favicon.ico" rel="icon" type="image/ico"/>
    <link href="assets/vendor/Bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/vendor/FontAwesome/css/all.min.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
    <style>
        .selected {
            background-color: #1e3932 !important;
            color: #ffffff !important;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="skills-main">
        <div class="row pt-3 expertise-interface">
            <div class="col-12">
                <div class="mt-3">
                    <a href="signup.php" class="text-decoration-none"><i class="fa-solid fa-chevron-left fs-primary-color"></i></a>
                    <h1 class="fs-lan-title mt-5">
                       Top us you top skills
                    </h1>
                    <p class="fs-lan-caption mt-3 mb-3">
                        This helps us recommend jobs for you.
                    </p>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <h3 class="fs-lan-title">
                        Select a category
                    </h3>
                    <hr/>
                </div>
                <div class="mb-3">
                    <button class="btn fs-skills-btn w-100" data-value="Ad-Hoc">
                        <span class="btn-text">1. Ad-Hoc</span>
                        <i class="fa-solid fa-chevron-right arrow-icon"></i>
                    </button>
                </div>
                <div class="mb-3">
                    <button class="btn fs-skills-btn w-100" data-value="Long term">
                        <span class="btn-text">2. Long term</span>
                        <i class="fa-solid fa-chevron-right arrow-icon"></i>
                    </button>
                </div>
                <div class="mb-3">
                    <button class="btn fs-skills-btn w-100" data-value="Short term">
                        <span class="btn-text">3. Short term</span>
                        <i class="fa-solid fa-chevron-right arrow-icon"></i>
                    </button>
                </div>
                <div class="mb-3">
                    <button class="btn fs-skills-btn w-100" data-value="Full-Time">
                        <span class="btn-text">4. Full-Time</span>
                        <i class="fa-solid fa-chevron-right arrow-icon"></i>
                    </button>
                </div>
                <div class="mb-3">
                    <button class="btn fs-skills-btn w-100" data-value="Part-Time">
                        <span class="btn-text">5. Part-Time</span>
                        <i class="fa-solid fa-chevron-right arrow-icon"></i>
                    </button>
                </div>
                <div class="mb-3">
                    <button class="btn fs-skills-btn w-100" data-value="Freelance">
                        <span class="btn-text">6. Freelance</span>
                        <i class="fa-solid fa-chevron-right arrow-icon"></i>
                    </button>
                </div>
                <hr/>
                <form action="" method="post">
                    <?php
                    if (isset($_POST['registration'])) {
                        ?>
                    <input type="hidden" name="username" value="<?php echo $_POST['username']; ?>" required/>
                    <input type="hidden" name="fname" value="<?php echo $_POST['fname']; ?>" required/>
                    <input type="hidden" name="surname" value="<?php echo $_POST['surname']; ?>" required/>
                    <input type="hidden" name="gender" value="<?php echo $_POST['gender']; ?>" required/>
                    <input type="hidden" name="dob" value="<?php echo $_POST['dob']; ?>" required/>
                    <input type="hidden" name="region" value="<?php echo $_POST['region']; ?>" required/>
                    <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>" required/>
                    <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>" required/>
                    <input type="hidden" name="keywords" value="<?php echo $_POST['keywords']; ?>" required/>
                    <?php

                    } else {
                    ?>
                        <script>
                            alert('Invalid page');
                            window.location.href = 'signup.php';
                        </script>
                        <?php
                    }
                    ?>
                    <input type="hidden" id="selectedValues" name="job_category" required>
                    <div class="mb-3 mt-5">
                        <div class="row">
                            <div class="col-6">
                                <p class="fs-lan-caption" id="result">
                                    0 skills selected
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <button type="submit" name="submit" class="btn btn-outline-success fs-skills-next-btn">
                                    Submit
                                </button>
                            </div>
                        </div>
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
<script>
    const buttons = document.querySelectorAll('.fs-skills-btn');
    const selectedValuesInput = document.getElementById('selectedValues');
    const resultDisplay = document.getElementById("result");
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Toggle selected class for the clicked button
            button.classList.toggle('selected');

            // Get all selected buttons
            const selectedButtons = document.querySelectorAll('.btn.selected');

            // Get values from selected buttons and update input field
            const selectedValues = Array.from(selectedButtons).map(btn => btn.getAttribute('data-value')).join(', ');
            selectedValuesInput.value = selectedValues;

            const selectedCount = selectedButtons.length;
            resultDisplay.textContent = `${selectedCount} skills selected`;
        });
    });
</script>
</body>
</html>
