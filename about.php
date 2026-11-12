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

<?php include 'navbar.php'; ?>
  <!-- ================= ABOUT PAGE CONTENT START ================= -->

 <!-- About Page Header -->
<div class="container-fluid about-header">

    <div class="container text-center">

        <h1>About Us</h1>

        <div class="breadcrumb-text">
            <a href="task.php">HOME</a>
            <span>/</span>

            <a href="#">PAGES</a>
            <span>/</span>

            <span class="active-page">ABOUT</span>
        </div>

    </div>

</div>



    <!-- <div class="row">
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

<h5 class="text-warning text-center small-title"><span></span>Team Members<span></span></h5>
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

         
    </div>
</div>




 
 
 
 
 
 
 
 <?php include 'footer.php'; ?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>