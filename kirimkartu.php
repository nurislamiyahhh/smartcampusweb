<?php
	include "config.php";

	//baca nomor kartu dari NodeMCU
	$no_id = $_GET['no_id'];
	//kosongkan tabel tmprfid
	mysqli_query($conn, "DELETE FROM tmprfid");

	//simpan nomor kartu yang baru ke tabel tmprfid
	$simpan = mysqli_query($conn, "INSERT INTO tmprfid(no_id)VALUES('$no_id')");
	if($simpan)
		echo "Berhasil";
	else
		echo "Gagal";
?>