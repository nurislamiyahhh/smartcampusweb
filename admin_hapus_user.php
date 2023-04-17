<?php
	include "config.php";

	//baca id data yang akan dihapus
	$no = $_GET['no_id'];

	//hapus data
	$hapus = mysqli_query($conn, "delete from datauser where no='$no'");

	//jika berhasil terhapus tampilkan pesan Terhapus
	//kemudian kembali ke data karyawan
	if($hapus)
	{
		echo "
			<script>
				alert('Terhapus');
				location.replace('datauser.php');
			</script>
		";
	}
	else
	{
		echo "
			<script>
				alert('Gagal Terhapus');
				location.replace('datauser.php');
			</script>
		";
	}

?>