<?php
  require "../koneksi.php";

  $id = $_GET['p'];
  $query = mysqli_query($db, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.
  kategori_id=b.id WHERE a.id='$id'");
  $data = mysqli_fetch_array($query);

   $querykategori = mysqli_query($db, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");
   

   
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
        <h2>DETAIL PRODUK</h2>

         <div class="col-12 col-md-6 mb-5">
               <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?php echo $data['nama'] ?>"class="form-control" autocomplete=off required>
        </div>
           <div>
            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori" class="form-control" required>
                <option value="<?php echo $data['kategori_id']; ?>"><?php echo $data['nama_kategori']?></option>
               <?php
               while($datakategori=mysqli_fetch_array($querykategori)){
                ?>
                    <option value="<?php echo $datakategori['id']; ?>"><?php echo $datakategori['nama']; ?></
                    option>
                <?php
               }
               ?>
            </select>
        </div>
         <div>
            <label for="harga">harga</label>
            <input type="text number" class="form-control" value="<?php echo $data['harga']; ?>"name="harga" required>

        </div>
        <div>
            <label for="ukuran">ukuran</label>
            <input type="text" id="ukuran" name="ukuran" value="<?php echo $data['ukuran'] ?>"class="form-control" autocomplete=off required>
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
       
       
         <div>
            <label for="detail"> Detail</label>
            <textarea name="detail" id="detail" cols="30" rows="10"class="form-control">
                <?php echo $data['detail'];?>
            </textarea>
        </div>
       <div>
            <label for="link_marketplace">LINK</label>
            <input type="text" id="link_marketplace" name="link_marketplace" value="<?php echo $data['link_marketplace'] ?>"class="form-control" autocomplete=off required>
        </div>

            </select>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
             <button type="submit" class="btn btn-danger" name="hapus">delete</button>
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
                    Nama, Kategori dan harga wajib diisi
             </div>
                <?php
             }
             else{
                $queryUpdate = mysqli_query($db, "UPDATE produk SET 
                kategori_id='$kategori', nama='$nama', harga='$harga', ukuran='$ukuran', detail='$detail', link_marketplace='$link_marketplace'
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
               

                    $queryUpdate = mysqli_query($db, "UPDATE produk SET foto='$new_name' WHERE id='$id' ");
                   
                
                if($queryUpdate){
                    ?>
                     <div class="alert alert-primary mt-3" role="alert">
                        Produk berhasil diupdate
                </div>
                <meta htp-equiv="refresh" content="2; url=produk.php" />
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
        $queryHapus = mysqli_query($db, "DELETE FROM produk WHERE id='$id' ");

         if($queryHapus){ 
        ?>
        <div class="alert alert-primary mt-3" role="alert">
                        produk berhasil dihapus
                </div>
                  <meta http-equiv="refresh" content="1; url=produk.php" />
    <?php
   }
    }
?>
</div>
</div>
    <script src="../boostrap 5/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>