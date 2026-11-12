<?php

include '../connection.php';

/* =========================================================
   GET BOOKING ID
========================================================= */

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


/* =========================================================
   CHECK ID
========================================================= */

if ($id <= 0) {

    header("Location: booking.php");
    exit;

}


/* =========================================================
   FETCH BOOKING
========================================================= */

$stmt = mysqli_prepare(
    $conn,
    "SELECT * FROM booking WHERE id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$booking = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


/* =========================================================
   BOOKING NOT FOUND
========================================================= */

if (!$booking) {

    header("Location: booking.php");
    exit;

}

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

<!-- =========================================================
     LAYOUT WRAPPER
========================================================= -->

<div class="layout-wrapper layout-content-navbar">

    <div class="layout-container">


        <!-- =====================================================
             SIDEBAR
        ====================================================== -->

        <?php include '../common/sidebar.php'; ?>


        <!-- =====================================================
             LAYOUT PAGE
        ====================================================== -->

        <div class="layout-page">


            <!-- =================================================
                 NAVBAR
            ================================================== -->

            <?php include '../common/navbar.php'; ?>


            <!-- =================================================
                 CONTENT
            ================================================== -->

            <div class="content-wrapper">


                <div class="container-xxl flex-grow-1 container-p-y">


                    <!-- =================================================
                         PAGE HEADER
                    ================================================== -->

                    <div class="row">

                        <div class="col-12">

                            <div class="card mb-4">

                                <div class="card-body">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <h4 class="fw-bold mb-1">
                                                Booking Details
                                            </h4>

                                            <p class="mb-0 text-muted">
                                                View customer booking message
                                            </p>

                                        </div>


                                        

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         BOOKING DETAILS
                    ================================================== -->

                    <div class="card">

                        <h5 class="card-header">
                            Customer Booking
                        </h5>


                        <div class="card-body">


                            <!-- ID -->

                            <div class="row mb-3">

                                <div class="col-md-3">

                                    <strong>
                                        Booking ID
                                    </strong>

                                </div>

                                <div class="col-md-9">

                                    <?php
                                    echo htmlspecialchars($booking['id']);
                                    ?>

                                </div>

                            </div>


                            <hr>


                            <!-- NAME -->

                            <div class="row mb-3">

                                <div class="col-md-3">

                                    <strong>
                                        Name
                                    </strong>

                                </div>

                                <div class="col-md-9">

                                    <?php
                                    echo htmlspecialchars($booking['name']);
                                    ?>

                                </div>

                            </div>


                            <!-- EMAIL -->

                            <div class="row mb-3">

                                <div class="col-md-3">

                                    <strong>
                                        Email
                                    </strong>

                                </div>

                                <div class="col-md-9">

                                    <?php
                                    echo htmlspecialchars($booking['email']);
                                    ?>

                                </div>

                            </div>


                            <!-- SUBJECT -->

                            <div class="row mb-3">

                                <div class="col-md-3">

                                    <strong>
                                        Subject
                                    </strong>

                                </div>

                                <div class="col-md-9">

                                    <?php
                                    echo htmlspecialchars($booking['subject']);
                                    ?>

                                </div>

                            </div>


                            <!-- MESSAGE -->

                            <div class="row mb-3">

                                <div class="col-md-3">

                                    <strong>
                                        Message
                                    </strong>

                                </div>

                                <div class="col-md-9">

                                    <div
                                        class="border rounded p-3"
                                        style="
                                            white-space: normal;
                                            word-break: break-word;
                                        "
                                    >

                                        <?php
                                        echo nl2br(
                                            htmlspecialchars($booking['message'])
                                        );
                                        ?>

                                    </div>

                                </div>

                            </div>


                            <!-- DATE -->

                            <div class="row mb-3">

                                <div class="col-md-3">

                                    <strong>
                                        Date
                                    </strong>

                                </div>

                                <div class="col-md-9">

                                    <?php

                                    if (!empty($booking['created_at'])) {

                                        echo date(
                                            'd M Y, h:i A',
                                            strtotime($booking['created_at'])
                                        );

                                    } else {

                                        echo '-';

                                    }

                                    ?>

                                </div>

                            </div>


                            <hr>


                            <!-- ACTION -->

                            <div class="mt-3">

                                <a
                                    href="booking.php"
                                    class="btn btn-secondary me-2"
                                >
                                    <i class="bx bx-arrow-back me-1"></i>
                                    Back
                                </a>

                            </div>


                        </div>

                    </div>


                </div>


                <!-- =================================================
                     FOOTER
                ================================================== -->

                <?php include '../common/footer.php'; ?>


                <div class="content-backdrop fade"></div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         OVERLAY
    ========================================================== -->

    <div class="layout-overlay layout-menu-toggle"></div>

</div>


<!-- =========================================================
     CORE JS
========================================================= -->

<script src="../assets/vendor/libs/jquery/jquery.js"></script>

<script src="../assets/vendor/libs/popper/popper.js"></script>

<script src="../assets/vendor/js/bootstrap.js"></script>

<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../assets/vendor/js/menu.js"></script>

<script src="../assets/js/main.js"></script>


</body>

</html>