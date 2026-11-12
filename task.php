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

    <style>
        /* =========================================================
   TESTIMONIAL CAROUSEL
========================================================= */

#testimonialCarousel {
    position: relative;
    padding-bottom: 55px;
}


/* =========================================================
   SAME HEIGHT FOR ALL TESTIMONIAL CARDS
========================================================= */

#testimonialCarousel .carousel-item .row {
    align-items: stretch;
}

#testimonialCarousel .col-lg-4 {
    display: flex;
}

#testimonialCarousel .testimonial-card {
    width: 100%;
    height: 410px;
    display: flex;
    flex-direction: column;
}


/* =========================================================
   TESTIMONIAL DESCRIPTION
========================================================= */

#testimonialCarousel .testimonial-card p {
    flex-grow: 1;
}


/* =========================================================
   CAROUSEL INDICATORS / 3 DOTS
========================================================= */

#testimonialCarousel .custom-indicators {
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);

    width: auto;
    margin: 0;

    display: flex;
    justify-content: center;
    align-items: center;

    gap: 10px;
}


/* Dot */

#testimonialCarousel .custom-indicators button {
    width: 18px;
    height: 18px;

    border-radius: 50%;
    border: 2px solid rgb(255, 212, 59);

    background-color: transparent;

    opacity: 1;

    margin: 0;
    padding: 0;
}


/* Active Dot */

#testimonialCarousel .custom-indicators button.active {
    background-color: rgb(255, 212, 59);
    border-color: rgb(255, 212, 59);
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 991px) {

    #testimonialCarousel .testimonial-card {
        height: 410px;
    }

}


@media (max-width: 767px) {

    #testimonialCarousel .testimonial-card {
        height: auto;
        min-height: 380px;
    }

}
        </style>
  </head>
  <body>
    


<?php include 'navbar.php'; ?>

<!--Restoran-->

<div class="container-fluid bg-dark about-header">
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <h1 class="fs text-white">Enjoy Our <br> Delicious Meal</h1>
            <p class="text-white">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p><br>
            <div class="common-btn">
            <a href="contact.php" style="text-decoration: none;"><strong class="text-light">BOOK A TABLE</strong></a>
            </div>
        </div>




         <div class="col-lg-6 col-md-6">
           <div class="img mb-5">
            <img src="assets/img/hero.png" class="img-fluide w-100 h-100">
           </div>
        </div>
    </div>   
</div>
</div>



<!-- <div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-3 ">
            <div class="shadow p-2 service-card"> 
            <div class="mb-5 mt-2">
                <i class="fa-solid fa-user-tie" style="color: rgb(255, 212, 59);"></i>
            </div>
            <h5>Master Chefs</h5>
            <p>
                Diam elitr kasd sed at elitr<br> sed ipsum justo dolor sed <br>clita amet diam
            </p>
        </div>
        </div>



          <div class="col-lg-3 ">
            <div class="shadow p-2 service-card"> 
            <div class="mb-5  mt-2">
                <i class="fa-solid fa-utensils" style="color: rgb(255, 212, 59); font-size: 50px;"></i>
            </div>
            <h5>Quality Food</h5>
            <p>
                Diam elitr kasd sed at elitr<br> sed ipsum justo dolor sed <br>clita amet diam
            </p>
        </div>
        </div>




         <div class="col-lg-3 ">
            <div class="shadow p-2 service-card"> 
            <div class="mb-5  mt-2">
               <i class="fa-solid fa-cart-shopping" style="color: rgb(255, 212, 59);"></i>
            </div>
            <h5>Online Order</h5>
            <p>
                Diam elitr kasd sed at elitr<br> sed ipsum justo dolor sed <br>clita amet diam
            </p>
        </div>
        </div>




         <div class="col-lg-3 ">
            <div class="shadow p-2 service-card"> 
            <div class="mb-5  mt-2">
               <i class="fa-solid fa-headset" style="color: rgb(255, 212, 59);"></i>
            </div>
            <h5>24/7 Service</h5>
            <p>
                Diam elitr kasd sed at elitr<br> sed ipsum justo dolor sed <br>clita amet diam
            </p>
        </div>
        </div>
    </div>

</div> -->

<?php

/* =========================================================
   DATABASE CONNECTION
========================================================= */

require_once 'demo-comman-dashbaord-new/connection.php';


