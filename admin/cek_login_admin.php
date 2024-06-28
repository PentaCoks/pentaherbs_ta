<?php
session_start();
$_SESSION['sesi'] = NULL;

include "koneksi.php";
	if( isset($_POST['submit']))
	{
			$user	= isset($_POST['user']) ? $_POST['user'] : "";
			$pass	= isset($_POST['pass']) ? $_POST['pass'] : "";
			$qry	= mysqli_query($db,"SELECT * FROM admin WHERE username = '$user' AND password = '$pass'");
			$sesi	= mysqli_num_rows($qry);

			if ($sesi == 1)
			{
				$data_admin	= mysqli_fetch_array($qry);
				$_SESSION['id_admin'] = $data_admin['id_admin'];
				$_SESSION['sesi'] = $data_admin['nama'];

				echo "<meta http-equiv='refresh' content='0; url=index.php'>";
				echo "<script>alert('Anda berhasil Log In');</script>";
			}
			else
			{
				echo "<meta http-equiv='refresh' content='0; url=login_admin.php'>";
				echo "<script>alert('Anda Gagal Log In');</script>";
			}
		
		
	}
	else
	{
	  include "login_admin.php";
	}
?>