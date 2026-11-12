<?php

include '../connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: testimonial.php");
    exit();
}

$id = (int) $_GET['id'];

// Get existing testimonial
$result = mysqli_query($conn, "SELECT * FROM testimonials WHERE id = $id");

if (mysqli_num_rows($result) == 0) {
    header("Location: testimonial.php");
    exit();
}

$testimonial = mysqli_fetch_assoc($result);


// Update testimonial
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $profession = mysqli_real_escape_string($conn, $_POST['profession']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $old_image = $testimonial['image'];

    $image_name = $old_image;

    // New image uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        $image_name = basename($_FILES['image']['name']);

        $target = "../assets/img/avatars/" . $image_name;

        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $query = "UPDATE testimonials SET
              client_name = '$client_name',
              profession = '$profession',
              description = '$description',
              image = '$image_name'
              WHERE id = $id";

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
                    UPDATE TESTIMONIALS 
                </div> 
 
              <div class="table-responsive"> 
 
                    <div class="container row g-4 mt-3"> 
 
                        <!-- Client Name --> 
                        <div class="col-lg-6"> 
 
                            <label class="form-label"> 
                                Client Name 
                            </label> 
 
                            <input 
                                type="text" 
                                name="client_name" 
                                class="form-control" 
                                placeholder="Enter client name" 
                                value="<?php echo htmlspecialchars($testimonial['client_name']); ?>"
                                required
                            > 
 
                        </div> 
 
                        <!-- Profession --> 
                        <div class="col-lg-6"> 
 
                            <label class="form-label"> 
                                Profession 
                            </label> 
 
                            <input 
                                type="text" 
                                name="profession" 
                                class="form-control" 
                                placeholder="Enter profession" 
                                value="<?php echo htmlspecialchars($testimonial['profession']); ?>"
                                required
                            > 
 
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

                            <br>

                            <?php if (!empty($testimonial['image'])) { ?>

                                <img 
                                    src="../assets/img/avatars/<?php echo htmlspecialchars($testimonial['image']); ?>"
                                    width="80"
                                    height="80"
                                    class="rounded-circle mt-2"
                                    style="object-fit:cover;"
                                >

                            <?php } ?>
 
                        </div> 
 
                        <!-- Description --> 
                        <div class="col-lg-12"> 
 
                            <label class="form-label"> 
                                Description 
                            </label> 
 
                            <textarea 
                                name="description" 
                                class="form-control" 
                                rows="5" 
                                placeholder="Enter testimonial description" 
                                required
                            ><?php echo htmlspecialchars($testimonial['description']); ?></textarea> 
 
                        </div> 
 
                        <!-- Buttons --> 
                        <div class="col-12 mt-3"> 
 
                            <button type="submit" class="btn btn-warning"> 
                                <i class="fa-solid fa-save"></i> 
                                Update Testomonial 
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