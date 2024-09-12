

<?php 
 $id = $_POST['data_ajax'];
 
 include "config/koneksi.php";
 
 $query = mysql_unbuffered_query("select * from data_mobil where nopenjualan = '' and data_mobil.kode_model = '$id' group by kode_tipe");
 echo "<option value = 'semua_tipe'>SEMUA TIPE</option>";
 while ($r=mysql_fetch_assoc($query)){
    echo "<option value = '$r[kode_tipe]'>$r[kode_tipe] - $r[nama_tipe]</option>";   
 }
 

?>