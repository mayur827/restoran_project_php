<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="assets/img/testimonial-1.jpg">
    <title>My Web</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/fontawesome.min.css" integrity="sha512-SMQ1DwSGiIDyNoXdQae7kUBADdtQa8Xsb3LxBxzAXExZNCCH/36yQSpZSYo1c6ckFshd1iMp9eD9+s9+tdhmyg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>


<?php
require_once 'demo-comman-dashbaord-new/connection.php';

/* =========================================================
   FETCH FOOD MENU DATA
========================================================= */

$query = "SELECT id, title, category, description, price, image
          FROM food_menu
          ORDER BY id DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Food menu query failed: " . mysqli_error($conn));
}

/* =========================================================
   STORE FOOD ITEMS
========================================================= */

$food_items = [];

while ($row = mysqli_fetch_assoc($result)) {
    $food_items[] = $row;
}
?>


<!-- =========================================================
     FOOD MENU TITLE
========================================================= -->

<h6 class="text-center text-warning small-title">
    <span></span>Food menu<span></span>
</h6>

<h1 class="text-center text-black">
    <strong>Most Popular Items</strong>
</h1>


<!-- =========================================================
     FOOD MENU TABS
========================================================= -->

<div class="food-menu-tabs">

    <ul class="nav nav-pills justify-content-center mb-5 mt-5">

        <!-- ================= BREAKFAST ================= -->

        <li class="nav-item">

            <a
                class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active menu-link"
                data-bs-toggle="pill"
                href="#tab-breakfast"
            >

                <i class="fa fa-coffee fa-2x"></i>

                <div class="ps-3">

                    <small class="text-body">
                        Popular
                    </small>

                    <h6 class="mt-n1 mb-0 text-black">
                        Breakfast
                    </h6>

                </div>

            </a>

        </li>


        <!-- ================= LUNCH ================= -->

        <li class="nav-item">

            <a
                class="d-flex align-items-center text-start mx-3 pb-3 menu-link"
                data-bs-toggle="pill"
                href="#tab-lunch"
            >

                <i class="fa fa-hamburger fa-2x"></i>

                <div class="ps-3">

                    <small class="text-body">
                        Special
                    </small>

                    <h6 class="mt-n1 mb-0 text-black">
                        Lunch
                    </h6>

                </div>

            </a>

        </li>


        <!-- ================= DINNER ================= -->

        <li class="nav-item">

            <a
                class="d-flex align-items-center text-start mx-3 me-0 pb-3 menu-link"
                data-bs-toggle="pill"
                href="#tab-dinner"
            >

                <i class="fa fa-utensils fa-2x"></i>

                <div class="ps-3">

                    <small class="text-body">
                        Lovely
                    </small>

                    <h6 class="mt-n1 mb-0 text-black">
                        Dinner
                    </h6>

                </div>

            </a>

        </li>

    </ul>

</div>


<!-- =========================================================
     FOOD MENU CONTENT
========================================================= -->

<div class="tab-content">


    <!-- =====================================================
         BREAKFAST
    ====================================================== -->

    <div
        id="tab-breakfast"
        class="tab-pane fade show active"
    >

        <div class="food-menu-container">

            <div class="row g-4">

                <?php

                $breakfast_found = false;

                foreach ($food_items as $food) {

                    if (strtolower(trim($food['category'])) != 'breakfast') {
                        continue;
                    }

                    $breakfast_found = true;

                ?>

                    <div class="col-lg-6 col-md-6">

                        <div class="food-item">

                            <!-- IMAGE -->

                            <img
                                class="flex-shrink-0 img-fluid rounded food-image"
                                src="/demo-comman-dashbaord-new/uploads/food_menu/<?php echo htmlspecialchars($food['image']); ?>"
                                alt="<?php echo htmlspecialchars($food['title']); ?>"
                            >


                            <!-- CONTENT -->

                            <div class="food-content">

                                <h5 class="food-title">

                                    <span>
                                        <?php echo htmlspecialchars($food['title']); ?>
                                    </span>

                                    <span class="text-warning war">
                                        ₹<?php echo number_format((float)$food['price'], 2); ?>
                                    </span>

                                </h5>


                                <small class="fst-italic food-description">

                                    <?php
                                    echo htmlspecialchars($food['description']);
                                    ?>

                                </small>

                            </div>

                        </div>

                    </div>

                <?php

                }

                if (!$breakfast_found) {

                ?>

                    <div class="col-12 text-center">

                        <p class="text-muted">
                            No breakfast items available.
                        </p>

                    </div>

                <?php } ?>

            </div>

        </div>

    </div>



    <!-- =====================================================
         LUNCH
    ====================================================== -->

    <div
        id="tab-lunch"
        class="tab-pane fade"
    >

        <div class="food-menu-container">

            <div class="row g-4">

                <?php

                $lunch_found = false;

                foreach ($food_items as $food) {

                    if (strtolower(trim($food['category'])) != 'lunch') {
                        continue;
                    }

                    $lunch_found = true;

                ?>

                    <div class="col-lg-6 col-md-6">

                        <div class="food-item">

                            <!-- IMAGE -->

                            <img
                                class="flex-shrink-0 img-fluid rounded food-image"
                                src="/demo-comman-dashbaord-new/uploads/food_menu/<?php echo htmlspecialchars($food['image']); ?>"
                                alt="<?php echo htmlspecialchars($food['title']); ?>"
                            >


                            <!-- CONTENT -->

                            <div class="food-content">

                                <h5 class="food-title">

                                    <span>
                                        <?php echo htmlspecialchars($food['title']); ?>
                                    </span>

                                    <span class="text-warning war">
                                        ₹<?php echo number_format((float)$food['price'], 2); ?>
                                    </span>

                                </h5>


                                <small class="fst-italic food-description">

                                    <?php
                                    echo htmlspecialchars($food['description']);
                                    ?>

                                </small>

                            </div>

                        </div>

                    </div>

                <?php

                }

                if (!$lunch_found) {

                ?>

                    <div class="col-12 text-center">

                        <p class="text-muted">
                            No lunch items available.
                        </p>

                    </div>

                <?php } ?>

            </div>

        </div>

    </div>



    <!-- =====================================================
         DINNER
    ====================================================== -->

    <div
        id="tab-dinner"
        class="tab-pane fade"
    >

        <div class="food-menu-container">

            <div class="row g-4">

                <?php

                $dinner_found = false;

                foreach ($food_items as $food) {

                    if (strtolower(trim($food['category'])) != 'dinner') {
                        continue;
                    }

                    $dinner_found = true;

                ?>

                    <div class="col-lg-6 col-md-6">

                        <div class="food-item">

                            <!-- IMAGE -->

                            <img
                                class="flex-shrink-0 img-fluid rounded food-image"
                                src="/demo-comman-dashbaord-new/uploads/food_menu/<?php echo htmlspecialchars($food['image']); ?>"
                                alt="<?php echo htmlspecialchars($food['title']); ?>"
                            >


                            <!-- CONTENT -->

                            <div class="food-content">

                                <h5 class="food-title">

                                    <span>
                                        <?php echo htmlspecialchars($food['title']); ?>
                                    </span>

                                    <span class="text-warning war">
                                        ₹<?php echo number_format((float)$food['price'], 2); ?>
                                    </span>

                                </h5>


                                <small class="fst-italic food-description">

                                    <?php
                                    echo htmlspecialchars($food['description']);
                                    ?>

                                </small>

                            </div>

                        </div>

                    </div>

                <?php

                }

                if (!$dinner_found) {

                ?>

                    <div class="col-12 text-center">

                        <p class="text-muted">
                            No dinner items available.
                        </p>

                    </div>

                <?php } ?>

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     FOOD MENU CSS
========================================================= -->

