<?php
	if(isset($_POST['simpan'])){
		$sketsaImgFile = $_FILES['sketsa']['name'];
		$sketsaTmp_dir = $_FILES['sketsa']['tmp_name'];
		$sketsaImgSize = $_FILES['sketsa']['size'];

		$persilImgFile = $_FILES['persil']['name'];
		$persilTmp_dir = $_FILES['persil']['tmp_name'];
		$persilImgSize = $_FILES['persil']['size'];
		if (empty($sketsaImgFile)||empty($persilImgFile)){
			$errMSG = "Silahkan pilih gambar.";
		} else {
			$directoryName = 'uploads';
			if(!is_dir($directoryName)){
				mkdir($directoryName, 0755);
			}
			$upload_dir = 'uploads/';
			$sketsaImgExt = strtolower(pathinfo($sketsaImgFile,PATHINFO_EXTENSION));
			$persilImgExt = strtolower(pathinfo($persilImgFile,PATHINFO_EXTENSION));
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
			$id_pel = $_POST['id_pel'];
			$nama = $_POST['nama'];
			$alamat = $_POST['alamat'];
			$tarif = $_POST['tarif'];
			$daya = $_POST['daya'];
			$docfileSketsa = "sketsa_".$id_pel.".".$sketsaImgExt;
			$docfilePersil = "persil_".$id_pel.".".$sketsaImgExt;;
			if(in_array($sketsaImgExt, $valid_extensions)||in_array($persilImgExt, $valid_extensions)){			
				if($sketsaImgSize < 5000000)				{
					move_uploaded_file($sketsaTmp_dir,$upload_dir.$docfileSketsa);
				}
				else{
					$errMSG = "Ukuran file terlalu besar.";
				}
				if($persilImgSize < 5000000)				{
					move_uploaded_file($persilTmp_dir,$upload_dir.$docfilePersil);
				}
				else{
					$errMSG = "Ukuran file terlalu besar.";
				}
			}
			else{
				$errMSG = "Format yang diizinkan adalah JPG, JPEG, PNG & GIF.";		
			}
		}	
		if(!isset($errMSG))
		{
			$sql = "INSERT INTO pemutusan(id_pel,nama,alamat,tarif,daya,sketsa,persil) VALUES('".$id_pel."','".$nama."','".$alamat."','".$tarif."','".$daya."','".$docfileSketsa."','".$docfilePersil."')";
			if(mysqli_query($con, $sql)){
				echo "<script>alert('Data berhasil disimpan');document.location='?p=form'</script>";
			}else{
				echo "<script>alert('Error');document.location='?p=form'</script>";
			}
		}
	}
	if(isset($_GET['ubah'])){
		$sql=mysqli_query($con,"select * from pemutusan where id_pel='".$_GET['ubah']."'");
		$data=mysqli_fetch_array($sql);
	}
	
	if(isset($_POST['ubah'])){
		$sql=mysqli_query($con,"update pemutusan set nama='".$_POST['nama']."',alamat='".$_POST['alamat']."',tarif='".$_POST['tarif']."',daya='".$_POST['daya']."' where id_pel='".$_GET['ubah']."'");
		if($sql){
			if(!empty($_FILES['sketsa']['tmp_name'])){ 
				move_uploaded_file($_FILES['sketsa']['tmp_name'], "sketsa/sketsa_".$id['id_pel'].".jpg");
			}
			if(!empty($_FILES['persil']['tmp_name'])){ 
				move_uploaded_file($_FILES['persil']['tmp_name'], "persil/persil_".$id['id_pel'].".jpg");
			}
			echo"
				<script>alert('data berhasil diubah');document.location='?p=form'</script>
			";
		}
	}
	
	if(isset($_GET['hapus'])){
		$sql=mysqli_query($con,"delete from pemutusan where id_pel='".$_GET['hapus']."'");
		if($sql){
			echo"
				<script>alert('data berhasil dihapus');document.location='?p=form'</script>
			";
		}
	}
?>
  <div class="container">
    <h1>Pemutusan Rampung Sambungan Rumah</h1>
	</div>

<div class="container">
	<form class="form-horizontal" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label class="control-label col-sm-2">ID Pelanggan :</label>
				<input type="number" class="form-control" placeholder="ID Pelanggan" name="id_pel" required="required"
				<?php 
					if(isset($_GET['ubah'])){echo'value="'.$data['id_pel'].'"';}
				?>>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2">Nama :</label>
				<input type="text" class="form-control" placeholder="Nama" required="required"
				<?php if(isset($_GET['ubah'])){echo'value="'.$data['nama'].'"';}?> name="nama">
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2">Alamat :</label>
				<input type="text" class="form-control" placeholder="Alamat" required="required"
				<?php
					if(isset($_GET['ubah'])){echo'value="'.$data['alamat'].'"';}?> name="alamat">
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-2">Tarif :</label>
				<input type="text" class="form-control" placeholder="Tarif" required="required"
				<?php
					if(isset($_GET['ubah'])){echo'value="'.$data['tarif'].'"';}?> name="tarif">
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-2">Daya :</label>
						<select class="form-control" name="daya">
							<option <?php if(isset($_GET['ubah'])){if($data['daya']=="900"){echo "selected=''";}}?>>900</option>
							<option <?php if(isset($_GET['ubah'])){if($data['daya']=="1300"){echo "selected=''";}}?>>1300</option>
							<option <?php if(isset($_GET['ubah'])){if($data['daya']=="2200"){echo "selected=''";}}?>>2200</option>
						</select>
		</div>
				
		<div class="form-group">
			<label>Upload Foto Sketsa Lokasi</label>
			<input class="input-group" type="file" name="sketsa" accept="image/*" class="form-control" required="required" />
		</div>

		<div class="form-group">
			<label>Upload Foto Photo Persil</label>
			<input class="input-group" type="file" name="persil" accept="image/*" class="form-control" required="required" />
		</div>

		<div class="form-group">
			<button type="submit" <?php if(isset($_GET['ubah'])){echo "name=ubah";}else{echo"name=simpan";}?> class="btn btn-success">Submit</button>
			<button type="reset" name="batal" class="btn btn-danger">Reset</button>
		</div>
	</form>
</div>

<div class="container">
<h1>Data Pelanggan</h1>
	<table class="table table-bordered" id="tabel">
		<thead>
			<tr>
				<th>ID Pelanggan</th>
				<th>Nama</th>
				<th>Alamat</th>
				<th>Tarif</th>
				<th>Daya</th>
				<th>Sketsa Lokasi</th>
				<th>Photo Persil</th>
				<th>Opsi</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$i=1;
			$data=mysqli_query($con,"select * from pemutusan");
			while ($res=mysqli_fetch_array($data)){
		?>
		
		
			<tr>
				<td><?php echo $i++;?></td>
				<td><?php echo $res['nama'];?></td>
				<td><?php echo $res['alamat'];?></td>
				<td><?php echo $res['tarif'];?></td>
				<td><?php echo $res['daya'];?></td>
				<td><a href="uploads/sketsa_<?php echo $res['id_pel']?>.jpg" target="_blank">Lihat</a></td>
				<td><a href="uploads/persil_<?php echo $res['id_pel']?>.jpg" target="_blank">Lihat</a></td>
				<td>
					<a href="?p=member&ubah=<?php echo $res['id_pel'];?>">ubah</a> ||
					<a href="?p=member&hapus=<?php echo $res['id_pel'];?>">hapus</a>
				</td>
				
			</tr>
		
		<?php
			}
		?>
		<tbody>
		
	</table>
</div>