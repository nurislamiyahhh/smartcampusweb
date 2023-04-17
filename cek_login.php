<form action="cek_login.php" method="post">

<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'config.php';
 
// menangkap data yang dikirim dari form login
$email = $_POST['email'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from user where email='$email' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['user_type']=="admin"){
 
		// buat session login dan username
		$_SESSION['email'] = $email;
		$_SESSION['user_type'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:admin_page.php");
 
	// cek jika user login sebagai pegawai
	}else if($data['user_type']=="user"){
		// buat session login dan username
		$_SESSION['email'] = $email;
		$_SESSION['user_type'] = "user";
		// alihkan ke halaman dashboard pegawai
		header("location:user_page.php");
 
	}else{
 
		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}	
}else{
	header("location:index.php?pesan=gagal");
}
 
?>