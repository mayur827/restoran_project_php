<?php

require_once '../connection.php';


/* =========================
   GET SERVICE ID
========================= */

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {

    header("Location: service.php");
    exit;
}


/* =========================
   FETCH SERVICE
========================= */

$stmt = mysqli_prepare(
    $conn,
    "SELECT id, title, description, image
     FROM service
     WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$service = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


if (!$service) {

    header("Location: service.php");
    exit;
}


/* =========================
   UPDATE SERVICE
========================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($title === '' || $description === '') {

        $error = "Please fill all required fields.";

    } else {

        $old_image = $service['image'];
        $new_image = $old_image;


        /* =========================
           NEW IMAGE
        ========================= */

        if (
            isset($_FILES['image']) &&
            $_FILES['image']['error'] === UPLOAD_ERR_OK
        ) {

            $upload_dir = '../uploads/service/';

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }


            $original_name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];

            $extension = strtolower(
                pathinfo($original_name, PATHINFO_EXTENSION)
            );

            $allowed_extensions = [
                'jpg',
                'jpeg',
                'png',
                'webp'
            ];


            if (!in_array($extension, $allowed_extensions)) {

                $error = "Only JPG, JPEG, PNG and WEBP images are allowed.";

            } else {

                $new_image = uniqid('service_', true) . '.' . $extension;

                $new_image_path =
                    $upload_dir . $new_image;


                if (!move_uploaded_file($tmp_name, $new_image_path)) {

                    $error = "Failed to upload new image.";

                } else {

                    /* =========================
                       UPDATE DATABASE
                    ========================= */

                    $stmt = mysqli_prepare(
                        $conn,
                        "UPDATE service
                         SET title = ?, description = ?, image = ?
                         WHERE id = ?"
                    );

                    mysqli_stmt_bind_param(
                        $stmt,
                        "sssi",
                        $title,
                        $description,
                        $new_image,
                        $id
                    );


                    if (mysqli_stmt_execute($stmt)) {

                        mysqli_stmt_close($stmt);


                        /* Delete old image */

                        if (
                            !empty($old_image) &&
                            file_exists($upload_dir . $old_image)
                        ) {

                            unlink($upload_dir . $old_image);
                        }


                        header("Location: service.php");
                        exit;

                    } else {

                        mysqli_stmt_close($stmt);

                        if (file_exists($new_image_path)) {
                            unlink($new_image_path);
                        }

                        $error = "Failed to update service.";
                    }
                }
            }

        } else {

            /* =========================
               UPDATE WITHOUT IMAGE
            ========================= */

            $stmt = mysqli_prepare(
                $conn,
                "UPDATE service
                 SET title = ?, description = ?
                 WHERE id = ?"
            );

            mysqli_stmt_bind_param(
                $stmt,
                "ssi",
                $title,
                $description,
                $id
            );


            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_close($stmt);

                header("Location: service.php");
                exit;

            } else {

                $error = "Failed to update service.";
                mysqli_stmt_close($stmt);
            }
        }
    }


    /* Refresh values if there was an error */

    $service['title'] = $title;
    $service['description'] = $description;
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

                            UPDATE SERVICES

                        </div>


                        <?php if (isset($error)): ?>

                            <div class="alert alert-danger mt-3">

                                <?php echo htmlspecialchars($error); ?>

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
                                        value="<?php echo htmlspecialchars($service['title']); ?>"
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
                                    >

                                    <small class="text-muted">
                                        JPG, JPEG, PNG or WEBP
                                    </small>


                                    <?php if (!empty($service['image'])): ?>

                                        <div class="mt-2">

                                            <img
                                                src="../uploads/service/<?php echo htmlspecialchars($service['image']); ?>"
                                                width="100"
                                                height="80"
                                                class="rounded"
                                                style="object-fit:cover;"
                                                alt="Current Service Image"
                                            >

                                        </div>

                                    <?php endif; ?>

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
                                    ><?php echo htmlspecialchars($service['description']); ?></textarea>

                                </div>


                                <!-- Buttons -->

                                <div class="col-lg-12 d-flex align-items-start gap-2">

                                    <button
                                        type="submit"
                                        class="btn btn-warning"
                                    >

                                        <i class="fa-solid fa-plus"></i>

                                        Update Service

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