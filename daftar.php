<?php
	require_once(dirname(__FILE__).'/koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Daftar | Katun Silungkang</title>

		<link rel="icon" type="image/png" href="img/.png">
		<link rel="stylesheet" href="css/febi.css">

		<!-- Bootstrap-->
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/font-awesome.css">
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/jquery.bxslider.css">
	</head>
	<body>
		<!-- Header-->
		<br><br><br><br>
		<center>
			<div class="container">
		<div class="row">
	   
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1">
			<div class="form">
				<div class="panel-heading">
				</div>
				<div class="panel-body">
					<form method="post">
						<a href = "index.php"><img src ="img/c.png" width ="150px" height ="150px"></a>
						 <div class="input-group">
						 <span class="input-group-addon">
						  <span class="fa fa-user fa-fw"></span>
						 </span>
						 <input type="text"  name="nama" class="form-control" placeholder="Nama" required></input>
					  </div>
					  <br>
						<div class="input-group">
					 		<span class="input-group-addon">
						  <span class="fa fa-envelope fa-fw"></span>
						</span>
						<input type="email" name="email" class="form-control" placeholder="Email" required></input>
					  </div>
						<br>
						<div class="input-group">
					 		<span class="input-group-addon">
						  <span class="fa fa-key fa-fw"></span>
						</span>
						<input type="password" name="password" class="form-control" placeholder="Password" required></input>
					  </div>
						<br>
						<div class="input-group">
					 		<span class="input-group-addon">
						  <span class="fa fa-home fa-fw"></span>
						</span>
						<input type="text" name="Alamat" class="form-control" placeholder="Alamat" required></input>
					  </div>
						<br>
						<div class="input-group">
					 		<span class="input-group-addon">
						  <span class="fa fa-phone fa-fw"></span>
						</span>
						<input type="text" name="No Telepon" class="form-control" placeholder="No Telepon" required></input>
					  </div>
						<br>
						<button class="btn btn-primary" name="daftar">Daftar</button></center>
						</br>
					</form>	
				</div>
			</div>
	
	</div>
</div>
</center>
<br><br>

<?php
							//jika ada tombol daftar(tombol daftar ditekan)
							if (isset($_POST["daftar"]))
							 {
								//mengambil nama email,password, alamat, telp/Hp
								$nama = $_POST["nama"];
								$email = $_POST["email"];
								$password = $_POST["password"];
								$alamat = $_POST["alamat_pelanggan"];
								$telepon = $_POST["telepon_pelanggan"];	
								$hasedpassword=hash('sha256',$password);
								


								//cek apakan email sudah digunakan
								$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email' ");
								$yangcocok = $ambil->num_rows;
								if ($yangcocok==1) 
								{
									echo "<script>alert('Pendaftaran Gagal, Karena email sudah digunakan');</script>";
									echo "<script>location='daftar.php';</script>";
								}
								else
								{
									//kita melakukan Query insert ke pelanggan
									$koneksi->query("INSERT INTO pelanggan(email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES ('$email', '$hasedpassword', '$nama', '$telepon', '$alamat')");

									// echo "<script>alert('Pendaftaran anda sukses, Silahkan Login');</script>";
									echo "<script>location='login.php';</script>";
								}
							}
						?>

<br><br>

		<?php
			require_once(dirname(__FILE__).'/commons/footer.php');
		?>
			<!-- Scroll Up Button -->
		<a href="#" class="scrollup"><i class="fa fa-angle-up fa-2x active"></i></a>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery-3.1.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.singlePageNav.js"></script>
		<script src="js/jquery.flexslider.js"></script>
		<script src="js/jquery.appear.js"></script>
		<script src="js/custom.js"></script>
		<script src="js/wow.min.js"></script>
		<script>wow = new WOW({}).init();</script>
		<script>
			$('.carousel').carousel({			//Waktu Carousel
				interval: 3000
			})
		</script>
	
</body>
</html>