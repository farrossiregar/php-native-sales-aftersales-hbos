<?php 
if (isset($_GET['data_ajax'])){

session_start();
include "../../../config/koneksi_sqlserver.php";
include "../../../config/koneksi.php";

$id = addslashes($_GET['data_ajax']);
	$quer = mysql_query("select * from `pemasangan_aksesoris` where no_spk='$id'");
	$j = mysql_fetch_array($quer);

?>
					
					<table class="table table-bordered table-hover" id="sample-table-1">
					
						<tbody>
						
							<tr class="warning">
								<td>No Form</td>
								<td><?php echo $j['no_permohonan']; ?></td>
							</tr>
							<tr class="info">
								<td>No Spk</td>
								<td><?php echo $j['no_spk'];?></td>
							</tr>
							<tr class="warning">
								<td>Nama Sales</td>
								<td><?php echo $j['nama_sales']; ?></td>
							</tr>
							<tr class="info">
								<td>Nama Customer</td>
								<td><?php echo $j['nama_customer'];?></td>
							</tr>
							<tr class="warning">
								<td>Model</td>
								<td><?php echo $j['model']; ?></td>
							</tr>
							<tr class="info">
								<td>No Rangka</td>
								<td><?php echo $j['no_rangka'];?></td>
							</tr>
							<tr class="warning">
								<td>No Mesin</td>
								<td><?php echo $j['no_mesin']; ?></td>
							</tr>
							<tr class="info">
								<td>Tahun Buat</td>
								<td><?php echo $j['tahun_buat'];?></td>
							</tr>
							<tr class="warning">
								<td>Tgl Unit Keluar</td>
								<td><?php echo $j['tgl_unit_keluar']; ?></td>
							</tr>
						
						</tbody>
					
					</table>
<?php } ?>