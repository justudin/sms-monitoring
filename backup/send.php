<?php
// koneksi ke database Gammu
include "../config/koneksi.php";
// baca no tujuan
 $no_tujuan = $_POST['nohp'];
// baca isi sms
 $isi_sms = $_POST['sms'];
	$byk=$_POST['jumlahsms'];
// baca format sms
 $pilih_format = $_POST['format'];
if ($pilih_format == "flash")
 {
 // jika format yang dipilih 'flash'
// query kirim sms format flash
	for($i=1;$i<=$byk;$i++){
 $query = "INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID, Class)
 VALUES ('$no_tujuan', '$isi_sms', 'Gammu', '0')";
// jalankan query
 mysql_query($query);
	}
		echo $byk." Sms sudah terkirim semua..";
			echo "<br/><a href='form.php'>Kirim Pesan Lagi</a>";
 }
 else if ($pilih_format == "normal")
 {
 // jika format yang dipilih 'normal'
// query kirim sms normal
	for($i=1;$i<=$byk;$i++){
 $query = "INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID, Class)
 VALUES ('$no_tujuan', '$isi_sms', 'Gammu', '-1')";
// jalankan query
 mysql_query($query);
	}
		echo $byk." Sms sudah terkirim semua..";
			echo "<br/><a href='form.php'>Kirim Pesan Lagi</a>";
 }
 else echo "Anda belum memilih format SMS";
?>