/* =========================================================
   FETCH LATEST 4 SERVICES
========================================================= */

$sql = "SELECT id, title, description, image
        FROM service
        ORDER BY id DESC
        LIMIT 4";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Service query failed: " . mysqli_error($conn));
}

?>

<!-- =========================================================
     SERVICES SECTION
========================================================= -->

<div class="container mt-5 mb-5">

    <div class="row">

        <?php

        /* =====================================================
           CHECK SERVICE DATA
        ===================================================== */

        if (mysqli_num_rows($result) > 0) {

            while ($service = mysqli_fetch_assoc($result)) {

        ?>

        <!-- =================================================
             SERVICE CARD
        ================================================== -->

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="shadow p-2 service-card">

                <!-- =================================================
                     SERVICE ICON / IMAGE
                ================================================== -->

                <div class="mb-5 mt-2">

                    <?php if (!empty($service['image'])) { ?>

                        <img
                            src="/demo-comman-dashbaord-new/uploads/service/<?php echo htmlspecialchars($service['image']); ?>"
                            alt="<?php echo htmlspecialchars($service['title']); ?>"
                            style="
                                width: 60px;
                                height: 60px;
                                object-fit: cover;
                                border-radius: 10px;
                            "
                        >

                    <?php } else { ?>

                        <i
                            class="fa-solid fa-utensils"
                            style="
                                color: rgb(255, 212, 59);
                                font-size: 50px;
                            "
                        ></i>

                    <?php } ?>

                </div>


                <!-- =================================================
                     SERVICE TITLE
                ================================================== -->

                <h5>

                    <?php
                    echo htmlspecialchars($service['title']);
                    ?>

                </h5>


                <!-- =================================================
                     SERVICE DESCRIPTION
                ================================================== -->

                <p>

                    <?php
                    echo nl2br(htmlspecialchars($service['description']));
                    ?>

                </p>

            </div>

        </div>


        <?php

            }

        } else {

        ?>

        <!-- =================================================
             NO SERVICE DATA
        ================================================== -->

        <div class="col-12 text-center">

            <p class="text-muted">
                No services available.
            </p>

        </div>

        <?php

        }

        ?>

    </div>

</div>

<!--About-->

<!-- <div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6">



            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="mt-5 mt-3">
                        <div>
                        <img src="assets/img/about-1.jpg" class="img-fluide w-100 h-100" style="margin-top: 25%;">
                        </div>
                    </div>
                </div>


                  <div class="col-lg-6 col-md-6">
                    <div class="mt-5 mt-3">
                        <div class="img-new">
                        <img src="assets/img/about-2.jpg" class="img-fluide w-75 h-75" style=" margin-top: 50%;">
                        </div>
                    </div>
                </div>
            </div>    


             <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="mt-2 mt-3">
                        <div>
                        <img src="assets/img/about-3.jpg" class="img-fluide w-75 h-75" style="margin-bottom: 50% ; margin-left: 25%;">
                        </div>
                    </div>
                </div>


                  <div class="col-lg-6 col-md-6">
                    <div class="mt-3">
                        <div>
                      <img src="assets/img/about-4.jpg" class="img-fluide w-100 h-100">
                        </div>
                    </div>
                  </div>
             </div>
        </div>



           <div class="col-lg-6 col-md-6" style="margin-top: 170px;">
            <div class="mt-5">
                <h5 class="section-title ff-secondary text-start  fw-normal about small-title"><span></span>About Us<span></span> </h5>
                <h1><strong>Welcome to <i class="fa-solid fa-utensils" style="color: rgb(255, 212, 59); font-size: 50px;"></i>  Restoran</strong></h1>

                <p class="mt-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam<br> amet diam et eos erat ipsum et lorem et sit, sed stet lorem sit.</p>
                <p class="mt-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam<br> amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita<br> duo justo magna dolore erat amet</p>
            </div>

            <div class="row g-4 mb-4">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center border-start border-5 border-warning px-3">
                                    <h1 class="flex-shrink-0 display-5 bor mb-0" data-toggle="counter-up"><strong style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">15</strong></h1>
                                    <div class="ps-4">
                                        <small class="mb-0">Years of</small>
                                        <h6 class="text-uppercase mb-0"><strong class="fs-5">Experience</strong></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center border-start border-5 border-warning px-3">
                                    <h1 class="flex-shrink-0 display-5 bor mb-0" data-toggle="counter-up"><strong style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">50</strong></h1>
                                    <div class="ps-4">
                                        <small class="mb-0">Popular</small>
                                        <h6 class="text-uppercase mb-0"><strong class="fs-6">Master Chefs</strong></h6>
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                        <div class="common-btn">
                          <a href="#" style="text-decoration: none;"><strong class="text-white">READ MORE</strong></a>
                         </div>
                      </div>








    </div>
