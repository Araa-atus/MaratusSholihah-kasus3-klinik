<?php
include "config/koneksi.php";

if (!isset($_GET['id'])) {
    die("ID pasien tidak ditemukan.");
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM pasien WHERE id='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data pasien tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pasien</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="card">

        <div class="card-header bg-primary text-white">
            <h3>Detail Pasien</h3>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 text-center">

                    <?php if($data['foto']!=""){ ?>

                        <img src="upload/<?= $data['foto']; ?>"
                             width="250"
                             class="img-thumbnail">

                    <?php }else{ ?>

                        <img src="https://via.placeholder.com/250x250?text=No+Photo"
                             class="img-thumbnail">

                    <?php } ?>

                </div>

                <div class="col-md-8">

                    <table class="table table-bordered">

                        <tr>
                            <th width="220">No Rekam Medis</th>
                            <td><?= $data['no_rm']; ?></td>
                        </tr>

                        <tr>
                            <th>Nama Pasien</th>
                            <td><?= $data['nama']; ?></td>
                        </tr>

                        <tr>
                            <th>Tanggal Lahir</th>
                            <td><?= $data['tanggal_lahir']; ?></td>
                        </tr>

                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?= $data['jenis_kelamin']; ?></td>
                        </tr>

                        <tr>
                            <th>Alamat</th>
                            <td><?= $data['alamat']; ?></td>
                        </tr>

                        <tr>
                            <th>No Telepon</th>
                            <td><?= $data['telepon']; ?></td>
                        </tr>

                        <tr>
                            <th>Jadwal Konsultasi</th>
                            <td><?= $data['jadwal']; ?></td>
                        </tr>

                        <tr>
                            <th>Dokter Spesialis</th>
                            <td><?= $data['dokter']; ?></td>
                        </tr>

                        <tr>
                            <th>Status Antrian</th>
                            <td><?= $data['status_antrian']; ?></td>
                        </tr>

                        <tr>
                            <th>Riwayat Alergi</th>
                            <td><?= nl2br($data['alergi']); ?></td>
                        </tr>

                        <tr>
                            <th>Catatan Kunjungan Sebelumnya</th>
                            <td><?= nl2br($data['riwayat']); ?></td>
                        </tr>

                        <tr>
                            <th>Informasi Asuransi</th>
                            <td><?= $data['asuransi']; ?></td>
                        </tr>

                    </table>

                    <a href="index.php" class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>