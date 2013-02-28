<?php
include 'config/koneksi.php';
$aksi=$_GET['aksi'];
if($aksi == "in"){
if(isset($_POST['username'], $_POST['password']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$req = mysql_query('select * from users where username="'.$username.'"');
		$dn = mysql_fetch_array($req);
		if($dn['password']==md5($password) and mysql_num_rows($req)>0)
		{
			
					$_SESSION['username'] = $_POST['username'];
					$_SESSION['id_users'] = $dn['id_users'];
					$_SESSION['nama'] = $dn['nama']; 
					echo "<script type='text/javascript'>window.location = 'admin/';</script>";
		}
		else
		{
		 echo "<script type='text/javascript'>alert('username atau password salah!');</script>
		 <meta http-equiv='REFRESH' content='0;url=index.php'>";
		}
	}

} else if($aksi == "out") {
	unset($_SESSION['username'], $_SESSION['id_users'],$_SESSION['nama']);
	$_SESSION=array();
	session_destroy();
	echo "<script type='text/javascript'>alert('Logout Berhasil! Terimakasih telah menggunakan sistem kami');</script>
			<meta http-equiv='REFRESH' content='0;url=index.php'>";	
}
	
?>