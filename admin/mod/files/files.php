<?php 
include '../config/koneksi.php';

$aksi=$_GET['aksi'];
switch($aksi){
default:
?>
<h1>Daftar Data Files</h1>
<br/>
<table width="100%" cellspacing="2" cellpadding="4" border="0" class="listview" >
<tr bgcolor="#b9c9fe"> 
<th style="width:30px; height:30px; padding-left:5px;">No</td>
<th style="padding-left:10px;padding-right:10px;">Nama Files </td> 
<th style="padding-left:10px;padding-right:10px;">Letak Files</td> 
<th style="padding-left:10px;padding-right:10px;" align="center">Aksi</td> 
</tr>
<?php
$p      = new Paging;
$batas  = 13;
$posisi = $p->cariPosisi($batas);
$query=mysql_query("select * from files order by id_files desc LIMIT $posisi,$batas");
$no = $posisi+1;
if(mysql_num_rows($query)>0){
while ($data=mysql_fetch_array($query)){
	echo "<tr><td> $no</td>";
	echo "<td>".$data['nama_files']."</td>";
	echo "<td>".$data['url_files']."</td>";
	?>
	
	<td><b><a href='?mod=files&aksi=hapus&no=<?php echo $data['id_files']?>' onclick="return confirm('Apakah Anda yakin ingin menghapus Data ini?')">Hapus</a></b> | <b><a href='?mod=files&aksi=edit&no=<?php echo $data['id_files']?>'>Edit</a></b></tr>
	
	<?php
	
$no++; 
	}
}  else echo "<tr><td colspan='10' align='center'>Belum Ada Data Files</td></tr>";
echo "</table>";
$jmldata = mysql_num_rows(mysql_query("SELECT * FROM files"));
$jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
$linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

echo "<br/><div id=paging>Halaman: $linkHalaman</div>";
echo "<br/><br/><a href='?mod=files&aksi=upload' class='button'>Upload File</a>";
break;

case 'upload':
	$aksi="mod/files/act_files.php";
	echo "<table width=50% height=120px>
		<h1>Upload File</h1>
		<form action='$aksi?op=upload' enctype='multipart/form-data'  method='post'>
		<tr>
			<td>Nama File</td>
			<td><input type='text' name='nama' size=50/></td>
		</tr>
		<tr>
			<td>Upload file</td>
			<td><input type='file' name='namafile' /></td>
		</tr>
		<tr>
			<td colspan=2 align=left><input type='submit' value='Upload File' name='upload' class='button' /></td>
		</tr>
		</form>
		</table>";
break;

case 'hapus':
	

}
?>