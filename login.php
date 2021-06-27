
<div class="card" style="padding: 50px; width: 40%; margin: 0 auto; margin-top: 10%; box-shadow: 2px 2px 2px 2px grey">
<h4 style="text-align: center;" class="black-text"><font face="Courier New"><b>HAL<img class="circle" height="22" width="22" src="img/speaker.png">PEM</b></font></h4>
	<form method="POST">
		<div class="input_field">
			<input id="username" type="text" placeholder="Username" name="username" required>
		</div>
		<div class="input_field">
			<input id="password" type="password" placeholder="Password" name="password" required>
		</div>
		<input type="submit" name="login" value="Login" class="btn green" style="width: 100%;">
		<div class="section">
		<a href="register.php" type="button" class="btn btn-block btn-info">Register</a>
		</div>
	</form>
</div>
<?php 
	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($koneksi,$_POST['username']);
		$password = mysqli_real_escape_string($koneksi,md5($_POST['password']));
	
		$sql = mysqli_query($koneksi,"SELECT * FROM masyarakat WHERE username='$username' AND password='$password' ");
		$cek = mysqli_num_rows($sql);
		$data = mysqli_fetch_assoc($sql);
	
		$sql2 = mysqli_query($koneksi,"SELECT * FROM petugas WHERE username='$username' AND password='$password' ");
		$cek2 = mysqli_num_rows($sql2);
		$data2 = mysqli_fetch_assoc($sql2);

		if($cek>0){
			session_start();
			$_SESSION['username']=$username;
			$_SESSION['data']=$data;
			$_SESSION['level']='masyarakat';
			header('location:masyarakat/');
		}
		elseif($cek2>0){
			if($data2['level']=="admin"){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				header('location:admin/index.php?p=pengaduan');
			}
			elseif($data2['level']=="petugas"){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				header('location:petugas/index.php?p=pengaduan');
			}
		}
		else{
			echo "<script>alert('Username/Password salah')</script>";
		}

	}
 ?>