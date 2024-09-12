

<?php 
if (count($_POST)){
 $id = $_POST['data_ajax'];
 
 include "../../../../config/koneksi.php";
 
	$query = mysql_unbuffered_query("select * from varian_warna where kode_tipe = '$id' order by kode_warna asc");
  
 echo "<option value = ''>PILIH WARNA</option>";
 while ($r=mysql_fetch_assoc($query)){
	 $nama_warna = strtoupper($r[nama_warna]);
    echo "<option value = '$r[kode_warna]'>$nama_warna</option>";   
 }
 
}
?>