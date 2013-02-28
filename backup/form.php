<h1>Kirim SMS</h1>
<form method="post" action="send.php">
 Nomor HP Tujuan<br>
 <input type="text" name="nohp"><br><br>
 Isi SMS<br>
 <textarea name="sms" cols="50" rows="10"></textarea><br><br>
<br>Jumlah sms 
<input type="text" size="4" name="jumlahsms" value="1"><br><br>
 Format SMS<br>
 <input type="radio" name="format" value="flash"> Flash SMS <br>
 <input type="radio" name="format" value="normal"> Normal SMS <br><br>
 <input type="submit" name="submit" value="Kirim SMS">
 </form>
