

<?php 
 $id = $_POST['id_ajax'];
 $bulan = $_POST['bulan_ajax'];
 include "../../../config/koneksi.php";
 
 if ($_POST['pilihan_ajax'] == 'tipe'){
 
 
 
 $query = mysql_unbuffered_query("select a.*,t.nama_tipe from alokasi_unit_hpm a 
											left join tipe T on t.kode_tipe = a.kode_tipe
											where a.kode_model = '$id' 
										group by a.kode_tipe
										
										 ");
										
 echo "<option value = 'semua_tipe'>SEMUA TIPE</option>";
 while ($r=mysql_fetch_assoc($query)){
    echo "<option value = '$r[kode_tipe]'>$r[kode_tipe] - $r[nama_tipe]</option>";   
 }
 
 }else{
	$query = mysql_unbuffered_query("select a.*,t.nama_tipe,w.nama_warna from alokasi_unit_hpm a 
											left join tipe T on t.kode_tipe = a.kode_tipe
											left join warna w on w.kode_warna = a.kode_warna
											where a.kode_tipe = '$id' 
										group by a.kode_warna
										
										 ");
										
 echo "<option value = 'semua_warna'>SEMUA WARNA</option>";
 while ($r=mysql_fetch_assoc($query)){
    echo "<option value = '$r[kode_warna]'>$r[kode_warna] - $r[nama_warna]</option>";   
 } 
	 
 }
?>