<?php

require_once '../connection.php';

$message = "";
$message_type = "";


/* =========================
   ADD SERVICE
========================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    /* =========================
       VALIDATION
    ========================= */

    if ($title === '' || $description === '') {

        $message = "Please fill all required fields.";
        $message_type = "danger";

    } elseif (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {

        $message = "Please select a service image.";
        $message_type = "danger";

    } else {

        /* =========================
           IMAGE UPLOAD
        ========================= */

        $upload_dir = '../uploads/service/';

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $original_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];

        $extension = strtolower(
            pathinfo($original_name, PATHINFO_EXTENSION)
        );

        $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($extension, $allowed_extensions)) {

            $message = "Only JPG, JPEG, PNG and WEBP images are allowed.";
            $message_type = "danger";

        } else {

            $image_name = uniqid('service_', true) . '.' . $extension;

            $image_path = $upload_dir . $image_name;


            /* =========================
               MOVE IMAGE
            ========================= */

            if (move_uploaded_file($tmp_name, $image_path)) {

                /* =========================
                   INSERT DATABASE
                ========================= */

                $stmt = mysqli_prepare(
                    $conn,
                    "INSERT INTO service (title, description, image)
                     VALUES (?, ?, ?)"
                );

                if ($stmt) {

                    mysqli_stmt_bind_param(
                        $stmt,
                        "sss",
                        $title,
                        $description,
                        $image_name
                    );

                    if (mysqli_stmt_execute($stmt)) {

                        mysqli_stmt_close($stmt);

                        header("Location: service.php");
                        exit;

                    } else {

                        unlink($image_path);

                        $message = "Failed to add service: " . mysqli_stmt_error($stmt);
                        $message_type = "danger";

                        mysqli_stmt_close($stmt);
                    }

                } else {

                    unlink($image_path);

                    $message = "Database error: " . mysqli_error($conn);
                    $message_type = "danger";
                }

            } else {

                $message = "Failed to upload image.";
                $message_type = "danger";
            }
        }
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
    margin-left: 30px;
}

</style>

<?php include '../common/header.php'; ?>

<body>

<div class="layout-wrapper layout-content-navbar">

    <div class="layout-container">

        <?php include '../common/sidebar.php'; ?>

        <!-- ================= PAGE ================= -->

        <div class="layout-page">

            <!-- Navbar -->

            <?php include '../common/navbar.php'; ?>

            <!-- / Navbar -->


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

                            ADD SERVICES

                        </div>


                        <?php if ($message !== ""): ?>

                            <div class="alert alert-<?php echo $message_type; ?> mt-3">

                                <?php echo htmlspecialchars($message); ?>

                            </div>

                        <?php endif; ?>


                        <div class="table-responsive">

                            <div class="container row g-4 mt-3">


                                <!-- Title -->

                                <div class="col-lg-6">

                                    <label class="form-label">
                                        Service Title
                                    </label>

                                    <input
                                        type="text"
                                        name="title"
                                        class="form-control"
                                        placeholder="Enter service title"
                                        required
                                    >

                                </div>


                                <!-- Image -->

                                <div class="col-lg-6">

                                    <label class="form-label">
                                        Service Image
                                    </label>

                                    <input
                                        type="file"
                                        name="image"
                                        class="form-control"
                                        accept="image/jpeg,image/png,image/webp"
                                        required
                                    >

                                    <small class="text-muted">
                                        JPG, JPEG, PNG or WEBP
                                    </small>

                                </div>


                                <!-- Description -->

                                <div class="col-lg-12">

                                    <label class="form-label">
                                        Description
                                    </label>

                                    <textarea
                                        name="description"
                                        class="form-control"
                                        rows="5"
                                        placeholder="Enter service description"
                                        required
                                    ></textarea>

                                </div>


                                <!-- Buttons -->

                                <div class="col-lg-12 d-flex align-items-start gap-2">

                                    <button
                                        type="submit"
                                        class="btn btn-warning"
                                    >

                                        <i class="fa-solid fa-plus"></i>

                                        Add Service

                                    </button>


                                    <a
                                        href="service.php"
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