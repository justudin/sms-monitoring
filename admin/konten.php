<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/class_paging.php";
include "../config/function.php";


$mod=$_GET['mod'];
switch($mod){
//menu default [home]
default:
	echo "<h1>Selamat Datang</h1>
          ";
	break;
//menu Inbox
case 'inbox':
	include "mod/inbox/inbox.php";
	break;
//Menu data file
case 'files':
	include "mod/files/files.php";
	break;
//Menu history
case 'history':
	include "mod/history/history.php";
	break;
}

?>