</div> -->


<?php

/* =========================================================
   DATABASE CONNECTION
========================================================= */

require_once 'demo-comman-dashbaord-new/connection.php';


/* =========================================================
   FETCH LATEST ABOUT DATA
========================================================= */

$sql = "SELECT * FROM about ORDER BY id DESC LIMIT 1";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

$about = mysqli_fetch_assoc($result);


/* =========================================================
   DEFAULT VALUES
========================================================= */

$title = "Restoran";

$description = "Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos erat ipsum et lorem et sit, sed stet lorem sit.";

$experience_years = "15";
$experience_text = "Years of Experience";

$chefs_count = "50";
$chefs_text = "Popular Master Chefs";


/* =========================================================
   IF ABOUT DATA EXISTS
========================================================= */

if ($about) {

    $title = !empty($about['title'])
        ? htmlspecialchars($about['title'])
        : $title;

    $description = !empty($about['description'])
        ? htmlspecialchars($about['description'])
        : $description;

    $experience_years = !empty($about['experience_years'])
        ? htmlspecialchars($about['experience_years'])
        : $experience_years;

    $experience_text = !empty($about['experience_text'])
        ? htmlspecialchars($about['experience_text'])
        : "Years of Experience";

    $chefs_count = !empty($about['chefs_count'])
        ? htmlspecialchars($about['chefs_count'])
        : $chefs_count;

    $chefs_text = !empty($about['chefs_text'])
        ? htmlspecialchars($about['chefs_text'])
        : "Popular Master Chefs";
}


/* =========================================================
   IMAGE
========================================================= */

$aboutImage = "";

if ($about && !empty($about['image'])) {

    $aboutImage = "/demo-comman-dashbaord-new/uploads/about/" . htmlspecialchars($about['image']);

}

?>


<!-- =========================================================
     ABOUT SECTION
========================================================= -->

