<?php
include "../config/koneksi.php";
session_start();
$norangka_lok = $_GET['id'];

mysql_query("update matching_local set aktif = 'N' where norangka_local = '{$_GET['id']}'");




        				  
$data_mobil = mysql_query("select * from data_mobil where norangka = '$norangka_lok' and nomatching = ''");
$data_mobil_array = mysql_fetch_array($data_mobil);
mysql_query("update data_mobil set bisabooking = 'N' where kode_tipe = '{$data_mobil_array['kode_tipe']}' and kode_warna = '{$data_mobil_array['kode_warna']}'");

mysql_query("update data_mobil set reserved = 'N',fixbooked = 'N',bisabooking = 'Y' where norangka = '$norangka_lok'");

header('location:../media_showroom.php?module=sub_transaksi_stock');

?>