<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "db_pegawai";
$conn = mysqli_connect($host, $username, $password, $database);

// Query untuk mengambil data dari tabel pegawai, departemen, dan jabatan
$query = "SELECT p.id_pegawai, p.nama_pegawai, p.alamat, p.tanggal_lahir, p.gaji, d.nama_departemen, j.nama_jabatan
            FROM pegawai p 
            JOIN departemen d ON p.id_departemen = d.id_departemen 
            JOIN jabatan j ON p.id_jabatan = j.id_jabatan";

// Eksekusi query dan simpan hasilnya dalam variabel result
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
	<html>
	<head>
		<title>List Data Pegawai</title>
	</head>
	<body>
		<h1>List Data Pegawai</h1>
        <button onclick="location.href='tugas3_create.php'">Create Data</button>
        <br><br>

    <!--Tampilkan data dalam tabel-->
    <table border="3">
                <tr>
                    <th>ID Pegawai</th>
                    <th>Nama Pegawai</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Gaji</th>
                    <th>Departemen</th>
                    <th>Jabatan</th>
                    <th> </th>
                </tr>
     
    <?php
    while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id_pegawai']; ?></td>
                <td><?php echo $row['nama_pegawai']; ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td><?php echo $row['tanggal_lahir']; ?></td>
                <td><?php echo $row['gaji']; ?></td>
                <td><?php echo $row['nama_departemen']; ?></td>
                <td><?php echo $row['nama_jabatan']; ?></td>
                <td>
					<a href="tugas3_edit.php?id=<?php echo $row["id_pegawai"]; ?>">Edit</a>
					<a href="tugas3_delete.php?id=<?php echo $row["id_pegawai"]; ?>">Delete</a>
				</td>
            </tr>
            <?php } ?>
            </table>
	</body>
	</html>