<?php
// proses koneksi ke mysql
include "config/koneksi.php";

// cari data SMS yang masuk ke INBOX MySQL
// yang berawalan NILAI#...
$queryMySQL = "SELECT * FROM inbox WHERE TextDecoded LIKE 'NILAI#%' AND Processed = 'false'";
$hasilMySQL = mysql_query($queryMySQL);
while ($dataMySQL = mysql_fetch_array($hasilMySQL))
{
  // baca ID sms
  $id = $dataMySQL['ID'];
  // baca nomor pengirim (akan digunakan untuk mengirim SMS balasan)
  $sender = $dataMySQL['SenderNumber'];
	$split=explode('+62', $sender);
	$pengirim="0".$split[1];
  // mengubah sms ke huruf kapital semua
  $sms = strtoupper($dataMySQL['TextDecoded']);
  // proses parsing untuk mendapatkan KODEMK dan NIM dari SMS
  $split = explode('#', $sms);
  $kodemk = $split[1];
  $nim = $split[2];

  // query untuk mencari ada tidaknya data di tabel 'nilai' pada MS. Access berdasarkan KODEMK dan NIM
  $query = "SELECT count(*) AS jum FROM nilai WHERE nim = '$nim' AND kodemk = '$kodemk'";
  $hasil = mysql_query($query);
  $data = mysql_fetch_array($hasil);

  // jika hasil query ditemukan (hasil query > 0), maka cari nilainya dengan query
  if ($data['jum'] > 0)
  {
     // query untuk mendapatkan nilai di MS. Access
     $queryODBC = "SELECT * FROM nilai WHERE nim = '$nim' AND kodemk = '$kodemk'";
     $hasilODBC = mysql_query($queryODBC);
     $dataODBC = mysql_fetch_array($hasilODBC);
     $nilai = $dataODBC['nilai'];
     // bunyi balasan SMS jika nilai ditemukan
     $reply = "Nilai MK ".$kodemk." mahasiswa berNIM ".$nim." adalah ".$nilai;
  }
  // jika hasil query tidak ada, maka bunyi balasan SMS nya 'Data tidak ditemukan'
  else $reply = "Data tidak ditemukan";

  // query untuk mengirim SMS balasan via Gammu
  $queryMySQL2 = "INSERT INTO outbox(DestinationNumber, TextDecoded, CreatorID)
                  VALUES ('$pengirim', '$reply', 'Gammu')";
  mysql_query($queryMySQL2);	

  // proses penandaan SMS di Inbox bahwa SMS sudah diproses berdasarkan ID SMS
  $queryMySQL3 = "UPDATE inbox SET Processed = 'true' WHERE ID = '$id'";
  mysql_query($queryMySQL3);  

}

?>
