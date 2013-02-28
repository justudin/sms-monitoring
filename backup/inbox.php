<html>
<head>
<title>SMS Server Running...</title>
<head>
<!-- refresh script setiap 30 detik -->
<meta http-equiv="refresh" content="1; url=<?php $_SERVER['PHP_SELF']; ?>">
</head>
<body>
<?php
// koneksi ke database Gammu
include "config/koneksi.php";
//query tampilkan inbox
 $query="select * from inbox order by ID";
 $hasil=mysql_query($query);
echo "<table>";
 while($data=mysql_fetch_array($hasil)){
	echo"<tr><td>".$data["SenderNumber"];
	echo "</td><td>".$data["TextDecoded"]."</td></tr>";	
	}
echo "</table>";
?>
</body>
</html>
