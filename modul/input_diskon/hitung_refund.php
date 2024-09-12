<?php
include '../../config/koneksi.php';
$leasing = $_GET['leasing'];
$tenor = $_GET['tenor'];
//$harga_otr = $_GET['harga_otr'];

$harga_otr=str_replace(".","",$_GET['harga_otr']);


//$leasing = 'group1'; 
//$tenor = '1tahun';
//$harga_otr = 126000000;


if ($leasing == "MBF" || $leasing == "MTF" || $leasing == "OTO MULTIARTHA" ||  $leasing == "MY BANK" ){
    $leasing = 'group1';
}
else
{
    $leasing = 'group2';
}


if ($_GET['leasing'] == "(KKB) BCA"){
    $leasing = "zzzzzzzzz";
}

$query = mysql_query("select * from rate_asuransi where group_leasing = '$leasing' and tenor = '$tenor' and ($harga_otr > harga_awal and $harga_otr <= harga_akhir) ");
//$query = mysql_query("select * from rate_asuransi where group_leasing = '$leasing' and tenor = '$tenor' and ($harga_otr > harga_awal and $harga_otr <= harga_akhir) ");
//$query = mysql_query("select * from rate_asuransi ");
$hasil = mysql_fetch_array($query);
$data = array(
            'rasio'      =>  $hasil['rasio_rate'],
            'tenor'   =>  $hasil['tenor'],);
 echo json_encode($data);
?>