<div class="container">

    <div class="row">

        <!-- =================================================
             LEFT SIDE IMAGES
        ================================================== -->

        <div class="col-lg-6 col-md-6">

            <div class="row">

                <div class="col-lg-6 col-md-6">

                    <div class="mt-5 mt-3">

                        <div>

                            <?php if (!empty($aboutImage)) { ?>

                                <img
                                    src="<?php echo $aboutImage; ?>"
                                    class="img-fluide w-100 h-100"
                                    style="margin-top: 25%;"
                                    alt="About Restaurant"
                                >

                            <?php } else { ?>

                                <img
                                    src="/demo-comman-dashbaord-new/assets/img/about-1.jpg"
                                    class="img-fluide w-100 h-100"
                                    style="margin-top: 25%;"
                                    alt="About Restaurant"
                                >

                            <?php } ?>

                        </div>

                    </div>

                </div>


                <div class="col-lg-6 col-md-6">

                    <div class="mt-5 mt-3">

                        <div class="img-new">

                            <img
                                src="assets/img/about-2.jpg"
                                class="img-fluide w-75 h-75"
                                style="margin-top: 50%;"
                                alt="Restaurant"
                            >

                        </div>

                    </div>

                </div>

            </div>


            <div class="row">

                <div class="col-lg-6 col-md-6">

                    <div class="mt-2 mt-3">

                        <div>

                            <img
                                src="assets/img/about-3.jpg"
                                class="img-fluide w-75 h-75"
                                style="margin-bottom: 50%; margin-left: 25%;"
                                alt="Restaurant"
                            >

                        </div>

                    </div>

                </div>


                <div class="col-lg-6 col-md-6">

                    <div class="mt-3">

                        <div>

                            <img
                                src="assets/img/about-4.jpg"
                                class="img-fluide w-100 h-100"
                                alt="Restaurant"
                            >

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             RIGHT SIDE ABOUT CONTENT
        ================================================== -->

        <div class="col-lg-6 col-md-6" style="margin-top: 170px;">

            <div class="mt-5">

                <h5 class="section-title ff-secondary text-start fw-normal about small-title">

                    <span></span>

                    About Us

                    <span></span>

                </h5>


                <h1>

                    <strong>

                        Welcome to

                        <i
                            class="fa-solid fa-utensils"
                            style="color: rgb(255, 212, 59); font-size: 50px;"
                        ></i>

                        <?php echo $title; ?>

                    </strong>

                </h1>


                <p class="mt-4">

                    <?php echo nl2br($description); ?>

                </p>

            </div>


            <!-- =================================================
                 EXPERIENCE + CHEFS
            ================================================== -->

            <div class="row g-4 mb-4">

                <!-- EXPERIENCE -->

                <div class="col-sm-6">

                    <div class="d-flex align-items-center border-start border-5 border-warning px-3">

                        <h1
                            class="flex-shrink-0 display-5 bor mb-0"
                            data-toggle="counter-up"
                        >

                            <strong
                                style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;"
                            >

                                <?php echo $experience_years; ?>

                            </strong>

                        </h1>


                        <div class="ps-4">

                            <small class="mb-0">

                                Years of

                            </small>

                            <h6 class="text-uppercase mb-0">

                                <strong class="fs-5">

                                    <?php
                                    echo $experience_text;
                                    ?>

                                </strong>

                            </h6>

                        </div>

                    </div>

                </div>


                <!-- MASTER CHEFS -->

                <div class="col-sm-6">

                    <div class="d-flex align-items-center border-start border-5 border-warning px-3">

                        <h1
                            class="flex-shrink-0 display-5 bor mb-0"
                            data-toggle="counter-up"
                        >

                            <strong
                                style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;"
                            >

                                <?php echo $chefs_count; ?>

                            </strong>

                        </h1>


                        <div class="ps-4">

                            <small class="mb-0">

                                Popular

                            </small>

                            <h6 class="text-uppercase mb-0">

                                <strong class="fs-6">

                                    <?php
                                    echo $chefs_text;
                                    ?>

                                </strong>

                            </h6>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 READ MORE BUTTON
            ================================================== -->

            <div class="common-btn">

                <a
                    href="#"
                    style="text-decoration: none;"
                >

                    <strong class="text-white">

                        READ MORE

                    </strong>

                </a>

            </div>

        </div>

    </div>

</div>




<?php include 'breakfast.php'; ?>

<!--Reservation-->

<div class="container-xxl flud py-5 px-0 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="video-img">

                        <img src="assets/img/video.jpg" height="550" width="700px">

                            <div class="font">
                                <button type="button" class="video-play-btn" data-bs-toggle="modal" data-bs-target="#videoModal">
                                 <i class="fa-solid fa-circle-play" style="color:orange;"></i>
                                </button>
                            </div>

                    </div>



  <!-- Video Modal -->
                <div class="modal fade" id="videoModal" tabindex="-1">

                    <div class="modal-dialog modal-lg modal-dialog-centered">

                        <div class="modal-content bg-dark">

                           <div class="modal-body p-0">

                            <iframe
                               width="100%"
                               height="500"
                               src="https://www.youtube.com/embed/0W0XAi286XE"
                               title="YouTube Video"
                               frameborder="0"
                               allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                               allowfullscreen>
                            </iframe>

                            </div>

                                
                        </div>

                           
                     </div>

                </div>
  
            </div>
                <div class="col-md-6  bg-dark d-flex align-items-center">
                    <div class="p-5 wow  fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                        <h5 class="section-title ff-secondary text-start text-warning fw-normal small-title"><span></span>Reservation<span></span></h5>
                        <h1 class="text-white mb-4">Book A Table Online</h1>
                         <?php

