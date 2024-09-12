<?php 
	

		include "config/koneksi.php";
		date_default_timezone_set('Asia/Jakarta');
		
		echo date("m")-1;;
		
		
		//phpinfo();
		/* Specify the server and connection string attributes. */
		$serverName = "IT";
		 
		/* Get UID and PWD from application-specific files.  */
		$uid = "sa";
		$pwd = "fbsteam";
		$connectionInfo = array( "UID"=>$uid,
								 "PWD"=>$pwd,
								 "Database"=>"otobitz");
		 
		/* Connect using SQL Server Authentication. */
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		   if( $conn === false )
			{
				echo "Could not connect.\n";
				die( print_r( sqlsrv_errors(), true));
			}
			else {
				echo "koneksi berhasil..!";
				echo "Data Tabel Pemakai :";
				
				   
				$tsql = "select wo.nomor as no_wo,wo.Penerima,sf.Nomor as no_faktur,sf.Tanggal,f.Kode_Referensi,f.Nama_Referensi,qty from SrvT_Faktur SF 
						left join srvt_wo wo on wo.nomor = sf.Nomor_WO
						left join srvt_fakturdetail f on sf.nomor = f.Nomor_Faktur and sf.batal = 0 where convert(date,SF.Tanggal,110) >= '12-01-2017' and convert(date,SF.Tanggal,110) <= '12-31-2017'";

				$tsql = "select wo.penerima,f.Tanggal,
							CASE fd.Kode_Referensi
								 WHEN 'G-B/S004' THEN 4
								 WHEN 'G-B/S003' THEN 3
								 WHEN 'G-B/S002' THEN 2
								 WHEN 'G-B/S001' THEN 1
								 
							  END AS total_balance
							,

							Fd.* from srvt_faktur F
							left join srvt_fakturdetail FD on fd.nomor_faktur = f.nomor
							left join srvt_wo WO on wo.nomor = F.nomor_wo
																																								
							where convert(date,f.tanggal,105) >= '2017-12-01' AND convert(date,f.tanggal,105) <= '2017-12-31'
						
						and f.batal = 0 order by f.tanggal  ";

				$result = sqlsrv_query($conn, $tsql);
				
				
				$params = array();
				$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
				$stmt = sqlsrv_query( $conn, $tsql , $params, $options );

				$row_count = sqlsrv_num_rows( $stmt );
								
				echo "(".$row_count.")";
				
				
			    $no = 1;
				while($row = sqlsrv_fetch_array($result))
				{
						
							echo $no.' '.$row['penerima']."</br>" ;
							echo $no.' '.date_format($row['Tanggal'],'Y-m-d H:i:s')."</br>" ;
							echo $no.' '.$row['Nomor_Faktur']."</br>" ;
							echo $no.' '.$row['Nomor_Referensi']."</br>" ;
							echo $no.' '.$row['Kode_Referensi']."</br>" ;
							echo $no.' '.$row['Nama_Referensi']."</br>" ;
							echo $no.' '.$row['Qty']."</br>" ;
							echo $no.' '.$row['SubTotal']."</br>" ;
							
							
							
							$no++;
						
				
				
				}
			
				sqlsrv_close( $conn);       
			}
		
		/*
		$server = 'IT';
		$username = 'sa';
		$password = 'fbsteam';
		$con = sqlsrv_connect($server, $username, $password);
		if ($con) 
		{
			echo 'Berhasil konek!';
		}
		else
		{
			echo 'Koneksi GAGAL!';
		}
		
		
		//$query= mysql_query("select * from user");
		
		/*
		
		$tgl_mundur_matching = date('Y-m-d H:i:s', strtotime('-7 days'));
  
  $query_matching = mysql_query("SELECT ml.aktif,dm.norangka,dm.kode_sales,dm.kode_supervisor FROM data_mobil dm
					left join matching_local ml on ml.norangka_local = dm.norangka
					where dm.nomatching != '' and dm.tglmatching < '$tgl_mundur_matching' and dm.nofaktur = '' and ml.aktif = 'Y'");
						
  while ($data_matching = mysql_fetch_array($query_matching)){
	  $norangka = trim($data_matching['norangka']);
	  echo $norangka;
	 // echo $tgl_mundur_matching;
	  //mysql_unbuffered_query("UPDATE matching_local set aktif = 'N' where norangka_local = '$norangka' ");
	  
	  
  }
		*/
		/*
		
		
		$query = mysql_query("select * from tbpwd ");
		$username = "abdul_88";
		$len = strlen($username);
	
	
		$password = '';
		$gabuser='';
		$encrypt = '';
		for($n=0; $n<=$len;$n++){
			//echo substr($username,$n,1).' ';
			$id = substr($username,$n,1);
			
			$gabuser = $gabuser.$id;
			//echo $gabuser;
			$query = mysql_query("select * from tbpwd where enc = '$id' ");
			$data = mysql_fetch_array($query);
			
			$encrypt = $encrypt . $data['dec'];
			//echo $data['dec'];
		}
		echo $gabuser.'</br>';
		//echo substr($encrypt,0,strlen($encrypt)-1).substr($encrypt,0,strlen($encrypt)-1);
		$save = addslashes(substr($encrypt,0,strlen($encrypt)-1).substr($encrypt,0,strlen($encrypt)-1));
		echo stripslashes($save);
		
		
		mysql_unbuffered_query("insert into tespassword (hasilencrypt) values('$save') ");
	
	
	
	
	/*
	//echo "asdfsadf";
	
	$query = mysql_query("select * from pengajuan_discount_ulang 
								
	
	where tipe_mobil = ''  order by no_pengajuan ");
	
	
	while ($data = mysql_fetch_array($query)){
		$query2 = mysql_query(" select * from pengajuan_discount where no_pengajuan = '$data[no_pengajuan]' ");
		$data2 = mysql_fetch_array($query2);
		echo $data['no_pengajuan'].' '.$data2['model'].'</br>';
		
		
		$query3 = mysql_unbuffered_query(" update pengajuan_discount_ulang set model = '$data2[model]',warna = '$data2[warna]',asal_prospek = '$data2[asal_prospek]',ket_asal_prospek = '$data2[ket_asal_prospek]'
						,nama_customer = '$data2[nama_customer]',no_identitas = '$data2[no_identitas]',jenis_identitas = '$data2[jenis_identitas]',hp_customer = '$data2[hp_customer]',alamat_customer = '$data2[alamat_customer]'
						,tipe_mobil = '$data2[tipe_mobil]'

		where no_pengajuan = '$data[no_pengajuan]' ");
		
	}
	*/
	
?>
