<?php
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/function.php";

$modul=$_GET['modul'];
$aksi=$_GET['aksi'];
$pesan=$_POST['pesan'];

if($pesan=="Pesan"){
	$byk=0;
	$kasir = $_SESSION['username'];
	$tipekamar = $_POST['tipekamar'];
	$sqltipe=mysql_query('select tarif from tbl_tipe_kamar where tipe="'.$tipekamar.'"');
	$dt  = mysql_fetch_array($sqltipe);
	$no = $_POST['no'];
	$nama=$_POST['nama'];
	$tglcheckin=$_POST['tglcheckin'];
	$tglcheckout=$_POST['tglcheckout'];
	$noktp=$_POST['noktp'];
	$alamat=$_POST['alamat'];
	$nokamar=$_POST['nokamar'];
	$bykorg=$_POST['bykorg'];
	if($bykorg>2) {
		$tmbhorg=$bykorg-2;
		$byk=$tmbhorg*10000;
	}

	
	//convert ke JDN biar bisa dihitung selisihnya
	$jd1 = hitungTanggal($tglcheckin);
	$jd2 = hitungTanggal($tglcheckout);
	
	$bykhri = $jd2-$jd1;
	if($bykhri==0){
		$bykhri=1;
	}
	$tarif = $bykhri*$dt[tarif]+$byk;
	

	
	if(isset($nama,$tglcheckin,$noktp,$alamat,$bykorg,$nokamar))
	{
		$sintak='insert into tbl_checkin(no,
				nama,
				noktp,
				alamat,
				no_kamar,
				tgl_checkin,
				tgl_checkout,
				jam_checkin,
				byk_org,
				tarif,
				kasir)
				values ("'.$no.'", 
				"'.$nama.'", 
				"'.$noktp.'",
				"'.$alamat.'",
				"'.$nokamar.'",
				"'.$tglcheckin.'",
				"'.$tglcheckout.'",
				now(),
				"'.$bykorg.'",
				"'.$tarif.'",
				"'.$kasir.'")';
				
		if(mysql_query($sintak)){
			$sql=mysql_query('update tbl_kamar set status="isi" where no_kamar="'.$nokamar.'"');
			echo "<script type='text/javascript'>alert('Pemesanan Kamar berhasil diproses!'); window.location = '../../?modul=checkin';</script>";
			
		} else echo "<script type='text/javascript'>alert('Pemesanan Kamar Gagal diproses!'); document.location='../../?modul=checkin';</script>";
		
	}
}

?>
