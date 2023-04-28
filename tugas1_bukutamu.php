<?php
//koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'myDB';

$koneksi = mysqli_connect($host, $user, $password, $database);

// Mengecek Koneksi
if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

//buat tabel buku_tamu
$sql = "CREATE TABLE buku_tamu (
        ID_BT INT(10) AUTO_INCREMENT PRIMARY KEY,
        NAMA VARCHAR(200) NOT NULL,
        EMAIL VARCHAR(50) NOT NULL,
        ISI text
        )";

if(mysqli_query($koneksi, $sql)){
    echo "Tabel buku_tamu berhasil dibuat.";
} else{
    echo "Error: Tabel buku_tamu tidak dapat dibuat." . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>