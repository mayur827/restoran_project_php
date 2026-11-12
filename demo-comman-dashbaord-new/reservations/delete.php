<?php

include '../connection.php';


// Get ID from URL

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;


// Check ID

if ($id <= 0) {

    header("Location: reservation.php");
    exit;

}


// Delete reservation

$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM reservations WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);


// Close statement

mysqli_stmt_close($stmt);


// Go back to reservation page

header("Location: reservation.php");

exit;

?>