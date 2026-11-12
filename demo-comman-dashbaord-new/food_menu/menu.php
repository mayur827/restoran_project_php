<?php

require_once '../connection.php';


// ================= FETCH FOOD MENU =================

$query = "SELECT * FROM food_menu ORDER BY id DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
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


<body data-restaurant-page="menu">


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
            Food Menu
        </h4>

        <p class="text-muted mb-0">
            Manage restaurant food menu
        </p>

    </div>


    <!-- Add Food Button -->

    <a
        href="add.php"
        class="btn btn-warning"
    >

        <i class="bx bx-plus me-1"></i>

        Add Food

    </a>

</div>


<!-- ================= SUCCESS MESSAGE ================= -->

<?php if (isset($_GET['success'])) { ?>

<div class="alert alert-success alert-dismissible fade show">

    <?php echo htmlspecialchars($_GET['success']); ?>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

<?php } ?>


<!-- ================= ERROR MESSAGE ================= -->

<?php if (isset($_GET['error'])) { ?>

<div class="alert alert-danger alert-dismissible fade show">

    <?php echo htmlspecialchars($_GET['error']); ?>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

<?php } ?>


<!-- ================= FOOD MENU CARD ================= -->

<div class="card">


<div class="card-header">

    <h5 class="mb-0">
        Food Menu Information
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

    <th>Category</th>

    <th>Description</th>

    <th>Price</th>

    <th>Action</th>

</tr>

</thead>


<tbody>


<?php

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
        src="../uploads/food_menu/<?php echo htmlspecialchars($row['image']); ?>"
        width="70"
        height="60"
        class="rounded"
        style="object-fit:cover; cursor:pointer;"
        data-bs-toggle="modal"
        data-bs-target="#imageModal<?php echo $row['id']; ?>"
        alt="Food Image"
    >

<?php } else { ?>

    <div
        class="rounded bg-light d-flex align-items-center justify-content-center"
        style="width:70px;height:60px;"
    >

        <i class="bx bx-image text-muted fs-3"></i>

    </div>

<?php } ?>

</td>


<!-- ================= TITLE ================= -->

<td>

    <strong>

        <?php echo htmlspecialchars($row['title']); ?>

    </strong>

</td>


<!-- ================= CATEGORY ================= -->

<td>

<?php

$category = $row['category'];

if ($category == 'Breakfast') {

    echo '<span class="badge bg-label-warning">Breakfast</span>';

} elseif ($category == 'Lunch') {

    echo '<span class="badge bg-label-success">Lunch</span>';

} elseif ($category == 'Dinner') {

    echo '<span class="badge bg-label-primary">Dinner</span>';

} else {

    echo '<span class="badge bg-label-secondary">'
        . htmlspecialchars($category)
        . '</span>';

}

?>

</td>


<!-- ================= DESCRIPTION ================= -->

<td
    style="min-width:300px;"
    class="description"
>

    <?php echo htmlspecialchars($row['description']); ?>

</td>


<!-- ================= PRICE ================= -->

<td>

    <strong>

        ₹<?php echo number_format((float)$row['price'], 2); ?>

    </strong>

</td>


<!-- ================= ACTION ================= -->

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
    onclick="return confirm('Are you sure you want to delete this food item?');"
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

    <td
        colspan="7"
        class="text-center py-4"
    >

        <i class="bx bx-info-circle me-1"></i>

        No food menu found.

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

<!-- ================= / FOOD MENU CARD ================= -->


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

/*
|--------------------------------------------------------------------------
| Image Modal
|--------------------------------------------------------------------------
*/

$modal_query = "SELECT id, title, image
                FROM food_menu
                WHERE image IS NOT NULL
                AND image != ''
                ORDER BY id DESC";

$modal_result = mysqli_query($conn, $modal_query);


if ($modal_result && mysqli_num_rows($modal_result) > 0) {

    while ($modal = mysqli_fetch_assoc($modal_result)) {

?>


<div
    class="modal fade"
    id="imageModal<?php echo $modal['id']; ?>"
    tabindex="-1"
    aria-hidden="true"
>


<div class="modal-dialog modal-dialog-centered modal-lg">


<div class="modal-content">


<!-- MODAL HEADER -->

<div class="modal-header">

    <h5 class="modal-title">

        <?php echo htmlspecialchars($modal['title']); ?>

    </h5>


    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="modal"
        aria-label="Close"
    ></button>

</div>


<!-- MODAL BODY -->

<div class="modal-body text-center">

    <img
        src="../uploads/food_menu/<?php echo htmlspecialchars($modal['image']); ?>"
        class="img-fluid rounded"
        alt="<?php echo htmlspecialchars($modal['title']); ?>"
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