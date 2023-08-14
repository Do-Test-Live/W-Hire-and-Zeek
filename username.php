<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <title>Username Page - Hire & Zeek</title>
    <link href="assets/images/favicon.ico" rel="icon" type="image/ico"/>
    <link href="assets/vendor/Bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/vendor/FontAwesome/css/all.min.css" rel="stylesheet"/>
    <link href="assets/css/style.css" rel="stylesheet"/>
</head>
<body>
<div class="container-fluid">
    <div class="login-main">
        <div class="row pt-5 login-interface">
            <div class="col-12">
                <div class="text-center">
                    <img alt="" class="img-fluid" src="assets/images/logo.webp"/>
                </div>
                <div class="text-center mt-5 mb-3">
                    <div class="text-center mt-5 mb-3 d-flex justify-content-center align-items-center">
                        <div class="d-flex justify-content-center align-items-center fs-username-first">
                            <h1>J</h1>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <h3 class="fs-lan-title mt-3 text-center">
                        Welcome Jack!
                    </h3>
                    <p class="fs-lan-caption mt-3 mb-4">
                        Please not that a username cannot be changed once chosen
                    </p>
                </div>
            </div>
            <div class="col-12">
                <form action="expertise.php" method="post">
                    <?php
                    if (isset($_POST['submit'])) {
                        ?>
                        <input type="hidden" name="fname" value="<?php echo $_POST['fname']; ?>" required/>
                        <input type="hidden" name="surname" value="<?php echo $_POST['surname']; ?>" required/>
                        <input type="hidden" name="gender" value="<?php echo $_POST['gender']; ?>" required/>
                        <input type="hidden" name="dob" value="<?php echo $_POST['dob']; ?>" required/>
                        <input type="hidden" name="region" value="<?php echo $_POST['region']; ?>" required/>
                        <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>" required/>
                        <input type="hidden" name="password" value="<?php echo $_POST['password']; ?>" required/>
                        <?php
                    }else {
                        ?>
                        <script>
                            alert('Invalid page');
                            window.location.href = 'signup.php';
                        </script>
                        <?php
                    }
                    ?>
                    <div class="mb-3">
                        <input class="form-control fs-form-control" name="username" placeholder="Username" type="text" required>
                    </div>
                    <div class="mb-5">
                        <p>
                            <span class="fs-url">Suggestions:</span> Jack <span class="fs-url">/</span> Jack9 <span
                                    class="fs-url">/</span> Jack09
                        </p>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="registration" class="btn btn-primary fs-lan-primary-btn w-100">Next
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
    $(document).ready(function() {
        $('#usernameInput').on('keyup keydown', function() {
            let inputUsername = $(this).val();
            if (inputUsername.trim() !== '') {
                $.ajax({
                    type: 'POST',
                    url: 'check_availability.php',
                    data: { username: inputUsername,fname:<?php echo $_POST['fname']; ?>,lname: <?php echo $_POST['surname']; ?> },
                    dataType: 'json',
                    success: function(data) {
                        displaySuggestions(data.suggestions);
                    }
                });
            } else {
                $('#suggestions').empty();
            }
        });

        function displaySuggestions(suggestions) {
            let suggestionsDiv = $('#suggestions');
            suggestionsDiv.empty();

            if (suggestions.length > 0) {
                suggestionsDiv.append('<p>Suggested usernames:</p>');
                let ul = $('<ul>');
                suggestions.forEach(function(username) {
                    ul.append('<li>' + username + '</li>');
                });
                suggestionsDiv.append(ul);
            } else {
                suggestionsDiv.append('<p>No suggestions available.</p>');
            }
        }
    });
</script>
</body>
</html>
