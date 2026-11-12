<?php
/* =========================================================
   DATABASE CONNECTION
========================================================= */

include '../connection.php';


/* =========================================================
   LIVE DASHBOARD COUNTS
========================================================= */

$about_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM about")
)['total'];

$chef_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM our_master_cheif")
)['total'];

$service_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM service")
)['total'];

$menu_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM food_menu")
)['total'];

$testimonial_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM testimonials")
)['total'];

$reservation_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM reservations")
)['total'];


/* =========================================================
   NEW BOOKING COUNT
========================================================= */

$booking_count = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM booking")
)['total'];


/* =========================================================
   RESERVATION SUMMARY
========================================================= */

$upcoming_reservations = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COUNT(*) AS total
         FROM reservations
         WHERE reservation_date >= CURDATE()"
    )
)['total'];

$total_guests = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT COALESCE(SUM(no_of_people), 0) AS total
         FROM reservations"
    )
)['total'];


/* =========================================================
   LATEST FOOD MENU
========================================================= */

$food_result = mysqli_query(
    $conn,
    "SELECT id, title, category, description, price, image
     FROM food_menu
     ORDER BY id DESC
     LIMIT 3"
);


/* =========================================================
   LATEST CHEFS
========================================================= */

$chef_result = mysqli_query(
    $conn,
    "SELECT id, chef_name, designation, image
     FROM our_master_cheif
     ORDER BY id DESC
     LIMIT 3"
);


/* =========================================================
   LATEST TESTIMONIALS
========================================================= */

$testimonial_result = mysqli_query(
    $conn,
    "SELECT id, client_name, profession, description, image
     FROM testimonials
     ORDER BY id DESC
     LIMIT 2"
);


/* =========================================================
   RECENT RESERVATIONS
========================================================= */

$reservation_result = mysqli_query(
    $conn,
    "SELECT id, name, email, reservation_date, reservation_time, no_of_people
     FROM reservations
     ORDER BY id DESC
     LIMIT 5"
);


/* =========================================================
   RECENT BOOKINGS
========================================================= */

$booking_result = mysqli_query(
    $conn,
    "SELECT id, name, email, subject, message, created_at
     FROM booking
     ORDER BY id DESC
     LIMIT 5"
);

?>

<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
    data-theme="theme-default"
    data.-assets-path="../assets/"
    data-template="vertical-menu-template-free"
>

<?php include '../common/header.php'; ?>


<body>


<!-- =========================================================
     LAYOUT WRAPPER
========================================================= -->

