<?php
include "config/koneksi.php";

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $no_rm = $_POST['no_rm'];
    $nama = $_POST['nama'];
    $jadwal = $_POST['jadwal'];
    $dokter = $_POST['dokter'];
    $status = $_POST['status'];
    $tgl = $_POST['tanggal_lahir'];
    $jk = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $alergi = $_POST['alergi'];
    $riwayat = $_POST['riwayat'];
    $asuransi = $_POST['asuransi'];

    $foto = $data['foto'];

    if($_FILES['foto']['name'] != ""){

        if($data['foto'] != "" && file_exists("upload/".$data['foto'])){
            unlink("upload/".$data['foto']);
        }

        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp,"upload/".$foto);
    }

    mysqli_query($conn,"UPDATE pasien SET

        no_rm='$no_rm',
        nama='$nama',
        jadwal='$jadwal',
        dokter='$dokter',
        status_antrian='$status',
        tanggal_lahir='$tgl',
        jenis_kelamin='$jk',
        alamat='$alamat',
        telepon='$telepon',
        alergi='$alergi',
        riwayat='$riwayat',
        asuransi='$asuransi',
        foto='$foto'

        WHERE id='$id'
    ");

    echo "<script>
        alert('Data berhasil diupdate');
        window.location='index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Edit Pasien</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Edit Data Pasien</h2>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>No Rekam Medis</label>
<input type="text" name="no_rm" class="form-control" value="<?= $data['no_rm']; ?>" required>
</div>

<div class="mb-3">
<label>Nama Pasien</label>
<input type="text" name="nama" class="form-control" value="<?= $data['nama']; ?>" required>
</div>

<div class="mb-3">
<label>Jadwal Konsultasi</label>
<input type="date" name="jadwal" class="form-control" value="<?= $data['jadwal']; ?>">
</div>

<div class="mb-3">
<label>Dokter Spesialis</label>
<input type="text" name="dokter" class="form-control" value="<?= $data['dokter']; ?>">
</div>

<div class="mb-3">
<label>Status Antrian</label>

<select name="status" class="form-control">

<option <?= ($data['status_antrian']=="Menunggu")?"selected":""; ?>>Menunggu</option>

<option <?= ($data['status_antrian']=="Dipanggil")?"selected":""; ?>>Dipanggil</option>

<option <?= ($data['status_antrian']=="Selesai")?"selected":""; ?>>Selesai</option>

</select>

</div>

<div class="mb-3">
<label>Tanggal Lahir</label>
<input type="date" name="tanggal_lahir" class="form-control" value="<?= $data['tanggal_lahir']; ?>">
</div>

<div class="mb-3">
<label>Jenis Kelamin</label>

<select name="jenis_kelamin" class="form-control">

<option value="Laki-laki" <?= ($data['jenis_kelamin']=="Laki-laki")?"selected":""; ?>>Laki-laki</option>

<option value="Perempuan" <?= ($data['jenis_kelamin']=="Perempuan")?"selected":""; ?>>Perempuan</option>

</select>

</div>

<div class="mb-3">
<label>Alamat</label>
<textarea name="alamat" class="form-control"><?= $data['alamat']; ?></textarea>
</div>

<div class="mb-3">
<label>No Telepon</label>
<input type="text" name="telepon" class="form-control" value="<?= $data['telepon']; ?>">
</div>

<div class="mb-3">
<label>Riwayat Alergi</label>
<textarea name="alergi" class="form-control"><?= $data['alergi']; ?></textarea>
</div>

<div class="mb-3">
<label>Catatan Kunjungan Sebelumnya</label>
<textarea name="riwayat" class="form-control"><?= $data['riwayat']; ?></textarea>
</div>

<div class="mb-3">
<label>Asuransi</label>
<input type="text" name="asuransi" class="form-control" value="<?= $data['asuransi']; ?>">
</div>

<div class="mb-3">

<label>Foto Saat Ini</label><br>

<?php
if($data['foto']!=""){
?>
<img src="upload/<?= $data['foto']; ?>" width="150" class="img-thumbnail mb-2">
<?php
}
?>

<input type="file" name="foto" class="form-control">

</div>

<button type="submit" name="update" class="btn btn-success">
Update
</button>

<a href="index.php" class="btn btn-secondary">
Kembali
</a>

</form>

</div>

</body>
</html>