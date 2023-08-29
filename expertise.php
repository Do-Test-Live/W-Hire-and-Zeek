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
    <title>Expertise Page - Hire & Zeek</title>
    <link href="assets/images/favicon.ico" rel="icon" type="image/ico"/>
    <link href="assets/vendor/Bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/vendor/FontAwesome/css/all.min.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="expertise-main">
        <div class="row pt-5 expertise-interface">
            <div class="col-12">
                <div class="mt-5">
                    <h3 class="fs-lan-title mt-3">
                        What are your expertises?
                    </h3>
                    <p class="fs-lan-caption mt-3 mb-4">
                        Select category
                    </p>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                    <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #illustration
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #Photography
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #FineArt
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #GraphicDesign
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #WebDevelopment
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #UXDesign
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #UIDesign
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #Animation
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #Lifestyle
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #Film&Video
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #Music
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #Marketing
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #Business&Management
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #Productivity
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3"
                            onclick="othersButton(this)">
                        <i class="fa-regular fa-circle"></i> #Others
                    </button>
                    <div class="hidden mt-3" id="othersInput">
                        <input type="text" class="form-control" onkeyup="othersValue(this.value);" onkeydown="othersValue(this.value);" value="" name="others"/>
                    </div>
                </div>
                <div class="mb-3 mt-5 pt-5 text-center">
                    <form action="skills.php" method="post">
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

                        <input type="hidden" id="outputInput" name="keywords" required>

                        <button class="btn btn-primary fs-arrow-btn w-75" type="submit" name="registration">
                            <span class="btn-text">Continue</span>
                            <i class="fas fa-arrow-right arrow-icon"></i>
                        </button>
                    </form>
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
        } else {
            button.classList.remove("fs-expertise-check-btn-check");
            button.classList.add("fs-expertise-check-btn");

            icon.classList.remove("fa-solid");
            icon.classList.add("fa-regular");
            icon.classList.remove("fa-circle-check");
            icon.classList.add("fa-circle");

            outputInput.value = '';
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
