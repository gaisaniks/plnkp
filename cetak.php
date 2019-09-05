<?php
   include_once "koneksi.php";
  $id=$_GET['id'];
  $a="select * from pemutusan where id_pel='$id' LIMIT 1";
  $qrykoreksi=mysqli_query($koneksi,$a);
  $data=mysqli_fetch_object($qrykoreksi);  
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Cetak Data</title>
  </head>
  
  
  <body>
  <font face="Times New Roman">
  
    <div class="row">
	<img src="images/Logo_PLN.png" width="85px" height="auto">
	<div class="ml-3"><p>PT. PLN(PERSERO) WILAYAH S2JB<br>ULP RIVAI<br>PALEMBANG</p><br>
	</div>
	</div>
	
		<p align="center">LAMPIRAN BERITA ACARA<br>
		===============================================<br>
		PEMUTUSAN RAMPUNG SAMBUNGAN RUMAH (SR) DAN APP</p>
	</font>
	
	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="155px">ID PELANGGAN:</th>
				<td width="300px"><?php echo $data->id_pel ?></td>
				<th rowspan="2" width="155px">ALAMAT:</th>
				<td rowspan="2" width="350px"><?php echo $data->alamat ?></td>
			</tr>
			<tr>
				<th width="155px">NAMA:</th>
				<td width="300px"><?php echo $data->nama ?></td>
			</tr>
			<tr>
				<th width="155px">TARIF:</th>
				<td width="300"><?php echo $data->tarif ?></td>
				<th width="155px">DAYA:</th>
				<td width="300"><?php echo $data->daya ?></td>
			</tr>
		</tbody>
	</table>
	<br>
	
	<table class="table table-bordered">
		<thead>
			<tr>
				<th><center>SKETSA LOKASI</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><center><a href="<?PHP echo $data->sketsa ?>"><img src="<?PHP echo $data->sketsa ?>"  width="50%" /></a><center></td>
			</tr>
		</tbody>
	</table>

	<table class="table table-bordered" >
		<thead>
			<tr>
				<th><center>PHOTO PERSIL</th>
			</tr>
		</thead>
		<tbody>
			<tr>
            <td><center><a href="<?PHP echo $data->persil ?>"><img src="<?PHP echo $data->persil ?>"  width="50%" /></a><center></td>
			</tr>
		</tbody>
	</table>
    </body>
    <script>
		window.print();
	</script>
</html>
