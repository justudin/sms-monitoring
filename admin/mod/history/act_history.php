<?php
include "../../../config/koneksi.php";
include "../../../config/library.php";

$modul=$_GET[modul];
$aksi=$_GET[aksi];
$id=(int)$_GET[id];
if($_SESSION[status]==1){
if($modul=='datakamar' AND $aksi=='hapus'){
	mysql_query("delete from tbl_kamar where id_kamar='$id'");
	echo "<script type='text/javascript'>alert('Data kamar berhasil dihapus!');</script>
	<meta http-equiv='REFRESH' content='0;url=../../../admin/index.php?modul=datakamar'>";
}

// Input datakamar
elseif ($modul=='datakamar' AND $aksi=='input'){
	$status='kosong';
  mysql_query("INSERT INTO tbl_kamar(no_kamar,
								tipe_kamar,
                                 status) 
	                       VALUES('$_POST[nokamar]',
								'$_POST[tipekamar]',
                                '$status')");
  header('location:../../?modul='.$modul);
}

// Update datakamar
elseif ($modul=='datakamar' AND $aksi=='update'){
    mysql_query("UPDATE tbl_kamar SET no_kamar   = '$_POST[nokamar]',
                                  tipe_kamar     = '$_POST[tipekamar]',
                                  status         = '$_POST[status]'
                           WHERE  id_kamar       = '$_POST[id]'");
						   
  header('location:../../?modul='.$modul);
}
}
?>