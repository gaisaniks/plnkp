<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
		<title>Login</title>

</head>

<body style="background-color : #89cff0">
	<div class="container">
	<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-6">
<br>
<br>
<br>
	<p align="center"><img src="images/icon.png" width="20%" height="auto"></p>

	<center>

	<h2 style="color: blue">Login Form</h2>
	
	<form class="form-horizontal" method="post">

		<div class="form-group">
			<label class="control-label">Username:</label>
			<input type="text" class="form-control" placeholder="username" name="username" required>
		</div>

		<div class="form-group">
			<label class="control-label">Password:</label>
			<input type="password" class="form-control" placeholder="password" name="password" required>
		</div>

		<div class="form-group">
			<input type="submit" class="btn btn-success" name="login" value="login">
			<input type="reset" class="btn btn-danger" name="cancel" value="cancel">
		</div>
	
	</form>
	<a href="?p=daftar">Lakukan pendaftaran jika belum mempunyai akun</a>
	</div>
	<div class="col-md-3"></div>
	</div>
	</div>
</body>