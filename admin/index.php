<?php
  require "../koneksi.php";
   $queryproduk = mysqli_query($db, "SELECT * FROM produk");
  $jumlahproduk = mysqli_num_rows($queryproduk);

  $querynews = mysqli_query($db, "SELECT * FROM news");
  $jumlahnews = mysqli_num_rows($querynews);
  
  ?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PentaHerbs</title>
    <link rel="stylesheet" href="../boostrap 5/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/style.css">

</head>
<style>
  .kotak {
    border: solid;
  }
    .summary-kategory{
      background-color: #FFB700;
      border-radius: 15px;
    }
      .summary-produk{
        background-color: #73d183;
        border-radius: 15px;
      }
    .no-decoration{
      text-decoration: none; 
    }
    
  </style>
<body>
  <?php require "navbar.php";?>
  <div class="container mt-5">
    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Home</li>
  </ol>
</nav>
    <h2> Hallo Admin </h2>
    <div class="container mt-5">
      <div class="row">
      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="summary-kategory p-3">
      <div class="row">
        <div class="col-6 me-2 text-black">
          <h3 class="fs-1"> News</h3>
          <p class="fs-3"><?php echo $jumlahnews; ?> news</p>
          <p><a href="news.php" class="text-black no-decoration">Lihat Detail</a></p>
       </div>
      </div>
  </div>
      </div>

      <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class= "summary-produk p-3">
      <div class="row">
        <div class="col-6 me-2 text-black">
          <h3 class="fs-1"> Produk</h3>
          <p class="fs-3"><?php echo $jumlahproduk; ?> produk</p>
          <p><a href="produk.php" class="text-black no-decoration">Lihat Detail</a></p>
       </div>
      </div>
  </div>
      </div>
      </div>
</div>

<script src="../boostrap 5/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
