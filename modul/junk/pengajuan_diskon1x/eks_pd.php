<?php
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
//header("Content-Disposition: attachment; filename=pengajuan_discount.xls");

?>

<?php
include "../../config/koneksi.php";

	$qry="select t.nama_tipe as nama_tipe, w.nama_warna as nama_warna, m.nama_model as nama_model ,pd.* from pengajuan_discount pd 
                                            			left join tipe t on t.kode_tipe=pd.tipe_mobil
                                            			left join model m on m.kode_model=pd.model
                                            			left join warna w on w.kode_warna=pd.warna ";

	if ($_GET['status_approved'] == ''){
        $sql=mysql_query("$qry where pd.waktu >='$_GET[tgl_awal]' and pd.waktu <='$_GET[tgl_akhir]' order by pd.no_pengajuan desc");
		header("Content-Disposition: attachment; filename=pengajuan_discount_semua_data_".$_GET['tgl_awal']."-s/d-".$_GET['tgl_akhir'].".xls");
	}else{
        if ($_GET['status_approved']=='B')
        {
			$sql=mysql_query("$qry where proses_approve='N' and pd.waktu >='$_GET[tgl_awal]' and pd.waktu <='$_GET[tgl_akhir]' order by pd.no_pengajuan desc ");	
			header("Content-Disposition: attachment; filename=pengajuan_discount_belum_diproses_".$_GET['tgl_awal']."-s/d-".$_GET['tgl_akhir'].".xls");			
        }
		elseif($_GET['status_approved']=="T"){
			$sql=mysql_query("$qry where status_approved='Y' and (no_spk='' and status_spk !='N' ) and pd.waktu >='$_GET[tgl_awal]' and pd.waktu <='$_GET[tgl_akhir]' and proses_approve='Y' order by pd.no_pengajuan desc");
			header("Content-Disposition: attachment; filename=pengajuan_discount_belum_spk_".$_GET['tgl_awal']."-s/d-".$_GET['tgl_akhir'].".xls");
		}
		elseif($_GET['status_approved']=="GASPK"){
			$sql=mysql_query("$qry where status_approved='Y' and (status_spk='N') and pd.waktu >='$_GET[tgl_awal]' and pd.waktu <='$_GET[tgl_akhir]' and proses_approve='Y' order by pd.no_pengajuan desc");
			header("Content-Disposition: attachment; filename=pengajuan_discount_tidak_spk_".$_GET['tgl_awal']."-s/d-".$_GET['tgl_akhir'].".xls");
		}
		elseif($_GET['status_approved']=="Y"){
			$sql=mysql_query("$qry where status_approved='Y' and proses_approve='Y' and pd.waktu >='$_GET[tgl_awal]' and pd.waktu <='$_GET[tgl_akhir]' order by pd.no_pengajuan desc");
			header("Content-Disposition: attachment; filename=pengajuan_discount_diproses_disetujui_".$_GET['tgl_awal']."-s/d-".$_GET['tgl_akhir'].".xls");
		}
		elseif($_GET['status_approved']=="N"){
			$sql=mysql_query("$qry where status_approved='N' and proses_approve='Y' and pd.waktu >='$_GET[tgl_awal]' and pd.waktu <='$_GET[tgl_akhir]' order by pd.no_pengajuan desc");
			header("Content-Disposition: attachment; filename=pengajuan_discount_diproses_tidak_setuju_".$_GET['tgl_awal']."-s/d-".$_GET['tgl_akhir'].".xls");
		}
		else{
			$sql=mysql_query("$qry where status_approved='AL' and pd.waktu >='$_GET[tgl_awal]' and pd.waktu <='$_GET[tgl_akhir]' order by pd.no_pengajuan desc");
			header("Content-Disposition: attachment; filename=pengajuan_discount_diajukan_direktur_".$_GET['tgl_awal']."-s/d-".$_GET['tgl_akhir'].".xls");
		}
	}
?>

                        <table  class="table table-striped table-bordered table-hover table-full-width">
                    		<thead>
                    			<tr>
									
									<th>No. Pengajuan</th>
									<th>No SPK</th>
									<th>Nama Sales</th>
									<th>Nama Customer</th>
									<th>Model</th>
									<th>Tipe Mobil</th>
									<th>Warna Mobil</th>
									<th>Harga OTR</th>
									<th>Plafon Diskon</th>
									<th>Pengajuan Diskon Bruto</th>
									<th>Keterangan Diskon</th>
									<th>Total Diskon Aksesoris</th>
									<th>Refund</th>
									<th>Pengajuan Diskon Netto</th>
									<th>Metode Pembayaran</th>
									<th>Leasing</th>
									<th>Tenor</th>
									<th>Pemohon</th>
								</tr>
                    		</thead>
                            <tbody>
											
							<?php
					
								    //$sql = mysql_query("$kueri");
								    //$sql = $data;
									//if(mysql_num_rows($sql) > 0){
									//$no = $posisi+1;
									while($data = mysql_fetch_array($sql)){
						           // $no_spk = $data['no_spk'];
						           // $statapp = $data['status_approved'];
						           // $proses_approve = $data['proses_approve'];
						           // $tombollogin = $_SESSION['leveluser'];
						                        
									//$harga_otr = "Rp ".number_format("$data[harga_otr]",0,".",".");
									//$discount_unit = "Rp ".number_format("$data[discount_unit]",0,".",".");
												
									//$total_discount = "Rp ".number_format("$data[total_discount]",0,".",".");
									//$disc_approved = "Rp ".number_format("$data[disc_approved]",0,".",".");
									//$refund = "Rp ".number_format("$data[refund]",0,".",".");
									
									$disc_bruto1 = $data['pengajuan_disc']+$data['total_discount_accs'];
						            $disc_bruto = "Rp ".number_format("$disc_bruto1",0,".",".");
									
						            //$plafondisc=$data[discount_unit];
									  
						            //$tombol=$tombollogin;
    						?>
						
								<tr>
									
									<td><?php echo $data['no_pengajuan']; ?></td>
									<td><?php echo $data['no_spk']; ?></td>
									<td><?php echo $data['nama_sales']; ?></td>
									<td><?php echo $data['nama_customer']; ?></td>
									<td><?php echo $data['nama_model']; ?></td>
									<td><?php echo $data['nama_tipe']; ?></td>
									<td><?php echo $data['nama_warna']; ?></td>
									<td><?php echo $data['harga_otr']; ?></td>
									<td><?php echo $data['discount_unit']; ?></td>
									<td><?php echo $disc_bruto1; ?></td>
									<td><?php echo $data['ket_discount']; ?></td>
									<td><?php echo $data['total_discount_accs']; ?></td>
									<td><?php echo $data['refund']; ?></td>
									<td><?php echo $data['total_discount']; ?></td>
									<td><?php echo $data['cara_beli']; ?></td>
									<td><?php echo $data['leasing']; ?></td>
									<td><?php echo $data['tenor']; ?></td>
									<td><?php echo $data['pemohon']; ?></td>
								</tr>
								<?php
									}
								?>
											
							</tbody>
                        </table>