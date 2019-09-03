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
    <p>PT. PLN(PERSERO) WILAYAH S2JB<br>RAYON RIVAI<br>PALEMBANG </p><br>
		<p align="center">LAMPIRAN BERITA ACARA<br>
		===============================================<br>
		PEMUTUSAN RAMPUNG SAMBUNGAN RUMAH (SR) DAN APP</p>
	</font>
	
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID PELANGGAN:</th>
				<td><?php echo $data->id_pel ?></td>
				<th></th>
				<td></td>
			</tr>
			<tr>
				<th>NAMA:</th>
				<td><?php echo $data->nama ?></td>
				<th>ALAMAT:</th>
				<td><?php echo $data->alamat ?></td>
			</tr>
			<tr>
				<th>TARIF:</th>
				<td><?php echo $data->tarif ?></td>
				<th>DAYA:</th>
				<td><?php echo $data->daya ?></td>
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