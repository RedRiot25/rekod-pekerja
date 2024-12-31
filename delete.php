<?php
include 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Padamkan rekod pekerja berdasarkan ID
    $sql = "DELETE FROM maklumat WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Rekod berjaya dipadam!";
        header('Location: dashboard.php');
        exit;
    } else {
        echo "Ralat: " . $conn->error;
    }
}
?>
