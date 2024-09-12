<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=".$_GET['status_spk'].".xls");

if($_GET['status_spk']=='out_spk'){
	$filter = " and po.tglfakturnaik = '' ";
}
if($_GET['status_spk']=='out_do'){
	$filter = " and po.norangka != '' ";
}
?>

<?php
include "../../config/koneksi.php";

	$qry="select po.*,t.nama_tipe,w.nama_warna from pesanan_kendaraan_outstanding po 
	left join tipe t on t.kode_tipe = po.kode_tipe 
	left join warna w on w.kode_warna = po.kode_warna where po.kode_spv != 'OFFCE' $filter order by po.kode_spv, po.tanggal
						    ";
							
	$sql=mysql_query("$qry");
	
	
	

?>

                        <table  class="table table-striped table-bordered table-hover table-full-width">
                    		<thead>
                    			<tr>
									<th>SPV</th>
									<th>SALES</th>
									<th>NO SPK</th>
									<th>TGL SPK</th>
									<th>NAMA CUSTOMER</th>
									<th>NO RANGKA</th>
									<th>TGL FAKTUR</th>
									<th>PEMBAYARAN</th>
									<th>TIPE</th>
									<th>WARNA</th>
								</tr>
                    		</thead>
							
                            <tbody>
							
							<?php
								while($data = mysql_fetch_array($sql)){
									
									
									
									$query_status_spk = mysql_query("select * from status_spk where no_spk = '$data[no_spk]' ");
									$dtspk = mysql_fetch_array($query_status_spk);
									$no_spk = trim($dtspk['no_spk']);
									$no_penjualan = trim($dtspk['no_penjualan']);
									
									$query_kwitansi = mysql_query("select sum(nilaipenerimaan) as nilaipenerimaan from kwitansi_pesanan_kendaraan where noreferensi in('$no_spk','$no_penjualan') ");
									$data_kwitansi = mysql_fetch_array($query_kwitansi);
									
									
									$nilai_penerimaan = $data_kwitansi['nilaipenerimaan'];
						    
    						?>
						
								<tr>
									<td><?php echo $data['kode_spv']; ?></td>
									<td><?php echo $data['kode_sales']; ?></td>
									<td><?php echo $data['no_spk']; ?></td>
									<td><?php echo date('d-m-Y',strtotime($data['tanggal'])); ?></td>
									<td><?php echo $data['nama_customer']; ?></td>
									<td><?php echo $data['norangka']; ?></td>
									<td><?php echo $data['tglfakturnaik']; ?></td>
									<td><?php echo $nilai_penerimaan; ?></td>
									<td><?php echo $data['nama_tipe']; ?></td>
									<td><?php echo $data['nama_warna']; ?></td>
								</tr>
								<?php
									}
								?>		
							</tbody>
                        </table>