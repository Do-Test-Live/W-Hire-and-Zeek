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
            background-color: #1e3932;
            color: #ffffff;
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
                    <input type="hidden" id="selectedValues" name="job_category" required>
                    <div class="mb-3 mt-5">
                        <div class="row">
                            <div class="col-6">
                                <p class="fs-lan-caption">
                                    20 skills selected
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <button type="submit" class="btn btn-outline-success fs-skills-next-btn">
                                    Next
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
    const buttons = document.querySelectorAll('.btn');
    const selectedValuesInput = document.getElementById('selectedValues');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Toggle selected class for the clicked button
            button.classList.toggle('selected');

            // Get all selected buttons
            const selectedButtons = document.querySelectorAll('.btn.selected');

            // Get values from selected buttons and update input field
            const selectedValues = Array.from(selectedButtons).map(btn => btn.getAttribute('data-value')).join(', ');
            selectedValuesInput.value = selectedValues;
        });
    });
</script>
</body>
</html>
