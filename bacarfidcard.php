<?php 
	include "config.php";
	//baca tabel status untuk mode absensi
	$sql = mysqli_query($conn, "SELECT * FROM statusrfid");
	$data = mysqli_fetch_array($sql);
	$mode_absen = $data['mode'];

	//uji mode absen
	$mode = "";
	if($mode_absen==1)
		$mode = "Masuk";
	else if($mode_absen==2)
		$mode = "Keluar";


	//baca tabel tmprfid
	$baca_kartu = mysqli_query($conn, "SELECT * FROM tmprfid");
	$data_kartu = mysqli_fetch_array($baca_kartu);
	$no_id    = $data_kartu['no_id'] ?? null;
?>


<div class="container-fluid" style="text-align: center;">
	<?php if($no_id=="") { ?>

	<h3>Absen : <?php echo $mode; ?> </h3>
	<h3>Silahkan Tempelkan Kartu RFID Anda</h3>
	<img src="images/rfid.png" style="width: 200px"> <br>
	<img src="images/animasi2.gif">

	<?php } else {
		//cek nomor kartu RFID tersebut apakah terdaftar di tabel mahasiswa
		$cari_mahasiswa = mysqli_query($conn, "SELECT * FROM datauser WHERE no_id='$no_id'");
		$jumlah_data = mysqli_num_rows($cari_mahasiswa);

		if($jumlah_data==0)
			echo "<h1>Maaf! Kartu Tidak Dikenali</h1>";
		else
		{
			//ambil nama mahasiswa
			$data_mahasiswa = mysqli_fetch_array($cari_mahasiswa);
			$nama = $data_mahasiswa['nama'];

			//tanggal dan jam hari ini
			date_default_timezone_set('Asia/Makassar') ;
			$tanggal = date('Y-m-d');
			$jam     = date('H:i:s');

			//cek di tabel rekap, apakah nomor kartu tersebut sudah ada sesuai tanggal saat ini. Apabila belum ada, maka dianggap absen masuk, tapi kalau sudah ada, maka update data sesuai mode absensi
			$cari_absen = mysqli_query($conn, "SELECT * FROM rekap WHERE no_id='$no_id' AND Tanggal='$tanggal'");
			//hitung jumlah datanya
			$jumlah_absen = mysqli_num_rows($cari_absen);
			if($jumlah_absen == 0)
			{
				echo "<h1>Selamat Datang <br> $nama</h1>";
				mysqli_query($conn, "INSERT INTO rekap(no_id, Tanggal, Jam_Masuk)VALUES('$no_id', '$tanggal', '$jam')");
			}
			else
			{
				//update sesuai pilihan mode absen
				if($mode_absen == 2)
				{
					echo "<h1>Selamat Jalan <br> $nama</h1>";
					mysqli_query($conn, "UPDATE rekap SET Jam_Keluar='$jam' WHERE no_id='$no_id' AND Tanggal='$tanggal'");
				}
			}
		}

		//kosongkan tabel tmprfid
		mysqli_query($conn, "DELETE FROM tmprfid");
	} ?>

</div>