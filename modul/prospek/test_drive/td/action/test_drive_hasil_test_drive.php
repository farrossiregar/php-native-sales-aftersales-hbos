<script>
	
	
	
</script>
<?php 

if (count($_POST)){

	include "../../../../config/koneksi.php";
	$id = $_POST['data'];
	$hasil = $_POST['hasil'];
	if($hasil == '1'){
		$hasil = "Hasil Test";
	}else{
		$hasil = "Ubah Data";
	}
	$query = mysql_query("SELECT * FROM peminjaman_test_drive where no = '$id' ");
	
	while($r = mysql_fetch_array($query)){
		$no_peminjaman = $r['no_peminjaman'];
		
		$nama = $r['nama_customer'];
		$alamat = $r['alamat_customer'];
		$no_ktp = $r['no_ktp'];
		$telepon = $r['no_telp'];
		$keterangan = $r['keterangan'];
		$tipe = $r['tipe_mobil'];
		$tanggal_test_drive = $r['tgl_test_drive'];
		$jam_test_drive_awal = $r['jam_test_drive'];
		$jam_test_drive_akhir = $r['estimasi_jam_selesai'];
		$jenis_customer = $r['jenis_customer'];
		$lokasi_test_drive = $r['lokasi_test_drive'];
		$peserta_test_drive = $r['peserta_test_drive'];
	
		$simpan =	"<button class='btn btn-primary btn-wide' type='button' id='bn' name='bn' onClick='simpan();'>
						<span class='ladda-label'><i class='fa fa-save'></i> Simpan</span>
					</button>";
						
		$update =   "<button type = 'button' id='upd' name='upd' class='btn btn-primary btn-wide' data-style='expand-right'  onclick = 'update_booking();' >
						<span class='ladda-label'><i class='fa fa-mail-save'></i> Update </span>
					</button>";
						
		$reschedule="<button type = 'button' id='upd2' name='upd2' class='btn btn-primary btn-wide' data-style='expand-right'>
						<span class='ladda-label'><i class='fa fa-mail-save'></i> Reschedule</span>
					</button>";
						
		$keluar = 	"<button type = 'button' id='keluar' class='btn btn-wide btn-danger ladda-button' data-style='expand-right'  onclick='exit_modal();'>
						<span class='ladda-label'><i class='fa fa-mail-reply'></i> Keluar </span>
					</button>";
					
		$buat_pengajuan = 	"<button type = 'button' id='buat_pengajuan' class='btn btn-primary btn-wide' data-style='expand-right'  onclick='buat_pengajuan();'>
								<span class='ladda-label'><i class='fa fa-mail-reply'></i> Buat Pengajuan </span>
							</button>";
					
		$hasil_test_drive = "<div class='form-group'>
								<fieldset>
									<legend>
										Rencana SPK
									</legend>
									<div class = 'col-md-3'>
										<div class='radio clip-radio radio-primary radio-inline' >
											<input id='spk1' name='rencana_spk' value='Y' type='radio'>
											<label for='spk1'>
												Ya
											</label>
										</div>
									</div>
									
									<div class = 'col-md-3'>
										<div class='radio clip-radio radio-primary radio-inline' >
											<input id='spk2' name='rencana_spk' value='N' type='radio'>
											<label for='spk2'>
												Tidak
											</label>
										</div>
									</div>
									<br>
									<div class='col-md-12'>
										<div class='form-group'>
											<label class='control-label'>
												Keterangan <span class='symbol required'></span>
											</label>
											<div class='form-group'>
												<div class='note-editor'>
													<textarea class='form-control' id='keterangan_spk_edit' name='keterangan_spk_edit'></textarea>
												</div>
											</div>
										</div>
									</div>
								</fieldset>
							</div>	";
							
			
$data = array('no_peminjaman'=>$no_peminjaman,'nama'=>$nama,'alamat'=>$alamat);		

		
		/*$data = array(	'no_peminjaman'=>$no_peminjaman,
						'nama'=>$nama,
						'alamat'=>$alamat,
						'no_ktp'=>$waktu_booking,
						'telepon'=>$telepon,
						'keterangan'=>$keterangan,
						'tipe'=>$tipe,
						'tanggal_test_drive'=>$tanggal_test_drive,
						'jam_test_drive_awal'=>$jam_test_drive_awal,
						'jam_test_drive_akhir'=>$jam_test_drive_akhir,
						'jenis_customer'=>$jenis_customer,
						'lokasi_test_drive'=>$lokasi_test_drive,
						'peserta_test_drive'=>$peserta_test_drive,
						'update'=>$update,
						'keluar'=>$keluar
						
						);	*/
		$data_encode = json_encode($data);
	//	echo $data_encode;
?>
<fieldset>
	<legend>Edit Data</legend>
	<div class="form-group">
		<div class="panel panel-white collapses" id="panel5">
			<a data-original-title="Buka" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse"></a>
			<div class="panel-heading">
				<a data-original-title="Buka" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
					<h4 class="panel-title text-primary">Detail Test Drive</h4>
				</a>
				<ul class="panel-heading-tabs border-light">
					<a data-original-title="Buka" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
					</a>
					<li class="panel-tools">
						<a data-original-title="Buka" data-toggle="tooltip" data-placement="top" href="#" class="panel-collapse">
						</a>
						<a data-original-title="Collapse" data-toggle="tooltip" data-placement="top" class="btn btn-transparent btn-sm panel-collapse" href="#">
							<i class="ti-minus collapse-off"></i>
							<i class="ti-plus collapse-on"></i>
						</a>
					</li>
				</ul>
			</div>
			<div class="panel-body" style="display: none;">		
				<div class="div_simpan">
					<div class="form-group">
						<label class="control-label">
							No Peminjaman
						</label>
						<input id="no_peminjaman_edit" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control simpan_test_drive" type="text"  name="input_test_drive" required readonly>
					</div>
				</div>
				<div class=" div_simpan">
					<div class="form-group">
						<label class="control-label">
							Nama Customer
						</label>
						<input id="nama_cust_edit" style="text-transform:uppercase" onblur="this.value=this.value.toUpperCase()" class="form-control simpan_test_drive" type="text"  name="input_test_drive" required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>>
					</div>
				</div>
				<div class="div_simpan">
					<div class="form-group">
						<label class="control-label">
							Alamat <span class="symbol required"></span>
						</label>
						<div class="note-editor">
							<textarea class="form-control simpan_test_drive" id="alamat_edit" name="input_test_drive" required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 div_simpan">
						<div class="form-group">
							<label class="control-label">
								No KTP
							</label>
							<input type="text"  class="form-control simpan_test_drive" id="no_ktp_edit" name="input_test_drive"  required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>>
						</div>
					</div>
					<div class="col-md-6 div_simpan">
						<div class="form-group">
							<label class="control-label">
								No Telp
							</label>
							<input type="text"  class="form-control simpan_test_drive" id="telepon_edit" name="input_test_drive"  required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>>
						</div>
					</div>
				</div>
				<div class=" div_simpan">
					<div class="form-group">
						<label class="control-label">
							Jenis Customer
						</label>
						<input type="text"  class="form-control simpan_test_drive" name = "jenis_customer_edit" id="jenis_customer"  required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>>
						<!--select  class = "form-control simpan_test_drive" >														
							<option value="" selected disabled> -- JENIS CUSTOMER -- </option>
							<option value="PEMBELIAN PERTAMA">PEMBELIAN PERTAMA</option>
							<option value="REPEAT ORDER">REPEAT ORDER</option>
							<option value="TRADE IN">TRADE IN</option>
						</select-->
					</div>
				</div>
				<div class="div_simpan">
					<div class="form-group">
						<label class="control-label">
							Keterangan <span class="symbol required"></span>
						</label>
						<div class="form-group">
							<div class="note-editor">
								<textarea class="form-control simpan_test_drive" id="keterangan_edit" name="keterangan"  required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>></textarea>
							</div>
						</div>
					</div>
				</div>
				
				<div class="div_simpan">
					<div class="form-group">
						<label class="control-label">
							Tanggal Test Drive <span class="symbol required"></span>
						</label>
						<div class="input-group input-daterange datepicker" data-date-format='yyyy-mm-dd'>
							<input class="form-control simpan_test_drive" type="text" id="tgl_test_drive_edit" name="tgl_test_drive"  <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?> required >
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 div_simpan">
						<div class="form-group" >
							<label class="control-label">
								Jam Test Drive <span class="symbol required"></span>
							</label>
							<div>
								<input class="form-control simpan_test_drive" type="text" id="waktu_test_drive_awal_edit" name="waktu_test_drive_awal_edit" <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?> required >
								<!--select name = "waktu_test_drive_awal" id="waktu_test_drive_awal" class = "form-control simpan_test_drive" style=""></select-->
							</div>
						</div>
					</div>
					<div class="col-md-6 div_simpan">
						<div class="form-group" >
							<label class="control-label">
								Estimasi Jam Selesai<span class="symbol required"></span>
							</label>
							<div>
								<input class="form-control simpan_test_drive" type="text" id="waktu_test_drive_akhir_edit" name="waktu_test_drive_akhir_edit"  <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?> required >
							</div>
						</div>
					</div>
				</div>
				<div class="div_simpan">
					<div class="form-group">
						<label class="control-label">
							Tipe Mobil
						</label>
						<input class="form-control simpan_test_drive" type="text" name = "tipe" id="tipe" class = "form-control simpan_test_drive"  <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?> required >
						<!--select name = "tipe" id="tipe" class = "form-control simpan_test_drive" >														
							<option value="" selected disabled>CARI MODEL</option>
							<?php
							/*	$data = mysql_query("select nama_model from model");
								while ($r=mysql_fetch_array($data))
								{
									if ($r[nama_model] == $_GET[model]){
										$selek = "selected";
									}else {
										$selek = "";
									}
									echo "<option value='$r[nama_model]' $selek > $r[nama_model] </option>";															
								}*/
							?>
						</select-->
					</div>
				</div>
				<div class="div_simpan">
					<div class="form-group">
						<label class="control-label">
							Lokasi Test Drive
						</label>
						<input type="text"  class="form-control simpan_test_drive" id="lokasi_test_drive" name="lokasi_test_drive" required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?>>
					</div>
				</div>
				<div class="div_simpan">
					<div class="form-group">
						<label class="control-label">
							Peserta Test Drive
						</label>
						<input type="text"  class="form-control simpan_test_drive" id="peserta_test_drive" name="peserta_test_drive"  required <?php if ($hasil == 'Hasil Test') echo "readonly"; else echo ""; ?> >
					</div>
				</div>
			</div>
		</div>
		

		<?php
			if($hasil == 'Hasil Test'){
				echo $hasil_test_drive;
				$action = "1";
			}else{
				echo "";
				$action = "2";
			}
		?>
		<div class = "col-md-12" id = "rencana_spk_test">
		</div>
		<div class="col-md-12">
			<button type = "button" id="ubah_data" name="ubah_data" class="btn btn-primary btn-wide" data-style="expand-right" onclick = "update_test_drive(<?php echo $action ?>)">
				<span class="ladda-label"><i class="fa fa-mail-save"></i> Ubah Data</span>
			</button>
			<button type = "button" id="batal_edit" class="btn btn-wide btn-danger ladda-button" data-style="expand-right"  onclick='batal_edit();'
				<span class="ladda-label"><i class="fa fa-mail-reply"></i> Batal </span>
			</button>
		</div>
			
	</div>
</fieldset>	
<?php
	}
}
?>
