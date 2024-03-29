<?php

session_start();
include 'koneksi.php';

?>


<?php
	require_once(dirname(__FILE__).'/koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Beranda | Katun Silungkang</title>

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
		<section id="inner-headline">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-home"> Beranda</i></a><i class="icon-angle-right"></i></li>
						<li><a href="produk.php"><i class="fa fa-product">Produk</i></a></li>
						<li><a href="keranjang.php"><i class="fa fa-product"><a href="keranjang.php">Keranjang</i></a><i class="icon-angle-right"></i></li>
						<li><a href="checkout.php"><i class="fa fa-product">keranjang Belanja</i></a></li>
						<li><i class="fa fa-product">Detail Pembelian</i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<section class="konten">
		<div class="container">


			<!-- nota yang berada disini copy saja dari nota yang ada di admin -->
<?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
	ON pembelian.id_pelanggan=pelanggan.id_pelanggan
	WHERE pembelian.id_pembelian= $_GET[id]");
$detail=$ambil->fetch_assoc();
?>

<h2><center>Detail Pembelian <?php echo $detail['nama_pelanggan']; ?></center></h2>
<?php 
//mendapatkan id_pelanggan yang beli
$idpelangganyangbeli = $detail["id_pelanggan"];

//mendapatkan id_pelanggan yang login
$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];	

if ($idpelangganyangbeli!==$idpelangganyanglogin)
 {
	echo "<script>alert('Pembelian Tidak Berhasil');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>

<table>
		<strong>
			<td>Nama</td>   		
			<td>:</td>
			<td></td>
			<td><?php echo $detail['nama_pelanggan']; ?></td> 
		
		<tr>
		<td>Alamat</td> 		   		
		<td>: </td>
		<td></td>
		<td><?php echo $detail['alamat_pengiriman']?> </td>	<br>
	</tr>
	<tr>
		<td>Tanggal Pembelian </td>  
		<td>:</td>
		<td></td> 
		<td><?php echo $detail['tanggal_pembelian']; ?></td><br>
	</tr>
	<tr>
		<td>Biaya Packing</td>		
		<td>: </td>
		<td></td>
		<td>Rp. <?php echo number_format($detail['tarif_packing']); ?></td><br>
	</tr>
	<tr>
		<td>Ongkos Kirim </td>		
		<td>: </td>
		<td></td>
		<td>Rp. <?php echo number_format($detail['tarif']); ?></td><br>
	</tr>
	<tr>
		<td>Total Pembelian </td>  
		 <td> : </td>
		 <td></td>
		 <td> <?php echo number_format($detail['total_pembelian']) ?></td>
		</tr>
		
	</strong>
	</table>
<br><br>


<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga</th>
			<!-- <th>Berat</th> -->
			<th>Jumlah</th>
			<!-- <th>Subberat</th> -->
			
			<th>Total</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1; 
			$idid=0;
		?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga']); ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>
				Rp. <?php echo ($detail['total_pembelian']); ?>
			</td>
			<td><?php 
			$idid=$pecah['id_pembelian'];?>
		<?php $nomor++; ?>
		<?php } ?>
			<a href="hapusnota.php?id=<?php echo $pecah['id_pembelian_produk']; ?>" class="btn btn-danger btn">Hapus</a>
				<a href="pembayaran.php?id=<?php echo $idid ?>" class="btn btn-success">Pembayaran</a>
			</td>
		</tr>
	</tbody>
</table>


<div class="row">
	<div class="col-md-12">
		<div class="alert alert-info">
			<p>
				Silahkan Melakukan Pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> Ke <br>
				<strong>Bank MANDIRI 137-00-876-12345678 An.Katun Silungkang</strong><br>
				<strong>Bank BNI 137-00-876-12345678 An.Katun Silungkang</strong><br>
				<strong>Bank BRI 137-00-876-12345678 An.Katun Silungkang</strong><br>
			</p>
		</div>
	</div>
	
</div>
						
</div>
	</section>
	</div>
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