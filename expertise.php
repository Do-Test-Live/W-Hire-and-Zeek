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
                        <i class="fa-regular fa-circle"></i> #Fine Art
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #Graphic Design
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #Web Development
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #UX Design
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn ms-3 mt-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #UI Design
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
                        <i class="fa-regular fa-circle"></i> #Film & Video
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
                        <i class="fa-regular fa-circle"></i> #Business & Management
                    </button>

                    <button class="btn btn-outline-success fs-expertise-check-btn mt-3 ms-3"
                            onclick="toggleButton(this)">
                        <i class="fa-regular fa-circle"></i> #Productivity
                    </button>
                </div>
                <div class="mb-3 mt-5 pt-5 text-center">
                    <form action="registration.php" method="post">
                        <?php
                        if (isset($_POST['registration'])) {
                        if ($_POST['role'] == 'Hirer') {

                            $email = $db_handle->checkValue($_POST['email']);
                            $password = $db_handle->checkValue($_POST['password']);
                            $role = $db_handle->checkValue($_POST['role']);
                            $inserted_at = date('Y-m-d h:i:s');

                            $query = "INSERT INTO `customer`( `email`, `password`, `role`,  `inserted_at`) VALUES ('$email','$password','$role','$inserted_at')";

                            $insert = $db_handle->insertQuery($query);

                        if ($insert) {
                            echo "<script>
                                            document.cookie = 'alert = 6;';
                                            window.location.href='login.php';
                                            </script>";
                        }
                        else {
                            ?>
                        <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>" required/>
                        <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>" required/>
                        <?php
                        }
                        }
                        }else{
                        ?>
                            <script>
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

        updateInputValue();
    }

    function updateInputValue() {
        outputInput.value = buttonTexts.join(", ");
    }

</script>

</body>
</html>
