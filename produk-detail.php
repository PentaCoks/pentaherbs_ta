<?php
require "koneksi.php";

$nama = htmlspecialchars($_GET['nama']);
$queryproduk = mysqli_query($db, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryproduk);


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- title -->
	<title>Single Product</title>

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
								<li><a href="index.php">Home</a></li>
								<li><a href="about.html">About</a></li>
								<li><a href="contact.html">Contact</a></li>
								<li><a href="news.php">News</a></li>
								<li class="current-list-item"><a href="produk.php">Catalogue</a>
								</li>
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
        $('#search-results').empty().hide();

        if (query) {
            $.ajax({
                url: 'search.php', // PHP script to handle search
                method: 'GET',
                data: { keyword: query },
                dataType: 'json',
                success: function(response) {
                    if (response.length > 0) {
                        response.forEach(result => {
                            $('#search-results').append(`<div data-url="${result.url}">${result.title}</div>`);
                        });
                        $('#search-results').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }
    });

    $(document).on('click', function(event) {
        if (!$(event.target).closest('.search-container').length) {
            $('#search-results').hide();
        }
    });

    $('#search-results').on('click', 'div', function() {
        const url = $(this).data('url');
        window.location.href = url;
    });
});


	</script>
	<!-- end search arewa -->
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>See more Details</p>
						<h1>Single Product</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->
	<div class="container-fluid py-5 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mb-3">

                <img src="img/<?php echo $produk['foto'];?>" class="w-200" alt="">
				
            </div>
            <div class="col-lg-6 offset-lg-1 p-5 rounded justify-content-center shadow">
              <div class="col">
                 <div class="p-2 border bg-light mb-3 rounded text-center">
                <p class="fw-bold"><h2><?php echo $produk['nama'];?></h2></p>
                </div>
                </div>
                <p class="fs-5">
                   <?php echo $produk['detail'];?>
                </p>
                <h5><?php echo $produk['ukuran'];?></h5></p>
                <p class="text-harga ">
                    <h3>Rp <?php echo $produk['harga'];?></h3>
                </p><br>
                 <a href="<?php echo $produk['link_marketplace'];?>" 
				  class="cart-btn" class="fas fa-shopping-cart" >Beli Sekarang</a>
				<a href="https://wa.me/6285886074151?text=Halo,%20saya%20ingin%20menanyakan%20tentang%20bumbu" class="cart-btn"><i class="fab fa-whatsapp"></i> Whatsapp</a>
            </div>
        </div>
    </div>
</div>


	<!-- more products -->
	<div class="more-products mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Related</span> Products</h3>
						<p>Merupakan Rempah-rempah pilihan dan terjamin kualitas nya. Yang di tanam oleh petani petani lokal serta diawasi oleh tenaga kerja yang profesional</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.html"><img src="assets/img/products/product-img-1.jpg" alt=""></a>
						</div>
						<h3>Adas</h3>
						<p class="product-price"><span>Per 100 gram</span> Rp.10.000 </p>
						<a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> View Detail</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.html"><img src="assets/img/products/product-img-2.jpg" alt=""></a>
						</div>
						<h3>Cengkeh</h3>
						<p class="product-price"><span>Per 100 gram</span> Rp.15.000 </p>
						<a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i>View Detail</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 offset-lg-0 offset-md-3 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.html"><img src="assets/img/products/product-img-3.jpg" alt=""></a>
						</div>
						<h3>Kapol</h3>
						<p class="product-price"><span>Per 100 gram</span> Rp.20.000</p>
						<a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i>View Detail</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end more products -->


	<!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">About us</h2>
						<p>So here we sell selected herbs and spices that have been sorted by professionals, therefore we always maintain the quality of our products so that consumers can enjoy maximum results.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Get in Touch</h2>
						<ul>
							<li>Pasar Induk Kramat Jati </li>
							<li>PentaHerbs@gmail.com</li>
							<li>08423452341235</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Pages</h2>
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
							<li><a href="https://www.instagram.com/pentaherbs/" target="_blank"><i class="fab fa-instagram"></i></a></li>
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