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

  <div class="container-fluid about-header">

    <div class="container text-center">

        <h1>SERVICES</h1>

        <div class="breadcrumb-text">
            <a href="task.php">HOME</a>
            <span>/</span>

            <a href="#">PAGES</a>
            <span>/</span>

            <span class="active-page">SERVICES</span>
        </div>

    </div>

</div>



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
  












<?php include 'footer.php'; ?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>