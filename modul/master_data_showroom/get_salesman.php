<?php
	include "../../config/koneksi.php";
	$kode_spv = $_POST['kode_spv'];
	$cari_sales = mysql_query("select kode_sales from salesman where kode_supervisor = '$kode_spv'");
	while($data_cari_sales = mysql_fetch_array($cari_sales)){
?>
		 <option value="<?php echo $data_cari_sales['kode_sales']; ?>" <?php echo ($data_cari_sales['kode_sales'] == $data_cari_sales['kode_sales'] ? 'selected' : '') ?>><?php echo $data_cari_sales['kode_sales']?></option>
<?php
	}
?>