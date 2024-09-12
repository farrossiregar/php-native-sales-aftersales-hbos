<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=booking_stock_(".$_GET['tgl_awal'].")_sd_(".$_GET['tgl_akhir'].").xls");

?>

<?php
include "../config/koneksi.php";

	$qry="SELECT norangka,nomesin,harga_jual,tahun_buat,tglbeli,nopenjualan,tglmatching,kode_model,nama_model,kode_tipe,nama_tipe,kode_warna,nama_warna
						    ,kode_sales,nama_sales,nomatching,nofaktur,status,ml.norangka_local,ml.nama_sales_local,ml.tgl,ml.nounique,ml.fix,ml.user,ml.no_spk_local,ml.nama_customer_local,ml.jenis_pembayaran_local
						    FROM data_mobil dm
						
						    left join matching_local ml on ml.norangka_local = dm.norangka 
						    
						    
						    where ml.aktif='Y' and dm.nomatching=''
						    ";
							
	$sql=mysql_query("$qry and ml.tgl >= '$_GET[tgl_awal]' and ml.tgl <= '$_GET[tgl_akhir]' order by ml.tgl desc");

?>

                        <table  class="table table-striped table-bordered table-hover table-full-width">
                    		<thead>
                    			<tr>
									<th>Tipe Mobil</th>
									<th>Booked By</th>
									<th>Booking For</th>
									<th>No SPK</th>
									<th>Customer</th>
									<th>Jenis Pembayaran</th>
									<th>Tgl Booking</th>
									<th>No. Rangka</th>
									<th>No. Mesin</th>
									<th>Warna</th>
									<th>Tahun</th>
								</tr>
                    		</thead>
							
                            <tbody>
							
							<?php
								while($data = mysql_fetch_array($sql)){
									$jenispembayaranlocal = "$data[jenis_pembayaran_local]";
                            	$nospk_local = "$data[no_spk_local]";
                            	$namacustomer_local = "$data[nama_customer_local]";
                                $jenispembayaran=$jenispembayaranlocal;
    							    if($jenispembayaran=="1") {
    								    $jenispembayaran="Kredit"; 
    									}
    								if($jenispembayaran=="2") {
    									$jenispembayaran="Tunai"; 
    									}
    								if($jenispembayaran=="3") {
    								    $jenispembayaran="GSO"; 
    									}
    							$no_spklocal=$nospk_local;
    							    if($no_spklocal=="") {
    								    $no_spklocal="<b class='blink'>No SPK Belum di Input</b>"; 
    									}
    								if($no_spklocal=="-") {
    								    $no_spklocal="<b class='blink'>No SPK Belum di Input</b>"; 
    									}
    								if($no_spklocal!=="") {
    									$no_spklocal="$no_spklocal"; 
    									}
    							$nama_customerlocal=$namacustomer_local;
    							    if($nama_customerlocal=="") {
    								    $nama_customerlocal="<b>Belum di Input</b>"; 
    									}
    								if($nama_customerlocal=="-") {
    								    $nama_customerlocal="<b>Belum di Input</b>"; 
    									}
    								if($nama_customerlocal!=="") {
    									$nama_customerlocal="<b>Customer : $nama_customerlocal</b>"; 
    									}
						    
    						?>
							<?php $tampilmodel=mysql_query("SELECT * FROM data_mobil WHERE norangka='$data[norangka_local]'");
                            	$tampilkan=mysql_fetch_array($tampilmodel);
                            ?>
                            <?php $tampilnama=mysql_query("SELECT * FROM users WHERE username='$data[user]'");
								$nama=mysql_fetch_array($tampilnama);
                            ?><br />
                            			
								<tr>
									<td><?php echo $data['nama_tipe']; ?></td>
									<td><?php echo $nama['nama_lengkap']; ?></td>
									<td><?php echo $data['nama_sales_local']; ?></td>
									<td><?php echo $no_spklocal; ?></td>
									<td><?php echo $nama_customerlocal; ?></td>
									<td><?php echo $jenispembayaran; ?></td>
									<td><?php echo $data['tgl']; ?></td>
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