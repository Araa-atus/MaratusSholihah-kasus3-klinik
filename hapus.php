<?php

include "config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM pasien WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if($row['foto'] != "" && file_exists("upload/".$row['foto'])){
    unlink("upload/".$row['foto']);
}

mysqli_query($conn,"DELETE FROM pasien WHERE id='$id'");

echo "<script>
alert('Data berhasil dihapus');
window.location='index.php';
</script>";

?>