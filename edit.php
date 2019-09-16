<?php
   include_once "koneksi.php";
  $id=$_GET['id'];
  $a="select * from pemutusan where id_pel='$id' LIMIT 1";
  $qrykoreksi=mysqli_query($koneksi,$a);
  $data=mysqli_fetch_object($qrykoreksi);
    
?>
<?PHP
if(isset($_POST['tblIsi'])){

$id_new = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$tarif = $_POST['tarif'];
$daya = $_POST['daya'];

$namafolder="photo/"; //tempat menyimpan file
if (!is_dir($namafolder)) {
  mkdir($namafolder, 0755);
}
    //proses upload photo jika ada
    if (!empty($_FILES["sketsa"]["tmp_name"]))
    {
        
        $ext = strtolower(pathinfo($_FILES['sketsa']['name'], PATHINFO_EXTENSION));
        $jenis_gambar=$_FILES['sketsa']['type'];
        if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")
        {          
            $sketsa = $namafolder."sketsa_".$id_new.".".$ext;
            if (!move_uploaded_file($_FILES['sketsa']['tmp_name'], $sketsa))
            {
               die("Gambar gagal dikirim");
            }
            //Hapus photo yang lama jika ada
                   
            $res = "select sketsa from pemutusan where id_pel='$id' LIMIT 1";
            
            @$d=mysqli_fetch_object($koneksi,$res);
            if (strlen(@$d->sketsa)>3)
            {
                if (file_exists($d->sketsa)) unlink($d->sketsa);
            }                   
            //update photo dengan yang baru
            

            
            
           $a= "UPDATE pemutusan SET sketsa='$sketsa' WHERE id_pel='$id' LIMIT 1";
           $b=mysqli_query($koneksi,$a);
        }
        else { die("Jenis gambar yang anda kirim salah. Harus .jpg .gif .png"); }
    } else {
      $res = "select sketsa from pemutusan where id_pel='$id' LIMIT 1";
      @$d=mysqli_query($koneksi,$res);
      $data = mysqli_fetch_array($d);
      $namaFile = $data['sketsa'];
      $getExt = explode(".",$namaFile);
      $newSketsa = $namafolder."sketsa_".$id_new.".".$getExt[1];
      rename($namaFile,$newSketsa);
      $a= "UPDATE pemutusan SET sketsa='$newSketsa' WHERE id_pel='$id' LIMIT 1";
      $b=mysqli_query($koneksi,$a) or die(mysqli_error());;
    }//end if cek file upload

    //proses upload photo rumah jika ada
    if (!empty($_FILES["persil"]["tmp_name"]))
    {
        $ext = strtolower(pathinfo($_FILES['persil']['name'], PATHINFO_EXTENSION));
        $jenis_gambar=$_FILES['persil']['type'];
        if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/png")
        {          
            $persil = $namafolder."persil_".$id_new.".".$ext;
            if (!move_uploaded_file($_FILES['persil']['tmp_name'], $persil))
            {
               die("Gambar gagal dikirim");
            }
            //Hapus photo yang lama jika ada
                   
            $res = "select persil from pemutusan where id_pel='$id' LIMIT 1";
            
            @$d=mysqli_fetch_object($koneksi,$res);
            if (strlen(@$d->persil)>3)
            {
                if (file_exists($d->persil)) unlink($d->persil);
            }                   
            //update photo dengan yang baru
            

            
            
           $a= "UPDATE pemutusan SET persil='$persil' WHERE id_pel='$id' LIMIT 1";
           $b=mysqli_query($koneksi,$a);
        }
        else { die("Jenis gambar yang anda kirim salah. Harus .jpg .gif .png"); }
    } else {
      $res = "select persil from pemutusan where id_pel='$id' LIMIT 1";
      @$d=mysqli_query($koneksi,$res);
      $data = mysqli_fetch_array($d);
      $namaFile = $data['persil'];
      $getExt = explode(".",$namaFile);
      $newPersil = $namafolder."persil_".$id_new.".".$getExt[1];
      rename($namaFile,$newPersil);
      $a= "UPDATE pemutusan SET persil='$newPersil' WHERE id_pel='$id' LIMIT 1";
      $b=mysqli_query($koneksi,$a) or die(mysqli_error());;
    } //end if cek file upload
    $myqry="UPDATE pemutusan SET id_pel='$id_new',nama='$nama',alamat='$alamat',".
            "tarif='$tarif',daya='$daya' WHERE id_pel='$id' LIMIT 1";
        
    $b1=mysqli_query($koneksi,$myqry) or die(mysqli_error());
    echo "<script>alert('Data Telah Di Edit');document.location='index.php'</script>";
    exit;

}     
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<title>Data Pelanggan</title>
</head>

<body>
<form action=" " method="post" enctype="multipart/form-data" name="FKoreksi">
  <table width="950" height="281" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF">
    
    <tr>
      <td width="452"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF">
          
          <tr>
            <td bordercolor="#999999">ID</td>
            <td bordercolor="#999999"><input name="id" type="text" id="id" size="8" value="<?php echo $data->id_pel?>" /></td>
            <td width="163" rowspan="8" align="center" valign="top"><a href="<?PHP echo $data->sketsa ?>"><img src="<?php echo  $data->sketsa?>" alt="<?php echo  $data->nama?>" width="100" border="1"/></a></td>
            <td width="163" rowspan="8" align="center" valign="top"><a href="<?PHP echo $data->persil ?>"><img src="<?php echo  $data->persil?>" alt="<?php echo  $data->nama?>" width="100" border="1"/></a></td>
          </tr>
          <tr>
            <td bordercolor="#999999" >Nama</td>
            <td bordercolor="#999999" ><input name="nama" type="text" value="<?php echo $data->nama?>" size="20" /></td>
          </tr>
          <tr>
            <td bordercolor="#999999" >Alamat</td>
            <td bordercolor="#999999" ><input type="text" name="alamat" value="<?php echo $data->alamat?>" size="30" /></td>
          </tr>
          <tr>
            <td bordercolor="#999999" >Tarif</td>
            <td bordercolor="#999999" ><select name="tarif" class="form-control">
				<option value="<?php echo $data->tarif?>"><?php echo $data->tarif?></option>
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
            <td bordercolor="#999999" >Daya</td>
            <td  bordercolor="#999999"><select name="daya" class="form-control">
				<option value="<?php echo $data->daya?>"><?php echo $data->daya?></option>
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
			</select>
			</td>
          </tr>
          <tr>
            <td bordercolor="#999999" >Sketsa</td>
            <td bordercolor="#999999" ><input type="file" name="sketsa" id="sketsa" /></td>
          </tr>
          <tr>
            <td bordercolor="#999999" >Persil</td>
            <td bordercolor="#999999" ><input type="file" name="persil" id="persil" /></td>
          </tr>
          <tr>
            <td bordercolor="#999999" ><input name="tblIsi" type="submit" id="tblIsi" value="Simpan" /></td>
            <td bordercolor="#999999" ><input type="reset" name="reset" value="Reset" /></td>
	    <td bordercolor="#999999" ><input type="button" value="Go Back" onclick="history.back(-1)" /></td>
          </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
