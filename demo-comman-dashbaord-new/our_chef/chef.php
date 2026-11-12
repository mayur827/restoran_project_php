<?php

require_once '../connection.php';

/* =========================================================
   FETCH CHEF DATA
========================================================= */

$sql = "SELECT * FROM our_master_cheif ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database Error: " . mysqli_error($conn));
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

<style>

.description {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
    text-overflow: ellipsis;
    line-clamp: 2;
    max-width: 350px;
}

</style>

<?php include '../common/header.php'; ?>

<body data-restaurant-page="chef">

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

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div>

                            <h4 class="fw-bold mb-1">
                                Chefs
                            </h4>

                            <p class="text-muted mb-0">
                                Manage restaurant chefs
                            </p>

                        </div>


                        <!-- ADD CHEF -->

                        <a
                            href="add.php"
                            class="btn btn-warning"
                        >

                            <i class="bx bx-plus me-1"></i>

                            Add Chef

                        </a>

                    </div>


                    <!-- ================= CHEF CARD ================= -->

                    <div class="card">

                        <div class="card-header">

                            <h5 class="mb-0">
                                Chef Information
                            </h5>

                        </div>


                        <div class="card-body">

                            <div class="table-responsive">


                                <!-- ================= TABLE ================= -->

                                <table
                                    class="table table-bordered table-hover align-middle"
                                >

                                    <thead>

                                        <tr>

                                            <th>ID</th>

                                            <th>Image</th>

                                            <th>Chef Name</th>

                                            <th>Designation</th>

                                            <th>Description</th>

                                            <th>Action</th>

                                        </tr>

                                    </thead>


                                    <tbody>


                                    <?php

                                    if (mysqli_num_rows($result) > 0) {

                                        while ($row = mysqli_fetch_assoc($result)) {

                                    ?>


                                        <!-- ================= CHEF ================= -->

                                        <tr>


                                            <!-- ID -->

                                            <td>

                                                <?php
                                                echo htmlspecialchars($row['id']);
                                                ?>

                                            </td>


                                            <!-- IMAGE -->

                                            <td>

                                                <?php if (!empty($row['image'])) { ?>

                                                    <img
                                                        src="../uploads/chef/<?php echo htmlspecialchars($row['image']); ?>"
                                                        width="70"
                                                        height="70"
                                                        class="rounded-circle"
                                                        style="object-fit:cover; cursor:pointer;"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#imageModal<?php echo $row['id']; ?>"
                                                    >

                                                <?php } else { ?>

                                                    <img
                                                        src="../assets/img/avatars/1.png"
                                                        width="70"
                                                        height="70"
                                                        class="rounded-circle"
                                                        style="object-fit:cover;"
                                                    >

                                                <?php } ?>

                                            </td>


                                            <!-- CHEF NAME -->

                                            <td>

                                                <strong>

                                                    <?php
                                                    echo htmlspecialchars($row['chef_name']);
                                                    ?>

                                                </strong>

                                            </td>


                                            <!-- DESIGNATION -->

                                            <td>

                                                <span class="badge bg-label-primary">

                                                    <?php
                                                    echo htmlspecialchars($row['designation']);
                                                    ?>

                                                </span>

                                            </td>


                                            <!-- DESCRIPTION -->

                                            <td
                                                style="min-width:300px;"
                                                class="description"
                                            >

                                                <?php
                                                echo htmlspecialchars($row['description']);
                                                ?>

                                            </td>


                                            <!-- ACTION -->

                                            <td style="white-space:nowrap;">


                                                <!-- EDIT -->

                                                <a
                                                    href="edit.php?id=<?php echo $row['id']; ?>"
                                                    class="btn btn-sm btn-warning me-1"
                                                    title="Edit"
                                                >

                                                    <i class="bx bx-edit"></i>

                                                </a>


                                                <!-- DELETE -->

                                                <a
                                                    href="delete.php?id=<?php echo $row['id']; ?>"
                                                    class="btn btn-sm btn-danger"
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this chef?');"
                                                >

                                                    <i class="bx bx-trash"></i>

                                                </a>


                                            </td>


                                        </tr>


                                    <?php

                                        }

                                    } else {

                                    ?>


                                        <tr>

                                            <td
                                                colspan="6"
                                                class="text-center text-muted"
                                            >

                                                No chefs found.

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

                    <!-- ================= / CHEF CARD ================= -->


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


<!-- =========================================================
     IMAGE MODALS
========================================================= -->

<?php

mysqli_data_seek($result, 0);

while ($row = mysqli_fetch_assoc($result)) {

    if (!empty($row['image'])) {

?>

<div
    class="modal fade"
    id="imageModal<?php echo $row['id']; ?>"
    tabindex="-1"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title">

                    <?php
                    echo htmlspecialchars($row['chef_name']);
                    ?>

                </h5>


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            <div class="modal-body text-center">

                <img
                    src="../uploads/chef/<?php echo htmlspecialchars($row['image']); ?>"
                    class="img-fluid rounded-circle"
                    style="max-width:400px;"
                    alt="Chef Image"
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

<script src="../assets/vendor/libs/popper/popper.js"></script>

<script src="../assets/vendor/js/bootstrap.js"></script>

<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../assets/vendor/js/menu.js"></script>

<script src="../assets/js/main.js"></script>

<script src="../assets/js/restaurant-data.js"></script>

<script src="../assets/js/restaurant-sync.js"></script>

</body>

</html>