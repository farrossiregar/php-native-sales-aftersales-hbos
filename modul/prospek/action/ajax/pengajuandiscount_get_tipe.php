

<?php 
if (count($_POST)){
 $id = $_POST['data_ajax'];
 
 include "../../../../config/koneksi.php";
 
 $query = mysql_unbuffered_query("select * from tipe where kode_model = '$id'");
 echo "<option value = ''>PILIH TIPE</option>";
 while ($r=mysql_fetch_assoc($query)){
    echo "<option value = '$r[kode_tipe]'>$r[kode_tipe] - $r[nama_tipe]</option>";   
 }
 
 

}
?>