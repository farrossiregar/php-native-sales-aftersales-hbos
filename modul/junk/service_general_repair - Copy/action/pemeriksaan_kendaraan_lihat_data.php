

<?php
	include "../../../config/koneksi_service.php";
	date_default_timezone_set('Asia/Jakarta');

	if(count($_POST)){
		include "../../../config/koneksi_service.php";
		date_default_timezone_set('Asia/Jakarta');
		$periode_pemeriksaan = $_POST['periode_pemeriksaan'];
		$pemeriksaan_kendaraan = mysql_query("SELECT * FROM pemeriksaan_kendaraan where tanggal = '$periode_pemeriksaan'"); 
		$n = 0;
		while($data_pemeriksaan_kendaraan = mysql_fetch_array($pemeriksaan_kendaraan)){
			$n = $n +1;
?>
		<tr>
			<td><?php echo $n; ?></td>
			<!--td>
				<img src = "<?php echo 'modul/service_general_repair/action/act/upload/'.$data_pemeriksaan_kendaraan['gambar_pemeriksaan']; ?>" height="120" alt = "<?php echo $data_pemeriksaan_kendaraan['gambar_pemeriksaan'] ?>">
			</td-->
			<td>
				<b>No pemeriksaan : <?php echo $data_pemeriksaan_kendaraan['no_pemeriksaan'] ?></b><br>
				<b>Nama Customer : <?php echo $data_pemeriksaan_kendaraan['nama_customer'] ?></b><br>
				<b>Tanggal pemeriksaan : <?php echo $data_pemeriksaan_kendaraan['tanggal'] ?></b><br>
				<b>No Polisi : <?php echo $data_pemeriksaan_kendaraan['no_polisi'] ?></b><br>
				<b>Jenis Kendaraan : <?php echo $data_pemeriksaan_kendaraan['model'].' / '.$data_pemeriksaan_kendaraan['tahun'].' / '.strtoupper($data_pemeriksaan_kendaraan['transmisi_mobil']) ?></b><br>
				<center>
					<!--button type='button' id='edit$id' name='edit' class='dlt btn btn-xs btn-warning' onclick='editPemeriksaan($id);' data-original-title='Update Data Pemeriksaan Kendaraan $id' value='$id'>
						<span class='ladda-label'><i class='fa fa-pencil'></i> Ubah Data</span>
					</button-->
					<a class='btn btn-xs btn-warning' href='modul/service_general_repair/action/pemeriksaan_kendaraan_lembar_pemeriksaan.php?no_pemeriksaan=<?php echo $data_pemeriksaan_kendaraan['no_pemeriksaan']?>' target="_blank" data-toggle='tooltip' data-original-title='Cetak Lembar Pemeriksaan <?php echo $data_pemeriksaan_kendaraan['no_pemeriksaan']?>' ><i class='fa fa-print'></i> CETAK</a>
				</center>
			</td>
		</tr>
<?php
			}
	}
?>


<script>
/*	function lihat_detail(){
		var data = '1';
		$.ajax({
			method : "post",
			url : "modul/service_general_repair/action/pemeriksaan_kendaraan_detail_data.php",
			data : "data="+data,
			success : function(data){
				$("#modal_pemeriksaan_kendaraan").modal('show');
				$("#detail_pemeriksaan").html(data);
			}
		})
	}	*/

