<?php
include '../config/koneksi.php';

$aksi="mod/history/act_history.php";

switch($_GET[aksi]){
default: 
?>

<h1>Data History Pencarian</h1>
<table width="100%" cellspacing="2" cellpadding="4" border="0" class="listview" align="center">
<tr bgcolor="#b9c9fe"> 
<th style="width:30px; height:30px; padding-left:5px;">No</td>
<th>Tanggal</td>
<th style="padding-left:10px;padding-right:10px;">No Pengirim </td> 
<th style="padding-left:10px;padding-right:10px;">Isi Pesan</td> 
<th style="padding-left:10px;padding-right:10px;">Status </td>
<th style="padding-left:10px;padding-right:10px;">Aksi</td> 
</tr>
<?php
$p      = new Paging;
$batas  = 13;
$posisi = $p->cariPosisi($batas);
	
$query=mysql_query("select * from history order by id_history desc LIMIT $posisi,$batas");
$no = $posisi+1;
while ($data=mysql_fetch_array($query)){
	$status=$data['status']==1?"Ditemukan":"Tidak ditemukan";
	$tgl=tgl_indo($data['waktu']);
	echo "<tr><td> $no</td>";
	echo "<td>".$tgl."</td>";
	echo "<td>".$data['no_pengirim']."</td>";
	echo "<td>".$data['isi_pesan']."</td>";
	echo "<td>".$status."</td>";
	echo "<td><a href='?mod=history&aksi=hapus&no=".$data['id_history']."' class='del'>Hapus</a></td>";
	echo "</tr>";
	$no++;	
}
echo "</table>";
	
$jmldata = mysql_num_rows(mysql_query("SELECT * FROM history"));
$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

echo "<div id=paging>Halaman: $linkHalaman</div>Total Data : $jmldata";

break;
case 'hapus':
	$id=$_GET['no'];
	$sql="delete from history where id_history='$id'";
	$hapus=mysql_query($sql);
	if($hapus){
		echo "<script type='text/javascript'>document.location='?mod=history';</script>";	
	}
break;
}
?>