<?php 
	include "config/koneksi.php";
	$konfigurasi = mysql_query("select * from konfigurasi");
	$r = mysql_fetch_array($konfigurasi);
	$gjml_sabp = $r['jml_sabp'];
	$gjml_sagr = $r['jml_sagr'];
?>