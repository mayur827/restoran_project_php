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

  <div class="container-fluid about-header">

    <div class="container text-center">

        <h1>Testimonial</h1>

        <div class="breadcrumb-text">
            <a href="task.php">HOME</a>
            <span>/</span>

            <a href="#">PAGES</a>
            <span>/</span>

            <span class="active-page">TESTIMONIAL</span>
        </div>

    </div>

</div>


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