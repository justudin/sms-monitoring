<?php
class Paging{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET[halaman])){
	$posisi=0;
	$_GET[halaman]=1;
}
else{
	$posisi = ($_GET[halaman]-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link halaman 1,2,3, ...
for ($i=1; $i<=$jmlhalaman; $i++){
  if ($i == $halaman_aktif){
    $link_halaman .= "<b>$i</b> | ";
  }
else{
  $link_halaman .= "<a href=$_SERVER[PHP_SELF]?mod=$_GET[mod]&halaman=$i>$i</a> | ";
}
$link_halaman .= " ";
}
return $link_halaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk pengunjung)
function navHalaman2($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link halaman 1,2,3, ...
for ($i=1; $i<=$jmlhalaman; $i++){
  if ($i == $halaman_aktif){
    $link_halaman .= "<b>$i</b> | ";
  }
else{
  $link_halaman .= "<a href=$_SERVER[PHP_SELF]?mod=$_GET[mod]&id=$_GET[id]&halaman=$i>$i</a> | ";
}
$link_halaman .= " ";
}
return $link_halaman;
}
//fungsi halaman link untuk laporan
function navHalamanLaporan($halaman_aktif, $jmlhalaman,$tglawal,$tglakhir){
$link_halaman = "";

// Link halaman 1,2,3, untuk laporan...
for ($i=1; $i<=$jmlhalaman; $i++){
  if ($i == $halaman_aktif){
    $link_halaman .= "<b>$i</b> | ";
  }
else{
  $link_halaman .= "<a href=$_SERVER[PHP_SELF]?mod=$_GET[mod]&aksi=datalaporan&halaman=$i&tglawal=$tglawal&tglakhir=$tglakhir>$i</a> | ";
}
$link_halaman .= " ";
}
return $link_halaman;
}

}
?>
