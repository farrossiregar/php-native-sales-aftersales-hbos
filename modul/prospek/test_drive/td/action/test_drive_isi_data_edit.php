
<?php 

if (count($_POST)){

	include "../../../../config/koneksi.php";
	$id = $_POST['no_peminjaman'];
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
		echo $data_encode;
?>

<?php
	}
}
?>
