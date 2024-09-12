<?php 
 $id = $_POST['data_ajax'];
 
 include "config/koneksi.php";
 
 $query = mysql_unbuffered_query("select * from itemcontrol where id_kategori = '$id' ");
 
 while ($r=mysql_fetch_assoc($query)){
    echo "<option value = '$r[id_item]'>$r[nm_item]</option>";   
 }
 

?>