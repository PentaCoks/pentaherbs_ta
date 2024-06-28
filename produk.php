<?php
require "koneksi.php";
$queryKategori = mysqli_query($db, "SELECT * FROM kategori LIMIT 3");

// get produk by nama produk

if (isset($_GET['keyword'])) {
	$queryProduk = mysqli_query($db, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%' ");

}

// get produk dari kategori
else if (isset($_GET['kategori'])) {
	$queryGetKategoriId = mysqli_query($db, "SELECT id FROM kategori WHERE nama='$_GET[kategori]' ");
	$kategoriId = mysqli_fetch_array($queryGetKategoriId);

	$queryProduk = mysqli_query($db, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]' ");
}

//get produk dari default
else {

	$queryProduk = mysqli_query($db, "SELECT * FROM produk");
}
$countData = mysqli_num_rows($queryProduk);

if (isset($_GET['kategori'])) {
	$kategori = mysqli_real_escape_string($db, $_GET['kategori']); // Escape input for security

	// Query to get the category ID based on the name
	$queryGetKategoriId = mysqli_query($db, "SELECT id FROM kategori WHERE nama='$kategori'");
	$kategoriId = mysqli_fetch_array($queryGetKategoriId);

	// Query to get products filtered by category ID
	$queryProduk = mysqli_query($db, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- title -->
	<title>Shop</title>

	<!-- Logo Pentaherbs -->
	<link rel="shortcut icon" type="image/png" href="assets/img/logo1.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body>

	<!--PreLoader-->
	<div class="loader">
		<div class="loader-inner">
			<div class="circle"></div>
		</div>
	</div>
	<!--PreLoader Ends-->

	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="index.php">
								<img src="assets/img/logo.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li><a href="index.php">Home</a>
								</li>
								<li><a href="about.html">About</a></li>
								<li><a href="contact.html">Contact</a></li>
								<li><a href="news.php">News</a></li>
								<li class="current-list-item"><a href="produk.php">Catalogue</a></li>
								<li>
									<div class="search-container align-items-center d-flex flex-row">
										<input type="text" id="search-box" placeholder="Cari artikel...">
										<i class="fas fa-search px-2"></i>
										<div id="search-results"></div>
									</div>
								</li>
							</ul>
						</nav>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

	<!-- search area -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function () {
			$('#search-box').on('input', function () {
				const query = $(this).val().toLowerCase();
				$('#search-results').empty().hide();

				if (query) {
					$.ajax({
						url: 'search.php', // PHP script to handle search
						method: 'GET',
						data: { keyword: query },
						dataType: 'json',
						success: function (response) {
							if (response.length > 0) {
								response.forEach(result => {
									$('#search-results').append(`<div data-url="${result.url}">${result.title}</div>`);
								});
								$('#search-results').show();
							}
						},
						error: function (xhr, status, error) {
							console.error('AJAX Error:', error);
						}
					});
				}
			});

			$(document).on('click', function (event) {
				if (!$(event.target).closest('.search-container').length) {
					$('#search-results').hide();
				}
			});

			$('#search-results').on('click', 'div', function () {
				const url = $(this).data('url');
				window.location.href = url;
			});
		});


	</script>
	</script>
	<!-- end search arewa -->

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>Segar dan Organik</p>
						<h1>Toko</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- products -->
	<div class="product-section mt-150 mb-150">
		<div class="container">

			<div class="row">
				<div class="col-md-12">
					<div class="product-filters">
						<ul>
							<li data-filter="*"><a class="text-dark" href="produk.php">All</a></li>
							<li class="<?php echo isset($_GET['kategori']) && $_GET['kategori'] == 'Bahan' ? 'active' : ''; ?>"
								data-filter=".Bahan"><a class="text-dark" href="produk.php?kategori=Bahan">Bahan</a>
							</li>
							<li class="<?php echo isset($_GET['kategori']) && $_GET['kategori'] == 'Jadi' ? 'active' : ''; ?>"
								data-filter=".Jadi"><a class="text-dark" href="produk.php?kategori=Jadi">Jadi</a></li>
							<li class="<?php echo isset($_GET['kategori']) && $_GET['kategori'] == 'Kemasan' ? 'active' : ''; ?>"
								data-filter=".Kemasan"><a class="text-dark"
									href="produk.php?kategori=Kemasan">Kemasan</a></li>

						</ul>
					</div>
				</div>
			</div>
			<div class="row product-lists">
				<?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
					<div class="col-lg-4 col-md-6 text-center">
						<div class="single-product">
							<div class="single-product-item">
								<img class="rounded" src="img/<?php echo $produk['foto']; ?>" class="product-image"
									alt="..."><br><br>
								<h3 class="card-title"><?php echo $produk['nama']; ?></h3>
								<p class="product-price"><span>Per Pcs</span>Rp <?php echo $produk['harga']; ?></p>
								<a href="produk-detail.php?nama=<?php echo $produk['nama']; ?>" class="cart-btn"><i
										class="fas fa-info-circle"></i>Lihat Detail</a>
							</div>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>
	</div>
	<!-- end products -->

	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">Tentang kami</h2>
						<p>disini kami menjual bumbu dan rempah pilihan yang telah disortir oleh tenaga profesional,
							oleh karena itu kami selalu menjaga kualitas produk kami agar konsumen dapat menikmati hasil
							yang maksimal.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Kontak Kami</h2>
						<ul>
							<li>Pasar Induk Kramat Jati </li>
							<li>PentaHerbs@gmail.com</li>
							<li>08423452341235</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Halaman</h2>
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="contact.php">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribe</h2>
						<p>Subscribe to our mailing list to get the latest updates.</p>
						<form action="index.php">
							<input type="email" placeholder="Email">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->

	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>Copyrights &copy; 2021 - Penta Herbs</a>, All Rights Reserved.<br>
					</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end copyright -->
	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
		(function () {
			var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
			s1.async = true;
			s1.src = 'https://embed.tawk.to/66754ac6eaf3bd8d4d12ea66/1i0t2o738';
			s1.charset = 'UTF-8';
			s1.setAttribute('crossorigin', '*');
			s0.parentNode.insertBefore(s1, s0);
		})();
	</script>
	<!--End of Tawk.to Script-->
	<script>
		$(document).ready(function () {
			$('.product-filters ul li').on('click', function () {
				// Menghapus kelas active dari semua elemen menu
				$('.product-filters ul li').removeClass('active');

				// Menambahkan kelas active ke elemen yang sedang diklik
				$(this).addClass('active');
			});
		});
	</script>

	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>

</body>

</html>