<?php

include '../connection.php';

// Get ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: testimonial.php");
    exit();
}

// Get testimonial from database
$result = mysqli_query($conn, "SELECT * FROM testimonials WHERE id = $id");

if (mysqli_num_rows($result) == 0) {
    header("Location: testimonial.php");
    exit();
}

// Get selected testimonial
$testimonial = mysqli_fetch_assoc($result);

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
 
<?php include '../common/header.php';?> 
 
<body> 
 
<div class="layout-wrapper layout-content-navbar"> 
 
    <div class="layout-container"> 
 
<?php include '../common/sidebar.php';?> 
 
        <!-- ================= / SIDEBAR ================= --> 
 
        <!-- ================= PAGE ================= --> 
 
        <div class="layout-page"> 
 
            <!-- Navbar --> 
 
            <?php include '../common/navbar.php';?> 
 
            <!-- / Navbar --> 
 
            <!-- ================= CONTENT ================= --> 
 
<div class="card shadow-sm m-4"> 
 
            <div class="card-body"> 
 
                        <div class="row g-4"> 
 
                            <!-- Client Image --> 
                            <div class="col-lg-12"> 
 
                                <label class="form-label fw-bold"> 
                                    Client Image 
                                </label> 
 
                                <div> 
 
                                    <img 
                                        src="../assets/img/avatars/<?php echo htmlspecialchars($testimonial['image']); ?>" 
                                        alt="Client Image" 
                                        width="100" 
                                        height="100" 
                                        style="object-fit: cover; border-radius: 50%;"
                                    > 
 
                                </div> 
 
                            </div> 
 
                            <!-- Client Name --> 
                            <div class="col-lg-6"> 
 
                                <label class="form-label fw-bold"> 
                                    Client Name 
                                </label> 
 
                                <div class="form-control bg-light"> 
                                    <?php echo htmlspecialchars($testimonial['client_name']); ?> 
                                </div> 
 
                            </div> 
 
                            <!-- Profession --> 
                            <div class="col-lg-6"> 
 
                                <label class="form-label fw-bold"> 
                                    Profession 
                                </label> 
 
                                <div class="form-control bg-light"> 
                                    <?php echo htmlspecialchars($testimonial['profession']); ?> 
                                </div> 
 
                            </div> 
 
                            <!-- Description --> 
                            <div class="col-12"> 
 
                                <label class="form-label fw-bold"> 
                                    Description 
                                </label> 
 
                                <div class="form-control bg-light" 
                                     style="height: auto; min-height: 100px;"> 
 
                                    <?php echo htmlspecialchars($testimonial['description']); ?> 
 
                                </div> 
 
                            </div> 
 
                            <!-- Back --> 
                            <div class="col-12"> 
 
                                <a href="testimonial.php" class="btn btn-secondary"> 
 
                                    <i class="fa-solid fa-xmark"></i> 
 
                                    Back 
 
                                </a> 
 
                            </div> 
 
                        </div> 
</div> 
</div> 
</div> 
 
</div> 
</div> 
 
<!-- ================= SNEAT JS ================= --> 
 
<script src="../assets/vendor/libs/jquery/jquery.js"></script> 
 
<script src="../assets/vendor/js/bootstrap.js"></script> 
 
<script src="../assets/vendor/js/menu.js"></script> 
 
<script src="../assets/js/main.js"></script> 
 
</body> 
 
</html>