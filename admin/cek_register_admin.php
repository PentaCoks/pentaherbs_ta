<?php
include "koneksi.php";
	// ambil data dari formulir
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // apakah query simpan berhasil?
    if (empty($nama)){
        echo "<script>alert('Nama belum diisi')</script>";
        echo "<meta http-equiv='refresh' content='1 url=register_admin.php'>";
        }else
    if (empty($username)){
        echo "<script>alert('Username belum diisi')</script>";
        echo "<meta http-equiv='refresh' content='1 url=register_admin.php'>";
        }else    
    if (empty($password)){
        echo "<script>alert('Password belum diisi')</script>";
        echo "<meta http-equiv='refresh' content='1 url=register_admin.php'>";
    }else{
        // buat query
        $cek_dulu = "SELECT * FROM admin WHERE  username='$username' " ;
      
    $cek = mysqli_query ($db, $cek_dulu);
    
    if (mysqli_num_rows ($cek) > 0) {
    echo "<script>alert('Anda Gagal Mendaftar')</script>";
    echo "<meta http-equiv='refresh' content='0; url=register_admin.php'>";
    }else {
    mysqli_query($db, "INSERT INTO admin (nama, username, password) VALUE ('$nama','$username','$password')");
    // kalau berhasil alihkan ke halaman index.php dengan status=sukses
    echo "<script>alert('Anda berhasil Daftar')</script>";
    echo "<meta http-equiv='refresh' content='0; url=login_admin.php'>";
    
    }	
}

?>