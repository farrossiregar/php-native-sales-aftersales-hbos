<?php 
if (count($_GET)){
	session_start();
	include "../../../config/koneksi_sqlserver.php";
	include "../../../config/koneksi.php";

	$type = $_GET['type'];
	$id = mysql_real_escape_string($_GET['data_ajax']);
	switch($type){
		case "kuota":
			
			$query = mysql_query("select no_puk from unit_keluar where date(waktu_keluar) = '$id'");
			$data = mysql_num_rows($query);
			echo $data;
		break;
		
		case "listspk":
		
		?>
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Pilih Data</h4>
					</div>
					<div class="modal-body">
					
						<div class = "table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th colspan = "2">
											<input type="text" class="form-control" name="search" id="search" onkeyup="cari_data()" autofocus>
										</th>
										
									</tr>
								</thead>
								<tbody id="isi_data">
									
									<?php
										$query_salesman = mysql_query("select * from users where username = '$_SESSION[username]'");
										$kode_sales = mysql_fetch_array($query_salesman);
										
										if ($_SESSION['leveluser'] == 'admin' || $_SESSION['leveluser'] == 'MNGR'){
											$filter = "";
										}else{$filter = "and kode_sales = '$kode_sales[kode_sales]'"; }
										
										$query = "select SPK.NomorSPK,SPK.NamaCustomer from vw_PukSOS SPK
												where SPK.NoBSTK = '-' and SPK.norangka !='-' $filter ";
										$query = sqlsrv_query($conn, $query);
										$n=0;
										while($data = sqlsrv_fetch_array($query)){
											
										$n=$n+1;
										
										$query_puk = mysql_query("select * from unit_keluar where no_spk = '$data[NomorSPK]'");
										if (mysql_num_rows($query_puk) < 1){
									?>
				
									<tr id="tr" style="cursor: pointer; ">
										<td id="td" name="td<?php echo $n; ?>" data-dismiss="modal" onclick="post();" value="">
											<?php echo $data['NomorSPK']; ?>
										</td>
										<td data-dismiss="modal" onclick="post();"><?php echo $data['NamaCustomer']; ?> </td>
									</tr>
									<?php
										}}
									?>
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
		<?php break;
			
		case "pembayaran":
			

			$query = "select * from vw_SUB_StatusKendaraanPerSPKHistoryKwitansi where NomorPesanan = '$id' order by JenisKwitansi desc";
							$query = sqlsrv_query($conn, $query);
							
							$dokumenpj = "";
							$totalpj = 0;
							$no = 1;
							$n = 0;
						$total = 0;
				while ($data = sqlsrv_fetch_array($query)){
						
					$pembayaran = number_format($data['NilaiPenerimaan'],0,".",".");
					if($id != ''){
						echo  "
						<div class='form-group'
							<label class='control-label'>
									".($data['JenisKwitansi'] == "Uang Muka" ? "Uang Muka" : ($data['JenisKwitansi'] == "Pelunasan" ? "Pelunasan" : ($data['JenisKwitansi'] == "Accessories PJ" ? "Aksesoris" : ($data['JenisKwitansi'] == "Asuransi PJ" ? "Asuransi" : "Dokumen PJ" ) )))." 
							</label>
								<div class='input-group'>
									<span class='input-group-addon'>Rp</span>
									<input type='text' placeholder='' class='form-control' value='$pembayaran' id='dp$n' name='dp$n' required readonly>
									</input>
								</div>
						</div>";
						$total = $total + $data['NilaiPenerimaan'];
					}
					
						
					
					$n++;
				}
				echo  "
						<div class='form-group'
							<label class='control-label'>
									Total
							</label>
								<div class='input-group'>
									<span class='input-group-addon'>Rp</span>
									<input type='text' placeholder='' class='form-control' value='".number_format($total,0,".",".")."' id='dp$n' name='dp$n' required readonly>
									</input>
								</div>
						</div>";
		
		break;
		case "tampildata":
			$query = "select SPK.* from vw_PukSOS SPK
				

				 where SPK.NoBSTK = '-' and NomorSPK = '$id'";
			$query = sqlsrv_query($conn, $query);
			while($data = sqlsrv_fetch_array($query)){
			
				$no_spk = $data['NomorSPK'];
				$namacustomer = $data['NamaCustomer'];
				
				
				
				echo $no_spk."--".$namacustomer."--".$data['NamaTipe']."--".$data['NamaWarna']."--".$data['JenisPenjualan'].
				"--".$data['NoRangka']."--".$data['NoMesin']."--".$data['lamaangsuran']."--".$data['Diskon']."--".$data['NamaLeasing'];
			}
		
		break;
	}

}
?>
							