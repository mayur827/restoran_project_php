<?php

require_once '../connection.php';


/* =========================================================
   GET ID
========================================================= */

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    header("Location: chef.php");
    exit;

}

$id = (int) $_GET['id'];


/* =========================================================
   GET IMAGE NAME
========================================================= */

$sql = "SELECT image FROM our_master_cheif WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$chef = mysqli_fetch_assoc($result);


if (!$chef) {

    header("Location: chef.php");
    exit;

}


/* =========================================================
   DELETE DATABASE RECORD
========================================================= */

$sql = "DELETE FROM our_master_cheif WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);


if (mysqli_stmt_execute($stmt)) {


    /* =====================================================
       DELETE IMAGE
    ===================================================== */

    if (!empty($chef['image'])) {

        $image_path =
            '../uploads/chef/' . $chef['image'];


        if (file_exists($image_path)) {

            unlink($image_path);

        }

    }


    /* Redirect */

    header("Location: chef.php");
    exit;


} else {

    die(
        "Delete failed: " .
        mysqli_error($conn)
    );

}

?>