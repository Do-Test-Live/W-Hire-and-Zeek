<?php
require_once('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['registration'])) {
    $email = strtolower($db_handle->checkValue($_POST['email']));
    $password = $db_handle->checkValue($_POST['password']);

    function productCode($length)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    $fetch_customer = $db_handle->runQuery("select * from customer where email = '$email'");
    $fetch_customer_no = $db_handle->numRows("select * from customer where email = '$email'");

    $code = productCode(4);

    if ($fetch_customer_no == 0) {


        $email_to = $email;
        $subject = 'Verify Email';

        $messege = "<!DOCTYPE html>
                <html>
                <head>
                    <title>Verify Your Email</title>
                </head>
                <body style='font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border-collapse: collapse; background-color: #ffffff;'>
                        <tr>
                            <td align='center' bgcolor='#007549' style='padding: 20px 0;'>
                                <h1 style='color: #ffffff;'>Verify Your Email</h1>
                            </td>
                        </tr>
                        <tr>
                            <td style='padding: 20px;'>
                                <p>Hello,</p>
                                <p>Thank you for signing up! To complete your registration, please click the button below to verify your email address:</p>
                                <p style='text-align: center;'>
                                    <span style='display: inline-block; padding: 10px 20px; background-color: #007549; color: #ffffff; text-decoration: none; border-radius: 5px;'>Verify Email with this code: $code
                                    </span>
                                </p>
                                <p>If you didn't sign up for this account, you can ignore this email.</p>
                            </td>
                        </tr>
                        <tr>
                            <td align='center' bgcolor='#007549' style='padding: 20px;'>
                                <p style='color: #ffffff; margin: 0;'>If you have any questions, please contact our support team.</p>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>
                ";

        $sender_name = "Hire & Zeek";
        $sender_email = "business@ngt.hk";
//
        $username = "business@ngt.hk";
        $password = "123Qweasd!@#";
//

        $receiver_email = $email_to;


        $mail = new PHPMailer(true);
        $mail->isSMTP();
//$mail->SMTPDebug = 2;
        $mail->Host = 'mail.ngt.hk';

        $mail->SMTPAuth = true;

        $mail->SMTPSecure = 'ssl';

        $mail->Port = 465;

        $mail->setFrom($sender_email, $sender_name);
        $mail->Username = $username;
        $mail->Password = $password;

        $mail->Subject = $subject;
        $mail->msgHTML($messege);
        $mail->addAddress($receiver_email);

        if ($mail->send()) {
            ?>
            <!doctype html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta content="width=device-width, initial-scale=1" name="viewport">
                <title>Verification Page - Hire & Zeek</title>
                <link href="assets/images/favicon.ico" rel="icon" type="image/ico"/>
                <link href="assets/vendor/Bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
                <link href="assets/vendor/FontAwesome/css/all.min.css" rel="stylesheet"/>
                <link href="assets/css/style.css" rel="stylesheet"/>
                <style>
                    .center-align-input {
                        text-align: center;
                    }
                </style>
            </head>
            <body>
            <div class="container-fluid">
                <div class="fs-verification-2">
                    <div class="row pt-5 login-interface">
                        <div class="col-12">
                            <div class="mt-5">
                                <h3 class="fs-lan-title mt-5 text-center">
                                    Verification Code
                                </h3>
                            </div>
                            <div class="text-center mt-5 mb-4">
                                <img alt="" class="img-fluid fs-mobile" src="assets/images/reset.webp"/>
                            </div>
                            <p class="fs-lan-caption mt-3 mb-4 text-center">
                                Please type the verification <br/>
                                code sent to <?php echo $_POST['email']; ?>
                            </p>
                        </div>
                        <div class="col-12">
                            <form action="registration.php" method="post">

                                <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>" required/>
                                <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>"
                                       required/>
                                <input type="hidden" name="code" value="<?php echo $code; ?>" required/>

                                <div class="mb-5">
                                    <div class="row">
                                        <div class="col-3 ps-2 pe-2">
                                            <input class="form-control fs-form-control center-align-input" name="one" maxlength="1" placeholder="" type="text" required>
                                        </div>
                                        <div class="col-3 ps-2 pe-2">
                                            <input class="form-control fs-form-control center-align-input" name="two" maxlength="1" placeholder="" type="text" required>
                                        </div>
                                        <div class="col-3 ps-2 pe-2">
                                            <input class="form-control fs-form-control center-align-input" name="three" maxlength="1" placeholder="" type="text" required>
                                        </div>
                                        <div class="col-3 ps-2 pe-2">
                                            <input class="form-control fs-form-control center-align-input" name="four" maxlength="1" placeholder="" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button name="registration" type="submit"
                                            class="btn btn-primary fs-lan-primary-btn w-100">Verify
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
            <script>
                const inputFields = document.querySelectorAll('.center-align-input');

                inputFields.forEach((input, index) => {
                    input.addEventListener('input', () => {
                        if (index < inputFields.length - 1 && input.value.length > 0) {
                            inputFields[index + 1].focus();
                        }
                    });
                });
            </script>
            </body>
            </html>
            <?php
        }
    } else {
        echo "<script>
            alert('Email already registered.');
            window.location.href='signup.php';
            </script>";
    }
} else {
    echo "<script>
            alert('Invalid Page');
            window.location.href='signup.php';
            </script>";
}
?>
