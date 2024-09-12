<?php
if (count($_POST)){
	
	$nopolisi = addslashes($_POST['nopolisi']);
	
	session_start();
	include "../../../config/koneksi_sqlserver.php";
	
	
	
	$query = "select convert(varchar,wo.tanggal,105) as tanggal_wo ,wo.Nomor as nowo,wo.Keluhan,f.saran,wo.OdMeter,wo.penerima,f.nomor,convert(varchar,f.tanggal,105) as Tanggal from srvt_wo wo
	left join srvt_faktur f on f.Nomor_WO = wo.nomor and f.batal = 0
	where wo.NoPolisi = '$nopolisi' and wo.batal = 0 
	union
	select convert(varchar,wo.tanggal,105) as tanggal_wo ,wo.Nomor as nowo,wo.Keluhan,'' as saran,wo.OdMeter,wo.penerima,f.nomor,convert(varchar,f.tanggal,105) as Tanggal from SrvT_WOBodyRepair wo
	left join srvt_fakturbodyrepair f on f.Nomor_WObody = wo.nomor and f.batal = 0
	where wo.NoPolisi = '$nopolisi' and wo.batal = 0 
	
	order by nowo desc 
	";
	
	
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$row = sqlsrv_query( $conn, $query , $params, $options );
	
	$row_count = sqlsrv_num_rows($row);
	
	if ($row_count > 0){
		
		
	
		
		$result = sqlsrv_query($conn, $query);		
		
		
		
		
?>
																	
																	
															
																

<?php		
		
		
		
		while ($data = sqlsrv_fetch_array($result)){
			
			echo "<div class='panel panel-".(substr($data['nowo'],0,2) == "GW" ? "green" : "primary" )."'>
					<div class='panel-body'><p>";
					
			echo "NO WO : ".$data['nowo'] . " / ". date("d-m-Y",strtotime($data['tanggal_wo'])) ." --- ODMETER : " .number_format($data['OdMeter'],0,",","."). " --- NO FAKTUR : ".$data['nomor']. " / ".date("d-m-Y",strtotime($data['Tanggal']))." --- SA : ".$data['penerima']."</br>"  ;
			echo "KELUHAN : ".$data['Keluhan'];
			echo (strlen($data['saran']) >= 5 ? "</br>SARAN : ".$data['saran'] : "");
			echo "</p></div></div>";
			?>
			

			<div class = "table-responsive"  >
					<table class="table table-striped table-bordered table-condensed table-hover table-full-width" style="text-align:center;" >
						<thead>
							<tr>
								<td  width="5%">No</th>
								<td align = "left" width="15%">Kode</th>
								<td width="4%" >Qty</th>
								<td align = "left" width="40%">Nama</th>
								<td align = "left" >Mekanik</th>
								
								
								
							</tr>
						</thead>
						<tbody id="detailhistory">
<?php			
			$query_detail = "select fd.Kode_Referensi,fd.Nama_Referensi,fd.Qty,fd.nama_mechanic from srvt_fakturdetail fd where nomor_faktur = '$data[nomor]'
							union
							select fd.Kode_Referensi,fd.Nama_Referensi,fd.Qty,fd.nama_mechanic from srvt_fakturbodyrepairdetail fd where nomor_fakturbody = '$data[nomor]'
			";
			
			$result_detail = sqlsrv_query($conn, $query_detail);
			$no = 0;
			while ($data_detail = sqlsrv_fetch_array($result_detail)){
				$no++;
?>
				<tr>
					<td><?php echo $no; ?></td>
					<td align = "left"><?php echo $data_detail['Kode_Referensi']; ?></td>
					<td><?php echo round($data_detail['Qty'],0); ?></td>
					<td  align = "left"><?php echo $data_detail['Nama_Referensi']; ?></td>
					<td  align = "left"><?php echo $data_detail['nama_mechanic']; ?></td>
					
				</tr>
				
<?php		
			}
			echo "</tbody>
					</table>
				</div>";
			
			
		}
		
?>
						

<?php		
	}else{
		echo "";
	}
}

?>