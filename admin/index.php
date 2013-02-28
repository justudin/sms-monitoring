<?php
	include "../config/indotgl_function.php";
	include "../config/koneksi.php";
	include "../config/library.php";
	$tanggal = tgl_indo(date("Y-m-d"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Control Panel Petugas Administrasi Hotel</title>
	<link href="../css/style.css" rel="stylesheet" type="text/css" />
	<link href="../css/tcal.css" rel="stylesheet" type="text/css" />
	<link href="../css/menustyle.css" rel="stylesheet" type="text/css" />
	<link href="../css/default/calender.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/interface.js"></script>
	<script src="../js/jquery.jclock.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/tcal.js"></script>

<script type="text/javascript">
  function ajax()
  {
  if (window.XMLHttpRequest)
  {
     xmlhttp=new XMLHttpRequest();
  }
  else
  {
     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.open("GET","cari.php");
  xmlhttp.send();
  setTimeout("ajax()", 5000);
  }
  </script>
</head>
<body onload="ajax()">
<div id="konten">
	<div id="header">
		<div id="navigation">
			<ul>
            	<?php include "menu.php";?>
				
			</ul>
		</div> 
	</div>
	<div id="jam"><?php echo $hari_ini.", ".$tanggal; ?></div>
		<div id="isi">
			<?php include "konten.php"; ?> 
		</div>
</div>

</body>	
<?php include "footer.php"; ?>
</html>