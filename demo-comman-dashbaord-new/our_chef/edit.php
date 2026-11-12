<?php

require_once '../connection.php';


/* =========================================================
   GET ID
========================================================= */

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    header("Location: chef.php");
    exit;

}

$id = (int) $_GET['id'];


/* =========================================================
   FETCH CHEF
========================================================= */

$sql = "SELECT * FROM our_master_cheif WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$chef = mysqli_fetch_assoc($result);


if (!$chef) {

    die("Chef information not found.");

}


/* =========================================================
   UPDATE CHEF
========================================================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $chef_name = trim($_POST['chef_name']);

    $designation = trim($_POST['designation']);

    $description = trim($_POST['description']);


    /* =====================================================
       OLD IMAGE
    ===================================================== */

    $image_name = $chef['image'];


    /* =====================================================
       NEW IMAGE
    ===================================================== */

    if (
        isset($_FILES['image']) &&
        $_FILES['image']['error'] === 0
    ) {


        $upload_dir = '../uploads/chef/';


        /* Create folder */

        if (!is_dir($upload_dir)) {

            mkdir($upload_dir, 0777, true);

        }


        /* Get extension */

        $original_name = $_FILES['image']['name'];

        $extension = strtolower(
            pathinfo($original_name, PATHINFO_EXTENSION)
        );


        /* Allowed extensions */

        $allowed = [
            'jpg',
            'jpeg',
            'png',
            'webp'
        ];


        if (!in_array($extension, $allowed)) {

            die("Invalid image format. Only JPG, JPEG, PNG and WEBP are allowed.");

        }


        /* New image name */

        $new_image_name =
            time() . '_' . uniqid() . '.' . $extension;


        /* Upload */

        if (
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                $upload_dir . $new_image_name
            )
        ) {


            /* Delete old image */

            if (!empty($chef['image'])) {

                $old_image_path =
                    $upload_dir . $chef['image'];


                if (file_exists($old_image_path)) {

                    unlink($old_image_path);

                }

            }


            $image_name = $new_image_name;

        }

    }


    /* =====================================================
       UPDATE DATABASE
    ===================================================== */

    $sql = "UPDATE our_master_cheif SET
                chef_name = ?,
                designation = ?,
                image = ?,
                description = ?
            WHERE id = ?";


    $stmt = mysqli_prepare($conn, $sql);


    mysqli_stmt_bind_param(
        $stmt,
        "ssssi",
        $chef_name,
        $designation,
        $image_name,
        $description,
        $id
    );


    if (mysqli_stmt_execute($stmt)) {

        header("Location: chef.php");
        exit;

    } else {

        echo "Update failed: " . mysqli_error($conn);

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

                            UPDATE CHEF

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
                                        value="<?php echo htmlspecialchars($chef['chef_name']); ?>"
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
                                        value="<?php echo htmlspecialchars($chef['designation']); ?>"
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


                                    <?php if (!empty($chef['image'])) { ?>

                                        <div class="mt-2">

                                            <small class="text-muted">

                                                Current Image:

                                            </small>

                                            <br>


                                            <img
                                                src="../uploads/chef/<?php echo htmlspecialchars($chef['image']); ?>"
                                                width="100"
                                                height="100"
                                                class="rounded-circle mt-1"
                                                style="object-fit:cover;"
                                            >

                                        </div>

                                    <?php } ?>


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
                                    ><?php echo htmlspecialchars($chef['description']); ?></textarea>

                                </div>


                                <!-- BUTTONS -->

                                <div class="col-lg-6">


                                    <button
                                        type="submit"
                                        class="btn btn-warning"
                                    >

                                        <i class="fa-solid fa-save"></i>

                                        Update Chef

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