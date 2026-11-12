<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="app-brand demo">

        <a href="/demo-comman-dashbaord-new/index.php" class="app-brand-link">
            <span class="nav-logo text-warning">
                <i class="menu-icon tf-icons bx bx-restaurant nav-logo"></i>
                Restoran
            </span>
        </a>

        <a href="javascript:void(0);"
           class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>

    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- Dashboard -->
        <li class="menu-item <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
            <a href="/demo-comman-dashbaord-new/dashbaord/index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>


        <!-- About Restaurant -->
        <li class="menu-item <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">
            <a href="/demo-comman-dashbaord-new/about/about.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-restaurant"></i>
                <div data-i18n="Without menu">About Restaurant</div>
            </a>
        </li>


        <!-- Our Chief -->
        <li class="menu-item <?php echo ($current_page == 'chef.php') ? 'active' : ''; ?>">
            <a href="/demo-comman-dashbaord-new/our_chef/chef.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Without menu">Our Chief</div>
            </a>
        </li>


        <!-- Services -->
        <li class="menu-item <?php echo ($current_page == 'service.php') ? 'active' : ''; ?>">
            <a href="/demo-comman-dashbaord-new/services/service.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-briefcase"></i>
                <div data-i18n="Without menu">Services</div>
            </a>
        </li>


        <!-- Food Menu -->
        <li class="menu-item <?php echo ($current_page == 'menu.php') ? 'active' : ''; ?>">
            <a href="/demo-comman-dashbaord-new/food_menu/menu.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div data-i18n="Without menu">Food Menu</div>
            </a>
        </li>


        <!-- Testimonials -->
        <li class="menu-item <?php echo ($current_page == 'testimonial.php') ? 'active' : ''; ?>">
            <a href="/demo-comman-dashbaord-new/testimonials/testimonial.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-message-rounded-detail"></i>
                <div data-i18n="Without menu">Testimonials</div>
            </a>
        </li>


        <!-- Reservation -->
        <li class="menu-item <?php echo ($current_page == 'reservation.php') ? 'active' : ''; ?>">
            <a href="/demo-comman-dashbaord-new/reservations/reservation.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-check"></i>
                <div data-i18n="Without menu">Reservation</div>
            </a>
        </li>

        <!--Booking-->
         <li class="menu-item <?php echo ($current_page == 'booking.php') ? 'active' : ''; ?>">
            <a href="/demo-comman-dashbaord-new/contact/booking.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Without menu">Contact</div>
            </a>
        </li>


        <!-- Logout -->
        <li class="menu-item logout-item">
            <a href="/demo-comman-dashbaord-new/logout.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-log-out"></i>
                <div data-i18n="Without menu">Log Out</div>
            </a>
        </li>

    </ul>

</aside>


<style>

    .nav-logo {
        font-size: 35px;
    }

    /* Active menu */
    #layout-menu .menu-item.active > .menu-link {
        background-color: #fff3cd !important;
        color: #ff9800 !important;
        font-weight: 600;
    }

    /* Active icon */
    #layout-menu .menu-item.active > .menu-link .menu-icon {
        color: #ff9800 !important;
    }

    /* Keep logout at bottom */
    #layout-menu .menu-inner {
        position: relative;
        height: calc(100vh - 80px);
    }

    #layout-menu .logout-item {
        position: absolute;
        bottom: 20px;
        left: 0;
        width: 100%;
    }

</style>