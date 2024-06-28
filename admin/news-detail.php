<?php
  require "../koneksi.php";

  $id = $_GET['p'];
  $query = mysqli_query($db, "SELECT * FROM news WHERE id='$id'");
  $data = mysqli_fetch_array($query);

   $querykategori = mysqli_query($db, "SELECT * FROM kategori ");
   

   
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
    <title>Produk Detail</title>
     <link rel="stylesheet" href="../boostrap 5/bootstrap-5.3.3-dist/css/bootstrap.min.css">
</head>
<style>
    form div{
        margin-bottom: 10px;
    }  
    </style>
<body>
    <?php require "navbar.php"; ?>
     <div class="container mt-5">
        <h2>Detail News</h2>

         <div class="col-12 col-md-6 mb-5">
               <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="judul">Judul</label>
            <input type="text" id="judul" name="judul" value="<?php echo $data['judul'] ?>"class="form-control" autocomplete=off required>
        </div>
         <div>
            <label for="berita">Berita</label>
            <input type="text" class="form-control" value="<?php echo $data['berita']; ?>"name="berita" required>

        </div>
        <div>
            <label for="berita_2">Berita</label>
            <input type="text" class="form-control" value="<?php echo $data['berita_2']; ?>"name="berita_2" >

        </div>
        <div>
            <label for="berita_3">Berita</label>
            <input type="text" class="form-control" value="<?php echo $data['berita_2']; ?>"name="berita_3" >

        </div>
        <div>
            <label for="berita_4">Berita</label>
            <input type="text" class="form-control" value="<?php echo $data['berita_4']; ?>"name="berita_4" >

        </div>
        <div>
            <label for="berita_5">Berita</label>
            <input type="text" class="form-control" value="<?php echo $data['berita_5']; ?>"name="berita_5" >

        </div>
        <div>
            <label for="berita_6">Berita</label>
            <input type="text" class="form-control" value="<?php echo $data['berita_6']; ?>"name="berita_6">

        </div>
        <div>
            <label for="berita_7">Berita</label>
            <input type="text" class="form-control" value="<?php echo $data['berita_7']; ?>"name="berita_7" >

        </div>
        <div>
            <label for="berita_8">Berita</label>
            <input type="text" class="form-control" value="<?php echo $data['berita_8']; ?>"name="berita_8" >

        </div>
        <div>
            <label for="berita_9">Berita</label>
            <input type="text" class="form-control" value="<?php echo $data['berita_9']; ?>"name="berita_9" >

        </div>
        <div>
            <label for="tanggal">Tanggal</label>
            <input type="text" class="form-control" value="<?php echo $data['tanggal']; ?>"name="tanggal" >

        </div>
        <div>
            <label for="currentFoto">Foto Produk Saat ini</label>
            <img src="../img/<?php echo $data['foto']?>" alt="" width="300px">
        </div>
         
         <div>
            <label for="foto">FOTO</label>
            <input type="file" name="foto" id="foto" class="form-control">
        </div>
        <div>
            </select>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
             <button type="submit" class="btn btn-danger" name="hapus">delete</button>
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
                $queryUpdate = mysqli_query($db, "UPDATE news SET 
                judul='$judul', berita='$berita', berita_2='$berita_2', berita_3='$berita_3', berita_4='$berita_4', berita_5='$berita_5', berita_6='$berita_6', berita_7='$berita_7', berita_8='$berita_8', berita_9='$berita_9'
                 WHERE id=$id");

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
                    File wajib bertipe jpf, png dan gif
                    </div>
                        <?php    
                }
                else{
                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);
               

                    $queryUpdate = mysqli_query($db, "UPDATE news SET foto='$new_name' WHERE id='$id' ");
                   
                
                if($queryUpdate){
                    ?>
                     <div class="alert alert-primary mt-3" role="alert">
                        Produk berhasil diupdate
                </div>
                <meta htp-equiv="refresh" content="2; url=news.php" />
                    <?php
                }
                else{
                    echo mysqli_error($db);
                }
                }
             }
            }
        }
    }
    if(isset($_POST['hapus'])){
        $queryHapus = mysqli_query($db, "DELETE FROM news WHERE id='$id' ");

         if($queryHapus){ 
        ?>
        <div class="alert alert-primary mt-3" role="alert">
                        produk berhasil dihapus
                </div>
                  <meta http-equiv="refresh" content="1; url=news.php" />
    <?php
   }
    }
?>
</div>
</div>
    <script src="../boostrap 5/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>