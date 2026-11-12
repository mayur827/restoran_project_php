<?php

include '../connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: testimonial.php");
    exit();
}

$id = (int) $_GET['id'];

// Get image name before deleting
$result = mysqli_query($conn, "SELECT image FROM testimonials WHERE id = $id");

if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);

    $image = $row['image'];

    // Delete database record
    $delete = mysqli_query($conn, "DELETE FROM testimonials WHERE id = $id");

    if ($delete) {

        // Delete image file if it exists
        if (!empty($image)) {

            $image_path = "../assets/img/avatars/" . $image;

            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        header("Location: testimonial.php");
        exit();

    } else {

        echo "Error deleting testimonial: " . mysqli_error($conn);
    }

} else {

    header("Location: testimonial.php");
    exit();
}

?>