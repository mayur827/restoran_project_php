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

        <h1>Contact Us</h1>

        <div class="breadcrumb-text">
            <a href="task.php">HOME</a>
            <span>/</span>

            <a href="#">PAGES</a>
            <span>/</span>

            <span class="active-page">CONTACT</span>
        </div>

    </div>

</div>



<div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                  <h6 class="text-center text-warning small-title mt-5"><span></span>Contact Us<span></span></h6>  
                    <h1 class="mb-5">Contact For Any Query</h1>
                </div>
                <div class="row g-4">
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <h5 class="section-title ff-secondary fw-normal text-start text-warning small-title">Booking<span></span></h5>
                                <p><i class="fa fa-envelope-open text-warning me-2"></i>book@example.com</p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="section-title ff-secondary fw-normal text-start text-warning small-title">General<span></span></h5>
                                <p><i class="fa fa-envelope-open text-warning me-2"></i>info@example.com</p>
                            </div>
                            <div class="col-md-4">
                                <h5 class="section-title ff-secondary fw-normal text-start text-warning small-title">Technical<span></span></h5>
                                <p><i class="fa fa-envelope-open text-warning me-2"></i>tech@example.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                        <iframe class="position-relative rounded w-100 h-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd" frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                    <div class="col-md-6">
                        <div class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
<?php

require_once 'demo-comman-dashbaord-new/connection.php';

$message_status = "";
$message_type = "";


// =========================================================
// SAVE CONTACT FORM DATA
// =========================================================

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form values
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');


    // =====================================================
    // VALIDATION
    // =====================================================

    if ($name == "" || $email == "" || $subject == "" || $message == "") {

        $message_status = "Please fill all fields.";
        $message_type = "danger";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message_status = "Please enter a valid email address.";
        $message_type = "danger";

    } else {


        // =================================================
        // INSERT INTO DATABASE
        // =================================================

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO booking (name, email, subject, message)
             VALUES (?, ?, ?, ?)"
        );


        if ($stmt) {

            mysqli_stmt_bind_param(
                $stmt,
                "ssss",
                $name,
                $email,
                $subject,
                $message
            );


            // =============================================
            // EXECUTE
            // =============================================

            if (mysqli_stmt_execute($stmt)) {

                $message_status = "Message sent successfully!";
                $message_type = "success";


                // Clear form values after successful submission
                $name = "";
                $email = "";
                $subject = "";
                $message = "";

            } else {

                $message_status = "Something went wrong. Please try again.";
                $message_type = "danger";

            }


            mysqli_stmt_close($stmt);

        } else {

            $message_status = "Database error. Please try again.";
            $message_type = "danger";

        }

    }

}

?>


<!-- =========================================================
     CONTACT SECTION
========================================================= -->

<div class="container-xxl py-5">

    <div class="container">

        <div class="row g-5 align-items-center">


            <!-- =================================================
                 CONTACT INFORMATION
            ================================================== -->

            

            <!-- =================================================
                 CONTACT FORM
            ================================================== -->

            <div class="col-lg-12">


                <!-- =================================================
                     SUCCESS / ERROR MESSAGE
                ================================================== -->

                <?php if (!empty($message_status)) { ?>

                    <div
                        class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show"
                        role="alert"
                    >

                        <?php echo htmlspecialchars($message_status); ?>


                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"
                            aria-label="Close"
                        ></button>

                    </div>

                <?php } ?>


                <!-- =================================================
                     FORM
                ================================================== -->

                <form method="POST" action="">


                    <div class="row g-3">


                        <!-- =========================================
                             NAME
                        ========================================== -->

                        <div class="col-md-6">

                            <div class="form-floating">

                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    placeholder="Your Name"
                                    value="<?php echo htmlspecialchars($name ?? ''); ?>"
                                    required
                                >

                                <label for="name">
                                    Your Name
                                </label>

                            </div>

                        </div>


                        <!-- =========================================
                             EMAIL
                        ========================================== -->

                        <div class="col-md-6">

                            <div class="form-floating">

                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="Your Email"
                                    value="<?php echo htmlspecialchars($email ?? ''); ?>"
                                    required
                                >

                                <label for="email">
                                    Your Email
                                </label>

                            </div>

                        </div>


                        <!-- =========================================
                             SUBJECT
                        ========================================== -->

                        <div class="col-12">

                            <div class="form-floating">

                                <input
                                    type="text"
                                    class="form-control"
                                    id="subject"
                                    name="subject"
                                    placeholder="Subject"
                                    value="<?php echo htmlspecialchars($subject ?? ''); ?>"
                                    required
                                >

                                <label for="subject">
                                    Subject
                                </label>

                            </div>

                        </div>


                        <!-- =========================================
                             MESSAGE
                        ========================================== -->

                        <div class="col-12">

                            <div class="form-floating">

                                <textarea
                                    class="form-control"
                                    placeholder="Leave a message here"
                                    id="message"
                                    name="message"
                                    style="height: 150px"
                                    required
                                ><?php echo htmlspecialchars($message ?? ''); ?></textarea>

                                <label for="message">
                                    Message
                                </label>

                            </div>

                        </div>


                        <!-- =========================================
                             SEND BUTTON
                        ========================================== -->

                        <div class="col-12">

                            <button
                                class="btn btn-warning w-100 py-3 text-light"
                                type="submit"
                            >

                                SEND MESSAGE

                            </button>

                        </div>


                    </div>


                </form>


            </div>


        </div>

    </div>

</div>


            </div>


        </div>

    </div>

</div>
                        </div>
                    </div>
                </div>
            </div>
         </div>

<?php include 'footer.php'; ?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>


