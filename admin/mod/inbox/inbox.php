<?php
include '../config/koneksi.php';

$aksi=$_GET['aksi'];
switch($aksi){
default:

?>
<h1>Data Pesan Masuk</h1>
<br/>
<table width="100%" cellspacing="2" cellpadding="4" border="0" class="listview" align="center">
<tr bgcolor="#b9c9fe"> 
<th style="width:30px; height:30px; padding-left:5px;">No</td>
<th style="padding-left:10px;padding-right:10px;">No Pengirim </td> 
<th style="padding-left:10px;padding-right:10px;">Pesan</td> 
<th style="padding-left:10px;padding-right:10px;">Tanggal</td>
<th style="padding-left:10px;padding-right:10px;">Aksi</td> 
</tr>
<?php
$p      = new Paging;
$batas  = 10;
$posisi = $p->cariPosisi($batas);
$query=mysql_query("select * from inbox order by ID desc LIMIT $posisi,$batas");
$no = $posisi+1;
if(mysql_num_rows($query)>0){
while ($data=mysql_fetch_array($query)){
	echo "<tr><td> $no</td>";
	echo "<td>".$data['SenderNumber']."</td>";
	echo "<td>".$data['TextDecoded']."</td>";
	echo "<td>".tgl_indo($data['ReceivingDateTime'])."</td>";
	?>
	<td><a href='?mod=inbox&aksi=hapus&no=<?php echo $data['ID'];?>' onclick="return confirm('Apakah Anda yakin ingin menghapus Data ini?')">Hapus</a></td>
	
	<?php
	echo "</tr>";
$no++;
	
	}
	}  else echo "<tr><td colspan='9' align='center'>Inbox SMS KOSONG!</td></tr>";
echo "</table>";
$jmldata = mysql_num_rows(mysql_query("SELECT * FROM inbox"));
$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

echo "<br/><div id=paging>Halaman: $linkHalaman</div>";
break;

case 'hapus':
	$id=$_GET['no'];
	$sql="delete from inbox where ID='$id'";
	$hapus=mysql_query($sql);
	if($hapus){
		echo "<script type='text/javascript'>document.location='?mod=inbox';</script>";	
	}
break;
}
?>
