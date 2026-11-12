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

        <h1>Booking</h1>

        <div class="breadcrumb-text">
            <a href="task.php">HOME</a>
            <span>/</span>

            <a href="#">PAGES</a>
            <span>/</span>

            <span class="active-page">BOOKING</span>
        </div>

    </div>

</div>
<div class="container-xxl flud py-5 px-0">

    <div class="row g-0">

        <!-- LEFT SIDE VIDEO -->
        <div class="col-md-6">

            <div class="video-img">

                <img src="assets/img/video.jpg" alt="Restaurant Video">

                <div class="font">

                    <button type="button"
                        class="video-play-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#videoModal">

                        <i class="fa-solid fa-circle-play" style="color:orange;"></i>

                    </button>

                </div>

            </div>

        </div>


        <!-- RIGHT SIDE FORM -->
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


<!-- VIDEO MODAL - KEEP OUTSIDE ROW -->
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

   <?php include 'footer.php'; ?> 
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>