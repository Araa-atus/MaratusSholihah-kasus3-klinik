<?php
include "config/koneksi.php";

if(isset($_POST['simpan'])){

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

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    if($foto != ""){
        move_uploaded_file($tmp,"upload/".$foto);
    }

    $sql = "INSERT INTO pasien
    (no_rm,nama,jadwal,dokter,status_antrian,tanggal_lahir,jenis_kelamin,alamat,telepon,alergi,riwayat,asuransi,foto)
    VALUES
    ('$no_rm','$nama','$jadwal','$dokter','$status','$tgl','$jk','$alamat','$telepon','$alergi','$riwayat','$asuransi','$foto')";
    
    if(mysqli_query($conn, $sql)){
        echo "<script>
        alert('Data berhasil ditambahkan');
        window.location='index.php';
        </script>";
    } else {
        die("Query gagal: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Pasien</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

<h2>Tambah Pasien</h2>

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>No Rekam Medis</label>
<input type="text" name="no_rm" class="form-control" required>
</div>

<div class="mb-3">
<label>Nama Pasien</label>
<input type="text" name="nama" class="form-control" required>
</div>

<div class="mb-3">
<label>Jadwal Konsultasi</label>
<input type="date" name="jadwal" class="form-control">
</div>

<div class="mb-3">
<label>Dokter Spesialis</label>
<input type="text" name="dokter" class="form-control">
</div>

<div class="mb-3">
<label>Status Antrian</label>
<select name="status" class="form-control">
<option>Menunggu</option>
<option>Dipanggil</option>
<option>Selesai</option>
</select>
</div>

<div class="mb-3">
<label>Tanggal Lahir</label>
<input type="date" name="tanggal_lahir" class="form-control">
</div>

<div class="mb-3">
<label>Jenis Kelamin</label>
<select name="jenis_kelamin" class="form-control">
<option>Laki-laki</option>
<option>Perempuan</option>
</select>
</div>

<div class="mb-3">
<label>Alamat</label>
<textarea name="alamat" class="form-control"></textarea>
</div>

<div class="mb-3">
<label>No Telepon</label>
<input type="text" name="telepon" class="form-control">
</div>

<div class="mb-3">
<label>Riwayat Alergi</label>
<textarea name="alergi" class="form-control"></textarea>
</div>

<div class="mb-3">
<label>Catatan Kunjungan Sebelumnya</label>
<textarea name="riwayat" class="form-control"></textarea>
</div>

<div class="mb-3">
<label>Asuransi</label>
<input type="text" name="asuransi" class="form-control">
</div>

<div class="mb-3">
<label>Foto Pasien</label>
<input type="file" name="foto" class="form-control">
</div>

<button type="submit" name="simpan" class="btn btn-success">
Simpan
</button>

<a href="index.php" class="btn btn-secondary">
Kembali
</a>

</form>

</div>

</body>
</html>