<?php

include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $profession = mysqli_real_escape_string($conn, $_POST['profession']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $image_name = '';

    // Image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $image_name = basename($_FILES['image']['name']);

        $target = "../assets/img/avatars/" . $image_name;

        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $query = "INSERT INTO testimonials 
              (client_name, profession, description, image)
              VALUES 
              ('$client_name', '$profession', '$description', '$image_name')";

    if (mysqli_query($conn, $query)) {

        header("Location: testimonial.php");
        exit();

    } else {

        echo "Error: " . mysqli_error($conn);
    }
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
        .card-info{ 
            margin-left:30px; 
        } 
</style> 
 
<?php include '../common/header.php';?> 
 
<body> 
 
<div class="layout-wrapper layout-content-navbar"> 
 
    <div class="layout-container"> 
 
<?php include '../common/sidebar.php';?> 
 
        <div class="layout-page"> 
 
            <?php include '../common/navbar.php';?> 
 
            <!-- ================= CONTENT ================= --> 
 
<form method="POST" enctype="multipart/form-data" class="mt-4"> 

            <div class="card m-4"> 
 
            <div class="card-body"> 

                <div class="card-info" style="font-weight:bold;"> 
                    ADD NEW TESTIMONIALS 
                </div> 
 
              <div class="table-responsive"> 
 
             <div class="container row g-4 mt-3"> 
 
                        <!-- Client Name --> 
                        <div class="col-lg-6"> 
 
                            <label class="form-label"> 
                                Client Name 
                            </label> 
 
                            <input type="text" name="client_name" class="form-control" placeholder="Enter client name" required=""> 
 
                        </div> 
 
                        <!-- Profession --> 
                        <div class="col-lg-6"> 
 
                            <label class="form-label"> 
                                Profession 
                            </label> 
 
                            <input type="text" name="profession" class="form-control" placeholder="Enter profession" required=""> 
 
                        </div> 
 
                        <!-- Image --> 
                        <div class="col-lg-12"> 
 
                            <label class="form-label"> 
                                Client Image 
                            </label> 
 
                            <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp"> 
 
                            <small class="text-muted"> 
                                JPG, JPEG, PNG or WEBP 
                            </small> 
 
                        </div> 
 
                        <!-- Description --> 
                        <div class="col-lg-12"> 
 
                            <label class="form-label"> 
                                Description 
                            </label> 
 
                            <textarea name="description" class="form-control" rows="5" placeholder="Enter testimonial description" required=""></textarea> 
 
                        </div> 
 
                        <!-- Buttons --> 
                        <div class="col-12 mt-3"> 
 
                            <button type="submit" class="btn btn-warning"> 
                                <i class="fa-solid fa-save"></i> 
                                Save Testomonial 
                            </button> 
 
                            <a href="testimonial.php" class="btn btn-secondary"> 
                                Cancel 
                            </a> 
 
                        </div> 
 
                    </div> 
</div> 
</div> 
</div> 
</form> 

</div> 
</div> 
 
<!-- ================= SNEAT JS ================= --> 
 
<script src="../assets/vendor/libs/jquery/jquery.js"></script> 
<script src="../assets/vendor/js/bootstrap.js"></script> 
<script src="../assets/vendor/js/menu.js"></script> 
<script src="../assets/js/main.js"></script> 
 
</body> 
 
</html>