require_once 'demo-comman-dashbaord-new/connection.php';

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $datetime = trim($_POST['datetime']);
    $no_of_people = (int)$_POST['no_of_people'];
    $special_request = trim($_POST['special_request']);


    /* ================= VALIDATION ================= */

    if (
        empty($name) ||
        empty($email) ||
        empty($datetime) ||
        empty($no_of_people)
    ) {

        $message = "Please fill all required fields.";
        $message_type = "danger";

    } else {

        /* ================= SEPARATE DATE & TIME ================= */

        $date_time = new DateTime($datetime);

        $reservation_date = $date_time->format('Y-m-d');
        $reservation_time = $date_time->format('H:i:s');


        /* ================= INSERT RESERVATION ================= */

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO reservations
            (
                name,
                email,
                reservation_date,
                reservation_time,
                no_of_people,
                special_request
            )
            VALUES (?, ?, ?, ?, ?, ?)"
        );


        mysqli_stmt_bind_param(
            $stmt,
            "ssssis",
            $name,
            $email,
            $reservation_date,
            $reservation_time,
            $no_of_people,
            $special_request
        );


        if (mysqli_stmt_execute($stmt)) {

            $message = "Your table has been booked successfully!";
            $message_type = "success";

        } else {

            $message = "Reservation failed. Please try again.";
            $message_type = "danger";

        }


        mysqli_stmt_close($stmt);
    }
}

?>


<!-- ================= BOOKING FORM ================= -->

<form method="POST" action="">

    <div class="row g-3">


        <!-- ================= NAME ================= -->

        <div class="col-md-6">

            <div class="form-floating">

                <input
                    type="text"
                    class="form-control"
                    name="name"
                    id="name"
                    placeholder="Your Name"
                    required
                >

                <label for="name">
                    Your Name
                </label>

            </div>

        </div>


        <!-- ================= EMAIL ================= -->

        <div class="col-md-6">

            <div class="form-floating">

                <input
                    type="email"
                    class="form-control"
                    name="email"
                    id="email"
                    placeholder="Your Email"
                    required
                >

                <label for="email">
                    Your Email
                </label>

            </div>

        </div>


        <!-- ================= DATE & TIME ================= -->

        <div class="col-md-6">

            <div class="form-floating">

                <input
                    type="datetime-local"
                    class="form-control"
                    name="datetime"
                    id="datetime"
                    required
                >

                <label for="datetime">
                    Date &amp; Time
                </label>

            </div>

        </div>


        <!-- ================= NO OF PEOPLE ================= -->

        <div class="col-md-6">

            <div class="form-floating">

                <select
                    class="form-select"
                    name="no_of_people"
                    id="select1"
                    required
                >

                    <option value="1">
                        People 1
                    </option>

                    <option value="2">
                        People 2
                    </option>

                    <option value="3">
                        People 3
                    </option>

                    <option value="4">
                        People 4
                    </option>

                    <option value="5">
                        People 5
                    </option>

                    <option value="6">
                        People 6
                    </option>

                    <option value="7">
                        People 7
                    </option>

                    <option value="8">
                        People 8
                    </option>

                    <option value="9">
                        People 9
                    </option>

                    <option value="10">
                        People 10
                    </option>

                </select>

                <label for="select1">
                    No Of People
                </label>

            </div>

        </div>


        <!-- ================= SPECIAL REQUEST ================= -->

        <div class="col-12">

            <div class="form-floating">

                <textarea
                    class="form-control"
                    name="special_request"
                    placeholder="Special Request"
                    id="message"
                    style="height: 100px"
                ></textarea>

                <label for="message">
                    Special Request
                </label>

            </div>

        </div>


        <!-- ================= MESSAGE ================= -->

        <?php if (!empty($message)) { ?>

            <div class="col-12">

                <div class="alert alert-<?php echo $message_type; ?> mb-0">

                    <?php echo htmlspecialchars($message); ?>

                </div>

            </div>

        <?php } ?>


        <!-- ================= BOOK NOW ================= -->

        <div class="col-12">

            <button
                class="btn btn-warning w-100 py-3"
                type="submit"
            >
                Book Now
            </button>

        </div>

    </div>

</form>
                    </div>
                 </div>
            </div>
        </div>


<!--Team-->

<h5 class="text-warning text-center small-title mt-5 "><span></span>Team Members<span></span></h5>
<h1 class="text-center"><strong>Our Master Chefs</strong></h1>
<!-- <div class="container">
    <div class="row mt-5">
       <div class="col-lg-3 col-md-6 mb-4">
    <div class="team-card border shadow">

        <div class="team-img">
            <img src="assets/img/team-1.jpg"
                class="rounded-circle shadow"
                alt="Chef">
        </div>

        <h2>Full Name</h2>
        <p>Designation</p>

        <div class="social-icons">
            <i class="fa-brands fa-facebook-f facebook"></i>
            <i class="fa-brands fa-twitter facebook"></i>
            <i class="fa-brands fa-square-instagram facebook"></i>
        </div>

    </div>
