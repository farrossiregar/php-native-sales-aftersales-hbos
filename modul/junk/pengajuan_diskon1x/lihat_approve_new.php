<style type = "text/css">
	.tb-bawah {
	//text-align:right;
	border-bottom: 1px solid #abab9e;
    border-bottom-width: 1px;
    border-bottom-style: solid;
    //padding:7px 5px 7px 0;
	
	}
	.tb-bawah td{padding:5px 0px 5px 7px;}
</style>
<!-- Large Modal -->
		<div class="modal fade tampil<?php echo $no; ?>" id = "modal_pengajuan<?php echo $no; ?>"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">Detail Pengajuan </h4>
					</div>
					<div class="modal-body">
					
					
					
					<div class="panel panel-primary">
												
												<div class="panel-body">
													
															No Pengajuan : <?php echo $data[no_pengajuan] ?> <br/>
						
						Sales : <?php echo $data[pemohon] ?><br/>
						Status :  <?php echo ($data[proses_approve] == "Y" ? ( $data[status_approved] == "Y" ? "Di Setujui " : ($data[status_approved] == "N" ? "Tidak Disetujui" : "Menunggu Persetujuan BOD"   )) : "Belum Diproses" );   ?>
						<?php echo ($data[ket_approve] != "" ? "<br/>Catatan : $data[ket_approve] " : ""); ?>
						<?php echo ($data[status_spk] == "N" ? "<br/><font color='orange'>Tidak SPK </font></br> Catatan : $data[ket_tidakspk]"  : ""  ); ?>
													
												</div>
											</div>
					
					
					<?php $query_pengajuan_ulang = mysql_query("SELECT pd.*,t.nama_tipe,m.nama_model,w.nama_warna FROM pengajuan_discount_ulang  pd
																	left join tipe t on t.kode_tipe = pd.tipe_mobil
																	left join model m on pd.model = m.kode_model
																	left join warna w on w.kode_warna = pd.warna where pd.no_pengajuan = '$data[no_pengajuan]' order by nomor ");
						$rec_pu = mysql_num_rows($query_pengajuan_ulang);
						if ($rec_pu > 0 ) {
					?>
					
					
					<div class="panel panel-white collapses" style = "background:#e8e8e8;" id="panel5">
						<a data-original-title="Tampilkan" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
						<div class="panel-heading">
							<h4 class="panel-title text-primary">Pengajuan Awal</h4>
							<div class="panel-tools">
								<a data-original-title="Tampilkan" data-toggle="tooltip" data-placement="top" class="btn btn-transparent btn-sm panel-collapse" href="#"><i class="ti-minus collapse-off"></i><i class="ti-plus collapse-on"></i></a>
							</div>
						</div>
						</a>
						<div class="panel-body" style="display: none;">
						<?php } ?>		
								<table class="table table-bordered table-striped table-hover" id="sample-table-1">
									<tbody>
										
										<tr class="warning">
											<td>No SPK</td>
											<td><?php echo $data['no_spk'] ?></td>
										</tr>
										<tr class="info">
											<td>Nama Sales</td>
											<td><?php echo $data['nama_sales'] ?></td>
										</tr>
										<tr class="warning">
											<td>Nama Customer</td>
											<td><?php echo $data['nama_customer'] ?></td>
										</tr>
										<tr class="info">
											<td>Hp Customer</td>
											<td><?php echo $data['hp_customer'] ?></td>
										</tr>
										<tr class="warning">
											<td>Jenis Identitas</td>
											<td><?php echo $data['jenis_identitas'] ?></td>
										</tr>
										<tr class="info">
											<td>Nomor Identitas</td>
											<td><?php echo $data['no_identitas'] ?></td>
										</tr>
										<tr class="warning">
											<td width = "50%">Alamat Customer</td>
											<td><?php echo $data['alamat_customer'] ?></td>
										</tr>
										<tr class="info">
											<td>Asal Prospek</td>
											<td><?php echo $data['asal_prospek'] . ($data['ket_asal_prospek'] != "" ? " - $data[ket_asal_prospek]" : "" ) ?></td>
										</tr>
										<tr class="warning">
											<td>Asuransi</td>
											<td><?php echo ($data['ikut_asuransi'] == "Y" ? "IKUT ASURANSI" : ($data['ikut_asuransi'] == "" ? "" : "TIDAK ASURANSI")).($data['ikut_asuransi'] == "Y" ? " - $data[asuransi]" : "") ; ?></td>
										</tr>
											<tr class="info">
											<td>Model / Tahun </td>
											<td><?php echo $data['nama_model'].' / '.$data['tahun_buat'] ?> </td>
										</tr>
										<tr class="warning">
											<td>Tipe Mobil</td>
											<td> <?php echo $data['tipe_mobil'] ." - $data[nama_tipe]" ?></td>
										</tr>
										<tr class="info">
											<td>Warna Mobil</td>
											<td> <?php echo $data['nama_warna'] ?></td>
										</tr>
										<tr class="warning">
											<td>Harga OTR</td>
											<td><?php echo "$harga_otr"; ?></td>
										</tr>
										<tr class="success">
											<td>Program Delaer</td>
											<td><?php echo $data['promo_dealer']; ?></td>
										</tr>
										<tr class="danger">
											<td><b>Plafon Diskon</b></td>
											<td><b><?php echo "$discount_unit"; ?></b></td>
										</tr>
										
										<tr class="info">
											<td>Pengajuan Diskon</td>
											<td><?php $pengajuan_disc = "Rp ".number_format("$data[pengajuan_disc]",0,".","."); echo $pengajuan_disc ?></td>
										</tr>
										
										<tr class="warning">
											<td>Total Diskon Aksesoris</td>
											<td><?php echo $total_discount_accs = "Rp ".number_format("$data[total_discount_accs]",0,".","."); $total_discount_accs ?></td>
										</tr>
										<tr class="danger">
											<td><b>Total Diskon Bruto</b></td>
											<td><b><?php echo $disc_bruto ?></b></td>
										</tr>
										<tr class="warning">
											<td>Keterangan Diskon</td>
											<td><?php echo $data['ket_discount'] ?></td>
										</tr>
										<tr class="info">
											<td>Refund</td>
											<td><?php echo $refund ?></td>
										</tr>
										<tr class="warning">
											<td>Total Diskon Netto</td>
											<td><?php echo $total_discount ?></td>
										</tr>
										<tr class="info">
											<td>Metode Pembayaran</td>
											<td><?php echo $data['cara_beli'] ?></td>
										</tr>
										<?php if($data['cara_beli'] == "KREDIT"){ ?>
										<tr class="warning">
											<td>Leasing</td>
											<td><?php echo $data['leasing'] ?></td>
										</tr>
										<tr class="info">
											<td>Tenor</td>
											<td><?php echo $data['tenor'] ?></td>
										</tr>
										<?php }?>
										
										
									</tbody>
								</table>
					
					<?php if ($rec_pu > 0 ) {?>		
						</div>
					</div>
					<?php } ?>
					
					<?php $query_pengajuan_ulang = mysql_query("SELECT pd.*,t.nama_tipe,m.nama_model,w.nama_warna FROM pengajuan_discount_ulang  pd
																	left join tipe t on t.kode_tipe = pd.tipe_mobil
																	left join model m on pd.model = m.kode_model
																	left join warna w on w.kode_warna = pd.warna where pd.no_pengajuan = '$data[no_pengajuan]' order by nomor ");
						$nopengulang = 0;
						while ($data_pu = mysql_fetch_array($query_pengajuan_ulang)) {
							$nopengulang ++;
					?>
					<div class="panel panel-white collapses" style = "background:#e8e8e8;" id="panel5">
						<a data-original-title="Tampilkan" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
						<div class="panel-heading">
							<h4 class="panel-title text-primary">Pengajuan Ulang <?php echo $nopengulang; ?></h4>
							<div class="panel-tools">
								<a data-original-title="Tampilkan" data-toggle="tooltip" data-placement="top" class="btn btn-transparent btn-sm panel-collapse" href="#"><i class="ti-minus collapse-off"></i><i class="ti-plus collapse-on"></i></a>
							</div>
						</div>
						</a>
						<div class="panel-body" style="display: none;">
							<div class="table-responsive__">
								<table class="table table-bordered table-striped table-hover" id="sample-table-1">
									<tbody>
										
										<tr class="warning">
											<td>Nama Customer</td>
											<td><?php echo $data['nama_customer'] ?></td>
										</tr>
										<tr class="info">
											<td>Hp Customer</td>
											<td><?php echo $data_pu['hp_customer'] ?></td>
										</tr>
										<tr class="warning">
											<td>Jenis Identitas</td>
											<td><?php echo $data_pu['jenis_identitas'] ?></td>
										</tr>
										<tr class="info">
											<td>Nomor Identitas</td>
											<td><?php echo $data_pu['no_identitas'] ?></td>
										</tr>
										<tr class="warning">
											<td width = "50%">Alamat Customer</td>
											<td><?php echo $data_pu['alamat_customer'] ?></td>
										</tr>
										<tr class="info">
											<td>Asal Prospek</td>
											<td><?php echo $data_pu['asal_prospek'] . ($data_pu['ket_asal_prospek'] != "" ? " - $data_pu[ket_asal_prospek]" : "" ) ?></td>
										</tr>
										<tr class="warning">
											<td>Asuransi</td>
											<td><?php echo ($data_pu['ikut_asuransi'] == "Y" ? "IKUT ASURANSI" : ($data_pu['ikut_asuransi'] == "" ? "" : "TIDAK ASURANSI")).($data_pu['ikut_asuransi'] == "Y" ? " - $data_pu[asuransi]" : "") ; ?></td>
										</tr>
											<tr class="info">
											<td>Model</td>
											<td><?php echo $data_pu['nama_model'].' / '.$data_pu['tahun_buat'] ?> </td>
										</tr>
										<tr class="warning">
											<td>Tipe Mobil</td>
											<td> <?php echo $data_pu['tipe_mobil'] ." - $data_pu[nama_tipe]" ?></td>
										</tr>
										<tr class="info">
											<td>Warna Mobil</td>
											<td> <?php echo $data_pu['nama_warna'] ?></td>
										</tr>
										<tr class="warning">
											<td>Harga OTR</td>
											<td><?php $harga_otr = "Rp ".number_format("$data_pu[harga_otr]",0,".","."); echo $harga_otr; ?></td>
										</tr>
										<tr class="success">
											<td>Program Delaer</td>
											<td><?php echo $data_pu['promo_dealer']; ?></td>
										</tr>
										<tr class="danger">
											<td><b>Plafon Diskon</b></td>
											<td><b><?php $discount_unit = "Rp ".number_format("$data_pu[discount_unit]",0,".","."); echo $discount_unit; ?></b></td>
										</tr>
										
										<tr class="info">
											<td>Pengajuan Diskon</td>
											<td><?php $pengajuan_disc = "Rp ".number_format("$data_pu[pengajuan_disc]",0,".","."); echo $pengajuan_disc; ?></td>
										</tr>
										
										<tr class="warning">
											<td>Total Diskon Aksesoris</td>
											<td><?php $total_discount_accs = "Rp ".number_format("$data_pu[total_discount_accs]",0,".",".");echo $total_discount_accs ;?></td>
										</tr>
										<tr class="danger">
											<td><b>Total Diskon Bruto</b></td>
											<td><b><?php $disc_bruto = $data_pu['pengajuan_disc']+$data_pu['total_discount_accs']; 
														 $disc_bruto = "Rp ".number_format("$disc_bruto",0,".","."); 
														 echo $disc_bruto; ?></b></td>
										</tr>
										<tr class="warning">
											<td>Keterangan Diskon</td>
											<td><?php echo $data_pu['ket_discount'] ?></td>
										</tr>
										<tr class="info">
											<td>Refund</td>
											<td><?php $refund = "Rp ".number_format("$data_pu[refund]",0,".",".");echo $refund ; ?></td>
										</tr>
										<tr class="warning">
											<td>Total Diskon Netto</td>
											<td><?php $disc_netto = $data_pu['pengajuan_disc']+$data_pu['total_discount_accs']-$data_pu['refund']; 
														 $disc_netto = "Rp ".number_format("$disc_netto",0,".","."); 
														 echo $disc_netto; ?>
											</td>
										</tr>
										<tr class="info">
											<td>Metode Pembayaran</td>
											<td><?php echo $data_pu['cara_beli'] ?></td>
										</tr>
										<?php if($data_pu['cara_beli'] == "KREDIT"){ ?>
										<tr class="warning">
											<td>Leasing</td>
											<td><?php echo $data_pu['leasing'] ?></td>
										</tr>
										<tr class="info">
											<td>Tenor</td>
											<td><?php echo $data_pu['tenor'] ?></td>
										</tr>
										<?php }?>
										
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
						<?php } ?>
					
					<!--table>
						<tr class = "tb-bawah"  >
							<td style = "text-align:right;">No Pengajuan</td>   <td> <?php echo $data[no_pengajuan] ?></td>
						</tr>
						<tr class = "tb-bawah">
							<td style = "text-align:right;">Tanggal</td>   <td> <?php echo $data[waktu] ?></td>
						</tr>
						<tr class = "tb-bawah">
							<td style = "text-align:right;">Sales </td>   <td> <?php echo $data[nama_sales] ?></td>
						</tr>
						<tr class = "tb-bawah">
							<td style = "text-align:right;">Nama Customer </td>   <td > <?php echo $data[nama_customer] ?></td>
						</tr>
						<tr class = "tb-bawah">
							<td width = "50%" style = "text-align:right;">Tipe </td>   <td > <?php echo $data['tipe_mobil'] .' - '. $data['nama_tipe'] ?></td>
						</tr>
						<tr class = "tb-bawah">
							<td style = "text-align:right;">Warna </td>   <td > <?php echo $data['nama_warna'] ?></td>
						</tr>
						<tr class = "tb-bawah">
							<td style = "text-align:right;">Harga </td>   <td > <?php echo $harga_otr ?></td>
						</tr>
						<tr class = "tb-bawah">
							<td style = "text-align:right;">Alamat Customer </td>   <td > <?php echo $data[alamat_customer] ?></td>
						</tr>
								
						
					</table-->
					
					
						<?php
						/* echo '
												    <b>No Pengajuan :</b> '.$data[no_pengajuan].' / Tanggal: '.$data['waktu'].'<br />
												    <b>No SPK :</b> '.$data['no_spk'].'<br />
												    <b>Nama Sales :</b> '.$data['nama_sales'].' / '.$data['kode_spv'].'<br />
												    <b>Nama Customer :</b> '.$data['nama_customer'].'<br />
												    <b>('.$data['tipe_mobil'] .' - '. $data['nama_tipe'].' - '.$data['nama_warna'].')<br /> Harga OTR :</b> '.$harga_otr.
												    '<br /><b>Pemohon : </b>'.$data[pemohon].
												    '<br /><b>Plafon Diskon: </b>'.$discount_unit;
						
						*/?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary btn-o" data-dismiss="modal">
							Close
						</button>
						
					</div>
				</div>
			</div>
		</div>
<!-- /Large Modal -->