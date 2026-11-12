<?php

require_once '../connection.php';

$error = "";


// =========================
// CHECK ID
// =========================

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    header("Location: menu.php?error=Invalid food ID");
    exit;

}

$id = (int)$_GET['id'];


// =========================
// FETCH FOOD
// =========================

$stmt = mysqli_prepare(
    $conn,
    "SELECT id, title, category, description, price, image
     FROM food_menu
     WHERE id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


if (mysqli_num_rows($result) === 0) {

    mysqli_stmt_close($stmt);

    header("Location: menu.php?error=Food item not found");
    exit;

}


$food = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


// =========================
// UPDATE FOOD
// =========================

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '');

    $old_image = $food['image'];
    $new_image = $old_image;


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

    }


    // =========================
    // NEW IMAGE
    // =========================

    if (
        empty($error) &&
        isset($_FILES['image']) &&
        $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE
    ) {

        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {

            $error = "Image upload failed.";

        } else {

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

                    $new_image =
                        time() . "_" .
                        uniqid() . "." .
                        $extension;


                    $new_image_path =
                        $upload_dir . $new_image;


                    if (!move_uploaded_file(
                        $_FILES['image']['tmp_name'],
                        $new_image_path
                    )) {

                        $error = "Image upload failed.";

                    }

                }

            }

        }

    }


    // =========================
    // UPDATE DATABASE
    // =========================

    if (empty($error)) {

        $price = (float)$price;


        $stmt = mysqli_prepare(
            $conn,
            "UPDATE food_menu
             SET title = ?,
                 category = ?,
                 description = ?,
                 price = ?,
                 image = ?
             WHERE id = ?"
        );


        if (!$stmt) {

            $error = "Database error: " . mysqli_error($conn);

        } else {

            mysqli_stmt_bind_param(
                $stmt,
                "sssdsi",
                $title,
                $category,
                $description,
                $price,
                $new_image,
                $id
            );


            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_close($stmt);


                // Delete old image ONLY after successful update

                if (
                    !empty($old_image) &&
                    $new_image !== $old_image
                ) {

                    $old_image_path =
                        "../uploads/food_menu/" .
                        $old_image;


                    if (file_exists($old_image_path)) {

                        unlink($old_image_path);

                    }

                }


                header(
                    "Location: menu.php?success=Food updated successfully"
                );

                exit;

            } else {

                mysqli_stmt_close($stmt);


                // Delete new image if database update fails

                if (
                    $new_image !== $old_image &&
                    !empty($new_image)
                ) {

                    $new_image_path =
                        "../uploads/food_menu/" .
                        $new_image;


                    if (file_exists($new_image_path)) {

                        unlink($new_image_path);

                    }

                }


                $error = "Unable to update food.";

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

    UPDATE FOOD

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
    value="<?php echo htmlspecialchars($_POST['title'] ?? $food['title']); ?>"
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
    <?php
    echo (
        ($_POST['category'] ?? $food['category']) === 'Breakfast'
    ) ? 'selected' : '';
    ?>
>

    Breakfast

</option>


<option
    value="Lunch"
    <?php
    echo (
        ($_POST['category'] ?? $food['category']) === 'Lunch'
    ) ? 'selected' : '';
    ?>
>

    Lunch

</option>


<option
    value="Dinner"
    <?php
    echo (
        ($_POST['category'] ?? $food['category']) === 'Dinner'
    ) ? 'selected' : '';
    ?>
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
    value="<?php echo htmlspecialchars($_POST['price'] ?? $food['price']); ?>"
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
>


<small class="text-muted">

    JPG, JPEG, PNG or WEBP

</small>


<?php if (!empty($food['image'])) { ?>

<div class="mt-2">

    <img
        src="../uploads/food_menu/<?php echo htmlspecialchars($food['image']); ?>"
        width="100"
        height="80"
        class="rounded"
        style="object-fit:cover;"
        alt="Current Food Image"
    >

</div>

<?php } ?>


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
><?php echo htmlspecialchars($_POST['description'] ?? $food['description']); ?></textarea>

</div>


<!-- ================= BUTTONS ================= -->

<div class="col-lg-12 d-flex align-item-start gap-2">


<button
    type="submit"
    class="btn btn-warning"
>

    <i class="bx bx-edit"></i>

    Edit Food

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