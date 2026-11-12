<?php

require_once '../connection.php';


/* =========================================================
   ADD CHEF
========================================================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $chef_name = trim($_POST['chef_name'] ?? '');

    $designation = trim($_POST['designation'] ?? '');

    $description = trim($_POST['description'] ?? '');

    $image_name = "";


    /* =====================================================
       CHECK REQUIRED DATA
    ===================================================== */

    if ($chef_name === '' || $designation === '' || $description === '') {

        die("Please fill all required fields.");

    }


    /* =====================================================
       IMAGE UPLOAD
    ===================================================== */

    if (
        isset($_FILES['image']) &&
        $_FILES['image']['error'] === 0
    ) {

        $upload_dir = '../uploads/chef/';


        /* Create folder if not exists */

        if (!is_dir($upload_dir)) {

            if (!mkdir($upload_dir, 0777, true)) {

                die("Unable to create uploads/chef folder.");

            }

        }


        $original_name = $_FILES['image']['name'];

        $extension = strtolower(
            pathinfo($original_name, PATHINFO_EXTENSION)
        );


        $allowed = [
            'jpg',
            'jpeg',
            'png',
            'webp'
        ];


        if (!in_array($extension, $allowed)) {

            die("Invalid image format.");

        }


        $image_name =
            time() . '_' . uniqid() . '.' . $extension;


        if (!move_uploaded_file(
            $_FILES['image']['tmp_name'],
            $upload_dir . $image_name
        )) {

            die("Image upload failed.");

        }

    }


    /* =====================================================
       INSERT INTO DATABASE
    ===================================================== */

    $sql = "INSERT INTO our_master_cheif
            (chef_name, designation, image, description)
            VALUES (?, ?, ?, ?)";


    $stmt = mysqli_prepare($conn, $sql);


    if (!$stmt) {

        die("Prepare failed: " . mysqli_error($conn));

    }


    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $chef_name,
        $designation,
        $image_name,
        $description
    );


    /* =====================================================
       EXECUTE
    ===================================================== */

    if (mysqli_stmt_execute($stmt)) {

        echo "<script>
                window.location.href='chef.php';
              </script>";

        exit;

    } else {

        die(
            "Chef insert failed:<br><br>" .
            mysqli_stmt_error($stmt)
        );

    }

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

.card-info {
    margin-left:30px;
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

            <form
                method="POST"
                enctype="multipart/form-data"
                class="mt-4"
            >


                <div class="card m-4">


                    <div class="card-body">


                        <div
                            class="card-info"
                            style="font-weight:bold;"
                        >

                            ADD NEW CHEF

                        </div>


                        <div class="table-responsive">


                            <div class="container row g-4 mt-3">


                                <!-- CHEF NAME -->

                                <div class="col-lg-6">

                                    <label class="form-label">

                                        Chef Name

                                    </label>


                                    <input
                                        type="text"
                                        name="chef_name"
                                        class="form-control"
                                        placeholder="Enter chef name"
                                        required
                                    >

                                </div>


                                <!-- DESIGNATION -->

                                <div class="col-lg-6">

                                    <label class="form-label">

                                        Designation

                                    </label>


                                    <input
                                        type="text"
                                        name="designation"
                                        class="form-control"
                                        placeholder="e.g. Executive Chef"
                                        required
                                    >

                                </div>


                                <!-- IMAGE -->

                                <div class="col-lg-12">

                                    <label class="form-label">

                                        Chef Image

                                    </label>


                                    <input
                                        type="file"
                                        name="image"
                                        class="form-control"
                                        accept=".jpg,.jpeg,.png,.webp"
                                    >

                                </div>


                                <!-- DESCRIPTION -->

                                <div class="col-lg-12">

                                    <label class="form-label">

                                        Description

                                    </label>


                                    <textarea
                                        name="description"
                                        class="form-control"
                                        rows="5"
                                        placeholder="Enter chef description"
                                        required
                                    ></textarea>

                                </div>


                                <!-- BUTTONS -->

                                <div class="col-lg-6">


                                    <button
                                        type="submit"
                                        class="btn btn-warning"
                                    >

                                        <i class="fa-solid fa-plus"></i>

                                        Add Chef

                                    </button>


                                    <a
                                        href="chef.php"
                                        class="btn btn-secondary"
                                    >

                                        <i class="fa-solid fa-xmark"></i>

                                        Cancel

                                    </a>


                                </div>


                            </div>

                        </div>

                    </div>

                </div>

            </form>


            <!-- ================= / CONTENT ================= -->


        </div>

    </div>

</div>


<!-- ================= SNEAT JS ================= -->

<script src="../assets/vendor/libs/jquery/jquery.js"></script>

<script src="../assets/vendor/js/bootstrap.js"></script>

<script src="../assets/vendor/js/menu.js"></script>

<script src="../assets/js/main.js"></script>


</body>

</html>