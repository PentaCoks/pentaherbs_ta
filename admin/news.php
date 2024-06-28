<?php
  require "../koneksi.php";

  $query = mysqli_query($db, "SELECT * FROM news");
  $jumlahproduk = mysqli_num_rows($query);


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
     <h3>TAMBAH BERITA  </h3>
     <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="judul">Judul</label>
            <input type="text" id="judul" name="judul" class="form-control" autocomplete=off required>
        </div>
        <div>
            <label for="berita">Berita</label>
            <input type="text" class="form-control" name="berita" required>

        </div>
        <div>
            <label for="berita_2">Berita_2</label>
            <input type="text" class="form-control" name="berita_2" required>

        </div>
        <div>
            <label for="berita_3">Berita_3</label>
            <input type="text" class="form-control" name="berita_3" >

        </div>
        <div>
            <label for="berita_4">Berita_4</label>
            <input type="text" class="form-control" name="berita_4" >

        </div>
        <div>
            <label for="berita_5">Berita_5</label>
            <input type="text" class="form-control" name="berita_5" >

        </div>
        <div>
            <label for="berita_6">Berita_6</label>
            <input type="text" class="form-control" name="berita_6">

        </div><div>
            <label for="berita_7">Berita_7</label>
            <input type="text" class="form-control" name="berita_7" >

        </div><div>
            <label for="berita_8">Berita_8</label>
            <input type="text" class="form-control" name="berita_8" >

        </div><div>
            <label for="berita_9">Berita_9</label>
            <input type="text" class="form-control" name="berita_9" >

        </div>
        <div>
            <label for="tanggal">Tanggal</label>
            <input type="text" class="form-control" name="tanggal" >

        </div>
        <div>
            <label for="foto">FOTO</label>
            <input type="file" name="foto" id="foto" class="form-control">
        </div>
        <div>
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </div>
     </form>
     <?php
        if(isset($_POST['simpan'])){
            $judul = htmlspecialchars($_POST['judul']);
            $berita = htmlspecialchars($_POST['berita']);
            $berita_2 = htmlspecialchars($_POST['berita_2']);
            $berita_3 = htmlspecialchars($_POST['berita_3']);
            $berita_4 = htmlspecialchars($_POST['berita_4']);
            $berita_5 = htmlspecialchars($_POST['berita_5']);
            $berita_6 = htmlspecialchars($_POST['berita_6']);
            $berita_7 = htmlspecialchars($_POST['berita_7']);
            $berita_8 = htmlspecialchars($_POST['berita_8']);
            $berita_9 = htmlspecialchars($_POST['berita_9']);
            $tanggal = htmlspecialchars($_POST['tanggal']);

            $target_dir = "../img/";
            $nama_file = basename($_FILES["foto"]["name"]);
            $target_file = $target_dir . $nama_file;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $image_size = $_FILES["foto"]["size"];
            $random_name = generateRandomString(5);
            $new_name = $random_name . "." . $imageFileType;

            if($judul=='' || $berita==''){
                ?>
                <div class="alert alert-warning mt-3" role="alert">
                    Nama dan berita  wajib diisi!
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

                // query insert to news table
                $queryTambahan = mysqli_query($db, "INSERT INTO news (judul, berita, berita_2, berita_3, berita_4, berita_5,berita_6, berita_7, berita_8, berita_9, tanggal, foto) 
                VALUES ('$judul', '$berita', '$berita_2', '$berita_3', '$berita_4', '$berita_5', '$berita_6', '$berita_7', '$berita_8', '$berita_9', '$tanggal', '$new_name' )");


                if($queryTambahan){
                    ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Produk berhasil tersimpan
                </div>
                <meta http-equiv="refresh" content="2; url=news.php" /> 
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
    <h2> Daftar News</h2>
    <div class="table-responsive mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>berita</th>
                    <th>Tanggal</th>
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
                             <td><?php echo $data['judul']; ?></td>
                              <td><?php echo $data['berita']; ?></td>
                              <td><?php echo $data['tanggal']; ?></td>
                                <td>
                                <a href="news-detail.php?p=<?php echo $data['id']; ?>"
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