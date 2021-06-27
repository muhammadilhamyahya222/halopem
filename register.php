<?php $koneksi=mysqli_connect("localhost","root","","pengaduan_masyarakat"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>HALOPEM</title>
	<link rel="shortcut icon" href="img/speaker.png">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<link href="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">

</head>
<body>
<div class="card" style="padding: 50px; width: 40%; margin: 0 auto; margin-top: 5%; box-shadow: 2px 2px 2px 2px grey">
<h4 style="text-align: center;" class="black-text"><font face="Courier New"><b>HAL<img class="circle" height="22" width="22" src="img/speaker.png">PEM</b></font></h4>
<h6 style="text-align: center;" class="black-text"><font face="Courier New">register</font></h6>
	<form method="POST">
		<div class="input_field">
			<input id="nik" type="number" placeholder="NIK" name="nik" required>
		</div>
		<div class="input_field">
			<input id="nama" type="text" placeholder="Nama" name="nama" required>
		</div>
		<div class="input_field">
			<input id="username" type="text" placeholder="Username" name="username" required>
		</div>
		<div class="input_field">
			<input id="password" type="text" placeholder="Password" name="password" required>
		</div>
		<div class="input_field">
			<input id="telp" type="number" placeholder="Telephone" name="telp" required>
		</div>
		<input type="submit" name="simpan" value="Register" class="btn green" style="width: 100%;">
		<div class="section">
		<a href="index.php" type="button" class="btn btn-block btn-info">Login</a>
		</div>
		<?php 
				if(isset($_POST['simpan'])){
					$password = md5($_POST['password']);

					$query=mysqli_query($koneksi,"INSERT INTO masyarakat VALUES ('".$_POST['nik']."','".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."')");
					if($query){
						echo "<script>alert('Data Tesimpan')</script>";
						echo "<script>location='location:login.php;</script>";
					}
				}
			 ?>
	</form>
</div>
	
</body>
</html>