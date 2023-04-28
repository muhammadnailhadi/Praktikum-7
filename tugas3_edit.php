<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "db_pegawai");

// Mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
if (isset($_POST["submit"])) {
    $id = $_POST["id_pegawai"];
    $nama_pegawai = $_POST["nama_pegawai"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $alamat = $_POST["alamat"];
    $gaji = $_POST["gaji"];
    $id_departemen = $_POST["id_departemen"];
    $id_jabatan = $_POST["id_jabatan"];

    // Mengupdate data ke tabel pegawai
    $sql = "UPDATE pegawai SET nama_pegawai='$nama_pegawai', tanggal_lahir='$tanggal_lahir', alamat='$alamat', gaji='$gaji',
            id_departemen='$id_departemen', id_jabatan='$id_jabatan' WHERE id_pegawai='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Data berhasil diupdate";
        header("Location: tugas3_index.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
//Pengecekan ID
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    // Pengupdatean data dengan ID yang telah diberikan
    $sql = "SELECT * FROM pegawai WHERE id_pegawai='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Pegawai</title>
</head>
<body>
    <h1>Edit Data Pegawai</h1>
    <!-- Form untuk mengupdate data ke tabel pegawai-->
    <form action="" method="post">
        <input type="hidden" name="id_pegawai" value="<?php echo $row['id_pegawai']; ?>">
        <label>Nama</label>
        <input type="text" name="nama_pegawai" value="<?php echo $row['nama_pegawai']; ?>"><br><br>
        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="<?php echo $row['tanggal_lahir']; ?>"><br><br>
        <label>Alamat</label>
        <textarea name="alamat"><?php echo $row['alamat']; ?></textarea><br><br>
        <label>Gaji</label>
        <input type="text" name="gaji" value="<?php echo $row['gaji']; ?>"><br><br> 
        <label>Departemen</label>
        <select name="id_departemen">
            <?php
            //Menampilkan data tabel departemen ke dropdown
            $sql_departemen = "SELECT * FROM departemen";
            $result_departemen = mysqli_query($conn, $sql_departemen);
            while ($row_departemen = mysqli_fetch_assoc($result_departemen)) {
                if ($row['id_departemen'] == $row_departemen['id_departemen']) {
                    echo '<option value="' . $row_departemen['id_departemen'] . '" selected>' . $row_departemen['nama_departemen'] . '</option>';
                } else {
                    echo '<option value="' . $row_departemen['id_departemen'] . '">' . $row_departemen['nama_departemen'] . '</option>';
                }
            }
            ?>
        </select><br><br>
        <label>Jabatan</label>
        <select name="id_jabatan">
            <?php
            //Menampilkan data tabel jabatan ke dropdown
            $sql_jabatan = "SELECT * FROM jabatan";
            $result_jabatan = mysqli_query($conn, $sql_jabatan);
            while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                if ($row['id_jabatan'] == $row_jabatan['id_jabatan']) {
                    echo '<option value="' . $row_jabatan['id_jabatan'] . '">' . $row_jabatan['nama_jabatan'] . '</option>';

                } else {
                    echo '<option value="' . $row_jabatan['id_jabatan'] . '">' . $row_jabatan['nama_jabatan'] . '</option>';

                }
            }
            ?>
        </select>
        <br><br>
            <button type="submit" name="submit">Simpan</button>
        </form>
    </body>
</html>
