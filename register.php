<?php
session_start();
if (isset($_SESSION['user']) != "") {
    header("Location: home.php");
}
include_once 'koneksi.php';

if (isset($_POST['btn-signup'])) {
    $uname = mysqli_real_escape_string($koneksi, $_POST['uname']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $upass = md5(mysqli_real_escape_string($koneksi, $_POST['pass']));

    if (mysqli_query($koneksi, "INSERT INTO users(username,email,password) VALUES('" . $uname . "','" . $email . "','" . $upass . "')")) {
        $msg = 'Congratulation you have successfully registered.';

    } else {
        $msg = 'Error while registering you...';

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
<center>
  <div id="login-form">
    <form method="post">
      <?php echo @$msg; ?>
      <table align="center" width="30%" border="0">
        <tr>
          <td><input type="text" name="uname" placeholder="User Name" required /></td>
        </tr>
        <tr>
          <td><input type="email" name="email" placeholder="Your Email" required /></td>
        </tr>
        <tr>
          <td><input type="password" name="pass" placeholder="Your Password" required /></td>
        </tr>
        <tr>
          <td><button type="submit" name="btn-signup">Sign Me Up</button></td>
        </tr>
        <tr>
          <td><a href="index.php">Sign In Here</a></td>
        </tr>
      </table>
    </form>
  </div>
</center>
</body>
</html>
