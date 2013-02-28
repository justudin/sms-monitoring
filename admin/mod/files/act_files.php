<?php 
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/function.php";

if($_GET['op']=="upload"){
	$nama=$_POST['nama'];
	if(isset($nama)){
		$file=$_FILES["namafile"]["tmp_name"];
		$filename = $_FILES["namafile"]["name"];
		$upload = '../../../files/'.$filename;

		$sintak='insert into files values ("","'.$nama.'","'.$filename.'")';
		if(!move_uploaded_file($file, $upload)) {
			echo "<script type='text/javascript'>alert('Data File Gagal disimpan!'); document.location='../../?mod=files';</script>";			
		} else {
			mysql_query($sintak);
			echo "<script type='text/javascript'>alert('Data File Berhasil ditambahkan!'); window.location = '../../?mod=files';</script>";
		}
	
	}
	
}

echo "<script type='text/javascript'>window.location = '../../';</script>"; 

?>