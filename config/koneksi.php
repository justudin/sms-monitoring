<?php
	$host = "localhost";  //alamat server
	$user = "root";       //username untuk koneksi ke database
	$pass = "";   //password koneksi ke database, klo tidak ada bisa dikosongkan
	$db = "sms_monitoring";   //nama database yang akan diakses/digunakan
	
	$konek=mysql_connect($host, $user, $pass);
	if(!$konek){
		echo "Koneksi ke database gagal!";
	}
	mysql_select_db($db) or die("Database tidak ditemukan!");
	
	//inisiasi bwt ngecek user uda login pa blm
	//include "init.php";

?>