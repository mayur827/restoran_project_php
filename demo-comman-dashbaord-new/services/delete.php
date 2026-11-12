<?php

require_once '../connection.php';


/* =========================
   GET SERVICE ID
========================= */

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {

    header("Location: service.php");
    exit;
}


/* =========================
   GET IMAGE NAME
========================= */

$stmt = mysqli_prepare(
    $conn,
    "SELECT image
     FROM service
     WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$service = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


if (!$service) {

    header("Location: service.php");
    exit;
}


/* =========================
   DELETE DATABASE RECORD
========================= */

$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM service
     WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);


    /* =========================
       DELETE IMAGE
    ========================= */

    if (!empty($service['image'])) {

        $image_path =
            '../uploads/service/' . $service['image'];

        if (file_exists($image_path)) {

            unlink($image_path);
        }
    }

} else {

    mysqli_stmt_close($stmt);
}


/* =========================
   BACK TO SERVICE PAGE
========================= */

header("Location: service.php");
exit;

?>