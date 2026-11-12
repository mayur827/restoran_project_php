<?php

require_once '../connection.php';


// =========================
// CHECK ID
// =========================

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    header("Location: menu.php?error=Invalid food ID");
    exit;

}

$id = (int)$_GET['id'];


// =========================
// GET FOOD IMAGE
// =========================

$stmt = mysqli_prepare(
    $conn,
    "SELECT image
     FROM food_menu
     WHERE id = ?"
);


if (!$stmt) {

    header("Location: menu.php?error=Database error");
    exit;

}


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);


if (mysqli_num_rows($result) === 0) {

    mysqli_stmt_close($stmt);

    header("Location: menu.php?error=Food item not found");
    exit;

}


$row = mysqli_fetch_assoc($result);

$image = $row['image'];

mysqli_stmt_close($stmt);


// =========================
// DELETE FOOD
// =========================

$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM food_menu WHERE id = ?"
);


if (!$stmt) {

    header("Location: menu.php?error=Database error");
    exit;

}


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);


if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);


    // =========================
    // DELETE IMAGE
    // =========================

    if (!empty($image)) {

        $image_path =
            "../uploads/food_menu/" .
            $image;


        if (file_exists($image_path)) {

            unlink($image_path);

        }

    }


    header(
        "Location: menu.php?success=Food deleted successfully"
    );

    exit;

} else {

    mysqli_stmt_close($stmt);

    header(
        "Location: menu.php?error=Unable to delete food"
    );

    exit;

}

?>