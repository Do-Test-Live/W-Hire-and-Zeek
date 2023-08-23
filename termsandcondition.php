<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
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
</head>
<body>
<div class="container-fluid">
    <div class="fs-termsandcondition pb-5">
        <div class="row login-interface">
            <div class="col-12 fs-primary-color pb-5 pt-3">
                <h3>Welcome to Hire & Zeek!</h3>
                <p>These Terms and Conditions ("Terms") outline the rules and regulations for the use of our job posting
                    and hiring
                    website ("App/Website"). By accessing or using the App/Website, you agree to abide by these Terms.
                    Please read them
                    carefully before using the App/Website.</p>

                <h3><b>1.</b> Acceptance of Terms</h3>
                <p>By accessing or using the App/Website, you acknowledge that you have read, understood, and agreed to
                    these Terms,
                    as well as our Privacy Policy. If you do not agree with any part of these Terms, you must not use
                    the
                    App/Website.</p>

                <h3><b>2.</b> User Accounts</h3>
                <p><b>2.1.</b> To access certain features of the App/Website, you may be required to create an account.
                    You are responsible
                    for maintaining the confidentiality of your account information and password, and you agree to
                    accept
                    responsibility for all activities that occur under your account.</p>
                <p><b>2.2.</b> You agree to provide accurate, current, and complete information during the registration
                    process and to update
                    such information to keep it accurate, current, and complete.</p>

                <h3><b>3.</b> User Responsibilities</h3>
                <p><b>3.1.</b> You agree to use the App/Website only for lawful purposes and in accordance with these
                    Terms.</p>
                <p><b>3.2.</b> You are solely responsible for the content you post on the App/Website, including job
                    listings, company
                    information, and any other content. You warrant that any content you post does not infringe upon the
                    rights of any
                    third party and is accurate and up-to-date.</p>

                <h3><b>4.</b> Job Listings and Applications</h3>
                <p><b>4.1.</b> Job listings posted on the App/Website must be accurate and not misleading. Companies
                    posting job listings
                    are responsible for the accuracy of the information provided.</p>
                <p><b>4.2.</b> Job applicants are responsible for the accuracy of the information they submit when
                    applying for jobs through
                    the App/Website.</p>

                <h3><b>5.</b> Prohibited Activities</h3>
                <p>You must not:</p>
                <p><b>5.1.</b> Use the App/Website for any illegal or unauthorized purpose.</p>
                <p><b>5.2.</b> Post false, misleading, or fraudulent information.</p>
                <p><b>5.3.</b> Harass, bully, or discriminate against other users.</p>
                <p><b>5.4.</b> Use automated scripts or bots to access the App/Website or collect information.</p>
                <p><b>5.5.</b> Impersonate another person or entity.</p>

                <h3><b>6.</b> Intellectual Property</h3>
                <p><b>6.1.</b> The content on the App/Website, including text, graphics, logos, and software, is
                    protected by copyright,
                    trademark, and other intellectual property laws.</p>
                <p><b>6.2.</b> You may not reproduce, distribute, modify, create derivative works of, publicly display,
                    or use any of the
                    content without our prior written consent.</p>

                <h3><b>7.</b> Termination</h3>
                <p>We reserve the right to suspend or terminate your account and access to the App/Website at our sole
                    discretion,
                    without prior notice or liability, for any reason.</p>

                <h3><b>8.</b> Disclaimer of Warranty</h3>
                <p>The App/Website is provided "as is" and "as available" without warranties of any kind, either express
                    or implied,
                    including, but not limited to, implied warranties of merchantability, fitness for a particular
                    purpose, or
                    non-infringement.</p>

                <h3><b>9.</b> Limitation of Liability</h3>
                <p>To the fullest extent permitted by applicable law, in no event shall Hire & Zeek or its affiliates,
                    partners,
                    directors, officers, employees, or agents be liable for any indirect, incidental, special,
                    consequential, or
                    punitive damages.</p>

                <h3><b>10.</b> Governing Law</h3>
                <p>These Terms shall be governed by and construed in accordance with the laws of <b>[Jurisdiction]</b>,
                    without regard to
                    its conflict of law principles.</p>

                <h3><b>11.</b> Changes to Terms</h3>
                <p>We reserve the right to modify or replace these Terms at any time. Your continued use of the
                    App/Website after any
                    such changes constitutes your acceptance of the new Terms.</p>

                <h3><b>12.</b> Contact Information</h3>
                <p>If you have any questions about these Terms, please contact us at <a
                            href="mailto:contact@hireandzeek.com">contact@hireandzeek.com</a>.</p>

                <p>By using Hire & Zeek, you agree to these Terms and our Privacy Policy. Thank you for using our
                    App/Website!</p>

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
</div>


<script src="assets/vendor/Bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jQuery/jquery-3.6.4.min.js"></script>
<script src="assets/vendor/OwlCarousel/js/owl.carousel.min.js"></script>
<script src="assets/vendor/toastr/js/toastr.min.js" type="text/javascript"></script>
<script src="assets/js/toastr-init.js" type="text/javascript"></script>
<script src="assets/js/main.js"></script>
</body>
</html>
