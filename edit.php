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
            

            
            
           $a= "UPDATE pemutusan SET sketsa='$photo' WHERE id_pel='$id' LIMIT 1";
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
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
            <td bordercolor="#999999" ><input name="tarif" type="text" value="<?php echo $data->tarif?>" size="10" /></td>
          </tr>
          <tr>
            <td bordercolor="#999999" >Daya</td>
            <td  bordercolor="#999999"><select name="daya" class="form-control">
				<option value="<?php echo $data->daya?>"><?php echo $data->daya?></option>
				<?php $daya = (isset($_GET['daya']) ? strtolower($_GET['daya']) : null);?>
				<option value="900" <?php if ($daya == '900') {echo 'selected';}?>>900</option>
				<option value="1300" <?php if ($daya == '1300') {echo 'selected';}?>>1300</option>
				<option value="2200" <?php if ($daya == '2200') {echo 'selected';}?>>2200</option>
			</select></td>
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
          </tr>
      </table></td>
    </tr>
  </table>
</form>
</body>
</html>
