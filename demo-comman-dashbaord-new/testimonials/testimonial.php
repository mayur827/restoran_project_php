<?php
include '../connection.php';

// Get testimonials from database
$result = mysqli_query($conn, "SELECT * FROM testimonials ORDER BY id ASC");
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
  .description { 
    display: -webkit-box; 
    -webkit-box-orient: vertical; 
    -webkit-line-clamp: 2; 
    overflow: hidden; 
    text-overflow: ellipsis; 
    line-clamp: 2; 
    max-width: 350px; 
  } 
</style> 

<?php include '../common/header.php';?> 
 
<body data-restaurant-page="testimonial"> 
 
<div class="layout-wrapper layout-content-navbar"> 
 
  <div class="layout-container"> 
 
    <!-- ================= SIDEBAR ================= --> 
    <?php include '../common/sidebar.php';?> 
     
    <!-- ================= / SIDEBAR ================= --> 
 
    <!-- ================= PAGE ================= --> 
    <div class="layout-page"> 
 
      <!-- ================= NAVBAR ================= --> 
      <?php include '../common/navbar.php';?> 
 
      <!-- ================= / NAVBAR ================= --> 
 
      <!-- ================= CONTENT ================= --> 
      <div class="content-wrapper"> 
 
        <div class="container-xxl flex-grow-1 container-p-y"> 
 
          <!-- Page Header --> 
          <div class="d-flex justify-content-between align-items-center mb-4"> 
 
            <div> 
              <h4 class="fw-bold mb-1"> 
                Testimonials 
              </h4> 
 
              <p class="text-muted mb-0"> 
                Manage customer testimonials 
              </p> 
            </div> 
 
            <!-- Add Testimonial Button --> 
            <a href="add.php" class="btn btn-warning"> 
              <i class="bx bx-plus me-1"></i> 
              Add Testimonial 
            </a> 
 
          </div> 
 
          <!-- ================= TESTIMONIAL CARD ================= --> 
          <div class="card"> 
 
            <div class="card-header"> 
              <h5 class="mb-0"> 
                Testimonial Information 
              </h5> 
            </div> 
 
            <div class="card-body"> 
 
              <div class="table-responsive"> 
 
                <!-- ================= TABLE ================= --> 
                <table class="table table-bordered table-hover align-middle"> 
 
                  <thead> 
                    <tr> 
                      <th>ID</th> 
                      <th>Image</th> 
                      <th>Client Name</th> 
                      <th>Profession</th> 
                      <th>Description</th> 
                      <th>Action</th> 
                    </tr> 
                  </thead> 
 
                  <tbody>

<?php
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
?>

                    <tr> 
 
                      <!-- ID --> 
                      <td> 
                        <?php echo $row['id']; ?> 
                      </td> 
 
                      <!-- Image --> 
                      <td> 

                        <?php if (!empty($row['image'])): ?>

    <img
        src="../assets/img/avatars/<?php echo htmlspecialchars($row['image']); ?>"
        width="65"
        height="65"
        class="rounded-circle"
        style="object-fit:cover; cursor:pointer;"
        data-bs-toggle="modal"
        data-bs-target="#imageModal<?php echo (int)$row['id']; ?>"
        alt="Client Image"
    >

<?php else: ?>

    <span class="text-muted">No Image</span>

<?php endif; ?>
 
                      </td> 
 
                      <!-- Client Name --> 
                      <td> 
                        <strong> 
                          <?php echo htmlspecialchars($row['client_name']); ?> 
                        </strong> 
                      </td> 
 
                      <!-- Profession --> 
                      <td> 
                        <span class="badge bg-label-warning"> 
                          <?php echo htmlspecialchars($row['profession']); ?> 
                        </span> 
                      </td> 
 
                      <!-- Description --> 
                      <td style="min-width: 350px;" class="description"> 
                        <?php echo htmlspecialchars($row['description']); ?> 
                      </td> 
 
                      <!-- Action --> 
                      <td style="white-space: nowrap;"> 

                        <!-- View Button --> 
                        <a 
                          href="view.php?id=<?php echo $row['id']; ?>" 
                          class="btn btn-sm btn-info me-1" 
                          title="View" 
                        > 
                          <i class="bx bx-show"></i> 
                        </a> 
 
                        <!-- Edit Button --> 
                        <a 
                          href="edit.php?id=<?php echo $row['id']; ?>" 
                          class="btn btn-sm btn-warning me-1" 
                          title="Edit" 
                        > 
                          <i class="bx bx-edit"></i> 
                        </a> 
 
                        <!-- Delete Button --> 
                        <a 
                          href="delete.php?id=<?php echo $row['id']; ?>" 
                          class="btn btn-sm btn-danger" 
                          title="Delete" 
                          onclick="return confirm('Are you sure you want to delete this testimonial?');" 
                        > 
                          <i class="bx bx-trash"></i> 
                        </a> 
 
                      </td> 
 
                    </tr>

<?php
    }

} else {
?>

                    <tr>
                      <td colspan="6" class="text-center text-muted">
                        No testimonials found.
                      </td>
                    </tr>

<?php
}
?>

                  </tbody> 
 
                </table> 
                <?php
$modal_result = mysqli_query($conn, "SELECT * FROM testimonials ORDER BY id ASC");

while ($modal_row = mysqli_fetch_assoc($modal_result)):
?>

<div
    class="modal fade"
    id="imageModal<?php echo (int)$modal_row['id']; ?>"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">
                    <?php echo htmlspecialchars($modal_row['client_name']); ?>
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>

            <div class="modal-body text-center">

                <img
                    src="../assets/img/avatars/<?php echo htmlspecialchars($modal_row['image']); ?>"
                    class="img-fluid rounded-circle"
                    style="width:200px; height:200px; object-fit:cover;"
                    alt="Client Image"
                >

            </div>

        </div>

    </div>
</div>

<?php endwhile; ?>
 
                <!-- ================= / TABLE ================= --> 
 
              </div> 
 
            </div> 
 
          </div> 
 
          <!-- ================= / TESTIMONIAL CARD ================= --> 
 
        </div> 
 
        <!-- ================= FOOTER ================= --> 
        <footer class="content-footer footer bg-footer-theme"> 
 
          <div class="container-xxl d-flex flex-wrap justify-content-between py-2"> 
 
            <div class="mb-2 mb-md-0"> 
              © 2026 Restoran Dashboard 
            </div> 
 
            <div> 
              Admin Dashboard 
            </div> 
 
          </div> 
 
        </footer> 
 
        <!-- ================= / FOOTER ================= --> 
 
      </div> 
 
      <!-- ================= / CONTENT ================= --> 
 
    </div> 
 
    <!-- ================= / PAGE ================= --> 
 
  </div> 
 
</div> 
 
<!-- ================= SNEAT JS ================= --> 
 
<script src="../assets/vendor/libs/jquery/jquery.js"></script> 
<script src="../assets/vendor/js/bootstrap.js"></script> 
<script src="../assets/vendor/js/menu.js"></script> 
<script src="../assets/js/main.js"></script> 
<script src="../assets/js/restaurant-data.js"></script> 
<script src="../assets/js/restaurant-sync.js"></script> 
 
</body> 
 
</html>