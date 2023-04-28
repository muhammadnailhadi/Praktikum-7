<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_pegawai");

// Mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Pengecekan form submit
if (isset($_POST["submit"])) {
    $nama_pegawai = $_POST["nama_pegawai"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $alamat = $_POST["alamat"];
    $gaji = $_POST["gaji"];
    $id_departemen = $_POST["id_departemen"];
    $id_jabatan = $_POST["id_jabatan"];

    $sql = "SELECT MAX(id_pegawai) as max_id FROM pegawai";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $new_id = $row["max_id"] + 1;
    // Menambahkan data ke tabel pegawai
    $sql_insert = "INSERT INTO pegawai (id_pegawai, nama_pegawai, tanggal_lahir, alamat, gaji, id_departemen, id_jabatan) 
            VALUES ('$new_id', '$nama_pegawai', '$tanggal_lahir', '$alamat', '$gaji', '$id_departemen', '$id_jabatan')";
    if (mysqli_query($conn, $sql_insert)) {
        $last_id = mysqli_insert_id($conn);
        echo "Data berhasil disimpan. ID Pegawai terakhir adalah: " . $last_id;
        header("Location: tugas3_index.php");
    exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }        
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Pegawai</title>
</head>
<body>
    <h1>Tambah Data Pegawai</h1>
    <!-- Form untuk menambahkan data ke tabel pegawai-->
    <form method="post">
        <label for="nama_pegawai">Nama:</label>
        <input type="text" id="nama_pegawai" name="nama_pegawai" required>
        <br><br>
        <label for="alamat">Alamat:</label>
        <textarea id="alamat" name="alamat" required></textarea>
        <br><br>
        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
        <br><br>
        <label for="gaji">Gaji:</label>
        <input type="gaji" id="gaji" name="gaji" required>
        <br><br>
        <label for="id_departemen">Departemen:</label>
        <select id="id_departemen" name="id_departemen" required>
            <?php
            //Menampilkan data tabel departemen ke dropdown
            $sql = "SELECT * FROM departemen";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row["id_departemen"] . "'>" . $row["nama_departemen"] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="id_jabatan">Jabatan:</label>
        <select id="id_jabatan" name="id_jabatan" required>
            <?php
            //Menampilkan data tabel jabatan ke dropdown
            $sql = "SELECT * FROM jabatan";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row["id_jabatan"] . "'>" . $row["nama_jabatan"] . "</option>";

            }
            ?>
        </select>
        <br><br>
        <button type="submit" name="submit">Simpan</button>
    </form>
</body>
</html>