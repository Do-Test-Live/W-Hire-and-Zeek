<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Signup Page - Hire & Zeek</title>
    <link href="assets/images/favicon.ico" rel="icon" type="image/ico"/>
    <link href="assets/vendor/Bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/vendor/FontAwesome/css/all.min.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
    <style>
        #message {
            display:none;
            color: #000;
            position: relative;
            padding: 20px;
            margin-top: 10px;
            font-size:10px;
        }

        #message p {
            padding: 10px 10px;
            font-size: 10px;
            margin:unset;
        }

        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            left: -35px;
            content: "✔";
            font-size: 10px;
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
            color: red;
        }

        .invalid:before {
            position: relative;
            left: -35px;
            content: "✖";
            font-size: 10px;
        }

        .icon-left {
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-align: left;
            padding: 10px 10px 10px 20px;
        }

        .icon-left i {
            margin-right: 10px;
        }

        .icon-left span {
            flex-grow: 1;
        }


    </style>
</head>
<body>
<div class="container-fluid">
    <div class="signup-main">
        <div class="row pt-5 login-interface">
            <div class="col-12">
                <div class="text-center">
                    <img alt="" class="img-fluid" src="assets/images/logo.webp"/>
                </div>
                <div class="mt-5">
                    <h3 class="fs-lan-title mt-3">
                        Create an account
                    </h3>
                    <p class="fs-lan-caption mt-3 mb-4">
                        Create your account, it takes less than a minute. Enter your email and password
                    </p>
                </div>
            </div>
            <div class="col-12">
                <form action="verification.php" method="post">
                    <div class="mb-3">
                        <input class="form-control fs-form-control" placeholder="Email" id="email" name="email" type="email" required>
                    </div>
                    <div class="mb-4">
                        <input class="form-control fs-form-control" placeholder="Password" id="password" name="password" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="registration" class="btn btn-primary fs-lan-primary-btn w-100">Create an Account</button>
                    </div>
                </form>
                <div id="message">
                    <h6>Password must contain the following:</h6>
                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                    <p id="number" class="invalid">A <b>number</b></p>
                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                </div>
                <div class="mb-3 mt-4">
                    <p class="fs-login-horizonal-line"><span>OR</span></p>
                </div>
                <div class="mb-3 mt-4">
                    <button type="button" class="btn btn-primary fs-secondary-btn w-100 icon-left">
                        <i class="fa-brands fa-google"></i> <span>Continue with Gmail</span>
                    </button>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary fs-secondary-btn w-100 icon-left">
                        <i class="fa-brands fa-facebook"></i> <span>Continue with Facebook</span>
                    </button>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary fs-secondary-btn w-100 icon-left">
                        <i class="fa-brands fa-apple"></i> <span>Continue with Apple</span>
                    </button>
                </div>

                <div class="pt-3 text-center">
                    <span class="text-decoration-none fs-url">Already have an account?</span> <a class="text-decoration-none text-dark" href="login.php">Login</a>
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
    let myInput = document.getElementById("password");
    let letter = document.getElementById("letter");
    let capital = document.getElementById("capital");
    let number = document.getElementById("number");
    let length = document.getElementById("length");

    // When the user clicks on the password field, show the message box
    myInput.onfocus = function() {
        document.getElementById("message").style.display = "block";
    }

    // When the user clicks outside of the password field, hide the message box
    myInput.onblur = function() {
        document.getElementById("message").style.display = "none";
    }

    // When the user starts to type something inside the password field
    myInput.onkeyup = function() {
        // Validate lowercase letters
        let lowerCaseLetters = /[a-z]/g;
        if(myInput.value.match(lowerCaseLetters)) {
            letter.classList.remove("invalid");
            letter.classList.add("valid");
        } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
        }

        // Validate capital letters
        let upperCaseLetters = /[A-Z]/g;
        if(myInput.value.match(upperCaseLetters)) {
            capital.classList.remove("invalid");
            capital.classList.add("valid");
        } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
        }

        // Validate numbers
        let numbers = /[0-9]/g;
        if(myInput.value.match(numbers)) {
            number.classList.remove("invalid");
            number.classList.add("valid");
        } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
        }

        // Validate length
        if(myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
        } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
        }
    }
</script>
</body>
</html>
