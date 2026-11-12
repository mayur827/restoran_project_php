<?php

require_once '../connection.php';

/* =========================================================
   GET ID
========================================================= */

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    header("Location: about.php");
    exit;

}

$id = (int) $_GET['id'];


/* =========================================================
   FETCH EXISTING DATA
========================================================= */

$sql = "SELECT * FROM about WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$about = mysqli_fetch_assoc($result);

if (!$about) {

    die("About information not found.");

}


/* =========================================================
   UPDATE DATA
========================================================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title']);

    $experience_years = (int) $_POST['experience_years'];

    $experience_text = trim($_POST['experience_text']);

    $chefs_count = (int) $_POST['chefs_count'];

    $chefs_text = trim($_POST['chefs_text']);

    $description = trim($_POST['description']);


    /* =====================================================
       OLD IMAGE
    ===================================================== */

    $image_name = $about['image'];


    /* =====================================================
       NEW IMAGE
    ===================================================== */

    if (
        isset($_FILES['image']) &&
        $_FILES['image']['error'] === 0
    ) {

        $upload_dir = '../uploads/about/';


        /* Create folder if not exists */

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


        /* Generate unique image name */

        $new_image_name =
            time() . '_' . uniqid() . '.' . $extension;


        /* Upload image */

        if (
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                $upload_dir . $new_image_name
            )
        ) {


            /* Delete old image */

            if (!empty($about['image'])) {

                $old_image_path =
                    $upload_dir . $about['image'];


                if (file_exists($old_image_path)) {

                    unlink($old_image_path);

                }

            }


            /* Set new image */

            $image_name = $new_image_name;

        }

    }


    /* =====================================================
       UPDATE DATABASE
    ===================================================== */

    $sql = "UPDATE about SET
                title = ?,
                description = ?,
                image = ?,
                experience_years = ?,
                experience_text = ?,
                chefs_count = ?,
                chefs_text = ?
            WHERE id = ?";


    $stmt = mysqli_prepare($conn, $sql);


    /*
       s = string
       i = integer

       title             = s
       description       = s
       image             = s
       experience_years  = i
       experience_text   = s
       chefs_count       = i
       chefs_text        = s
       id                = i
    */

    mysqli_stmt_bind_param(
        $stmt,
        "sssisisi",
        $title,
        $description,
        $image_name,
        $experience_years,
        $experience_text,
        $chefs_count,
        $chefs_text,
        $id
    );


    /* =====================================================
       EXECUTE UPDATE
    ===================================================== */

    if (mysqli_stmt_execute($stmt)) {

        header("Location: about.php");
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
    margin-left: 30px;
}

</style>


<?php include '../common/header.php'; ?>


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

            <form
                method="POST"
                enctype="multipart/form-data"
                class="mt-4"
            >


                <div class="card m-4">


                    <div class="card-body">


                        <!-- ================= TITLE ================= -->

                        <div
                            class="card-info"
                            style="font-weight:bold;"
                        >

                            UPDATE INFORMATION

                        </div>


                        <div class="table-responsive">


                            <div class="container row g-4 mt-3">


                                <!-- ================= TITLE ================= -->

                                <div class="col-lg-6">

                                    <label class="form-label">

                                        Title

                                    </label>


                                    <input
                                        type="text"
                                        name="title"
                                        class="form-control"
                                        value="<?php echo htmlspecialchars($about['title']); ?>"
                                        placeholder="Welcome to Restoran"
                                        required
                                    >

                                </div>


                                <!-- ================= IMAGE ================= -->

                                <div class="col-lg-6">

                                    <label class="form-label">

                                        About Image

                                    </label>


                                    <input
                                        type="file"
                                        name="image"
                                        class="form-control"
                                        accept=".jpg,.jpeg,.png,.webp"
                                    >


                                    <?php if (!empty($about['image'])) { ?>

                                        <div class="mt-2">

                                            <small class="text-muted">
                                                Current Image:
                                            </small>

                                            <br>


                                            <img
                                                src="../uploads/about/<?php echo htmlspecialchars($about['image']); ?>"
                                                width="100"
                                                height="80"
                                                class="rounded mt-1"
                                                style="object-fit:cover;"
                                            >

                                        </div>

                                    <?php } ?>


                                </div>


                                <!-- ================= EXPERIENCE YEARS ================= -->

                                <div class="col-lg-3">

                                    <label class="form-label">

                                        Experience Years

                                    </label>


                                    <input
                                        type="number"
                                        name="experience_years"
                                        class="form-control"
                                        value="<?php echo htmlspecialchars($about['experience_years']); ?>"
                                        placeholder="15"
                                        min="0"
                                        required
                                    >

                                </div>


                                <!-- ================= EXPERIENCE TEXT ================= -->

                                <div class="col-lg-3">

                                    <label class="form-label">

                                        Experience Text

                                    </label>


                                    <input
                                        type="text"
                                        name="experience_text"
                                        class="form-control"
                                        value="<?php echo htmlspecialchars($about['experience_text']); ?>"
                                        placeholder="Years of Experience"
                                        required
                                    >

                                </div>


                                <!-- ================= CHEFS COUNT ================= -->

                                <div class="col-lg-3">

                                    <label class="form-label">

                                        Master Chefs Count

                                    </label>


                                    <input
                                        type="number"
                                        name="chefs_count"
                                        class="form-control"
                                        value="<?php echo htmlspecialchars($about['chefs_count']); ?>"
                                        placeholder="50"
                                        min="0"
                                        required
                                    >

                                </div>


                                <!-- ================= CHEFS TEXT ================= -->

                                <div class="col-lg-3">

                                    <label class="form-label">

                                        Chefs Text

                                    </label>


                                    <input
                                        type="text"
                                        name="chefs_text"
                                        class="form-control"
                                        value="<?php echo htmlspecialchars($about['chefs_text']); ?>"
                                        placeholder="Popular Master Chefs"
                                        required
                                    >

                                </div>


                                <!-- ================= DESCRIPTION ================= -->

                                <div class="col-lg-12">

                                    <label class="form-label">

                                        Description

                                    </label>


                                    <textarea
                                        name="description"
                                        class="form-control"
                                        rows="6"
                                        placeholder="Enter restaurant description."
                                        required
                                    ><?php echo htmlspecialchars($about['description']); ?></textarea>

                                </div>


                                <!-- ================= BUTTONS ================= -->

                                <div class="col-lg-12">


                                    <button
                                        type="submit"
                                        class="btn btn-warning"
                                    >

                                        <i class="fa fa-save"></i>

                                        Update About

                                    </button>


                                    <a
                                        href="about.php"
                                        class="btn btn-secondary"
                                    >

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