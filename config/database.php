<?php
$host = "localhost";
$user = "root";      // ganti sesuai username MySQL
$pass = "";          // ganti sesuai password MySQL
$db   = "kabis";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>