<style>

.food-menu-container {
    width: 100%;
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 15px;
}

.food-item {
    display: flex;
    align-items: center;
    width: 100%;
    min-height: 105px;
}

.food-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    flex-shrink: 0;
}

.food-content {
    width: 100%;
    padding-left: 20px;
    min-width: 0;
}

.food-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;

    width: 100%;

    margin-bottom: 8px;
    padding-bottom: 6px;

    border-bottom: 1px solid #dee2e6;

    font-weight: bold;
}

.food-title span:first-child {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.food-title .war {
    white-space: nowrap;
    flex-shrink: 0;
}

.food-description {
    display: block;
    line-height: 1.6;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991px) {

    .food-menu-container {
        max-width: 900px;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 767px) {

    .food-menu-container {
        padding: 0 15px;
    }

    .food-item {
        min-height: auto;
    }

    .food-image {
        width: 80px;
        height: 80px;
    }

    .food-content {
        padding-left: 15px;
    }

    .food-title {
        font-size: 18px;
        gap: 10px;
    }

    .food-description {
        font-size: 13px;
    }

}

</style>



<!-- <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active container">
                            <div class=" row g-4">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="assets/img/menu-1.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex align-items-center border-bottom pb-1" style="gap: 200px; width: fit-content; border-bottom: 1px solid #dee2e6;">
                                                <span style="font-weight: bold;">Chicken Burger</span>
                                                <span class="text-warning war">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="assets/img/menu-2.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex align-items-center border-bottom pb-1" style="gap: 200px; width: fit-content; border-bottom: 1px solid #dee2e6;">
                                                <span style="font-weight: bold;">Chicken Burger</span>
                                                <span class="text-warning war">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="assets/img/menu-3.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex align-items-center border-bottom pb-1" style="gap: 200px; width: fit-content; border-bottom: 1px solid #dee2e6;">
                                                <span style="font-weight: bold;">Chicken Burger</span>
                                                <span class="text-warning war">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="assets/img/menu-4.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex align-items-center border-bottom pb-1" style="gap: 200px; width: fit-content; border-bottom: 1px solid #dee2e6;">
                                                <span style="font-weight: bold;">Chicken Burger</span>
                                                <span class="text-warning war">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="assets/img/menu-5.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex align-items-center border-bottom pb-1" style="gap: 200px; width: fit-content; border-bottom: 1px solid #dee2e6;">
                                                <span style="font-weight: bold;">Chicken Burger</span>
                                                <span class="text-warning war">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="assets/img/menu-6.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex align-items-center border-bottom pb-1" style="gap: 200px; width: fit-content; border-bottom: 1px solid #dee2e6;">
                                                <span style="font-weight: bold;">Chicken Burger</span>
                                                <span class="text-warning war">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="assets/img/menu-7.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex align-items-center border-bottom pb-1" style="gap: 200px; width: fit-content; border-bottom: 1px solid #dee2e6;">
                                                <span style="font-weight: bold;">Chicken Burger</span>
                                                <span class="text-warning war">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid rounded" src="assets/img/menu-8.jpg" alt="" style="width: 80px;">
                                        <div class="w-100 d-flex flex-column text-start ps-4">
                                            <h5 class="d-flex align-items-center border-bottom pb-1" style="gap: 200px; width: fit-content; border-bottom: 1px solid #dee2e6;">
                                                <span style="font-weight: bold;">Chicken Burger</span>
                                                <span class="text-warning war">$115</span>
                                            </h5>
                                            <small class="fst-italic">Ipsum ipsum clita erat amet dolor justo diam</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       -->



   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>