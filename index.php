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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Codemarts.com - Login & Registration System</title>
</head>
<body>
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
