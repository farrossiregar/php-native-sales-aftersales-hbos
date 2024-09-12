<?php
if (count($_POST)){
	
	$nopolisi = addslashes($_POST['nopolisi']);
	
	session_start();
	include "../../../config/koneksi_sqlserver.php";
	
	
	
	$query = "select convert(varchar,tanggal,105) as tanggal_wo ,Nomor,Keluhan,OdMeter from srvt_wo where 
			nopolisi = '$nopolisi' and batal = 0 
			union
			select convert(varchar,tanggal,105) as tanggal_wo ,Nomor,Keluhan,OdMeter from srvt_wobodyrepair where 
			nopolisi = '$nopolisi' and batal = 0 
			
			order by nomor desc ";
	
	
	$params = array();
	$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$row = sqlsrv_query( $conn, $query , $params, $options );
	
	$row_count = sqlsrv_num_rows($row);
	
	if ($row_count > 0){
		
		
	
		
		$result = sqlsrv_query($conn, $query);		
		$no = 0;
		while ($data = sqlsrv_fetch_array($result)){
		$no++;

?>
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $data['Nomor']; ?></td>
			<td><?php echo date("d-m-Y",strtotime($data['tanggal_wo'])); ?></td>
			<td><?php echo $data['Keluhan']; ?></td>
			<td><?php echo number_format($data['OdMeter'],0,",","."); ?></td>
		</tr>
<?php		
		}
		
		
	}else{
		echo "";
	}
}

?>