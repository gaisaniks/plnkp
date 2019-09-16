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
  						<td><select name="tarif" class="form-control" >
							<option value="">Tarif</option>
							<?php $tarif = (isset($_GET['tarif']) ? strtolower($_GET['tarif']) : null);?>
							<option value="R1" <?php if ($tarif == 'R1') {echo 'selected';}?>>R1</option>
							<option value="R2" <?php if ($tarif == 'R2') {echo 'selected';}?>>R2</option>
							<option value="R3" <?php if ($tarif == 'R3') {echo 'selected';}?>>R3</option>
							<option value="B1" <?php if ($tarif == 'B1') {echo 'selected';}?>>B1</option>
							<option value="B2" <?php if ($tarif == 'B2') {echo 'selected';}?>>B2</option>
							<option value="B3" <?php if ($tarif == 'B3') {echo 'selected';}?>>B3</option>
							<option value="S1" <?php if ($tarif == 'S1') {echo 'selected';}?>>S1</option>
							<option value="S2" <?php if ($tarif == 'S2') {echo 'selected';}?>>S2</option>
							<option value="S3" <?php if ($tarif == 'S3') {echo 'selected';}?>>S3</option>
							<option value="P1" <?php if ($tarif == 'P1') {echo 'selected';}?>>P1</option>
							<option value="P2" <?php if ($tarif == 'P2') {echo 'selected';}?>>P2</option>
							<option value="P3" <?php if ($tarif == 'P3') {echo 'selected';}?>>P3</option>
							<option value="I1" <?php if ($tarif == 'I1') {echo 'selected';}?>>I1</option>
							<option value="I2" <?php if ($tarif == 'I2') {echo 'selected';}?>>I2</option>
							<option value="I3" <?php if ($tarif == 'I3') {echo 'selected';}?>>I3</option>
							<option value="LP" <?php if ($tarif == 'LP') {echo 'selected';}?>>LP</option>
							<option value="LS" <?php if ($tarif == 'LS') {echo 'selected';}?>>LS</option>
							<option value="LB" <?php if ($tarif == 'LB') {echo 'selected';}?>>LB</option>
							<option value="LI" <?php if ($tarif == 'LI') {echo 'selected';}?>>LI</option>
						</select></td>
  					</tr>
  					<tr>
  						<td>Daya</td>
  						<td><select name="daya" class="form-control" >
							<option value="">Daya</option>
							<?php $daya = (isset($_GET['daya']) ? strtolower($_GET['daya']) : null);?>
							<option value="450" <?php if ($daya == '450') {echo 'selected';}?>>450</option>
							<option value="900" <?php if ($daya == '900') {echo 'selected';}?>>900</option>
							<option value="1300" <?php if ($daya == '1300') {echo 'selected';}?>>1300</option>
							<option value="2200" <?php if ($daya == '2200') {echo 'selected';}?>>2200</option>
							<option value="3500" <?php if ($daya == '3500') {echo 'selected';}?>>3500</option>
							<option value="3900" <?php if ($daya == '3900') {echo 'selected';}?>>3900</option>
							<option value="4400" <?php if ($daya == '4400') {echo 'selected';}?>>4400</option>
							<option value="5500" <?php if ($daya == '5500') {echo 'selected';}?>>5500</option>
							<option value="6600" <?php if ($daya == '6600') {echo 'selected';}?>>6600</option>
							<option value="7700" <?php if ($daya == '7700') {echo 'selected';}?>>7700</option>
							<option value="10600" <?php if ($daya == '10600') {echo 'selected';}?>>10600</option>
							<option value="11000" <?php if ($daya == '11000') {echo 'selected';}?>>11000</option>
							<option value="13200" <?php if ($daya == '13200') {echo 'selected';}?>>13200</option>
							<option value="16500" <?php if ($daya == '16500') {echo 'selected';}?>>16500</option>
							<option value="23000" <?php if ($daya == '23000') {echo 'selected';}?>>23000</option>
							<option value="33000" <?php if ($daya == '33000') {echo 'selected';}?>>33000</option>
							<option value="41500" <?php if ($daya == '41500') {echo 'selected';}?>>41500</option>
							<option value="53000" <?php if ($daya == '53000') {echo 'selected';}?>>53000</option>
							<option value="66000" <?php if ($daya == '66000') {echo 'selected';}?>>66000</option>
							<option value="82500" <?php if ($daya == '82500') {echo 'selected';}?>>82500</option>
							<option value="105000" <?php if ($daya == '105000') {echo 'selected';}?>>105000</option>
							<option value="131000" <?php if ($daya == '131000') {echo 'selected';}?>>131000</option>
							<option value="147000" <?php if ($daya == '147000') {echo 'selected';}?>>147000</option>
							<option value="164000" <?php if ($daya == '164000') {echo 'selected';}?>>164000</option>
							<option value="197000" <?php if ($daya == '197000') {echo 'selected';}?>>197000</option>
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
