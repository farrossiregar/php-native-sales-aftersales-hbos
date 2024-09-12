<?php
include '../../config/koneksi.php';


$tipe = $_GET['tipe_mobil'];
$warna = $_GET['warna'];


$uery = mysql_query("select * from tipe_warna where kode_tipe = '$tipe' and kode_warna = '$warna' ");
$record_warna = mysql_num_rows($uery);

if ($record_warna >0){
    $hasil = mysql_fetch_array($uery); 
    $data = array(
                'harga'      =>  $hasil['harga_jual'],
                'tipe'   =>  $hasil['kode_tipe'],);
    echo json_encode($data);
    
} else {
    
    $cuery = mysql_query("select * from tipe where kode_tipe = '$tipe' ");
    
    $hasil = mysql_fetch_array($cuery); 
    $data = array(
                'harga'      =>  $hasil['harga_jual'],
                'tipe'   =>  $hasil['kode_tipe'],);
    echo json_encode($data);
}

?>