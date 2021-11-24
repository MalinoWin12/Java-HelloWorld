<?php
session_start();
    //koneksi ke database 
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> Login Pelanggan</title>

		<link rel="icon" type="image/png" href="img/.png">
		<link rel="stylesheet" href="css/febi.css">

		<!-- Bootstrap-->
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/font-awesome.css">
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<link rel="stylesheet" href="css/jquery.bxslider.css">
	</head>
<body>

<br><br><br><br><br>
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
						  <span class="fa fa-envelope fa-fw"></span>
						 </span>
						 <input type="email"  name="email" class="form-control" placeholder="Email" required></input>
					  </div>
					  <br>
					 	<div class="input-group">
					 		<span class="input-group-addon">
						  <span class="fa fa-key fa-fw"></span>
						</span>
						<input type="password" name="password" class="form-control" placeholder="Password" required></input>
					  </div>
						<br>
						<button class="btn btn-primary" name="login">Masuk</button>
						</br>
						<br>
						<a href ="daftar.php">Belum Memiliki Akun? <b>Daftar disini</b></a>
						<br>
					</form>	
				</div>
			</div>
	
	</div>
</div>
</center>

<?php 
// jika tombol login ditekan
if (isset($_POST["login"]))
{

	//Genrating random number for salt
if(@$_SESSION['randnmbr']==""){
   
        $Alpha22=range("A","Z");
        $Alpha12=range("A","Z"); 
        $alpha22=range("a","z");
        $alpha12=range("a","z");
        $num22=range(1000,9999);
        $num12=range(1000,9999);
        $numU22=range(99999,10000);
        $numU12=range(99999,10000);
        $AlphaB22=array_rand($Alpha22);
        $AlphaB12=array_rand($Alpha12);
        $alphaS22=array_rand($alpha22);
        $alphaS12=array_rand($alpha12);
        $Num22=array_rand($num22);
        $NumU22=array_rand($numU22);
        $Num12=array_rand($num12);
        $NumU12=array_rand($numU12);
        $res22=$Alpha22[$AlphaB22].$num22[$Num22].$Alpha12[$AlphaB12].$numU22[$NumU22].$alpha22[$alphaS22].$num12[$Num12];
        $text22=str_shuffle($res22);
         $_SESSION['randnum']= $text22;
}




	$email = $_POST["email"];
	$password = $_POST['password'];
	// $password = hash('sha256',$_POST['password']);
	//lakukan query untuk ngecek pelanggan dari db

	$saltedpassword = hash('sha256',$password.$_SESSION['randnum']);

	echo $saltedpassword;

	$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password' ");

	//menghitung akun yang terambil
	$akunyangcocok = $ambil->num_rows;

	// jika 1 akun yang cocok maka dapat login
	if ($akunyangcocok==1)
	{
		//anda sudah login
		//mendapatkan akun dalam bentuk array
		$akun = $ambil->fetch_assoc();
		//simpan di session pelanggan
		$_SESSION["pelanggan"] = $akun;
		// echo "<script>alert('anda sukses Login');</script>";
		echo "<script>location='index.php';</script>";	

		//jika sudah belanja
		if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
		{
			echo "<script>location='checkout.php';</script>";		
		}
		else
		{
			echo "<script>location='riwayat.php';</script>";	
		}
		

	}
	
	else
	{
		//anda gagal login
		echo "<script>alert('anda gagal login, periksa akun anda');</script>";
		echo "<script>location='login.php';</script>";
	}
}	
?>
<br><br><br><br><br><br><br>
		<?php
			require_once(dirname(__FILE__).'/commons/footer.php');
		?>

</body>
</html>