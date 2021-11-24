<?php
session_start();
 //koneksi ke database 
 include 'koneksi.php';

 ?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>produk | Katun Silungkang</title>

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
		<?php
			require_once(dirname(__FILE__).'/commons/header.php');
		?>

		<!---Menubar-->
		<?php
			require_once(dirname(__FILE__).'/commons/menubar.php');
		?>

<!-- konten -->
<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<ul class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-home"> Beranda</i></a><i class="icon-angle-right"></i></li>
						<li><i class="fa fa-product">Produk
					</i></a></li></ul>
				</div>
			</div>
		</div>
	</section>

	<section class="product">
	<div class="container">
			<div class="row"><div class="col-md-12">
		<center><h1>Produk Tenun Silungkang</h1>
			<?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
			<?php while($perproduk = $ambil->fetch_assoc()) { ?>
			
			<div class="col-md-4">
				<br>
				<div class="card">
					<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" /><img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="">
					<div class="caption">
						<h3><?php echo $perproduk['nama_produk']; ?></h3>
						<h4>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h4>
						  <h4>Stok : <?php echo $perproduk["stok_produk"]; ?></h4>
						<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>"class="btn btn-primary btn-lg">Beli</a>
						<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-success btn-lg">Detail</a>
						<br><br>
					</div>
				</div>
			</div>
			<?php } ?>

		</div>
		</center>
	</div>

</div>
</section>

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