/*	function editPemeriksaan(){
		
		var no_pemeriksaan = $('#nopemeriksaan').val();
		var tanggal_datang = $('#tanggal').val();
		var no_polisi = $('#nopolisi').val();
		var model = $('#model').val();
		var transmisi_mobil = $('#transmisi_mobil').val();
		if(transmisi_mobil == 'at'){
			var posisi_transmisi = $('#transmisi_at').val();
		}else if(transmisi_mobil == 'mt'){
			var posisi_transmisi = $('#transmisi_mt').val();
		}else if(transmisi_mobil == 'cvt'){
			var posisi_transmisi = $('#transmisi_mt').val();
		}else{
			var posisi_transmisi = "";
		}
		
		var tahunbuat = $('#tahunbuat').val();
		var odmeter = $('#odmeter').val();
		var pic = $('#pic').val();
		var customer = $('#customer').val();
		var keluhan = $('#keluhan').val();
		var catatan = $('#catatan').val();
		var image = $('#hidden_data').val();
		var battery = jQuery('input[name="radio10"]:checked').val();
	
		
		
		var tebaldepankanan = $('#tebaldepanKANAN').val();
		var tebaldepankiri= $('#tebaldepanKIRI').val();
		var tebalbelakangkanan = $('#tebalbelakangKANAN').val();
		var tebalbelakangkiri = $('#tebalbelakangKIRI').val();
		
		var keterangandepankanan = $('#keterangandepanKANAN').val();
		var keterangandepankiri= $('#keterangandepanKIRI').val();
		var keteranganbelakangkanan = $('#keteranganbelakangKANAN').val();
		var keteranganbelakangkiri = $('#keteranganbelakangKIRI').val();
		
		var kondisidepankiri = jQuery('input[name="kondisidepanKIRI"]:checked').val();
		var kondisidepankanan = jQuery('input[name="kondisidepanKANAN"]:checked').val();
		var kondisibelakangkiri = jQuery('input[name="kondisibelakangKIRI"]:checked').val();
		var kondisibelakangkanan = jQuery('input[name="kondisibelakangKANAN"]:checked').val();
		
		if($('#status1').is(":checked")){
			var stnk = "Y";
		}else{
			var stnk = "N";
		}
		
		if($('#status2').is(":checked")){
			var bukusrv = "Y";
		}else{
			var bukusrv = "N";
		}
		
		if($('#status3').is(":checked")){
			var toolset = "Y";
		}else{
			var toolset = "N";
		}
		
		if($('#status4').is(":checked")){
			var dongkrak = "Y";
		}else{
			var dongkrak = "N";
		}
		
		if($('#status5').is(":checked")){
			var doproda = "Y";
		}else{
			var doproda = "N";
		}
		
		if($('#status6').is(":checked")){
			var bancadangan = "Y";
		}else{
			var bancadangan = "N";
		}
		
		
		var kondisi_stnk = $('#kondisi1').val();
		var kondisi_buku_srv = $('#kondisi2').val();
		var kondisi_toolset = $('#kondisi3').val();
		var kondisi_dongkrak = $('#kondisi4').val();
		var kondisi_doproda = $('#kondisi5').val();
		var kondisi_bancadangan = $('#kondisi6').val();
		
		var bunyi = $('#bunyi').val();
		var sumberbunyi = $('#sumberbunyi').val();
		var volumebunyi = $('#volumebunyi').val();
		var karakterbunyi = $('#karakterbunyi').val();
		var intensitasbunyi = $('#intensitasbunyi').val();
		var waktubunyi1 = $('#waktubunyi').val();
		var waktubunyi2 = $('#waktubunyi2').val();
		var waktu_bunyi = waktubunyi1 + ' ' + waktubunyi2;
		
		$.ajax({
			method : "post",
			url : "modul/service_general_repair/action/pemeriksaan_kendaraan_ubah.php",
			data : "no_pemeriksaan="+no_pemeriksaan+
					'&tanggal_datang='+tanggal_datang+
					'&no_polisi='+no_polisi+
					'&model='+model+
					'&transmisi_mobil='+transmisi_mobil+
					'&tahunbuat='+tahunbuat+
					'&odmeter='+odmeter+
					'&pic='+pic+
					'&customer='+customer+
					'&rpm='+rpm+
					'&keluhan='+keluhan+
					'&catatan='+catatan+
					'&posisi_transmisi='+posisi_transmisi+
					
					'&battery='+battery+
					'&tebaldepankanan='+tebaldepankanan+
					'&tebaldepankiri='+tebaldepankiri+
					'&tebalbelakangkanan='+tebalbelakangkanan+
					'&tebalbelakangkiri='+tebalbelakangkiri+
					'&keterangandepankanan='+keterangandepankanan+
					'&keterangandepankiri='+keterangandepankiri+
					'&keteranganbelakangkanan='+keteranganbelakangkanan+
					'&keteranganbelakangkiri='+keteranganbelakangkiri+
					'&kondisidepankiri='+kondisidepankiri+
					'&kondisidepankanan='+kondisidepankanan+
					'&kondisibelakangkiri='+kondisibelakangkiri+
					'&kondisibelakangkanan='+kondisibelakangkanan+
					
					'&stnk='+stnk+
					'&bukusrv='+bukusrv+
					'&toolset='+toolset+
					'&dongkrak='+dongkrak+
					'&doproda='+doproda+
					'&bancadangan='+bancadangan+
					
					'&kondisi_stnk='+kondisi_stnk+
					'&kondisi_buku_srv='+kondisi_buku_srv+
					'&kondisi_toolset='+kondisi_toolset+
					'&kondisi_dongkrak='+kondisi_dongkrak+
					'&kondisi_doproda='+kondisi_doproda+
					'&kondisi_bancadangan='+kondisi_bancadangan+
					
					'&bunyi='+bunyi+
					'&sumberbunyi='+sumberbunyi+
					'&volumebunyi='+volumebunyi+
					'&karakterbunyi='+karakterbunyi+
					'&intensitasbunyi='+intensitasbunyi+
					'&waktubunyi='+waktu_bunyi
					,
			success : function(data){
				
			}	
		})
			
			
	}	*/
</script>

