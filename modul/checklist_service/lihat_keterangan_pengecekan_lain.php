<?php
	include "../../config/koneksi_service.php";
	
	$no = $_POST['data_ajax'];
	$query = mysql_unbuffered_query("SELECT * FROM pengecekan_service_detail_lain where no = '$no'");
		while($r = mysql_fetch_array($query)){

?>
			<table class="table table-bordered table-hover" id="sample-table-1">
				<tbody>
					
					<tr>
						<td></td>
					</tr>	
					
					<tr class="info">
						<td><b>Catatan Pengecekan : </b><?php echo $r['catatan_pengecekan']; ?></td>
					</tr>
					<tr class="warning">
						<td><b>Keterangan Catatan Pengecekan : </b><?php echo $r['keterangan_catatan_pengecekan']; ?></td>
					</tr>
				</tbody>
			</table>
<?php
		}
?>
