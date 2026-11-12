<?php

include '../connection.php';

/* =========================================================
   FETCH BOOKING DATA
========================================================= */

$result = mysqli_query(
    $conn,
    "SELECT * FROM booking ORDER BY id DESC"
);

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
                                                Contact
                                            </h4>

                                            <p class="mb-0 text-muted">
                                                Manage customer contacts
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- =================================================
                         BOOKING TABLE
                    ================================================== -->

                    <div class="card">

                        <h5 class="card-header">
                            Customer Contacts
                        </h5>


                        <div class="table-responsive text-nowrap">

                            <!-- BORDER ADDED HERE -->
                            <table class="table table-bordered">

                                <thead>

                                    <tr>

                                        <th>
                                            ID
                                        </th>

                                        <th>
                                            Name
                                        </th>

                                        <th>
                                            Email
                                        </th>

                                        <th>
                                            Subject
                                        </th>

                                        <th>
                                            Message
                                        </th>

                                        <th>
                                            Date
                                        </th>

                                        <th>
                                            Action
                                        </th>

                                    </tr>

                                </thead>


                                <tbody class="table-border-bottom-0">


                                <?php

                                if (mysqli_num_rows($result) > 0) {

                                    while ($row = mysqli_fetch_assoc($result)) {

                                ?>

                                    <tr>


                                        <!-- ID -->

                                        <td>

                                            <strong>
                                                <?php
                                                echo $row['id'];
                                                ?>
                                            </strong>

                                        </td>


                                        <!-- NAME -->

                                        <td>

                                            <?php
                                            echo htmlspecialchars($row['name']);
                                            ?>

                                        </td>


                                        <!-- EMAIL -->

                                        <td>

                                            <?php
                                            echo htmlspecialchars($row['email']);
                                            ?>

                                        </td>


                                        <!-- SUBJECT -->

                                        <td>

                                            <?php
                                            echo htmlspecialchars($row['subject']);
                                            ?>

                                        </td>


                                        <!-- MESSAGE -->

                                        <td>

                                            <div
                                                style="
                                                    max-width: 300px;
                                                    white-space: normal;
                                                    word-break: break-word;
                                                "
                                            >

                                                <?php
                                                echo htmlspecialchars($row['message']);
                                                ?>

                                            </div>

                                        </td>


                                        <!-- CREATED DATE -->

                                        <td>

                                            <?php

                                            if (!empty($row['created_at'])) {

                                                echo date(
                                                    'd M Y',
                                                    strtotime($row['created_at'])
                                                );

                                            } else {

                                                echo '-';

                                            }

                                            ?>

                                        </td>


                                        <!-- ACTION -->

                                        <td>

                                            <!-- VIEW BUTTON -->

                                            <a
                                                href="view.php?id=<?php echo $row['id']; ?>"
                                                class="btn btn-sm btn-info me-1"
                                                title="View Booking"
                                            >

                                                <i class="bx bx-show"></i>

                                            </a>


                                            <!-- DELETE BUTTON -->

                                            <a
                                                href="delete.php?id=<?php echo $row['id']; ?>"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this booking?');"
                                            >

                                                <i class="bx bx-trash"></i>

                                            </a>

                                        </td>


                                    </tr>


                                <?php

                                    }

                                } else {

                                ?>


                                    <!-- NO DATA -->

                                    <tr>

                                        <td
                                            colspan="7"
                                            class="text-center py-4"
                                        >

                                            <div>

                                                <i
                                                    class="bx bx-calendar-x"
                                                    style="font-size: 40px;"
                                                ></i>

                                                <h6 class="mt-2 mb-1">
                                                    No bookings found
                                                </h6>

                                                <small class="text-muted">
                                                    There are no customer bookings available.
                                                </small>

                                            </div>

                                        </td>

                                    </tr>


                                <?php

                                }

                                ?>


                                </tbody>

                            </table>

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


</body>

</html>