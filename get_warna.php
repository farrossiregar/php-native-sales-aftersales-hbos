

<?php 
 $id = $_POST['data_ajax'];
 
 include "config/koneksi.php";
 
 $query = mysql_unbuffered_query("select * from data_mobil where nopenjualan = '' and data_mobil.kode_tipe = '$id' group by nama_warna");
 echo "<option value = 'semua_warna'>SEMUA WARNA</option>";
 while ($r=mysql_fetch_assoc($query)){
    echo "<option value = '$r[kode_warna]'>$r[nama_warna]</option>";   
 }
 

?>