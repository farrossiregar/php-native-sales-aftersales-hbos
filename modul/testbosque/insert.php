<?php
include "../../config/koneksi.php";
if(isset($_POST['btnSiswa'])){
//hitung jumlah form yang dikirim
$jumlah = count($_POST['bulan']);

echo "<h1>Cetak semua form</h1>";
for($i=0; $i<$jumlah; $i++){
$urut = $i+1;
$bulan = $_POST['bulan'][$i];
$model = $_POST['model'][$i];
//jika mau dimasukkan ke databases, silahkan buat query anda disini
echo $urut." ".$bulan ." ".$model."<br />";
}

echo "<h1>Khusus NIM dan Nama yang tidak kosong</h1>";
//jika hanya akan memproses data yang nim dan namanya tidak kosong
for($a=0; $a<$jumlah; $a++){
$urut = $a+1;
$bulan = $_POST['bulan'][$a];
$model = $_POST['model'][$a];
if(trim($bulan) !="" and trim($model) !=""){
//jika mau dimasukkan ke databases, silahkan buat query anda disini
echo $urut." ".$bulan ." ".$model."<br />";
}
}
}
?>