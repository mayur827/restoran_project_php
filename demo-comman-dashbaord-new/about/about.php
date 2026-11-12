<!DOCTYPE html>
<html lang="en"
      class="light-style layout-menu-fixed"
      dir="ltr"
      data-theme="theme-default"
      data-assets-path="../assets/"
      data-template="vertical-menu-template-free">

<style>

.description {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 350px;
}

</style>

<?php

include '../common/header.php';

/* ================= DATABASE CONNECTION ================= */

require_once '../connection.php';

/* ================= FETCH ABOUT DATA ================= */

$sql = "SELECT * FROM about ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

?>

<body data-restaurant-page="about">

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


                    <!-- ================= PAGE HEADING ================= -->

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div>

                            <h4 class="fw-bold mb-1">
                                About Us
                            </h4>

                            <p class="text-muted mb-0">
                                Manage restaurant information
                            </p>

                        </div>


                        <!-- ADD BUTTON -->

                        <a href="add_about.php"
                           class="btn btn-warning">

                            <i class="bx bx-plus me-1"></i>

                            Add About

                        </a>

                    </div>


                    <!-- ================= CARD ================= -->

                    <div class="card">


                        <div class="card-header">

                            <h5 class="mb-0">
                                About Us Information
                            </h5>

                        </div>


                        <div class="card-body">

                            <div class="table-responsive">


                                <!-- ================= TABLE ================= -->

                                <table class="table table-bordered table-hover align-middle">

                                    <thead>

                                        <tr>

                                            <th>ID</th>

                                            <th>Image</th>

                                            <th>Title</th>

                                            <th>Description</th>

                                            <th>Experience</th>

                                            <th>Master Chefs</th>

                                            <th>Action</th>

                                        </tr>

                                    </thead>


                                    <tbody>


                                    <?php

                                    /* ================= CHECK DATA ================= */

                                    if (mysqli_num_rows($result) > 0) {

                                        while ($row = mysqli_fetch_assoc($result)) {

                                    ?>

                                        <tr>


                                            <!-- ================= ID ================= -->

                                            <td>

                                                <?php echo $row['id']; ?>

                                            </td>


                                            <!-- ================= IMAGE ================= -->

                                            <td>

                                                <?php if (!empty($row['image'])) { ?>

                                                    <img
                                                        src="../uploads/about/<?php echo htmlspecialchars($row['image']); ?>"
                                                        width="70"
                                                        height="60"
                                                        style="object-fit:cover; cursor:pointer;"
                                                        class="rounded"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#imageModal<?php echo $row['id']; ?>"
                                                    >

                                                <?php } else { ?>

                                                    <span class="badge bg-label-secondary">
                                                        No Image
                                                    </span>

                                                <?php } ?>

                                            </td>


                                            <!-- ================= TITLE ================= -->

                                            <td>

                                                <strong>

                                                    <?php
                                                    echo htmlspecialchars($row['title']);
                                                    ?>

                                                </strong>

                                            </td>


                                            <!-- ================= DESCRIPTION ================= -->

                                            <td class="description">

                                                <?php
                                                echo htmlspecialchars($row['description']);
                                                ?>

                                            </td>


                                            <!-- ================= EXPERIENCE ================= -->

                                            <td>

                                                <span class="badge bg-label-success">

                                                    <?php
                                                    echo htmlspecialchars($row['experience_years']);
                                                    ?>

                                                    <?php
                                                    echo htmlspecialchars($row['experience_text']);
                                                    ?>

                                                </span>

                                            </td>


                                            <!-- ================= CHEFS ================= -->

                                            <td>

                                                <span class="badge bg-label-warning">

                                                    <?php
                                                    echo htmlspecialchars($row['chefs_count']);
                                                    ?>

                                                    <?php
                                                    echo htmlspecialchars($row['chefs_text']);
                                                    ?>

                                                </span>

                                            </td>


                                            <!-- ================= ACTION ================= -->

                                            <td style="white-space: nowrap;">


                                                <!-- EDIT -->

                                                <a
                                                    href="edit_about.php?id=<?php echo $row['id']; ?>"
                                                    class="btn btn-sm btn-warning me-1"
                                                    title="Edit"
                                                >

                                                    <i class="bx bx-edit"></i>

                                                </a>


                                                <!-- DELETE -->

                                                <a
                                                    href="delete_about.php?id=<?php echo $row['id']; ?>"
                                                    class="btn btn-sm btn-danger"
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this About information?');"
                                                >

                                                    <i class="bx bx-trash"></i>

                                                </a>


                                            </td>


                                        </tr>


                                    <?php

                                        }

                                    } else {

                                    ?>

                                        <!-- ================= NO DATA ================= -->

                                        <tr>

                                            <td colspan="7" class="text-center">

                                                <div class="py-4">

                                                    <i class="bx bx-info-circle fs-1 text-muted"></i>

                                                    <h6 class="mt-2">
                                                        No About information found
                                                    </h6>

                                                    <p class="text-muted mb-0">
                                                        Click "Add About" to add restaurant information.
                                                    </p>

                                                </div>

                                            </td>

                                        </tr>

                                    <?php

                                    }

                                    ?>


                                    </tbody>

                                </table>

                                <!-- ================= / TABLE ================= -->


                            </div>

                        </div>

                    </div>

                    <!-- ================= / CARD ================= -->


                </div>


                <!-- ================= FOOTER ================= -->

                <footer class="content-footer footer bg-footer-theme">

                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2">

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


<!-- =========================================================
     IMAGE MODALS
========================================================= -->

<?php

/* Fetch again for image modals */

mysqli_data_seek($result, 0);

while ($row = mysqli_fetch_assoc($result)) {

    if (!empty($row['image'])) {

?>

<div class="modal fade"
     id="imageModal<?php echo $row['id']; ?>"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">

                    <?php
                    echo htmlspecialchars($row['title']);
                    ?>

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            <div class="modal-body text-center">

                <img
                    src="../uploads/about/<?php echo htmlspecialchars($row['image']); ?>"
                    class="img-fluid rounded"
                    alt="Restaurant Image"
                >

            </div>


        </div>

    </div>

</div>

<?php

    }

}

?>


<!-- ================= SNEAT JS ================= -->

<script src="../assets/vendor/libs/jquery/jquery.js"></script>

<script src="../assets/vendor/js/bootstrap.js"></script>

<script src="../assets/vendor/js/menu.js"></script>

<script src="../assets/js/main.js"></script>

<script src="../assets/js/restaurant-data.js"></script>

<script src="../assets/js/restaurant-sync.js"></script>

</body>

</html>