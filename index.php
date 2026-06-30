<?php
include "config/koneksi.php";

$cari = "";

if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $query = mysqli_query($conn,"SELECT * FROM pasien
    WHERE nama LIKE '%$cari%'
    OR no_rm LIKE '%$cari%'
    OR dokter LIKE '%$cari%'");
}else{
    $query = mysqli_query($conn,"SELECT * FROM pasien");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<title>Sistem Pendaftaran Pasien Klinik</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">

<div class="container">

<span class="navbar-brand mb-0 h1">
<i class="bi bi-hospital"></i>
Sistem Pendaftaran Pasien Klinik
</span>

</div>

</nav>

<div class="container mt-4">

<div class="card shadow">

<div class="card-header bg-white">

<div class="row">

<div class="col-md-6">

<a href="tambah.php" class="btn btn-success">

<i class="bi bi-person-plus-fill"></i>

Tambah Pasien

</a>

</div>

<div class="col-md-6">

<form>

<div class="input-group">

<input
type="text"
name="cari"
class="form-control"
placeholder="Cari Nama / No RM / Dokter"
value="<?= $cari ?>">

<button class="btn btn-primary">

<i class="bi bi-search"></i>

</button>

</div>

</form>

</div>

</div>

</div>

<div class="card-body">

<div class="row mb-3">

<div class="col-md-4">

<div class="card text-bg-primary">

<div class="card-body">

<h5>Total Pasien</h5>

<h2>

<?php

$total=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM pasien"));

echo $total;

?>

</h2>

</div>

</div>

</div>

</div>

<table class="table table-hover table-bordered align-middle">

<thead class="table-primary">

<tr>

<th>No</th>
<th>No RM</th>
<th>Nama</th>
<th>Jadwal</th>
<th>Dokter</th>
<th>Status</th>
<th width="220">Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

while($data=mysqli_fetch_assoc($query)){

?>

<tr>

<td><?= $no++; ?></td>

<td><?= $data['no_rm']; ?></td>

<td><?= $data['nama']; ?></td>

<td><?= $data['jadwal']; ?></td>

<td><?= $data['dokter']; ?></td>

<td>

<?php

if($data['status_antrian']=="Menunggu"){

echo "<span class='badge bg-warning text-dark'>Menunggu</span>";

}elseif($data['status_antrian']=="Dipanggil"){

echo "<span class='badge bg-primary'>Dipanggil</span>";

}else{

echo "<span class='badge bg-success'>Selesai</span>";

}

?>

</td>

<td>

<a href="detail.php?id=<?= $data['id']; ?>" class="btn btn-info btn-sm">

<i class="bi bi-eye-fill"></i>

</a>

<a href="edit.php?id=<?= $data['id']; ?>" class="btn btn-warning btn-sm">

<i class="bi bi-pencil-square"></i>

</a>

<a
href="hapus.php?id=<?= $data['id']; ?>"
onclick="return confirm('Yakin ingin menghapus data?')"
class="btn btn-danger btn-sm">

<i class="bi bi-trash-fill"></i>

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</body>
</html>