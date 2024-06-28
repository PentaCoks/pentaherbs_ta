<?php
  require "../koneksi.php";

  $query = mysqli_query($db, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a. kategori_id=b.id");
  $jumlahproduk = mysqli_num_rows($query);

  $querykategori = mysqli_query($db, "SELECT * FROM kategori");

  function generateRandomString($length = 10){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++){
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
     <link rel="stylesheet" href="../boostrap 5/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/style.css">
</head>
<style>
      .no-decoration{
      text-decoration: none; 
    }

    form div{
        margin-bottom: 10px;
    }  
    </style>
<body>
    <?php require "navbar.php";?>

     <div class="container mt-5">   
    <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">
        <a href="../adminpanel" class="no-decoration text-muted">Home</a></li>
     <li class="breadcrumb-item active" aria-current="page">Produk</li>
  </ol> 
</nav>



<!-- tambah produk -->
<div class="my-5 col-12-md-6">
     <h3>TAMBAH PRODUK</h3>
     <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" autocomplete=off required>
        </div>
        <div>
            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori" class="form-control" required>
                <option value="">pilih satu</option>
               <?php
               while($data=mysqli_fetch_array($querykategori)){
                ?>
                    <option value="<?php echo $data['id']; ?>"><?php echo $data['nama']; ?></
                    option>
                <?php
               }
               ?>
            </select>
        </div>
        <div>
            <label for="harga">Harga</label>
            <input type="text" class="form-control" name="harga" required>

        </div>
        <div>
            <label for="ukuran">Ukuran</label>
            <input type="text" id="ukuran" name="ukuran" class="form-control" autocomplete=off required>
        </div>
        <div>
            <label for="foto">FOTO</label>
            <input type="file" name="foto" id="foto" class="form-control">
        </div>
       
        <div>
            <label for="detail"> Detail</label>
            <textarea name="detail" id="detail" cols="30" rows="10"class="form-control"></textarea>
        </div>
       <div>
            <label for="link_marketplace">LINK</label>
            <input type="text" id="link_marketplace" name="link_marketplace" class="form-control" autocomplete=off required>
        </div>
        <div>
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </div>
     </form>
     <?php
        if(isset($_POST['simpan'])){
            $nama = htmlspecialchars($_POST['nama']);
            $kategori = htmlspecialchars($_POST['kategori']);
            $harga = htmlspecialchars($_POST['harga']);
            $ukuran = htmlspecialchars($_POST['ukuran']);
            $detail = htmlspecialchars($_POST['detail']);
            $link_marketplace = htmlspecialchars($_POST['link_marketplace']);

            $target_dir = "../img/";
            $nama_file = basename($_FILES["foto"]["name"]);
            $target_file = $target_dir . $nama_file;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $image_size = $_FILES["foto"]["size"];
            $random_name = generateRandomString(20);
            $new_name = $random_name . "." . $imageFileType;

           



            if($nama=='' || $kategori=='' || $harga==''){
                ?>
                <div class="alert alert-warning mt-3" role="alert">
                    Nama, kategori dan harga wajib diisi!
            </div>
                <?php
            }
            else{
                if($nama_file!=''){
                    if($image_size > 5000000){
                        ?>
                <div class="alert alert-warning mt-3" role="alert">
                    File tidak boleh lebih dari 5 MB
                    </div>
                        <?php
                    }
                    else{
                        if($imageFileType !='jpg' && $imageFileType != 'png' && $imageFileType !='gif' && $imageFileType !='mp4'){
                            ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                File wajib wajib bertipe jpg atau png atau gif
                            </div>
                            <?php
                        }
                        else{
                            move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
                        }
                    }
                }

                // query insert to product table
                $queryTambah = mysqli_query($db, "INSERT INTO produk (kategori_id, nama, harga, ukuran, 
                foto, detail) VALUES ('$kategori', '$nama', '$harga', '$ukuran', '$new_name', '$detail')");

                if($queryTambah){
                    ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Produk berhasil tersimpan
                </div>
                <meta http-equiv="refresh" content="2; url=produk.php" /> 
                    <?php
                }
                 else{
                    echo mysqli_error($db);
                 }

            }
        }
     ?>
</div>

<div class="container-fluid py-2 mb-5 p-5 shadow rounded">
    <div class="container lg-5 p-5 my-5 border ">
<div class="mt-3 mb-5">
    <h2> DAFTAR PRODUK</h2>
    <div class="table-responsive mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Ukuran</th>
                         <th>Action</th>
                </tr>
        </thead>
            <tbody>
                <?php
                if($jumlahproduk==0){
                ?>
                <tr>
                    <td colspan=7 class="text-center"> data Produk tidak ada</td>
                </tr>
                <?php
                }
                else{
                    $jumlah = 1;
                    while($data=mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td><?php echo $jumlah; ?></td>
                             <td><?php echo $data['nama']; ?></td>
                              <td><?php echo $data['nama_kategori']; ?></td>
                              <td><?php echo $data['harga']; ?></td>
                              <td><?php echo $data['ukuran']; ?></td>
                                <td>
                                <a href="produk-detail.php?p=<?php echo $data['id']; ?>"
                                class="btn btn-info"></a>
                                </td>
                        </tr>

                        <?php
                        $jumlah++;
                    }
                }
                ?>
            </tbody>
</table>
</div>
</div>
</div>
</div>
            </div>
    <script src="../boostrap 5/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>