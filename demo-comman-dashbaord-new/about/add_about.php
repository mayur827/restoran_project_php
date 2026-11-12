
<?php

require_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title']);
    $experience_years = (int) $_POST['experience_years'];
    $experience_text = trim($_POST['experience_text']);
    $chefs_count = (int) $_POST['chefs_count'];
    $chefs_text = trim($_POST['chefs_text']);
    $description = trim($_POST['description']);

    /* ================= IMAGE ================= */

    $image_name = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {

        $upload_dir = '../uploads/about/';

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $original_name = $_FILES['image']['name'];

        $extension = strtolower(
            pathinfo($original_name, PATHINFO_EXTENSION)
        );

        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($extension, $allowed)) {

            die("Invalid image format.");

        }

        $image_name = time() . '_' . uniqid() . '.' . $extension;

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            $upload_dir . $image_name
        );
    }


    /* ================= INSERT ================= */

$sql = "INSERT INTO about
        (
            title,
            description,
            experience_years,
            experience_text,
            chefs_count,
            chefs_text,
            image
        )
        VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
    $stmt,
    "ssisiss",
    $title,
    $description,
    $experience_years,
    $experience_text,
    $chefs_count,
    $chefs_text,
    $image_name
);

    if (mysqli_stmt_execute($stmt)) {

        header("Location: about.php");
        exit;

    } else {

        echo "Error: " . mysqli_error($conn);

    }

}

?>
<!DOCTYPE html>
<html lang="en"
      class="light-style layout-menu-fixed"
      dir="ltr"
      data-theme="theme-default"
      data-assets-path="../assets/"
      data-template="vertical-menu-template-free">

      <style>
        .card-info{
            margin-left:30px;
        }
        </style>

<?php include '../common/header.php';?>

<body>


<div class="layout-wrapper layout-content-navbar">

    <div class="layout-container">

<?php include '../common/sidebar.php';?>


        <!-- ================= / SIDEBAR ================= -->


        <!-- ================= PAGE ================= -->

        <div class="layout-page">


            <!-- Navbar -->

            <?php include '../common/navbar.php';?>

            <!-- / Navbar -->


            <!-- ================= CONTENT ================= -->
<form method="POST" enctype="multipart/form-data" class="mt-4">

            <div class="card m-4">

            <div class="card-body">
                <div class="card-info" style="font-weight:bold;" >
                    ADD INFORMATION
                </div>

              <div class="table-responsive">

                    <div class="container row g-4 mt-3">

                        <!-- Title -->
                        <div class="col-lg-6">

                            <label class="form-label">
                                Title
                            </label>

                            <input type="text" name="title" class="form-control" placeholder="Welcome to Restoran" required="">

                        </div>


                        <!-- Image -->
                        <div class="col-lg-6">

                            <label class="form-label">
                                About Image
                            </label>

                            <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">

                        </div>

                        <!-- Experience Years -->
                        <div class="col-lg-3">

                            <label class="form-label">
                                Experience Years
                            </label>

                            <input type="number" name="experience_years" class="form-control" placeholder="15" min="0" required="">

                        </div>


                        <!-- Experience Text -->
                        <div class="col-lg-3">

                            <label class="form-label">
                                Experience Text
                            </label>

                            <input type="text" name="experience_text" class="form-control" placeholder="Years of Experience" required="">

                        </div>


                        <!-- Chefs Count -->
                        <div class="col-lg-3">

                            <label class="form-label">
                                Master Chefs Count
                            </label>

                            <input type="number" name="chefs_count" class="form-control" placeholder="50" min="0" required="">

                        </div>


                        <!-- Chefs Text -->
                        <div class="col-lg-3">

                            <label class="form-label">
                                Chefs Text
                            </label>

                            <input type="text" name="chefs_text" class="form-control" placeholder="Popular Master Chefs" required="">

                        </div>

                            <!-- Description 1 -->
                        <div class="col-lg-12">

                            <label class="form-label">
                                Description 
                            </label>

                            <textarea name="description" class="form-control" rows="6"  placeholder="Enter restaurant description. You can press Enter to create a new line." required></textarea>

                        </div>

                        <!-- Submit -->
                        <div class="col-lg-12">

                            <button type="submit" class="btn btn-warning">
                                <i class="fa fa-save"></i>
                                Save About
                            </button>

                            <a href="about.php" class="btn btn-secondary">
                                Cancel
                            </a>

                        </div>

                    </div>
</div>
</div>
</div>
                </form>
</div>
</div>














<!-- Sneat JS -->

<script src="../assets/vendor/libs/jquery/jquery.js"></script>

<script src="../assets/vendor/js/bootstrap.js"></script>

<script src="../assets/vendor/js/menu.js"></script>

<script src="../assets/js/main.js"></script>

</body>

</html>