</div>
          <div class="col-lg-3 col-md-6 mb-4">
    <div class="team-card border shadow">

        <div class="team-img">
            <img src="assets/img/team-2.jpg"
                class="rounded-circle shadow"
                alt="Chef">
        </div>

        <h2>Full Name</h2>
        <p>Designation</p>

        <div class="social-icons">
            <i class="fa-brands fa-facebook-f facebook"></i>
            <i class="fa-brands fa-twitter facebook"></i>
            <i class="fa-brands fa-square-instagram facebook"></i>
        </div>

    </div>
</div>
        <div class="col-lg-3 col-md-6 mb-4">
    <div class="team-card border shadow">

        <div class="team-img">
            <img src="assets/img/team-3.jpg"
                class="rounded-circle shadow"
                alt="Chef">
        </div>

        <h2>Full Name</h2>
        <p>Designation</p>

        <div class="social-icons">
            <i class="fa-brands fa-facebook-f facebook"></i>
            <i class="fa-brands fa-twitter facebook"></i>
            <i class="fa-brands fa-square-instagram facebook"></i>
        </div>

    </div>
</div>
        <div class="col-lg-3 col-md-6 mb-4">
    <div class="team-card border shadow">

        <div class="team-img">
            <img src="assets/img/team-4.jpg"
                class="rounded-circle shadow"
                alt="Chef">
        </div>

        <h2>Full Name</h2>
        <p>Designation</p>

        <div class="social-icons">
            <i class="fa-brands fa-facebook-f facebook"></i>
            <i class="fa-brands fa-twitter facebook"></i>
            <i class="fa-brands fa-square-instagram facebook"></i>
        </div>

    </div>
</div>

         
    </div>
</div> -->



<?php

/* =========================================================
   DATABASE CONNECTION
========================================================= */



/* =========================================================
   FETCH LATEST 4 CHEFS
========================================================= */

$sql = "SELECT * FROM our_master_cheif ORDER BY id DESC LIMIT 4";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database Error: " . mysqli_error($conn));
}

?>

<!-- =========================================================
     CHEF SECTION
========================================================= -->

<div class="container">

    <div class="row mt-5">

        <?php

        /* =====================================================
           CHECK CHEF DATA
        ===================================================== */

        if (mysqli_num_rows($result) > 0) {

            while ($chef = mysqli_fetch_assoc($result)) {

        ?>

        <!-- =================================================
             CHEF CARD
        ================================================== -->

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="team-card border shadow">

                <!-- =================================================
                     CHEF IMAGE
                ================================================== -->

                <div class="team-img">

                    <?php if (!empty($chef['image'])) { ?>

                        <img
                            src="/demo-comman-dashbaord-new/uploads/chef/<?php echo htmlspecialchars($chef['image']); ?>"
                            class="rounded-circle shadow"
                            alt="<?php echo htmlspecialchars($chef['chef_name']); ?>"
                        >

                    <?php } else { ?>

                        <img
                            src="/demo-comman-dashbaord-new/assets/img/avatars/1.png"
                            class="rounded-circle shadow"
                            alt="Chef"
                        >

                    <?php } ?>

                </div>


                <!-- =================================================
                     CHEF NAME
                ================================================== -->

                <h2>

                    <?php
                    echo htmlspecialchars($chef['chef_name']);
                    ?>

                </h2>


                <!-- =================================================
                     DESIGNATION
                ================================================== -->

                <p>

                    <?php
                    echo htmlspecialchars($chef['designation']);
                    ?>

                </p>


                <!-- =================================================
                     SOCIAL ICONS
                ================================================== -->

                <div class="social-icons">

                    <i class="fa-brands fa-facebook-f facebook"></i>

                    <i class="fa-brands fa-twitter facebook"></i>

                    <i class="fa-brands fa-square-instagram facebook"></i>

                </div>

            </div>

        </div>


        <?php

            }

        } else {

        ?>

        <!-- =================================================
             NO CHEF DATA
        ================================================== -->

        <div class="col-12 text-center">

            <p>No chefs available.</p>

        </div>

        <?php

        }

        ?>

    </div>

</div>


<!--Testimonial-->

<section class="testimonial-section" id="testimonial">

    <div class="container">

        <!-- Heading -->
        <div class="testimonial-heading text-center">

            <div class="small-title">
                <span></span>
                Testimonial
                <span></span>
            </div>

            <h2>Our Clients Say!!!</h2>

        </div>


