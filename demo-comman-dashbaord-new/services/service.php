<?php
require_once '../connection.php';

/* =========================
   FETCH SERVICES
========================= */

$service_query = mysqli_query(
    $conn,
    "SELECT id, title, description, image
     FROM service
     ORDER BY id DESC"
);

if (!$service_query) {
    die("Service query failed: " . mysqli_error($conn));
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

<?php include '../common/header.php'; ?>

<body data-restaurant-page="service">

<div class="layout-wrapper layout-content-navbar">

  <div class="layout-container">

    <!-- ================= SIDEBAR ================= -->
    <?php include '../common/sidebar.php'; ?>
    <!-- ================= / SIDEBAR ================= -->

    <!-- ================= PAGE ================= -->

    <div class="layout-page">

      <!-- ================= NAVBAR ================= -->
      <?php include '../common/navbar.php'; ?>
      <!-- ================= / NAVBAR ================= -->

      <!-- ================= CONTENT ================= -->

      <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y">

          <!-- Page Header -->

          <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

              <h4 class="fw-bold mb-1">
                Services
              </h4>

              <p class="text-muted mb-0">
                Manage restaurant services
              </p>

            </div>

            <!-- Add Service Button -->

            <a
              href="add.php"
              class="btn btn-warning"
            >

              <i class="bx bx-plus me-1"></i>

              Add Service

            </a>

          </div>


          <!-- ================= SERVICE CARD ================= -->

          <div class="card">

            <div class="card-header">

              <h5 class="mb-0">
                Service Information
              </h5>

            </div>


            <div class="card-body">

              <div class="table-responsive">

                <!-- ================= TABLE ================= -->

                <table
                  class="table table-bordered table-hover align-middle"
                >

                  <thead>

                    <tr>

                      <th>ID</th>
                      <th>Image</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Action</th>

                    </tr>

                  </thead>


                  <tbody>

                  <?php if (mysqli_num_rows($service_query) > 0): ?>

                    <?php while ($service = mysqli_fetch_assoc($service_query)): ?>

                    <tr>

                      <!-- ID -->

                      <td>
                        <?php echo (int)$service['id']; ?>
                      </td>


                      <!-- Image -->

                      <td>

                        <?php if (!empty($service['image'])): ?>

                          <img
                            src="../uploads/service/<?php echo htmlspecialchars($service['image']); ?>"
                            width="70"
                            height="60"
                            class="rounded"
                            style="object-fit:cover; cursor:pointer;"
                            data-bs-toggle="modal"
                            data-bs-target="#imageModal<?php echo (int)$service['id']; ?>"
                          >

                        <?php else: ?>

                          <span class="text-muted">
                            No Image
                          </span>

                        <?php endif; ?>

                      </td>


                      <!-- Title -->

                      <td>

                        <strong>
                          <?php echo htmlspecialchars($service['title']); ?>
                        </strong>

                      </td>


                      <!-- Description -->

                      <td
                        style="min-width: 350px;"
                        class="description"
                      >

                        <?php echo htmlspecialchars($service['description']); ?>

                      </td>


                      <!-- Action -->

                      <td style="white-space: nowrap;">

                        <a
                          href="edit.php?id=<?php echo (int)$service['id']; ?>"
                          class="btn btn-sm btn-warning me-1"
                          title="Edit"
                        >

                          <i class="bx bx-edit"></i>

                        </a>


                        <a
                          href="delete.php?id=<?php echo (int)$service['id']; ?>"
                          class="btn btn-sm btn-danger"
                          title="Delete"
                          onclick="return confirm('Are you sure you want to delete this service?');"
                        >

                          <i class="bx bx-trash"></i>

                        </a>

                      </td>

                    </tr>

                    <?php endwhile; ?>

                  <?php else: ?>

                    <tr>

                      <td colspan="5" class="text-center text-muted">

                        No services found.

                      </td>

                    </tr>

                  <?php endif; ?>

                  </tbody>

                </table>

                <!-- ================= / TABLE ================= -->

              </div>

            </div>

          </div>

          <!-- ================= / SERVICE CARD ================= -->

        </div>


        <!-- ================= FOOTER ================= -->

        <footer class="content-footer footer bg-footer-theme">

          <div
            class="container-xxl d-flex flex-wrap justify-content-between py-2"
          >

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


<!-- ================= IMAGE MODALS ================= -->

<?php

mysqli_data_seek($service_query, 0);

while ($service = mysqli_fetch_assoc($service_query)):

?>

<div
  class="modal fade"
  id="imageModal<?php echo (int)$service['id']; ?>"
  tabindex="-1"
  aria-hidden="true"
>

  <div class="modal-dialog modal-dialog-centered modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title">

          <?php echo htmlspecialchars($service['title']); ?>

        </h5>

        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>

      </div>

      <div class="modal-body text-center">

        <?php if (!empty($service['image'])): ?>

          <img
            src="../uploads/service/<?php echo htmlspecialchars($service['image']); ?>"
            class="img-fluid rounded"
            alt="<?php echo htmlspecialchars($service['title']); ?>"
          >

        <?php else: ?>

          <p class="text-muted">
            No image available
          </p>

        <?php endif; ?>

      </div>

    </div>

  </div>

</div>

<?php endwhile; ?>


<!-- ================= SNEAT JS ================= -->

<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/js/menu.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/restaurant-data.js"></script>
<script src="../assets/js/restaurant-sync.js"></script>

</body>
</html>