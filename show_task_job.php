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
        <div aria-labelledby="tab1-tab" class="tab-pane fade show active" id="tab1" role="tabpanel">
            <div class="row">
                <?php
                $query = "SELECT * FROM company as c,job_post as j where c.id=j.company_id" . $query_add_on . " order by j.id desc";
                $data = $db_handle->runQuery($query);
                $row_count = $db_handle->numRows($query);
                for ($i = 0; $i < $row_count; $i++) {

                    $apply_job = $db_handle->numRows("select * from job_apply where job_id={$data[$i]['id']}");

                    if ($apply_job == 0) {
                        ?>
                        <div class="col-6 mt-3 all <?php echo ltrim($data[$i]["keywords"], $data[$i]["keywords"][0]); ?>">
                            <div class="card <?php echo ltrim($data[$i]["keywords"], $data[$i]["keywords"][0]); ?>">
                                <input type="checkbox" class="card-checkbox"
                                       value="<?php echo $data[$i]["id"]; ?>">
                                <div class="p-3">
                                    <img alt="" class="card-img-top fs-job-card-img"
                                         src="<?php echo $data[$i]["image"]; ?>">
                                    <p class="card-text card-sub-heading mt-2"><?php echo $data[$i]["name"]; ?></p>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title card-heading"><?php echo $data[$i]["job_title"]; ?></h5>
                                    <p class="card-text"><small
                                                class="text-muted">$<?php echo $data[$i]["salary"]; ?>
                                            HKD/<?php echo strtolower($data[$i]["salary_rate"]); ?></small></p>
                                    <div class="text-center mt-2">
                                        <button type="button" name="submit"
                                                class="btn btn-outline-success fs-skills-next-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop<?php echo $data[$i]["id"]; ?>">
                                            Detail
                                        </button>
                                    </div>

                                    <div class="modal fade"
                                         id="staticBackdrop<?php echo $data[$i]["id"]; ?>"
                                         data-bs-backdrop="static"
                                         data-bs-keyboard="false" tabindex="-1"
                                         aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header justify-content-center align-items-center">
                                                    <a class="text-decoration-none text-white card-checkbox"
                                                       data-bs-dismiss="modal"
                                                       aria-label="Close"><i
                                                                class="fa-solid fa-chevron-left"></i></a>
                                                    <?php
                                                    $favourite = $db_handle->numRows("select * from favorite where job_id={$data[$i]['id']}");
                                                    ?>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="job_id"
                                                               value="<?php echo $data[$i]["id"]; ?>"
                                                               required>
                                                        <button type="submit" name="favourite"
                                                                class="card-heart"><i
                                                                    class="fas fa-heart <?php if ($favourite % 2 == 1) echo 'text-danger'; ?>"></i>
                                                        </button>
                                                    </form>
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            <img src="<?php echo $data[$i]["image"]; ?>"
                                                                 class="img-fluid" alt=""
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
                                                    <div class="text-start">
                                                        <p>
                                                            <span class="badge text-bg-success">Salary/Rate:</span>
                                                            $<?php echo $data[$i]["salary"]; ?> HKD per
                                                            <?php echo strtolower($data[$i]["salary_rate"]); ?>
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
                                                        <input type="hidden" name="job_id"
                                                               value="<?php echo $data[$i]["id"]; ?>"
                                                               required>
                                                        <button type="submit"
                                                                class="btn btn-success fs-button-apply"
                                                                name="apply">Apply
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } ?>
            </div>
        </div>
        <div aria-labelledby="tab2-tab" class="tab-pane fade" id="tab2" role="tabpanel">
            <div class="row">
                <?php
                $query = "SELECT * FROM company as c,job_post as j where c.id=j.company_id order by j.id desc";
                $data = $db_handle->runQuery($query);
                $row_count = $db_handle->numRows($query);
                for ($i = 0; $i < $row_count; $i++) {

                    $apply_job = $db_handle->numRows("select * from job_apply where job_id={$data[$i]['id']} and customer_id='{$userId}'");
                    $favourite = $db_handle->numRows("select * from favorite where job_id={$data[$i]['id']} and customer_id='{$userId}'");

                    if ($apply_job == 0 && $favourite % 2 == 1) {
                        ?>
                        <div class="col-6 mt-3 all <?php echo ltrim($data[$i]["keywords"], $data[$i]["keywords"][0]); ?>">
                            <div class="card <?php echo ltrim($data[$i]["keywords"], $data[$i]["keywords"][0]); ?>">
                                <input type="checkbox" class="card-checkbox"
                                       value="<?php echo $data[$i]["id"]; ?>">
                                <div class="p-3">
                                    <img alt="" class="card-img-top fs-job-card-img"
                                         src="<?php echo $data[$i]["image"]; ?>">
                                    <p class="card-text card-sub-heading mt-2"><?php echo $data[$i]["name"]; ?></p>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title card-heading"><?php echo $data[$i]["job_title"]; ?></h5>
                                    <p class="card-text"><small
                                                class="text-muted">$<?php echo $data[$i]["salary"]; ?>
                                            HKD/<?php echo strtolower($data[$i]["salary_rate"]); ?></small></p>
                                    <div class="text-center mt-2">
                                        <button type="button" name="submit"
                                                class="btn btn-outline-success fs-skills-next-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop<?php echo $data[$i]["id"]; ?>">
                                            Detail
                                        </button>
                                    </div>

                                    <div class="modal fade"
                                         id="staticBackdrop<?php echo $data[$i]["id"]; ?>"
                                         data-bs-backdrop="static"
                                         data-bs-keyboard="false" tabindex="-1"
                                         aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header justify-content-center align-items-center">
                                                    <a class="text-decoration-none text-white card-checkbox"
                                                       data-bs-dismiss="modal"
                                                       aria-label="Close"><i
                                                                class="fa-solid fa-chevron-left"></i></a>
                                                    <?php
                                                    $favourite = $db_handle->numRows("select * from favorite where job_id={$data[$i]['id']}");
                                                    ?>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="job_id"
                                                               value="<?php echo $data[$i]["id"]; ?>"
                                                               required>
                                                        <button type="submit" name="favourite"
                                                                class="card-heart"><i
                                                                    class="fas fa-heart <?php if ($favourite % 2 == 1) echo 'text-danger'; ?>"></i>
                                                        </button>
                                                    </form>
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            <img src="<?php echo $data[$i]["image"]; ?>"
                                                                 class="img-fluid" alt=""
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
                                                    <div class="text-start">
                                                        <p>
                                                            <span class="badge text-bg-success">Salary/Rate:</span>
                                                            $<?php echo $data[$i]["salary"]; ?> HKD per
                                                            <?php echo strtolower($data[$i]["salary_rate"]); ?>
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
                                                        <input type="hidden" name="job_id"
                                                               value="<?php echo $data[$i]["id"]; ?>"
                                                               required>
                                                        <button type="submit"
                                                                class="btn btn-success fs-button-apply"
                                                                name="apply">Apply
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="" method="post">
                                        <input type="hidden" name="job_id"
                                               value="<?php echo $data[$i]["id"]; ?>" required>
                                        <button type="submit" name="favourite" class="card-heart"><i
                                                    class="fas fa-heart text-danger"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } ?>
            </div>
        </div>
        <div aria-labelledby="tab3-tab" class="tab-pane fade" id="tab3" role="tabpanel">
            <div class="row">
                <?php
                $query = "SELECT * FROM company as c,job_post as j where c.id=j.company_id order by j.id desc";
                $data = $db_handle->runQuery($query);
                $row_count = $db_handle->numRows($query);
                for ($i = 0; $i < $row_count; $i++) {

                    $apply_job = $db_handle->numRows("select * from job_apply where job_id={$data[$i]['id']} and customer_id='{$userId}'");
                    $favourite = $db_handle->numRows("select * from favorite where job_id={$data[$i]['id']} and customer_id='{$userId}'");

                    if ($apply_job == 1) {
                        ?>
                        <div class="col-6 mt-3 all <?php echo ltrim($data[$i]["keywords"], $data[$i]["keywords"][0]); ?>">
                            <div class="card <?php echo ltrim($data[$i]["keywords"], $data[$i]["keywords"][0]); ?>">
                                <input type="checkbox" class="card-checkbox"
                                       value="<?php echo $data[$i]["id"]; ?>" disabled>
                                <div class="p-3">
                                    <img alt="" class="card-img-top fs-job-card-img"
                                         src="<?php echo $data[$i]["image"]; ?>">
                                    <p class="card-text card-sub-heading mt-2"><?php echo $data[$i]["name"]; ?></p>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title card-heading"><?php echo $data[$i]["job_title"]; ?></h5>
                                    <p class="card-text"><small
                                                class="text-muted">$<?php echo $data[$i]["salary"]; ?>
                                            HKD/<?php echo strtolower($data[$i]["salary_rate"]); ?></small></p>
                                    <div class="text-center mt-2">
                                        <button type="button" name="submit"
                                                class="btn btn-outline-success fs-skills-next-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop<?php echo $data[$i]["id"]; ?>">
                                            Detail
                                        </button>
                                    </div>

                                    <div class="modal fade"
                                         id="staticBackdrop<?php echo $data[$i]["id"]; ?>"
                                         data-bs-backdrop="static"
                                         data-bs-keyboard="false" tabindex="-1"
                                         aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header justify-content-center align-items-center">
                                                    <a class="text-decoration-none text-white card-checkbox"
                                                       data-bs-dismiss="modal"
                                                       aria-label="Close"><i
                                                                class="fa-solid fa-chevron-left"></i></a>
                                                    <?php
                                                    $favourite = $db_handle->numRows("select * from favorite where job_id={$data[$i]['id']}");
                                                    ?>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="job_id"
                                                               value="<?php echo $data[$i]["id"]; ?>"
                                                               required>
                                                        <button type="submit" name="favourite"
                                                                class="card-heart"><i
                                                                    class="fas fa-heart <?php if ($favourite % 2 == 1) echo 'text-danger'; ?>"></i>
                                                        </button>
                                                    </form>
                                                    <div class="row">
                                                        <div class="col-12 text-center">
                                                            <img src="<?php echo $data[$i]["image"]; ?>"
                                                                 class="img-fluid" alt=""
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
                                                    <div class="text-start">
                                                        <p>
                                                            <span class="badge text-bg-success">Salary/Rate:</span>
                                                            $<?php echo $data[$i]["salary"]; ?> HKD per
                                                            <?php echo strtolower($data[$i]["salary_rate"]); ?>
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
                                            </div>
                                        </div>
                                    </div>
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
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } ?>
            </div>
        </div>
    <?php }
} ?>