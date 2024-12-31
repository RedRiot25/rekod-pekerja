<?php
$servername = "localhost";
$username = "root";
$password = ""; // Laragon biasanya tiada kata laluan
$dbname = "rekod-pekerja"; // Nama pangkalan data anda

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Sambungan gagal: " . $conn->connect_error);
}
?>
