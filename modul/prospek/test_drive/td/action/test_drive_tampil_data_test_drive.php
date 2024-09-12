<?php 
if (count($_POST)){
	session_start();
	include "../../../../config/koneksi.php";
		date_default_timezone_set('Asia/Jakarta');
		$hari_ini = date('Y-m-d');
		$jam_skrg = date('H:i:s');
		$tgl_awal = $_POST['tanggal_awal'];
		$tgl_akhir = $_POST['tanggal_akhir'];
		$query = mysql_unbuffered_query("SELECT * FROM peminjaman_test_drive where tgl_test_drive >= '$tgl_awal' and tgl_test_drive <= '$tgl_akhir' order by tgl_test_drive desc, tipe_mobil, jam_test_drive asc");
		$n = 0;
		while($r = mysql_fetch_array($query)){
			$count = mysql_num_rows($query);
			$n = $n+1;
			$id = $r['no'];
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
			$user_input = $r['nama_sales'];
			$input = $r['waktu_permohonan'];
			
			if($_SESSION['leveluser'] == 'user'){
				if($hari_ini >= $tanggal_test_drive and $jam_skrg >= $jam_test_drive_akhir ){
					$hasil_test = "	<button type='button' href='modul/prospek/test_drive/action/test_drive_edit.php?id=<?php echo $id;?>' id='hasil_test_drive$id' name='hasil_test_drive' class='dlt btn btn-xs btn-success' onclick='hasil_test_drive($id, 1)' data-original-title='Hasil Test Drive $no_peminjaman' value='$id'>
										<span class='ladda-label'><i class='fa fa-pencil'></i> Hasil Test Drive</span>
									</button>";
				}else{
					$hasil_test = "	<button type='button' href='modul/prospek/test_drive/action/test_drive_edit.php?id=<?php echo $id;?>' id='hasil_test_drive$id' name='hasil_test_drive' class='dlt btn btn-xs btn-warning' onclick='hasil_test_drive($id, 2)' data-original-title='Ubah Data Test Drive $no_peminjaman' value='$id'>
										<span class='ladda-label'><i class='fa fa-pencil'></i> Ubah Data Test Drive</span>
									</button>";
				}
			}else if($_SESSION['leveluser'] == 'HRD'){
				if($hari_ini >= $tanggal_test_drive and $jam_skrg >= $jam_test_drive_akhir ){
					$hasil_test = "	<button type='button' id='hasil_test_drive$id' name='hasil_test_drive' class='dlt btn btn-xs btn-success' onclick='hasil_test_drive($id, 1)' data-original-title='Hasil Test Drive $no_peminjaman' value='$id'>
										<span class='ladda-label'><i class='fa fa-pencil'></i> Hasil Test Drive</span>
									</button>";
				}else{
					$hasil_test = "";
				}
			}else{
				if($hari_ini >= $tanggal_test_drive and $jam_skrg >= $jam_test_drive_akhir ){
					$hasil_test = "	<button type='button' href='modul/prospek/test_drive/action/test_drive_edit.php?id=<?php echo $id;?>' id='hasil_test_drive$id' name='hasil_test_drive' class='dlt btn btn-xs btn-success'  data-original-title='Hasil Test Drive $no_peminjaman' value='$id'>
										<span class='ladda-label'><i class='fa fa-pencil'></i> Hasil Test Drive</span>
									</button>";
				}else{
					$hasil_test = "	<button type='button' href='modul/prospek/test_drive/action/test_drive_edit.php?id=$id' id='hasil_test_drive$id' name='hasil_test_drive' class='dlt btn btn-xs btn-warning'  data-original-title='Ubah Data Test Drive $no_peminjaman' value='$id'>
										<span class='ladda-label'><i class='fa fa-pencil'></i> Ubah Data Test Drive</span>
									</button>";
				}
			}
			
			
			if($tipe == 'ACCORD'){
				$panel_color = "panel-green";
				$button_color = "btn btn-primary";
			}elseif($tipe == 'BRIO'){
				$panel_color = "panel-primary";
				$button_color = "btn btn-success";
			}elseif($tipe == 'BR-V'){
				$panel_color = "panel-blue";
				$button_color = "btn btn-info";
			}elseif($tipe == 'CR-V'){
				$panel_color = "panel-purple";
				$button_color = "btn btn-warning";
			}elseif($tipe == 'CITY'){
				$panel_color = "panel-grey";
				$button_color = "btn btn-danger";
			}elseif($tipe == 'CIVIC'){
				$panel_color = "panel-green";
				$button_color = "btn btn-danger";
			}elseif($tipe == 'FREED'){
				$panel_color = "panel-orange";
				$button_color = "btn btn-danger";
			}elseif($tipe == 'HR-V'){
				$panel_color = "panel-red";
				$button_color = "btn btn-wide btn-o btn-success";
			}elseif($tipe == 'JAZZ'){
				$panel_color = "panel-yellow";
				$button_color = "btn btn-wide btn-o btn-info";
			}elseif($tipe == 'MOBILIO'){
				$panel_color = "panel-red";
				$button_color = "btn btn-wide btn-o btn-warning";
			}else{
				$panel_color = "panel-green";
				$button_color = "btn btn-wide btn-o btn-danger";
			}
		
?>
	<!--div class='panel <?php echo $panel_color ?> load1'>
		<div class='panel-heading'>
			<h4 class='panel-title'><b><?php echo $tipe ?></b></h4>
			<div class='panel-tools'>
				<?php echo $hasil_test ?> 
			</div>
		</div>
		<div class='panel-body'>
			<p>
				<?php echo
					"No Peminjaman : $no_peminjaman<br>
					Nama Customer : $nama<br>
					Waktu Test Drive : $tanggal_test_drive ($jam_test_drive_awal - $jam_test_drive_akhir)<br>";
				?>
			</p>
		</div>
	</div-->
	
	
	<tr>
		<td = 'tede'>
			<?php echo $hasil_test ?>
		</td>
		<td>
			<div class = '<?php echo $button_color ?>'><?php echo $tipe ?></div><br><br>
			<b>
			Tanggal : <?php echo $tanggal_test_drive.' '.substr($jam_test_drive_awal, 0, 5).' - '.substr($jam_test_drive_akhir, 0, 5) ?><br>
			Waktu : <?php echo $jam_test_drive_awal.'-'.$jam_test_drive_akhir ?> <br>
			Lokasi : <?php echo $lokasi_test_drive ?>
			</b>
		</td>
		<td>
			<b>
			No Peminjaman : <?php echo $no_peminjaman ?><br>
			Nama Customer : <?php echo $nama ?><br>
			No KTP : <?php echo $no_ktp ?><br>
			No Telp : <?php echo $telepon ?><br>
			Alamat : <?php echo $alamat ?><br>
			</b>
		</td>
		<td>
			<b>
			Rencana SPK : <br>
			Tujuan Test Drive : <?php echo $jenis_customer ?><br>
			</b>
		</td>
	</tr>
<?php		
	}
}
?>
