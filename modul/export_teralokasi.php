<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=stock_teralokasi_(".$_GET['tgl_awal'].")_sd_(".$_GET['tgl_akhir'].").xls");

?>

<?php
include "../config/koneksi.php";

	$qry="SELECT norangka,nomesin,harga_jual,tahun_buat,tglbeli,nopenjualan,tglmatching,kode_model,nama_model,kode_tipe,nama_tipe,kode_warna,nama_warna
						    ,kode_sales,nama_sales,kode_supervisor,nomatching,nofaktur,status
						    FROM data_mobil
						    where nomatching!='' and nofaktur=''
						    ";
							
	$sql=mysql_query("$qry and tglmatching >= '$_GET[tgl_awal]' and tglmatching <= '$_GET[tgl_akhir]' order by tglmatching desc");

?>

                        <table  class="table table-striped table-bordered table-hover table-full-width">
                    		<thead>
                    			<tr>
									<th>Tipe Mobil</th>
									<th>Kode Sales</th>
									<th>Nama Sales</th>
									<th>Kode Supervisor</th>
									<th>Tgl Teralokasi</th>
									<th>No. Rangka</th>
									<th>No. Mesin</th>
									<th>Warna</th>
									<th>Tahun</th>
								</tr>
                    		</thead>
							
                            <tbody>
							
							<?php
								while($data = mysql_fetch_array($sql)){
						    
    						?>
						
								<tr>
									<td><?php echo $data['nama_tipe']; ?></td>
									<td><?php echo $data['kode_sales']; ?></td>
									<td><?php echo $data['nama_sales']; ?></td>
									<td><?php echo $data['kode_supervisor']; ?></td>
									<td><?php echo $data['tglmatching']; ?></td>
									<td><?php echo $data['norangka']; ?></td>
									<td><?php echo $data['nomesin']; ?></td>
									<td><?php echo $data['nama_warna']; ?></td>
									<td><?php echo $data['tahun_buat']; ?></td>
								</tr>
								<?php
									}
								?>		
							</tbody>
                        </table>