<?php
session_start();
require_once('include/dbController.php');
$db_handle = new DBController();
date_default_timezone_set("Asia/Hong_Kong");
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
}
$userId = $_SESSION['userid'];

$query_add_on = '';
if (isset($_GET['keywords'])) {
    $keywords = $_GET['keywords'];
    if (!empty($keywords)) {
        $query_add_on = " AND j.keywords LIKE '%" . $keywords . "%'";
    }
}

$query = "SELECT * FROM company AS c, job_post AS j WHERE c.id = j.company_id" . $query_add_on . " ORDER BY j.id DESC";

$data = $db_handle->runQuery($query);
$row_count = $db_handle->numRows($query);
for ($i = 0; $i < $row_count; $i++) {

    $apply_job = $db_handle->numRows("select * from job_apply where job_id={$data[$i]['id']}");

    if ($apply_job == 0) {
        ?>

        <div class="row ms-1 me-1">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-4 p-2 d-flex justify-content-center align-items-center"
                         style="background: #383b40;">
                        <div>
                            <img alt="..." class="img-fluid" src="<?php echo $data[$i]["image"]; ?>"
                                 style="border: 3px solid white;border-radius: 15px;">
                            <p class="text-white text-center mt-2"
                               style="font-family: 'DMSans-Bold', serif;"><?php echo $data[$i]["name"]; ?></p>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $data[$i]["job_title"]; ?></h5>
                            <p class="card-text"><small class="text-muted"><img alt="Flag of Country"
                                                                                src="assets/images/12/hk.webp"
                                                                                style="width: 15px;"> <?php echo $data[$i]["address"]; ?>
                                </small>
                            </p>
                            <p class="card-text"><span
                                        class="price">$<?php echo $data[$i]["salary"]; ?> HKD</span><small
                                        class="text-muted"> per
                                    <?php echo strtolower($data[$i]["salary"]); ?></small></p>
                            <p class="card-text"><small
                                        class="text-muted"><?php echo $data[$i]["keywords"]; ?></small>
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button class="btn price-button" type="button" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop<?php echo $data[$i]["id"]; ?>">
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="staticBackdrop<?php echo $data[$i]["id"]; ?>"
             data-bs-backdrop="static"
             data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header justify-content-center align-items-center">
                        <a class="text-decoration-none text-white card-checkbox" data-bs-dismiss="modal"
                           aria-label="Close"><i class="fa-solid fa-chevron-left"></i></a>
                        <?php
                        $favourite = $db_handle->numRows("select * from favorite where job_id={$data[$i]['id']}");
                        ?>
                        <form action="" method="post">
                            <input type="hidden" name="job_id"
                                   value="<?php echo $data[$i]["id"]; ?>" required>
                            <button type="submit" name="favourite" class="card-heart"><i
                                        class="fas fa-heart <?php if ($favourite % 2 == 1) echo 'text-danger'; ?>"></i>
                            </button>
                        </form>
                        <div class="row">
                            <div class="col-12 text-center">
                                <img src="<?php echo $data[$i]["image"]; ?>" class="img-fluid" alt=""
                                     style="border: 3px solid white;border-radius: 15px;"/>
                            </div>
                            <div class="col-12">
                                <h1 class="text-center text-white mt-3"
                                    style="font-family: 'DMSans-Bold', serif;"><?php echo $data[$i]["name"]; ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-center"><?php echo $data[$i]["job_title"]; ?></h2>
                        <p>
                            <?php echo $data[$i]["job_description"]; ?>
                        </p>
                        <div>
                            <p>
                                <span class="badge text-bg-success">Salary/Rate:</span>
                                $<?php echo $data[$i]["salary"]; ?> HKD
                                per <?php echo strtolower($data[$i]["salary"]); ?>
                            </p>
                            <p>
                                <span class="badge text-bg-success">Job type:</span> <?php echo $data[$i]["job_type"]; ?>
                            </p>
                            <p>
                                <span class="badge text-bg-success">Address:</span> <?php echo $data[$i]["address"]; ?>
                            </p>
                            <p>
                                <span class="badge text-bg-success">Contact:</span> <?php echo $data[$i]["contact"]; ?>
                            </p>
                            <p>
                                <span class="badge text-bg-success">Rating:</span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: unset">
                        <form action="" method="post">
                            <input type="hidden" name="job_id" value="<?php echo $data[$i]["id"]; ?>"
                                   required>
                            <button type="submit" class="btn btn-success fs-button-apply" name="apply">
                                Apply
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} ?>