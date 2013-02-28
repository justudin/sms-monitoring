<?php
function header_excel($namaFile) {
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0,
            pre-check=0");
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // header untuk nama file
    header("Content-Disposition: attachment;
            filename=" . $namaFile . "");
    header("Content-Transfer-Encoding: binary ");
}

function format_rupiah($angka)
{
  $rupiah = "Rp. ".number_format($angka,0,',','.');
  return $rupiah;
}

function nota($value) {

    $value = $value + 1;
    $jml = strlen($value);
    if ($jml == 1) $no = "NT0000".$value;
    else if ($jml == 2) $no = "NT000".$value;
    else if ($jml == 3) $no = "NT00".$value;
    else if ($jml == 4) $no = "NT0".$value;
	else if ($jml == 5) $no = "NT".$value;
    return $no;
}

function hitungTanggal($tgl){
	$pecah1 = explode("-", $tgl);
	$tgl1 = $pecah1[2];
	$bln1 = $pecah1[1];
	$thn1 = $pecah1[0];
	
	$jeda = GregorianToJD($bln1, $tgl1, $thn1);
	return $jeda;
}

?>