<div class="layout-wrapper layout-content-navbar">

    <div class="layout-container">


        <!-- =====================================================
             SIDEBAR
        ====================================================== -->

        <?php include '../common/sidebar.php'; ?>


        <!-- =====================================================
             LAYOUT PAGE
        ====================================================== -->

        <div class="layout-page">


            <!-- =================================================
                 NAVBAR
            ================================================== -->

            <?php include '../common/navbar.php'; ?>


            <!-- =================================================
                 CONTENT WRAPPER
            ================================================== -->

            <div class="content-wrapper">


                <!-- =================================================
                     MAIN CONTENT
                ================================================== -->

                <div class="container-xxl flex-grow-1 container-p-y">


                    <!-- =================================================
                         WELCOME SECTION
                    ================================================== -->

                    <div class="row">

                        <div class="col-lg-12 mb-4">

                            <div class="card welcome-card">

                                <div class="row align-items-center">

                                    <!-- TEXT -->

                                    <div class="col-md-8">

                                        <div class="card-body">

                                            <h5
                                                class="card-title text-warning"
                                            >
                                                Congratulations Mayur! 🎉
                                            </h5>


                                            <p class="mb-4">

                                                Your restaurant dashboard is
                                                connected with the database.
                                                You currently have

                                                <span
                                                    class="fw-bold text-warning"
                                                >
                                                    <?php echo $reservation_count; ?>
                                                </span>

                                                reservations and

                                                <span
                                                    class="fw-bold text-warning"
                                                >
                                                    <?php echo $booking_count; ?>
                                                </span>

                                                customer bookings in the system.

                                            </p>


                                            <a
                                                href="javascript:;"
                                                class="btn btn-sm btn-outline-warning"
                                            >
                                                View Badges
                                            </a>

                                        </div>

                                    </div>


                                    <!-- IMAGE -->

                                    <div class="col-md-4 text-center">

                                        <div class="welcome-image-box">

                                            <img
                                                src="../assets/img/illustrations/man-with-laptop-light.png"
                                                alt="Restaurant Dashboard"
                                                class="welcome-image"
                                            >

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- =================================================
                         RESTAURANT STATISTICS
                    ================================================== -->

                    <div class="row">


                        <!-- =================================================
                             ABOUT RESTAURANT
                        ================================================== -->

                        <div class="col-xl-3 col-md-6 col-sm-6 mb-4">

                            <div class="card restaurant-stat-card">

                                <div class="card-body">

                                    <div class="d-flex align-items-center justify-content-between">

                                        <div class="restaurant-icon food-icon">

                                            <i class="bx bx-restaurant"></i>

                                        </div>

                                        <span class="stat-label text-warning">

                                            RESTAURANT

                                        </span>

                                    </div>


                                    <h3 class="stat-number">

                                        <?php echo str_pad($about_count, 2, '0', STR_PAD_LEFT); ?>

                                    </h3>


                                    <h6 class="stat-title">

                                        About Restaurant

                                    </h6>


                                    <p class="stat-text">

                                        Restaurant information sections

                                    </p>


                                    <a
                                        href="/demo-comman-dashbaord-new/about/about.php"
                                        class="stat-link text-warning"
                                    >

                                        View Information

                                        <i class="bx bx-right-arrow-alt"></i>

                                    </a>

                                </div>

                            </div>

                        </div>



                        <!-- =================================================
                             OUR CHEF
                        ================================================== -->

                        <div class="col-xl-3 col-md-6 col-sm-6 mb-4">

                            <div class="card restaurant-stat-card">

                                <div class="card-body">

                                    <div class="d-flex align-items-center justify-content-between">

                                        <div class="restaurant-icon chef-icon">

                                            <i class="bx bx-user"></i>

                                        </div>

                                        <span class="stat-label text-warning">

                                            CHEFS

                                        </span>

                                    </div>


                                    <h3 class="stat-number">

                                        <?php echo str_pad($chef_count, 2, '0', STR_PAD_LEFT); ?>

                                    </h3>


                                    <h6 class="stat-title">

                                        Our Chefs

                                    </h6>


                                    <p class="stat-text">

                                        Professional restaurant chefs

                                    </p>


                                    <a
                                        href="/demo-comman-dashbaord-new/our_chef/chef.php"
                                        class="stat-link text-warning"
                                    >

                                        View Chefs

                                        <i class="bx bx-right-arrow-alt"></i>

                                    </a>

                                </div>

                            </div>

                        </div>



                        <!-- =================================================
                             SERVICES
                        ================================================== -->

                        <div class="col-xl-3 col-md-6 col-sm-6 mb-4">

                            <div class="card restaurant-stat-card">

                                <div class="card-body">

                                    <div class="d-flex align-items-center justify-content-between">

                                        <div class="restaurant-icon service-icon">

                                            <i class="bx bx-briefcase"></i>

                                        </div>

                                        <span class="stat-label text-warning">

                                            SERVICES

                                        </span>

                                    </div>


                                    <h3 class="stat-number">

                                        <?php echo str_pad($service_count, 2, '0', STR_PAD_LEFT); ?>

                                    </h3>


                                    <h6 class="stat-title">

                                        Restaurant Services

                                    </h6>


                                    <p class="stat-text">

                                        Services available for customers

                                    </p>


                                    <a
                                        href="/demo-comman-dashbaord-new/services/service.php"
                                        class="stat-link text-warning"
                                    >

                                        View Services

                                        <i class="bx bx-right-arrow-alt"></i>

                                    </a>

                                </div>

                            </div>

                        </div>



                        <!-- =================================================
                             FOOD MENU
                        ================================================== -->

                        <div class="col-xl-3 col-md-6 col-sm-6 mb-4">

                            <div class="card restaurant-stat-card">

                                <div class="card-body">

                                    <div class="d-flex align-items-center justify-content-between">

                                        <div class="restaurant-icon menu-icon-box">

                                            <i class="bx bx-food-menu"></i>

                                        </div>

                                        <span class="stat-label text-warning">

                                            FOOD MENU

                                        </span>

                                    </div>


                                    <h3 class="stat-number">

                                        <?php echo str_pad($menu_count, 2, '0', STR_PAD_LEFT); ?>

                                    </h3>


                                    <h6 class="stat-title">

                                        Menu Items

                                    </h6>


                                    <p class="stat-text">

                                        Food items currently available

                                    </p>


                                    <a
                                        href="/demo-comman-dashbaord-new/food_menu/menu.php"
                                        class="stat-link text-warning"
                                    >

                                        View Menu

                                        <i class="bx bx-right-arrow-alt"></i>

                                    </a>

                                </div>

                            </div>

                        </div>


                    </div>



                    <!-- =================================================
                         SECOND SECTION
                    ================================================== -->

                    <div class="row">


                        <!-- =================================================
                             RESTAURANT OVERVIEW
                        ================================================== -->

                        <div class="col-lg-8 mb-4">

                            <div class="card h-100">

                                <div class="card-header">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <h5 class="card-title mb-1">

                                                Restaurant Overview

                                            </h5>

                                            <small class="text-muted">

                                                Current restaurant website content

                                            </small>

                                        </div>


                                        <span class="overview-badge text-warning">

                                            ACTIVE

                                        </span>

                                    </div>

                                </div>


                                <div class="card-body">


                                    <!-- ABOUT RESTAURANT -->

                                    <div class="overview-item">

                                        <div class="overview-left">

                                            <div class="overview-icon bg-label-primary">

                                                <i class="bx bx-restaurant"></i>

                                            </div>

                                            <div>

                                                <h6 class="mb-1">

                                                    About Restaurant

                                                </h6>

                                                <small class="text-muted">

                                                    Restaurant information

                                                </small>

                                            </div>

                                        </div>


                                        <div class="overview-right">

                                            <strong>

                                                <?php echo $about_count; ?> Records

                                            </strong>

                                            <a class="text-warning"
                                                href="/demo-comman-dashbaord-new/about/about.php"
                                            >

                                                View

                                            </a>

                                        </div>

                                    </div>



                                    <!-- OUR CHEFS -->

                                    <div class="overview-item">

                                        <div class="overview-left">

                                            <div class="overview-icon bg-label-success">

                                                <i class="bx bx-user"></i>

                                            </div>

                                            <div>

                                                <h6 class="mb-1">

                                                    Our Chefs

                                                </h6>

                                                <small class="text-muted">

                                                    Professional chef information

                                                </small>

                                            </div>

                                        </div>


                                        <div class="overview-right">

                                            <strong>

                                                <?php echo $chef_count; ?> Chefs

                                            </strong>

                                            <a class="text-warning"
                                                href="/demo-comman-dashbaord-new/our_chef/chef.php"
                                            >

                                                View

                                            </a>

                                        </div>

                                    </div>



                                    <!-- SERVICES -->

                                    <div class="overview-item">

                                        <div class="overview-left">

                                            <div class="overview-icon bg-label-info">

                                                <i class="bx bx-briefcase"></i>

                                            </div>

                                            <div>

                                                <h6 class="mb-1">

                                                    Services

                                                </h6>

                                                <small class="text-muted">

                                                    Restaurant services

                                                </small>

                                            </div>

                                        </div>


                                        <div class="overview-right">

                                            <strong>

                                                <?php echo $service_count; ?> Services

                                            </strong>

                                            <a class="text-warning"
                                                href="/demo-comman-dashbaord-new/services/service.php"
                                            >

                                                View

                                            </a>

                                        </div>

                                    </div>



                                    <!-- FOOD MENU -->

                                    <div class="overview-item">

                                        <div class="overview-left">

                                            <div class="overview-icon bg-label-warning">

                                                <i class="bx bx-food-menu"></i>

                                            </div>

                                            <div>

                                                <h6 class="mb-1">

                                                    Food Menu

                                                </h6>

                                                <small class="text-muted">

                                                    Restaurant food collection

                                                </small>

                                            </div>

                                        </div>


                                        <div class="overview-right">

                                            <strong>

                                                <?php echo $menu_count; ?> Items

                                            </strong>

                                            <a class="text-warning"
                                                href="/demo-comman-dashbaord-new/food_menu/menu.php"
                                            >

                                                View

                                            </a>

                                        </div>

                                    </div>



                                    <!-- TESTIMONIALS -->

                                    <div class="overview-item">

                                        <div class="overview-left">

                                            <div class="overview-icon bg-label-danger">

                                                <i class="bx bx-message-rounded-detail"></i>

                                            </div>

                                            <div>

                                                <h6 class="mb-1">

                                                    Testimonials

                                                </h6>

                                                <small class="text-muted">

                                                    Customer feedback

                                                </small>

                                            </div>

                                        </div>


                                        <div class="overview-right">

                                            <strong>

                                                <?php echo $testimonial_count; ?> Reviews

                                            </strong>

                                            <a class="text-warning"
                                                href="/demo-comman-dashbaord-new/testimonials/testimonial.php"
                                            >

                                                View

                                            </a>

                                        </div>

                                    </div>



                                    <!-- RESERVATIONS -->

                                    <div class="overview-item">

                                        <div class="overview-left">

                                            <div class="overview-icon bg-label-primary">

                                                <i class="bx bx-calendar-check"></i>

                                            </div>

                                            <div>

                                                <h6 class="mb-1">

                                                    Reservations

                                                </h6>

                                                <small class="text-muted">

                                                    Customer table bookings

                                                </small>

                                            </div>

                                        </div>


                                        <div class="overview-right">

                                            <strong>

                                                <?php echo $reservation_count; ?> Bookings

                                            </strong>

                                            <a class="text-warning"
                                                href="/demo-comman-dashbaord-new/reservations/reservation.php"
                                            >

                                                View

                                            </a>

                                        </div>

                                    </div>



                                    <!-- =================================================
                                         NEW BOOKING
                                    ================================================== -->

                                    <div class="overview-item">

                                        <div class="overview-left">

                                            <div class="overview-icon bg-label-warning">

                                                <i class="bx bx-calendar"></i>

                                            </div>

                                            <div>

                                                <h6 class="mb-1">

                                                    Contact

                                                </h6>

                                                <small class="text-muted">

                                                    Customer contacts

                                                </small>

                                            </div>

                                        </div>


                                        <div class="overview-right">

                                            <strong>

                                                <?php echo $booking_count; ?> Bookings

                                            </strong>

                                            <a class="text-warning"
                                                href="/demo-comman-dashbaord-new/contact/booking.php"
                                            >

                                                View

                                            </a>

                                        </div>

                                    </div>


                                </div>

                            </div>

                        </div>



                        <!-- =================================================
                             QUICK ACCESS
                        ================================================== -->

                        <div class="col-lg-4 mb-4">

                            <div class="card h-100">

                                <div class="card-header">

                                    <h5 class="card-title mb-1">

                                        Quick Access

                                    </h5>

                                    <small class="text-muted">

                                        Manage restaurant content

                                    </small>

                                </div>


                                <div class="card-body">


                                    <!-- ABOUT -->

                                    <a
                                        href="/demo-comman-dashbaord-new/about/about.php"
                                        class="quick-link"
                                    >

                                        <span class="quick-icon bg-label-primary">

                                            <i class="bx bx-restaurant"></i>

                                        </span>

                                        <span>

                                            <strong>

                                                About Restaurant

                                            </strong>

                                            <small>

                                                Manage restaurant information

                                            </small>

                                        </span>

                                        <i class="bx bx-chevron-right"></i>

                                    </a>



                                    <!-- CHEFS -->

                                    <a
                                        href="/demo-comman-dashbaord-new/our_chef/chef.php"
                                        class="quick-link"
                                    >

                                        <span class="quick-icon bg-label-success">

                                            <i class="bx bx-user"></i>

                                        </span>

                                        <span>

                                            <strong>

                                                Our Chefs

                                            </strong>

                                            <small>

                                                Manage restaurant chefs

                                            </small>

                                        </span>

                                        <i class="bx bx-chevron-right"></i>

                                    </a>



                                    <!-- SERVICES -->

                                    <a
                                        href="/demo-comman-dashbaord-new/services/service.php"
                                        class="quick-link"
                                    >

                                        <span class="quick-icon bg-label-info">

                                            <i class="bx bx-briefcase"></i>

                                        </span>

                                        <span>

                                            <strong>

                                                Services

                                            </strong>

                                            <small>

                                                Manage restaurant services

                                            </small>

                                        </span>

                                        <i class="bx bx-chevron-right"></i>

                                    </a>



                                    <!-- FOOD MENU -->

                                    <a
                                        href="/demo-comman-dashbaord-new/food_menu/menu.php"
                                        class="quick-link"
                                    >

                                        <span class="quick-icon bg-label-warning">

                                            <i class="bx bx-food-menu"></i>

                                        </span>

                                        <span>

                                            <strong>

                                                Food Menu

                                            </strong>

                                            <small>

                                                Manage food items and prices

                                            </small>

                                        </span>

                                        <i class="bx bx-chevron-right"></i>

                                    </a>



                                    <!-- TESTIMONIALS -->

                                    <a
                                        href="/demo-comman-dashbaord-new/testimonials/testimonial.php"
                                        class="quick-link"
                                    >

                                        <span class="quick-icon bg-label-danger">

                                            <i class="bx bx-message-rounded-detail"></i>

                                        </span>

                                        <span>

                                            <strong>

                                                Testimonials

                                            </strong>

                                            <small>

                                                View customer feedback

                                            </small>

                                        </span>

                                        <i class="bx bx-chevron-right"></i>

                                    </a>



                                    <!-- RESERVATIONS -->

                                    <a
                                        href="/demo-comman-dashbaord-new/reservations/reservation.php"
                                        class="quick-link"
                                    >

                                        <span class="quick-icon bg-label-primary">

                                            <i class="bx bx-calendar-check"></i>

                                        </span>

                                        <span>

                                            <strong>

                                                Reservations

                                            </strong>

                                            <small>

                                                Manage customer bookings

                                            </small>

                                        </span>

                                        <i class="bx bx-chevron-right"></i>

                                    </a>



                                    <!-- NEW BOOKING -->

                                    <a
                                        href="/demo-comman-dashbaord-new/contact/booking.php"
                                        class="quick-link"
                                    >

                                        <span class="quick-icon bg-label-warning">

                                            <i class="bx bx-calendar"></i>

                                        </span>

                                        <span>

                                            <strong>

                                                Contact

                                            </strong>

                                            <small>

                                                View customer contacts

                                            </small>

                                        </span>

                                        <i class="bx bx-chevron-right"></i>

                                    </a>


                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- =================================================
                         THIRD SECTION
                    ================================================== -->

                    <div class="row">


                        <!-- =================================================
                             FOOD MENU SUMMARY
                        ================================================== -->

                        <div class="col-lg-8 mb-4">

                            <div class="card">

                                <div class="card-header">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <h5 class="card-title mb-1">

                                                Food Menu Summary

                                            </h5>

                                            <small class="text-muted">

                                                Current food items in restaurant menu

                                            </small>

                                        </div>


                                        <a
                                            href="/demo-comman-dashbaord-new/food_menu/menu.php"
                                            class="btn btn-sm btn-outline-warning"
                                        >

                                            View All

                                        </a>

                                    </div>

                                </div>


                                <div class="table-responsive">

                                    <table class="table table-hover align-middle mb-0">

                                        <thead>

                                            <tr>

                                                <th>ID</th>

                                                <th>Food Item</th>

                                                <th>Category</th>

                                                <th>Price</th>

                                            </tr>

                                        </thead>


                                        <tbody>

                                        <?php if (mysqli_num_rows($food_result) > 0): ?>

                                            <?php while ($food = mysqli_fetch_assoc($food_result)): ?>

                                                <tr>

                                                    <td>

                                                        <strong>

                                                            <?php echo str_pad($food['id'], 2, '0', STR_PAD_LEFT); ?>

                                                        </strong>

                                                    </td>

                                                    <td>

                                                        <div class="d-flex align-items-center">

                                                            <div class="avatar me-3">

                                                                <?php if (!empty($food['image'])): ?>

                                                                    <img
                                                                        src="../uploads/food_menu/<?php echo htmlspecialchars($food['image']); ?>"
                                                                        alt="<?php echo htmlspecialchars($food['title']); ?>"
                                                                        class="rounded"
                                                                    >

                                                                <?php else: ?>

                                                                    <img
                                                                        src="../assets/img/elements/12.jpg"
                                                                        alt="<?php echo htmlspecialchars($food['title']); ?>"
                                                                        class="rounded"
                                                                    >

                                                                <?php endif; ?>

                                                            </div>

                                                            <div>

                                                                <h6 class="mb-0">

                                                                    <?php echo htmlspecialchars($food['title']); ?>

                                                                </h6>

                                                                <small class="text-muted">

                                                                    <?php echo htmlspecialchars($food['description']); ?>

                                                                </small>

                                                            </div>

                                                        </div>

                                                    </td>

                                                    <td>

                                                        <span class="badge bg-label-primary">

                                                            <?php echo htmlspecialchars($food['category']); ?>

                                                        </span>

                                                    </td>

                                                    <td>

                                                        <strong>

                                                            ₹<?php echo number_format((float)$food['price'], 2); ?>

                                                        </strong>

                                                    </td>

                                                </tr>

                                            <?php endwhile; ?>

                                        <?php else: ?>

                                            <tr>

                                                <td colspan="4" class="text-center text-muted">

                                                    No food items found.

                                                </td>

                                            </tr>

                                        <?php endif; ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>



                        <!-- =================================================
                             RESERVATION SUMMARY
                        ================================================== -->

                        <div class="col-lg-4 mb-4">

                            <div class="card h-100">

                                <div class="card-header">

                                    <h5 class="card-title mb-1">

                                        Reservation Summary

                                    </h5>

                                    <small class="text-muted">

                                        Current customer bookings

                                    </small>

                                </div>


                                <div class="card-body">


                                    <div class="reservation-number text-warning">

                                        <?php echo str_pad($reservation_count, 2, '0', STR_PAD_LEFT); ?>

                                    </div>


                                    <h6 class="reservation-title">

                                        Total Reservations

                                    </h6>


                                    <p class="text-muted">

                                        Customer table bookings currently
                                        available in the restaurant system.

                                    </p>


                                    <hr>


                                    <div class="reservation-info">

                                        <div>

                                            <i class="bx bx-calendar-check" style="color:orange;"></i>

                                            <span>

                                                Upcoming Bookings

                                            </span>

                                        </div>

                                        <strong>

                                            <?php echo $upcoming_reservations; ?>

                                        </strong>

                                    </div>


                                    <div class="reservation-info">

                                        <div>

                                            <i class="bx bx-group" style="color:orange;"></i>

                                            <span>

                                                Reserved Guests

                                            </span>

                                        </div>

                                        <strong>

                                            <?php echo $total_guests; ?>

                                        </strong>

                                    </div>


                                    <a
                                        href="/demo-comman-dashbaord-new/reservations/reservation.php"
                                        class="btn btn-outline-warning w-100 mt-3"
                                    >

                                        View Reservations

                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- =================================================
                         NEW BOOKING SUMMARY
                    ================================================== -->

                    <div class="row">

                        <div class="col-lg-12 mb-4">

                            <div class="card">

                                <div class="card-header">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <h5 class="card-title mb-1">

                                                Contact Summary

                                            </h5>

                                            <small class="text-muted">

                                                Recent customer contacts

                                            </small>

                                        </div>


                                        <a
                                            href="/demo-comman-dashbaord-new/contact/booking.php"
                                            class="btn btn-sm btn-outline-warning"
                                        >

                                            View All

                                        </a>

                                    </div>

                                </div>


                                <div class="table-responsive">

                                    <table class="table table-hover align-middle mb-0">

                                        <thead>

                                            <tr>

                                                <th>ID</th>

                                                <th>Name</th>

                                                <th>Email</th>

                                                <th>Subject</th>

                                                <th>Message</th>

                                                <th>Date</th>

                                            </tr>

                                        </thead>


                                        <tbody>

                                        <?php if (mysqli_num_rows($booking_result) > 0): ?>

                                            <?php while ($booking = mysqli_fetch_assoc($booking_result)): ?>

                                                <tr>

                                                    <td>

                                                        <strong>

                                                            <?php echo str_pad($booking['id'], 2, '0', STR_PAD_LEFT); ?>

                                                        </strong>

                                                    </td>


                                                    <td>

                                                        <?php echo htmlspecialchars($booking['name']); ?>

                                                    </td>


                                                    <td>

                                                        <?php echo htmlspecialchars($booking['email']); ?>

                                                    </td>


                                                    <td>

                                                        <span class="badge bg-label-warning">

                                                            <?php echo htmlspecialchars($booking['subject']); ?>

                                                        </span>

                                                    </td>


                                                    <td>

                                                        <div
                                                            style="
                                                                max-width: 350px;
                                                                white-space: normal;
                                                                word-break: break-word;
                                                            "
                                                        >

                                                            <?php echo htmlspecialchars($booking['message']); ?>

                                                        </div>

                                                    </td>


                                                    <td>

                                                        <?php

                                                        if (!empty($booking['created_at'])) {

                                                            echo date(
                                                                'd M Y',
                                                                strtotime($booking['created_at'])
                                                            );

                                                        } else {

                                                            echo '-';

                                                        }

                                                        ?>

                                                    </td>

                                                </tr>

                                            <?php endwhile; ?>

                                        <?php else: ?>

                                            <tr>

                                                <td
                                                    colspan="6"
                                                    class="text-center text-muted py-4"
                                                >

                                                    No bookings found.

                                                </td>

                                            </tr>

                                        <?php endif; ?>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- =================================================
                         FOURTH SECTION
                    ================================================== -->

                    <div class="row">


                        <!-- =================================================
                             CHEF SUMMARY
                        ================================================== -->

                        <div class="col-lg-6 mb-4">

                            <div class="card h-100">

                                <div class="card-header">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <h5 class="card-title mb-1">

                                                Our Chefs

                                            </h5>

                                            <small class="text-muted">

                                                Restaurant kitchen team

                                            </small>

                                        </div>


                                        <a
                                            href="/demo-comman-dashbaord-new/our_chef/chef.php"
                                            class="btn btn-sm btn-outline-success"
                                        >

                                            View All

                                        </a>

                                    </div>

                                </div>


                                <div class="card-body">

                                <?php if (mysqli_num_rows($chef_result) > 0): ?>

                                    <?php while ($chef = mysqli_fetch_assoc($chef_result)): ?>

                                        <div class="chef-item">

                                            <div class="avatar me-3">

                                                <?php if (!empty($chef['image'])): ?>

                                                    <img
                                                        src="../uploads/chef/<?php echo htmlspecialchars($chef['image']); ?>"
                                                        alt="<?php echo htmlspecialchars($chef['chef_name']); ?>"
                                                        class="rounded-circle"
                                                    >

                                                <?php else: ?>

                                                    <img
                                                        src="../assets/img/avatars/1.png"
                                                        alt="<?php echo htmlspecialchars($chef['chef_name']); ?>"
                                                        class="rounded-circle"
                                                    >

                                                <?php endif; ?>

                                            </div>

                                            <div class="chef-details">

                                                <h6 class="mb-1">

                                                    <?php echo htmlspecialchars($chef['chef_name']); ?>

                                                </h6>

                                                <small class="text-success">

                                                    <?php echo htmlspecialchars($chef['designation']); ?>

                                                </small>

                                            </div>

                                        </div>

                                    <?php endwhile; ?>

                                <?php else: ?>

                                    <p class="text-muted text-center">

                                        No chefs found.

                                    </p>

                                <?php endif; ?>

                                </div>

                            </div>

                        </div>



                        <!-- =================================================
                             TESTIMONIAL SUMMARY
                        ================================================== -->

                        <div class="col-lg-6 mb-4">

                            <div class="card h-100">

                                <div class="card-header">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <h5 class="card-title mb-1">

                                                Customer Testimonials

                                            </h5>

                                            <small class="text-muted">

                                                Recent customer feedback

                                            </small>

                                        </div>


                                        <a
                                            href="/demo-comman-dashbaord-new/testimonials/testimonial.php"
                                            class="btn btn-sm btn-outline-danger"
                                        >

                                            View All

                                        </a>

                                    </div>

                                </div>


                                <div class="card-body">

                                <?php if (mysqli_num_rows($testimonial_result) > 0): ?>

                                    <?php
                                    $testimonial_first = true;
                                    ?>

                                    <?php while ($testimonial = mysqli_fetch_assoc($testimonial_result)): ?>

                                        <div class="testimonial-item">

                                            <div class="avatar me-3">

                                                <?php if (!empty($testimonial['image'])): ?>

                                                    <img
                                                        src="../assets/img/avatars/<?php echo htmlspecialchars($testimonial['image']); ?>"
                                                        alt="<?php echo htmlspecialchars($testimonial['client_name']); ?>"
                                                        class="rounded-circle"
                                                    >

                                                <?php else: ?>

                                                    <img
                                                        src="../assets/img/avatars/1.png"
                                                        alt="<?php echo htmlspecialchars($testimonial['client_name']); ?>"
                                                        class="rounded-circle"
                                                    >

                                                <?php endif; ?>

                                            </div>

                                            <div>

                                                <h6 class="mb-1">

                                                    <?php echo htmlspecialchars($testimonial['client_name']); ?>

                                                </h6>

                                                <small class="text-muted">

                                                    <?php echo htmlspecialchars($testimonial['profession']); ?>

                                                </small>

                                                <div class="stars">

                                                    ★ ★ ★ ★ ★

                                                </div>

                                            </div>

                                        </div>


                                        <p class="testimonial-text">

                                            "<?php echo htmlspecialchars($testimonial['description']); ?>"

                                        </p>


                                        <?php if ($testimonial_first): ?>

                                            <hr>

                                        <?php endif; ?>


                                        <?php
                                        $testimonial_first = false;
                                        ?>

                                    <?php endwhile; ?>

                                <?php else: ?>

                                    <p class="text-muted text-center">

                                        No testimonials found.

                                    </p>

                                <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- =================================================
                         FINAL WEBSITE SECTION
                    ================================================== -->

                    <div class="row">


                        <div class="col-12 mb-4">

                            <div class="card website-sections-card">

                                <div class="card-body">

                                    <div class="row align-items-center">


                                        <!-- TEXT -->

                                        <div class="col-lg-5 mb-3 mb-lg-0">

                                            <span class="section-small-title text-warning">

                                                RESTORAN WEBSITE

                                            </span>


                                            <h4 class="section-main-title">

                                                Manage Your Restaurant Website

                                            </h4>


                                            <p class="text-muted mb-0">

                                                Manage restaurant information,
                                                chefs, services, food menu,
                                                testimonials, reservations
                                                and customer bookings
                                                from one dashboard.

                                            </p>

                                        </div>



                                        <!-- LINKS -->

                                        <div class="col-lg-7">

                                            <div class="website-links">


                                                <a
                                                    href="/demo-comman-dashbaord-new/about/about.php"
                                                    class="website-link"
                                                >

                                                    <i class="bx bx-restaurant" style="color:orange;"></i>

                                                    <span>

                                                        About

                                                    </span>

                                                </a>



                                                <a
                                                    href="/demo-comman-dashbaord-new/our_chef/chef.php"
                                                    class="website-link"
                                                >

                                                    <i class="bx bx-user" style="color:orange;"></i>

                                                    <span>

                                                        Chefs

                                                    </span>

                                                </a>



                                                <a
                                                    href="/demo-comman-dashbaord-new/services/service.php"
                                                    class="website-link"
                                                >

                                                    <i class="bx bx-briefcase" style="color:orange;"></i>

                                                    <span>

                                                        Services

                                                    </span>

                                                </a>



                                                <a
                                                    href="/demo-comman-dashbaord-new/food_menu/menu.php"
                                                    class="website-link"
                                                >

                                                    <i class="bx bx-food-menu" style="color:orange;"></i>

                                                    <span>

                                                        Menu

                                                    </span>

                                                </a>



                                                <a
                                                    href="/demo-comman-dashbaord-new/testimonials/testimonial.php"
                                                    class="website-link"
                                                >

                                                    <i class="bx bx-message-rounded-detail" style="color:orange;"></i>

                                                    <span>

                                                        Reviews

                                                    </span>

                                                </a>



                                                <a
                                                    href="/demo-comman-dashbaord-new/reservations/reservation.php"
                                                    class="website-link"
                                                >

                                                    <i class="bx bx-calendar-check" style="color:orange;"></i>

                                                    <span>

                                                        Reservation

                                                    </span>

                                                </a>



                                                <!-- NEW BOOKING -->

                                                <a
                                                    href="/demo-comman-dashbaord-new/contact/booking.php"
                                                    class="website-link"
                                                >

                                                    <i class="bx bx-calendar" style="color:orange;"></i>

                                                    <span>

                                                        Contact

                                                    </span>

                                                </a>


                                            </div>

                                        </div>


                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                </div>


                <!-- =================================================
                     FOOTER
                ================================================== -->

                <?php include '../common/footer.php'; ?>


            </div>

        </div>

    </div>

</div>



</body>

</html>