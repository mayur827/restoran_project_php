<?php

require_once '../connection.php';

$error = "";


// =========================
// ADD FOOD
// =========================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '');

    $image = "";


    // =========================
    // VALIDATION
    // =========================

    if (
        empty($title) ||
        empty($category) ||
        empty($description) ||
        $price === ''
    ) {

        $error = "Please fill all fields.";

    } elseif (!in_array($category, ['Breakfast', 'Lunch', 'Dinner'], true)) {

        $error = "Please select a valid food category.";

    } elseif (!is_numeric($price) || (float)$price < 0) {

        $error = "Please enter a valid price.";

    } elseif (
        !isset($_FILES['image']) ||
        $_FILES['image']['error'] !== UPLOAD_ERR_OK
    ) {

        $error = "Please select a food image.";

    } else {


        // =========================
        // IMAGE UPLOAD
        // =========================

        $upload_dir = "../uploads/food_menu/";


        if (!is_dir($upload_dir)) {

            if (!mkdir($upload_dir, 0777, true)) {

                $error = "Unable to create image upload folder.";

            }

        }


        if (empty($error)) {

            $extension = strtolower(
                pathinfo(
                    $_FILES['image']['name'],
                    PATHINFO_EXTENSION
                )
            );


            $allowed_extensions = [
                'jpg',
                'jpeg',
                'png',
                'webp'
            ];


            if (!in_array($extension, $allowed_extensions, true)) {

                $error = "Only JPG, JPEG, PNG or WEBP images are allowed.";

            } else {

                $image = time() . "_" . uniqid() . "." . $extension;

                $image_path = $upload_dir . $image;


                if (!move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    $image_path
                )) {

                    $error = "Image upload failed.";

                }

            }

        }

    }


    // =========================
    // INSERT INTO DATABASE
    // =========================

    if (empty($error)) {

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO food_menu
            (title, category, description, price, image)
            VALUES (?, ?, ?, ?, ?)"
        );


        if (!$stmt) {

            if (!empty($image)) {

                $image_path = "../uploads/food_menu/" . $image;

                if (file_exists($image_path)) {
                    unlink($image_path);
                }

            }

            $error = "Database error: " . mysqli_error($conn);

        } else {

            $price = (float)$price;


            mysqli_stmt_bind_param(
                $stmt,
                "sssds",
                $title,
                $category,
                $description,
                $price,
                $image
            );


            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_close($stmt);

                header(
                    "Location: menu.php?success=Food added successfully"
                );

                exit;

            } else {

                $error = "Unable to add food.";

                mysqli_stmt_close($stmt);


                // Delete uploaded image if DB insert fails

                if (!empty($image)) {

                    $image_path = "../uploads/food_menu/" . $image;

                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }

                }

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

    ADD FOOD

</div>


<?php if (!empty($error)) { ?>

<div class="alert alert-danger mt-3">

    <?php echo htmlspecialchars($error); ?>

</div>

<?php } ?>


<div class="table-responsive">


<div class="container row g-4 mt-3">


<!-- ================= TITLE ================= -->

<div class="col-lg-6">

<label class="form-label">

    Food Title

</label>


<input
    type="text"
    name="title"
    class="form-control"
    placeholder="Enter food title"
    value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>"
    required
>

</div>


<!-- ================= CATEGORY ================= -->

<div class="col-lg-6">

<label class="form-label">

    Food Category

</label>


<select
    name="category"
    class="form-select"
    required
>


<option value="">

    Select Food Category

</option>


<option
    value="Breakfast"
    <?php echo (($_POST['category'] ?? '') === 'Breakfast') ? 'selected' : ''; ?>
>

    Breakfast

</option>


<option
    value="Lunch"
    <?php echo (($_POST['category'] ?? '') === 'Lunch') ? 'selected' : ''; ?>
>

    Lunch

</option>


<option
    value="Dinner"
    <?php echo (($_POST['category'] ?? '') === 'Dinner') ? 'selected' : ''; ?>
>

    Dinner

</option>


</select>

</div>


<!-- ================= PRICE ================= -->

<div class="col-lg-6">

<label class="form-label">

    Price

</label>


<input
    type="number"
    name="price"
    class="form-control"
    placeholder="Enter price"
    step="0.01"
    min="0"
    value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>"
    required
>

</div>


<!-- ================= IMAGE ================= -->

<div class="col-lg-6">

<label class="form-label">

    Food Image

</label>


<input
    type="file"
    name="image"
    class="form-control"
    accept=".jpg,.jpeg,.png,.webp"
    required
>


<small class="text-muted">

    JPG, JPEG, PNG or WEBP

</small>

</div>


<!-- ================= DESCRIPTION ================= -->

<div class="col-lg-12">

<label class="form-label">

    Description

</label>


<textarea
    name="description"
    class="form-control"
    rows="5"
    placeholder="Enter food description"
    required
><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>

</div>


<!-- ================= BUTTONS ================= -->

<div class="col-lg-12 d-flex align-item-start gap-2">


<button
    type="submit"
    class="btn btn-warning"
>

    <i class="fa-solid fa-plus"></i>

    Add Food

</button>


<a
    href="menu.php"
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


</div>


</div>


<!-- ================= SNEAT JS ================= -->

<script src="../assets/vendor/libs/jquery/jquery.js"></script>

<script src="../assets/vendor/js/bootstrap.js"></script>

<script src="../assets/vendor/js/menu.js"></script>

<script src="../assets/js/main.js"></script>


</body>

</html>