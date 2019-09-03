<?php
include "koneksi.php";
echo "<script>alert('Data Telah Di Hapus');document.location='index.php'</script>";
$a="DELETE from pemutusan WHERE id_pel='$_GET[id]'";
$b=mysqli_query($koneksi,$a);
?>