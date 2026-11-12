<?php

include '../connection.php';


// Get ID from URL

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


// Check ID

if ($id <= 0) {
    header("Location: reservation.php");
    exit;
}


// Get reservation from database

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM reservations WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


// Check reservation exists

if (mysqli_num_rows($result) == 0) {

    header("Location: reservation.php");
    exit;

}


$reservation = mysqli_fetch_assoc($result);

?>


<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>


<?php include '../common/header.php'; ?>


<body>


<div class="layout-wrapper layout-content-navbar">

    <div class="layout-container">


        <!-- ================= SIDEBAR ================= -->

        <?php include '../common/sidebar.php'; ?>

        <!-- ================= / SIDEBAR ================= -->


        <!-- ================= PAGE ================= -->

        <div class="layout-page">


            <!-- ================= NAVBAR ================= -->

            <?php include '../common/navbar.php'; ?>

            <!-- ================= / NAVBAR ================= -->


            <!-- ================= CONTENT ================= -->

            <div class="content-wrapper">


                <div class="card shadow-sm m-4">


                    <div class="card-body">

                        <div class="row g-4">


                            <!-- Name -->

                            <div class="col-lg-6">

                                <label class="form-label fw-bold">
                                    Customer Name
                                </label>

                                <div class="form-control bg-light">

                                    <?php
                                    echo htmlspecialchars(
                                        $reservation['name']
                                    );
                                    ?>

                                </div>

                            </div>


                            <!-- Email -->

                            <div class="col-lg-6">

                                <label class="form-label fw-bold">
                                    Email
                                </label>

                                <div class="form-control bg-light">

                                    <?php
                                    echo htmlspecialchars(
                                        $reservation['email']
                                    );
                                    ?>

                                </div>

                            </div>


                            <!-- Reservation Date -->

                            <div class="col-lg-6">

                                <label class="form-label fw-bold">
                                    Reservation Date
                                </label>

                                <div class="form-control bg-light">

                                    <?php
                                    echo date(
                                        'd M Y',
                                        strtotime(
                                            $reservation['reservation_date']
                                        )
                                    );
                                    ?>

                                </div>

                            </div>


                            <!-- Reservation Time -->

                            <div class="col-lg-6">

                                <label class="form-label fw-bold">
                                    Reservation Time
                                </label>

                                <div class="form-control bg-light">

                                    <?php
                                    echo date(
                                        'h:i A',
                                        strtotime(
                                            $reservation['reservation_time']
                                        )
                                    );
                                    ?>

                                </div>

                            </div>


                            <!-- Number of People -->

                            <div class="col-lg-6">

                                <label class="form-label fw-bold">
                                    Number of People
                                </label>

                                <div class="form-control bg-light">

                                    <?php
                                    echo (int)$reservation['no_of_people'];
                                    ?>

                                    People

                                </div>

                            </div>


                            <!-- Created At -->

                            <div class="col-lg-6">

                                <label class="form-label fw-bold">
                                    Reservation Created At
                                </label>

                                <div class="form-control bg-light">

                                    <?php
                                    echo date(
                                        'd M Y h:i A',
                                        strtotime(
                                            $reservation['created_at']
                                        )
                                    );
                                    ?>

                                </div>

                            </div>


                            <!-- Special Request -->

                            <div class="col-12">

                                <label class="form-label fw-bold">
                                    Special Request
                                </label>

                                <div class="form-control bg-light">

                                    <?php
                                    echo htmlspecialchars(
                                        $reservation['special_request']
                                    );
                                    ?>

                                </div>

                            </div>


                            <!-- Back -->

                            <div class="col-12">

                                <a
                                    href="reservation.php"
                                    class="btn btn-secondary"
                                >

                                    <i class="fa-solid fa-xmark"></i>

                                    Back

                                </a>

                            </div>


                        </div>

                    </div>

                </div>


            </div>

            <!-- ================= / CONTENT ================= -->


        </div>

        <!-- ================= / PAGE ================= -->


    </div>

</div>


<!-- ================= SNEAT JS ================= -->

<script src="../assets/vendor/libs/jquery/jquery.js"></script>

<script src="../assets/vendor/js/bootstrap.js"></script>

<script src="../assets/vendor/js/menu.js"></script>

<script src="../assets/js/main.js"></script>


</body>

</html>