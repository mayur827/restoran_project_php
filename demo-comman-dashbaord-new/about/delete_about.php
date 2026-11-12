<?php

require_once '../connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    header("Location: about.php");
    exit;

}

$id = (int) $_GET['id'];


/* ================= GET IMAGE ================= */

$sql = "SELECT image FROM about WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$row = mysqli_fetch_assoc($result);


/* ================= DELETE IMAGE ================= */

if ($row && !empty($row['image'])) {

    $image_path = '../uploads/about/' . $row['image'];

    if (file_exists($image_path)) {

        unlink($image_path);

    }

}


/* ================= DELETE RECORD ================= */

$sql = "DELETE FROM about WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {

    header("Location: about.php");
    exit;

} else {

    die("Delete failed: " . mysqli_error($conn));

}

?>