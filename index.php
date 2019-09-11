<?php
session_start();
include_once 'koneksi.php';

if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}

if(isset($_POST['btn-login']))
{
	$email = $_POST['email'];
	$upass = $_POST['pass'];
	$res=mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
	$sql = mysqli_query($koneksi, "UPDATE users SET status='1'  WHERE email='$email'");
	$log = mysqli_query($koneksi, "INSERT INTO log SET email='$email'");
	$row=mysqli_fetch_array($res);
	
	if($row['password']==md5($upass))
	{
		$_SESSION['user'] = $row['user_id'];
		header("Location: home.php");
	}
	else
	{
            $err = "<p style='color: red'>Wrong Username or Password</p>";
		?>
<?php
	}
	
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
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<center>
  <div id="login-form">
    <form method="post">
      <table align="center" width="30%" border="0" >
        <tr> <?php echo @$err;?>
          <td><input type="text" name="email" placeholder="Your Email" required /></td>
        </tr>
        <tr>
          <td><input type="password" name="pass" placeholder="Your Password" required /></td>
        </tr>
        <tr>
          <td><button type="submit" name="btn-login">Sign In</button></td>
        </tr>
        <tr>
          <td><a href="register.php">Sign Up Here</a></td>
        </tr>
      </table>
    </form>
  </div>
</center>
</body>
</html>
