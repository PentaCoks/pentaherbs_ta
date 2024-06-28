<?php
require "koneksi.php";
    $queryKategori = mysqli_query($db, "SELECT * FROM kategori LIMIT 3");

    // get produk by nama produk

    if(isset($_GET['keyword'])){
        $queryProduk = mysqli_query($db, "SELECT * FROM produk WHERE nama LIKE '%$_GET[keyword]%' ");

    }

    // get produk dari kategori
    else if(isset($_GET['kategori'])){
  $queryGetKategoriId = mysqli_query($db, "SELECT id FROM kategori WHERE nama='$_GET[kategori]' ");
  $kategoriId = mysqli_fetch_array($queryGetKategoriId);

  $queryProduk = mysqli_query($db, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]' ");
    }

    //get produk dari default
    else{

 $queryProduk = mysqli_query($db, "SELECT * FROM produk");
    }
    $countData = mysqli_num_rows($queryProduk);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- title -->
	<title>PentaHerbs</title>

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
								<li class="current-list-item"><a href="index.php">Home</a>
								</li>
								<li><a href="about.html">About</a></li>
								<li><a href="contact.html">Contact</a></li>
								<li><a href="news.php">News</a></li>
								<li><a href="produk.php">Catalogue</a></li>
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
		$(document).ready(function() {
    $('#search-box').on('input', function() {
        const query = $(this).val().toLowerCase();
        const $searchResults = $('#search-results');
        
        $searchResults.empty().hide();

        if (query) {
            $.ajax({
                url: 'search.php', // Adjust URL to your search script
                method: 'GET',
                data: { keyword: query },
                dataType: 'json',
                success: function(response) {
                    if (response.length > 0) {
                        response.forEach(result => {
                            $searchResults.append(`<div data-url="${result.url}">${result.title}</div>`);
                        });
                        $searchResults.show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }
    });

    $(document).on('click touchstart', function(event) {
        if (!$(event.target).closest('.search-container').length) {
            $('#search-results').hide();
        }
    });

    $('#search-results').on('click touchstart', 'div', function() {
        const url = $(this).data('url');
        window.location.href = url;
    });
});



	</script>
	<!-- end search area -->

	<!-- hero area -->
	<div class="hero-area hero-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 offset-lg-2 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Segar & Organik</p>
							<h1>Delicious Seasonal Herbs</h1>
							<div class="hero-btns">
								<a href="produk.php" class="boxed-btn">Katalog Kami</a>
								<a href="contact.html" class="bordered-btn">Hubungi Kami</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end hero area -->

	<!-- features list section -->
	<div class="list-section pt-80 pb-80">
		<div class="container">

			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-shipping-fast"></i>
						</div>
						<div class="content">
							<h3>Bebas Biaya Kirim</h3>
							<p>Jika order di atas Rp 100.000</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-phone-volume"></i>
						</div>
						<div class="content">
							<h3>Dukungan 24/7</h3>
							<p>Dapatkan dukungan sepanjang hari</p>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="list-box d-flex justify-content-start align-items-center">
						<div class="list-icon">
							<i class="fas fa-sync"></i>
						</div>
						<div class="content">
							<h3>Pengembalian Dana</h3>
							<p>Dapatkan pengembalian <br>dana dalam 3 hari!</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end features list section -->

	<!-- product section -->
	<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Produk</span> Kami</h3>
						<p>Merupakan Rempah-rempah pilihan dan terjamin kualitas nya. Yang di tanam oleh petani petani lokal serta diawasi oleh tenaga kerja yang profesional</p>
					</div>
				</div>
			</div>
            <div class="row product-lists">
				<?php while($produk = mysqli_fetch_array($queryProduk)){ ?>  
                    <div class="col-lg-4 col-md-6 text-center">
                         <div class="single-product">
                            <div class="single-product-item">
                              <img src="img/<?php echo $produk['foto'];?>" class="product-image" alt="..."><br><br>
					<h3 class="card-title"><?php echo $produk['nama'];?></h3>
					<p class="product-price"><span>Per Pcs</span>Rp <?php echo $produk['harga'];?></p>
					<a href="produk-detail.php?nama=<?php echo $produk['nama'];?>" class="cart-btn"><i 
					class="fas fa-info-circle"></i>Lihat Detail</a>
					</div>
			</div>
				</div>
				<?php } ?>

			</div>
		</div>
	</div>
	<!-- end product section -->

	<!-- testimonail-section -->
	<div class="testimonail-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="testimonial-sliders">
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/avatar1.jpeg" alt="">
							</div>
							<div class="client-meta">
								<h3>Muhammad Ilham <span>Pembeli</span></h3>
								<p class="testimonial-body">
									" harga yang di tawarkan sangat menarik serta bumbu nya masih fresh dan membuat masakan menjadi wangi "
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/avatar2.jpg" alt="">
							</div>
							<div class="client-meta">
								<h3>Raihan Sabda Alam <span>Pedagang Makanan</span></h3>
								<p class="testimonial-body">
									" sangat cocok untuk masakan padang yang menggunakan begitu banyak bumbu sehingga menciptakan rasa yang luar bisa mantap   "
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/avatar3.jpeg" alt="">
							</div>
							<div class="client-meta">
								<h3>Daffa Dillah <span>Pemilik Restoran </span></h3>
								<p class="testimonial-body">
									"Harga bumbu nya sangat terjangkau dan Rempah rempah nya wangi sekali    "
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end testimonail-section -->
	
	<!-- advertisement section -->
	<div class="abt-section mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-12">
					<div class="logo.png-bg">
						<a href="about.html"><img src="assets/img/Logo1.png" alt=""></a>
					</div>
				</div>
				<div class="col-lg-6 col-md-12">
					<div class="abt-text">
						<p class="top-sub">Since 2019</p>
						<h2>Kami Adalah <span class="orange-text">Penta Herbs</span></h2>
						<p>kami menjual bumbu dan rempah pilihan yang telah disortir oleh tenaga profesional, oleh karena itu kami selalu menjaga kualitas produk kami agar konsumen dapat menikmati hasil yang maksimal.</p>
						<a href="about.html" class="boxed-btn mt-4">Informasi Lebih Lanjut</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end advertisement section -->
	
	<!-- shop banner -->
	<section class="shop-banner">
    	<div class="container">
        	<h3>Diskon juli sedang berlangsung !! <br> dengan diskon <span class="orange-text">Besar...</span></h3>
            <div class="sale-percent"><span>Promo sampai<br>Dengan</span>50% </div>
            <a href="produk.php" class="cart-btn btn-lg">Belanja Sekarang</a>
        </div>
    </section>
	<!-- end shop banner -->

	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">Tentang kami</h2>
						<p>disini kami menjual bumbu dan rempah pilihan yang telah disortir oleh tenaga profesional, oleh karena itu kami selalu menjaga kualitas produk kami agar konsumen dapat menikmati hasil yang maksimal.</p>
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
					<p>Copyrights &copy; 2021 - Penta Herbs</a>,  All Rights Reserved.<br>
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
	<!-- live chat -->
<!--Start of Tawk.to Script-->
<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/66754ac6eaf3bd8d4d12ea66/1i0t2o738';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
	</script>
	<!--End of Tawk.to Script-->
	
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
