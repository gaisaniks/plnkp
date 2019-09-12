<?php
session_start();
include_once 'koneksi.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}
$res = mysqli_query($koneksi, "SELECT * FROM users WHERE user_id=" . $_SESSION['user']);
$userRow = mysqli_fetch_assoc($res);
?>
<?php
//include file koneksi ke mysql

if (isset($_POST['tblIsi'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tarif = $_POST['tarif'];
    $daya = $_POST['daya'];
    if (empty($nama)) {
        die("<script>alert('Isikan Nama');document.location='home.php'</script>");
    } else {
        $query = mysqli_query($koneksi, "SELECT * FROM pemutusan WHERE nama='" . $nama . "'");

        if (!$query) {
            die('Error: ' . mysqli_error($koneksi));
        }

        if (mysqli_num_rows($query) > 0) {

            die("<script>alert('Nama Sudah ada');document.location='home.php'</script>");

        } else {

        }
    }

    if (!empty($_FILES["sketsa"]["tmp_name"])) {
        $namafolder = "photo/"; //tempat menyimpan file
        if (!is_dir($namafolder)) {
            mkdir($namafolder, 0755);
        }
        $jenis_gambar = $_FILES['sketsa']['type'];
        $ext = strtolower(pathinfo($_FILES['sketsa']['name'], PATHINFO_EXTENSION));
        if ($jenis_gambar == "image/jpeg" || $jenis_gambar == "image/jpg" || $jenis_gambar == "image/gif" || $jenis_gambar == "image/png") {
            $sketsa = $namafolder . "sketsa_" . $id . "." . $ext;
            if (!move_uploaded_file($_FILES['sketsa']['tmp_name'], $sketsa)) {die("Gambar gagal dikirim");}
        } else {die("Jenis gambar yang anda kirim salah. Harus .jpg .gif .png");}
    }

    if (!empty($_FILES["persil"]["tmp_name"])) {
        $namafolder = "photo/"; //tempat menyimpan file
        $ext = strtolower(pathinfo($_FILES['persil']['name'], PATHINFO_EXTENSION));
        $jenis_gambar = $_FILES['persil']['type'];
        if ($jenis_gambar == "image/jpeg" || $jenis_gambar == "image/jpg" || $jenis_gambar == "image/gif" || $jenis_gambar == "image/png") {
            $persil = $namafolder . "persil_" . $id . "." . $ext;
            if (!move_uploaded_file($_FILES['persil']['tmp_name'], $persil)) {die("Gambar gagal dikirim");}
        } else {die("Jenis gambar yang anda kirim salah. Harus .jpg .gif .png");}
    }

    @$a = "insert into pemutusan values  ('$id','$nama','$alamat','$tarif','$daya','$sketsa','$persil')";
    $b = mysqli_query($koneksi, $a);
    echo "<script>alert('Data Disimpan');document.location='index.php'</script>";
}
if (isset($_POST['upload'])) {
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    if (isset($_FILES['fileData']['name']) && in_array($_FILES['fileData']['type'], $file_mimes)) {

        $arr_file = explode('.', $_FILES['fileData']['name']);
        $extension = end($arr_file);

        if ('csv' == $extension) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $reader->load($_FILES['fileData']['tmp_name']);

        $sheetData = $spreadsheet->getActiveSheet()->toArray();
		foreach($sheetData as $val){
				$idPel = $val[0];
				$nama = $val[1];
				$alamat = $val[2];
				$tarif = $val[3];
				$daya = $val[4];
				$sketsa = $val[5];
				$persil = $val[6];
				if ($idPel != "" && $nama != "" && $alamat != "" && $tarif != "" && $daya != "" && $sketsa != "" && $persil != "") {
					mysqli_query($koneksi, "INSERT into pemutusan values('$idPel','$nama','$alamat','$tarif','$daya','$sketsa','$persil')");
				}
		}
	}
	unlink($_FILES['fileData']['name']);
	header("Location: home.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet'  href='style.css' type='text/css' media='all' />
	<title>Daftar Pelanggan</title>
</head>
<body>
	Selamat Datang <?php echo $userRow['username']; ?>&nbsp;<a href="logout.php?logout">Sign Out</a>
				<!-- Trigger/Open The Modal -->
				<button id="myBtn">Tambah Data</button>
				<form action="" method="post" enctype="multipart/form-data">
				Pilih File:
				<input name="fileData" id="fileData" type="file" required="required">
				<input name="upload" id="upload" type="submit" value="Import">
				</form>
				<table width="100%" border="1" align="center" id="myTable">
					<caption align="top">&nbsp;
					</caption>
					<tr class="header">
						<th width="73" scope="col">Id</th>
						<th width="217" scope="col">Nama </th>
						<th width="179" scope="col">Alamat</th>
						<th width="80" scope="col">Tarif</th>
						<th width="80" scope="col">Daya</th>
						<th width="80" scope="col">Sketsa</th>
						<th width="80" scope="col">Persil</th>
						<th width="80" scope="col">Opsi</th>
					</tr>
					<?php
$a = "SELECT * FROM  pemutusan";
$b = mysqli_query($koneksi, $a);
while ($data = mysqli_fetch_array($b)) {
    ?>
						<tr>
							<td><div align="center"> <?PHP echo $data['id_pel']; ?></div></td>
							<td><div align="center"><?PHP echo $data['nama'] ?></div></td>
							<td><div align="center"><?PHP echo $data['alamat'] ?></div></td>
							<td><div align="center"><?PHP echo $data['tarif'] ?></div></td>
							<td><div align="center"><?PHP echo $data['daya'] ?></div></td>
							<td><a href="<?PHP echo $data['sketsa'] ?>"><img src="<?PHP echo $data['sketsa'] ?>"  width="50" /></a></td>
							<td><a href="<?PHP echo $data['persil'] ?>"><img src="<?PHP echo $data['persil'] ?>"  width="50" /></a></td>
							<td><a href="edit.php?id=<?php echo $data['id_pel'] ?>">Edit</a> <a href="hapus.php?id=<?php echo $data['id_pel'] ?>">Hapus </a><a href="cetak.php?id=<?php echo $data['id_pel'] ?>">Cetak</a></td>
						</tr>
						<?PHP
}
?>
				</table>
				<hr>

  <!-- The Modal -->
  <div id="myModal" class="modal">
  	<form action="" method="post" enctype="multipart/form-data">
  		<!-- Modal content -->
  		<div class="modal-content">
  			<div class="modal-header"> <span class="close">&times;</span>
  				<h2>Pemutusan</h2>
  			</div>
  			<div class="modal-body">
  				<table align="center" frame="box">
  					<tr>
  						<td width="59">ID</td>
  						<td width="885"><input type="text" name="id" size="8" /></td>
  					</tr>
  					<tr>
  						<td>Nama</td>
  						<td><input type="text" name="nama" size="20" /></td>
  					</tr>
  					<tr>
  						<td>Alamat </td>
  						<td><input type="text" name="alamat" size="30" /></td>
  					</tr>
  					<tr>
  						<td>Tarif</td>
  						<td><input type="text" name="tarif" size="10" /></td>
  					</tr>
  					<tr>
  						<td>Daya</td>
  						<td><select name="daya" class="form-control" >
				<option value="">Daya</option>
				<?php $daya = (isset($_GET['daya']) ? strtolower($_GET['daya']) : null);?>
				<option value="900" <?php if ($daya == '900') {echo 'selected';}?>>900</option>
				<option value="1300" <?php if ($daya == '1300') {echo 'selected';}?>>1300</option>
				<option value="2200" <?php if ($daya == '2200') {echo 'selected';}?>>2200</option>
			</select></td>
  					</tr>
  					<tr>
  						<td>Sketsa</td>
  						<td><label>
  							<input name="sketsa" type="file" id="sketsa" />
  						</label></td>
					  </tr>
					  <tr>
  						<td>Persil</td>
  						<td><label>
  							<input name="persil" type="file" id="persil" />
  						</label></td>
  					</tr>
  				</table>

  			</div>
  			<div class="modal-footer">
  				<input name="tblIsi" type="submit" id="tblIsi" value="Simpan">
  				<input type="reset" name="reset" value="Reset">
  			</div>
  		</div>
  	</form>
  </div>


  <script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
	modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}
</script>
</body>
</html>
