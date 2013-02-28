<?php
include "../config/koneksi.php";

$ip = $_SERVER['SERVER_ADDR'];
// cari data SMS yang masuk ke INBOX MySQL
// yang berawalan tausiah#...
$sql = "SELECT * FROM inbox WHERE TextDecoded LIKE 'CARI#%' AND Processed = 'false'";
$proses_sql = mysql_query($sql);
while ($data = mysql_fetch_array($proses_sql))
{
	// baca ID sms
	$id = $data['ID'];
	// baca nomor pengirim (akan digunakan untuk mengirim SMS balasan)
	$sender = $data['SenderNumber'];
	$split=explode('+62', $sender);
	$pengirim="0".$split[1];
	
	// mengubah sms ke huruf kapital semua
	$sms = $data['TextDecoded'];
	$waktu = $data['ReceivingDateTime'];
	
	// proses parsing untuk mendapatkan isi pesan dan password dari SMS
	$split = explode('#', $sms);
	//pesan berisi nama file yang ingin dicari
	$pesan = $split[1];
	//pin berisi password bagi user
	$pin = md5($split[2]);
	//cek apakah sudah terdaftar sebagai user
	$cek="select * from users where nohp = '$pengirim' and password= '$pin'";
	$hasilcek = mysql_query($cek);
	$jml=mysql_num_rows($hasilcek);
	$datacek = mysql_fetch_array($hasilcek);
	//jika user sudah terdaftar dengan nohp dan password yang benar maka Pesan SMS-nya akan diproses
	if ($jml>0)
	{
		$sql_cari=mysql_query("select * from files where nama_files LIKE '%$pesan%'");
		$data_file=mysql_fetch_array($sql_cari);
		$ketemu=mysql_num_rows($sql_cari);
		if($ketemu>0){
			//memasukan data pesan ke history pencarian dengan status 1 -> Data ditemukan
			$query = "insert into history values ('','$pengirim','$pesan','$waktu','1')";
			$hasil = mysql_query($query);
			//balasan sms untuk file yang ditemukan
			$reply="Data Ditemukan! Silahkan download di link berikut : http://".$ip."/files/".$data_file['url_files'];
		} else {
		//memasukan data pesan ke history pencarian dengan status 0 -> Data tidak ditemukan
		$query = "insert into history values ('','$pengirim','$pesan','$waktu','0')";
		$hasil = mysql_query($query);
		//balasan sms untuk file yang tidak ditemukan
		$reply="Maaf data yang Anda cari tidak ditemukan! Silahkan ulangi lagi.";
		
		}
		 // query untuk mengirim SMS balasan via Gammu
		$sql2 = "INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID)
                  VALUES ('$pengirim', '$reply', 'Gammu')";
		mysql_query($sql2);	

		// proses penandaan SMS di Inbox bahwa SMS sudah diproses berdasarkan ID SMS
		$sql3 = "UPDATE inbox SET Processed = 'true' WHERE ID = '$id'";
		mysql_query($sql3);  
	}
}
?>
