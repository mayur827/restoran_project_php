<?php

include '../connection.php';


// ================= GET RESERVATION ID =================

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


// ================= CHECK ID =================

if ($id <= 0) {
    header("Location: reservation.php");
    exit;
}


// ================= GET RESERVATION =================

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM reservations WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


// ================= CHECK RESERVATION =================

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


<body data-restaurant-page="reservation">


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


                <div class="container-xxl flex-grow-1 container-p-y">


                    <!-- ================= PAGE HEADER ================= -->

                    <div class="card shadow-sm mb-4">

                        <div class="card-body">

                            <h4 class="fw-bold mb-1">
                                Reservation Details
                            </h4>

                            <p class="text-muted mb-0">
                                View customer reservation information
                            </p>

                        </div>

                    </div>


                    <!-- ================= RESERVATION DETAILS ================= -->

                    <div class="card shadow-sm">


                        <div class="card-header">

                            <h5 class="mb-0">
                                Customer Reservation
                            </h5>

                        </div>


                        <div class="card-body">


                            <div class="row g-4">


                                <!-- ================= RESERVATION ID ================= -->

                                <div class="col-lg-6">

                                    <label class="form-label fw-bold">
                                        Reservation ID
                                    </label>

                                    <div class="form-control bg-light">

                                        <?php
                                        echo (int)$reservation['id'];
                                        ?>

                                    </div>

                                </div>


                                <!-- ================= CUSTOMER NAME ================= -->

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


                                <!-- ================= EMAIL ================= -->

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


                                <!-- ================= RESERVATION DATE ================= -->

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


                                <!-- ================= RESERVATION TIME ================= -->

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


                                <!-- ================= NUMBER OF PEOPLE ================= -->

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


                                <!-- ================= CREATED AT ================= -->

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


                                <!-- ================= SPECIAL REQUEST ================= -->

                                <div class="col-lg-12">

                                    <label class="form-label fw-bold">
                                        Special Request
                                    </label>

                                    <div
                                        class="form-control bg-light"
                                        style="min-height: 80px;"
                                    >

                                        <?php

                                        if (
                                            !empty(
                                                $reservation['special_request']
                                            )
                                        ) {

                                            echo nl2br(
                                                htmlspecialchars(
                                                    $reservation['special_request']
                                                )
                                            );

                                        } else {

                                            echo '<span class="text-muted">
                                                    No special request
                                                  </span>';

                                        }

                                        ?>

                                    </div>

                                </div>


                                <!-- ================= BACK BUTTON ================= -->

                                <div class="col-12">

                                    <a
                                        href="reservation.php"
                                        class="btn btn-secondary"
                                    >

                                        <i class="bx bx-arrow-back me-1"></i>

                                        Back

                                    </a>


                                    <!-- EDIT BUTTON -->

                                    <a
                                        href="edit.php?id=<?php echo (int)$reservation['id']; ?>"
                                        class="btn btn-warning ms-2"
                                    >

                                        <i class="bx bx-edit me-1"></i>

                                        Edit Reservation

                                    </a>

                                </div>


                            </div>


                        </div>

                    </div>


                </div>


                <!-- ================= FOOTER ================= -->

                <footer class="content-footer footer bg-footer-theme">

                    <div
                        class="container-xxl d-flex flex-wrap justify-content-between py-2"
                    >

                        <div class="mb-2 mb-md-0">

                            © 2026 Restoran Dashboard

                        </div>


                        <div>

                            Admin Dashboard

                        </div>

                    </div>

                </footer>

                <!-- ================= / FOOTER ================= -->


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

<script src="../assets/js/restaurant-data.js"></script>

<script src="../assets/js/restaurant-sync.js"></script>


</body>

</html>