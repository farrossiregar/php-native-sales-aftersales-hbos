<?php 
session_start();
include "../../../config/koneksi_sqlserver.php";

$id = $_POST['data'];

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
?>
							