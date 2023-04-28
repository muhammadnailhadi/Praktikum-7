<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_pegawai");

// Mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    // Penghapusan data dengan ID yang telah diberikan
    $sql = "DELETE FROM pegawai WHERE id_pegawai = $id";
    if (mysqli_query($conn, $sql)) {
        // update data dengan ID lebih besar atau sama dengan ID yang dihapus
        $update_sql = "UPDATE pegawai SET id_pegawai = id_pegawai - 1 WHERE id_pegawai >= $id";
        mysqli_query($conn, $update_sql);
        
        header("Location: tugas3_index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>