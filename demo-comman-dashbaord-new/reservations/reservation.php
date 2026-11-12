<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>

<?php include '../common/header.php'; ?>

<?php
include '../connection.php';

$result = mysqli_query($conn, "SELECT * FROM reservations ORDER BY id ASC");
?>

<body data-restaurant-page="reservation">

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

          <div class="mb-4">

            <h4 class="fw-bold mb-1">
              Reservations
            </h4>

            <p class="text-muted mb-0">
              Manage restaurant reservations
            </p>

          </div>


          <!-- ================= RESERVATION CARD ================= -->

          <div class="card">


            <div class="card-header">

              <h5 class="mb-0">
                Reservation Information
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

                      <th>Name</th>

                      <th>Email</th>

                      <th>Date</th>

                      <th>Time</th>

                      <th>People</th>

                      <th>Special Request</th>

                      <th>Created At</th>

                      <th>Action</th>

                    </tr>

                  </thead>


                  <tbody>

<?php if (mysqli_num_rows($result) > 0): ?>

<?php while ($reservation = mysqli_fetch_assoc($result)): ?>

                    <tr>

                      <!-- ID -->

                      <td>
                        <?php echo (int)$reservation['id']; ?>
                      </td>


                      <!-- Name -->

                      <td>
                        <?php echo htmlspecialchars($reservation['name']); ?>
                      </td>


                      <!-- Email -->

                      <td>
                        <?php echo htmlspecialchars($reservation['email']); ?>
                      </td>


                      <!-- Date -->

                      <td>
                        <?php
                        echo date(
                            'd M Y',
                            strtotime($reservation['reservation_date'])
                        );
                        ?>
                      </td>


                      <!-- Time -->

                      <td>
                        <?php
                        echo date(
                            'h:i A',
                            strtotime($reservation['reservation_time'])
                        );
                        ?>
                      </td>


                      <!-- People -->

                      <td>

                        <span class="badge bg-label-primary">

                          <?php echo (int)$reservation['no_of_people']; ?>
                          People

                        </span>

                      </td>


                      <!-- Special Request -->

                      <td style="min-width: 200px;">

                        <?php
                        echo htmlspecialchars(
                            $reservation['special_request']
                        );
                        ?>

                      </td>


                      <!-- Created At -->

                      <td>

                        <?php
                        echo date(
                            'd M Y',
                            strtotime($reservation['created_at'])
                        );
                        ?>

                      </td>


                      <!-- Action -->

                      <td style="white-space: nowrap;">


                        <!-- View Button -->

                        <a
                          href="view.php?id=<?php echo (int)$reservation['id']; ?>"
                          class="btn btn-sm btn-info me-1"
                          title="View"
                        >

                          <i class="bx bx-show"></i>

                        </a>

                            <!-- Edit -->
    <a
        href="edit.php?id=<?php echo (int)$reservation['id']; ?>"
        class="btn btn-sm btn-warning me-1"
        title="Edit"
    >
        <i class="bx bx-edit"></i>
    </a>

                        <!-- Delete Button -->

                        <a
                          href="delete.php?id=<?php echo (int)$reservation['id']; ?>"
                          class="btn btn-sm btn-danger"
                          title="Delete"
                          onclick="return confirm('Are you sure you want to delete this reservation?');"
                        >

                          <i class="bx bx-trash"></i>

                        </a>


                      </td>

                    </tr>

<?php endwhile; ?>

<?php else: ?>

                    <tr>

                      <td colspan="9" class="text-center text-muted">

                        No reservations found.

                      </td>

                    </tr>

<?php endif; ?>

                  </tbody>

                </table>

                <!-- ================= / TABLE ================= -->


              </div>

            </div>

          </div>

          <!-- ================= / RESERVATION CARD ================= -->


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


<!-- ================= SNEAT JS ================= -->

<script src="../assets/vendor/libs/jquery/jquery.js"></script>

<script src="../assets/vendor/js/bootstrap.js"></script>

<script src="../assets/vendor/js/menu.js"></script>

<script src="../assets/js/main.js"></script>

<script src="../assets/js/restaurant-data.js"></script>

<script src="../assets/js/restaurant-sync.js"></script>

</body>

</html>