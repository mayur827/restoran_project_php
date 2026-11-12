<?php

include '../connection.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    header("Location: booking.php");
    exit;
}

$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM booking WHERE id = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $id
);

mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);

header("Location: booking.php");
exit;

?>