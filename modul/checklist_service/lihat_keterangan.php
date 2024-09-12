<?php
	include "../../config/koneksi_service.php";
	
	$no = $_POST['data_ajax'];
	$query = mysql_unbuffered_query("SELECT * FROM pengecekan_service_detail where no = '$no'");
		while($r = mysql_fetch_array($query)){
			/*	$id = $r['no'];
				$no_pengecekan = $r['no_pengecekan'];
				$catatan_pengecekan = $r['catatan_pengecekan'];
				$keterangan_catatan_pengecekan = $r['keterangan_catatan_pengecekan'];
		echo $id.','.$no_pengecekan.','.$catatan_pengecekan.','.$keterangan_catatan_pengecekan;	*/
	
?>
			<table class="table table-bordered table-hover" id="sample-table-1">
				<tbody>
					
							<?php 
								if ($r['hasil']  == "Y"){
									echo
									"<tr class='info'>
											<td><center>
												<i class='fa fa-check fa-4x text-success' ></i><br>
											<center></td>
										</tr>";
									
								}else{
									echo "
										<tr class='warning'>
											<td><center>
												<i class='fa fa-close fa-4x text-danger'></i><br>
											<center></td>
										</tr>";
									
								}
							?>
					<tr>
						<td></td>
					</tr>	
					<tr class="info">
						<td><b>Kategori Penilaian : </b><b><?php echo strtoupper($r['kategori_penilaian']); ?><b></td>
					</tr>
					<tr class="warning">
						<td><b>Nama Penilaian : </b><?php echo $r['nama_penilaian']; ?></td>
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
