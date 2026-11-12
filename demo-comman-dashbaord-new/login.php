<?php

include 'connection.php';

$message = "";

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "INSERT INTO users (name, email, password)
            VALUES ('$name', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {

        header("Location: /demo-comman-dashbaord-new/dashbaord/index.php");
        exit();

    } else {

        $message = "Error: " . mysqli_error($conn);

    }
}

?>


<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
============================================================== -->

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>

<?php include 'common/header.php'; ?>


<body>

    <!-- Content -->

    <div class="container">

        <div class="authentication-wrapper authentication-basic container-p-y">

            <div class="authentication-inner">

                <!-- Register -->

                <div class="card w-50 m-auto">

                    <div class="card-body">

                        <!-- Logo -->

                        <div class="app-brand justify-content-center">

                            <a
                                href="login.php"
                                class="app-brand-link gap-2"
                            >

                                <span class="app-brand-text demo text-body fw-bolder">
                                    logo
                                </span>

                            </a>

                        </div>

                        <!-- /Logo -->


                        <h4 class="mb-2 text-center py-4">
                            Welcome to Sneat! 👋
                        </h4>


                        <!-- ERROR MESSAGE -->

                        <?php if (!empty($message)) { ?>

                            <div class="alert alert-danger">

                                <?php echo htmlspecialchars($message); ?>

                            </div>

                        <?php } ?>


                        <!-- FORM -->

                        <form
                            class="mb-3"
                            action="login.php"
                            method="POST"
                        >


                            <!-- NAME -->

                            <div class="mb-3">

                                <label
                                    for="name"
                                    class="form-label"
                                >
                                    Name
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    placeholder="Enter your name"
                                    required
                                    autofocus
                                />

                            </div>


                            <!-- EMAIL -->

                            <div class="mb-3">

                                <label
                                    for="email"
                                    class="form-label"
                                >
                                    Email
                                </label>

                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="Enter your email"
                                    required
                                />

                            </div>


                            <!-- PASSWORD -->

                            <div class="mb-3 form-password-toggle">

                                <div class="d-flex justify-content-between">

                                    <label
                                        class="form-label"
                                        for="password"
                                    >
                                        Password
                                    </label>

                                    <a href="auth-forgot-password-basic.html">

                                        <small>
                                            Forgot Password?
                                        </small>

                                    </a>

                                </div>


                                <div class="input-group input-group-merge">

                                    <input
                                        type="password"
                                        id="password"
                                        class="form-control"
                                        name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password"
                                        required
                                    />

                                    <span class="input-group-text cursor-pointer">

                                        <i class="bx bx-hide"></i>

                                    </span>

                                </div>

                            </div>


                            <!-- REMEMBER ME -->

                            <div class="mb-3">

                                <div class="form-check">

                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="remember-me"
                                    />

                                    <label
                                        class="form-check-label"
                                        for="remember-me"
                                    >
                                        Remember Me
                                    </label>

                                </div>

                            </div>


                            <!-- SUBMIT -->

                            <div class="mb-3">

                                <button
                                    class="btn btn-warning d-grid w-100"
                                    type="submit"
                                    name="submit"
                                >
                                    Sign in
                                </button>

                            </div>


                        </form>

                    </div>

                </div>

                <!-- /Register -->

            </div>

        </div>

    </div>

    <!-- / Content -->


    <?php include 'common/footer.php'; ?>


</body>

</html>