<?php

/* =========================================================
   DATABASE CONNECTION
========================================================= */

require_once 'demo-comman-dashbaord-new/connection.php';


/* =========================================================
   FETCH TESTIMONIAL DATA
========================================================= */

$sql = "SELECT id, client_name, profession, description, image
        FROM testimonials
        ORDER BY id DESC
        LIMIT 9";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Testimonial query failed: " . mysqli_error($conn));
}


/* =========================================================
   STORE DATA
========================================================= */

$testimonials = [];

while ($row = mysqli_fetch_assoc($result)) {
    $testimonials[] = $row;
}


/* =========================================================
   CREATE SLIDES
   3 TESTIMONIALS PER SLIDE
========================================================= */

$slides = array_chunk($testimonials, 3);

?>

<!-- =========================================================
     TESTIMONIAL CAROUSEL
========================================================= -->

<div id="testimonialCarousel"
     class="carousel slide"
     data-bs-ride="carousel"
     data-bs-interval="4000">


    <!-- ================= CAROUSEL ================= -->

    <div class="carousel-inner">


        <?php if (count($slides) > 0) { ?>

            <?php foreach ($slides as $slideIndex => $slide) { ?>


                <!-- ================= SLIDE ================= -->

                <div class="carousel-item <?php echo ($slideIndex == 0) ? 'active' : ''; ?>">

                    <div class="row g-4">


                        <?php foreach ($slide as $cardIndex => $testimonial) { ?>


                            <!-- ================= CARD ================= -->

                            <div class="col-lg-4">

                                <div class="testimonial-card <?php echo ($cardIndex == 1) ? 'active-card' : ''; ?>">


                                    <!-- Quote -->

                                    <div class="quote-icon">
                                        ❝
                                    </div>


                                    <!-- Description -->

                                    <p>
                                        <?php
                                        echo nl2br(
                                            htmlspecialchars(
                                                $testimonial['description']
                                            )
                                        );
                                        ?>
                                    </p>


                                    <!-- Client Information -->

                                    <div class="client-info">


                                        <!-- Client Image -->

                                        <?php if (!empty($testimonial['image'])) { ?>

                                            <img
                                                src="/demo-comman-dashbaord-new/assets/img/avatars/<?php echo htmlspecialchars($testimonial['image']); ?>"
                                                alt="<?php echo htmlspecialchars($testimonial['client_name']); ?>"
                                            >

                                        <?php } else { ?>

                                            <img
                                                src="/demo-comman-dashbaord-new/assets/img/avatars/1.png"
                                                alt="Client"
                                            >

                                        <?php } ?>


                                        <!-- Client Details -->

                                        <div>

                                            <h4>
                                                <?php
                                                echo htmlspecialchars(
                                                    $testimonial['client_name']
                                                );
                                                ?>
                                            </h4>

                                            <span>
                                                <?php
                                                echo htmlspecialchars(
                                                    $testimonial['profession']
                                                );
                                                ?>
                                            </span>

                                        </div>


                                    </div>


                                </div>

                            </div>

                            <!-- ================= / CARD ================= -->


                        <?php } ?>


                    </div>

                </div>

                <!-- ================= / SLIDE ================= -->


            <?php } ?>


        <?php } else { ?>


            <!-- ================= NO DATA ================= -->

            <div class="carousel-item active">

                <div class="row g-4">

                    <div class="col-12 text-center">

                        <p class="text-muted">
                            No testimonials available.
                        </p>

                    </div>

                </div>

            </div>


        <?php } ?>


    </div>


    <!-- =====================================================
         3 DOT SLIDER
    ====================================================== -->

    <?php if (count($slides) > 1) { ?>

        <div class="carousel-indicators custom-indicators">


            <?php foreach ($slides as $index => $slide) { ?>

                <button
                    type="button"
                    data-bs-target="#testimonialCarousel"
                    data-bs-slide-to="<?php echo $index; ?>"
                    class="<?php echo ($index == 0) ? 'active' : ''; ?>"
                    aria-current="<?php echo ($index == 0) ? 'true' : 'false'; ?>"
                    aria-label="Slide <?php echo $index + 1; ?>">
                </button>

            <?php } ?>


        </div>

    <?php } ?>


</div>

</section>




<?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>