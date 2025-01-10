<?php
$host = 'localhost:3306';
$dbname = 'uas_basdat';
$username = 'root';
$password = '';

$koneksi = mysqli_connect($host, $username, $password, $dbname);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
else {
    echo"koneksi berhasil";
}
?>
