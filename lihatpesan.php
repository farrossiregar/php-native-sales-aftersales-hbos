<script language="JavaScript">
	function warning() {
		return confirm('Anda yakin menghapus data ini?');
	}
	function tampil(){
		var tgl_awal = document.postform.tgl_awal.value;
		var tgl_akhir = document.postform.tgl_akhir.value;
		var filter = document.postform.filter.value;
		if (tgl_akhir!='' && tgl_awal!=''){
			document.getElementById("tampil_data").click();
		}
	}
	function tampil_lihat_detail($id){
		//alert("modal_pengajuan"+$id);
		$("#modal_pengajuan"+$id).modal('show');
		//$('#myModal').modal('show');
	}
</script>

<?php
session_start();
include "config/koneksi.php";

$lvr = $_SESSION['leveluser'];
		if($_SESSION['leveluser']=='admin'){
		//	$pesan = mysql_query("SELECT t.nama_tipe,m.nama_model,pd.* FROM pengajuan_discount pd left join model m on m.kode_model = pd.model left join tipe t on t.kode_tipe = pd.tipe_mobil where pd.dibaca = 'N' and pd.proses_approve != '' order by tgl_pengajuan_ulang desc");
			$pesan = mysql_query("SELECT t.nama_tipe,m.nama_model,n.read_admin,pd.* FROM pengajuan_discount pd 
									left join model m on m.kode_model = pd.model 
									left join tipe t on t.kode_tipe = pd.tipe_mobil 
									left join notif n on n.no_pengajuan = pd.no_pengajuan
									where n.read_admin = 'N' and (pd.proses_approve = 'N' or pd.status_approved='AL') order by tgl_pengajuan_ulang desc");
		}elseif($_SESSION['leveluser']=='DRKSI'){
			$pesan = mysql_query("SELECT t.nama_tipe,m.nama_model,n.read_drksi, pd.* FROM pengajuan_discount pd 
									left join model m on m.kode_model = pd.model 
									left join tipe t on t.kode_tipe = pd.tipe_mobil 
									left join notif n on n.no_pengajuan = pd.no_pengajuan
									where n.read_drksi = 'N' and (pd.proses_approve = 'N' or pd.status_approved='AL') order by tgl_pengajuan_ulang desc");
		}elseif($_SESSION['leveluser']=='MNGR'){
			$pesan = mysql_query("SELECT t.nama_tipe,m.nama_model,n.read_mngr,pd.* FROM pengajuan_discount pd 
									left join model m on m.kode_model = pd.model 
									left join tipe t on t.kode_tipe = pd.tipe_mobil 
									left join notif n on n.no_pengajuan = pd.no_pengajuan
									where pd.proses_approve = 'N' and n.read_mngr = 'N' order by tgl_pengajuan_ulang desc");
		}elseif($_SESSION['leveluser']=='user'){
			$pesan = mysql_query("SELECT t.nama_tipe,m.nama_model,pd.* FROM pengajuan_discount pd 
									left join model m on m.kode_model = pd.model 
									left join tipe t on t.kode_tipe = pd.tipe_mobil 
									left join notif n on n.no_pengajuan = pd.no_pengajuan
									where n.read_user = 'N' and pd.proses_approve = 'Y' and (pd.status_approved = 'Y' or pd.status_approved = 'N') and username_pemohon = '$_SESSION[username]' order by tgl_pengajuan_ulang desc limit 20");
		}else{
			$pesan = mysql_query("SELECT* FROM pengajuan_discount where proses_approve = 'S'");
		}
			


$j = mysql_num_rows($pesan);
if($j>0){
    while ($rec = mysql_fetch_array($pesan)){

    	$no_pengajuan = $rec['no_pengajuan'];
    	$username = $rec['username_pemohon'];
    	$foto = mysql_query("select * from users where username = '$username'");
    	$foto1 = mysql_fetch_array($foto);
    	$fotonotif = $foto1['foto'];
		
		//	while($sql = mysql_fetch_array($pesan)){
			/*	$row = mysql_num_rows($pesan);
				$model = $sql['nama_model'];
				$tipe = $sql['nama_tipe'];
				$status_approved = $sql['status_approved'];	*/
				
				$no_pengajuan = $rec['no_pengajuan'];
				$nama_sales = $rec['nama_sales'];
				$discount_unit = $rec['discount_unit'];
				$pengajuan_disc = $rec['pengajuan_disc'];
				$disc_bruto = $pengajuan_disc + $rec['total_discount_accs'];
				$proses_approve = $rec['proses_approve'];
				
									
				$pdu = mysql_query("select t.nama_tipe,m.nama_model,n.read_mngr,pd.no_pengajuan, pd.proses_approve, pd.status_approved, pd.nama_sales ,pdu.discount_unit, pdu.pengajuan_disc, pdu.total_discount_accs, pdu.* from pengajuan_discount_ulang pdu
									left join model m on m.kode_model = pdu.model 
									left join tipe t on t.kode_tipe = pdu.tipe_mobil 
									left join notif n on n.no_pengajuan = pdu.no_pengajuan
									left join pengajuan_discount pd on pd.no_pengajuan = pdu.no_pengajuan
									where n.read_mngr = 'N' and pdu.no_pengajuan = '$rec[no_pengajuan]' and aktif = 'Y'");
				$data_pdu = mysql_fetch_array($pdu);
				$num_pdu = mysql_num_rows($pdu);
				if($num_pdu > 0){
					$discount_unit = $data_pdu['discount_unit'];
					$disc_bruto = $data_pdu['pengajuan_disc'] + $data_pdu['total_discount_accs'];
					
				/*	$no_pengajuan = $data_pdu['no_pengajuan'];
					$nama_sales = $data_pdu['nama_sales'];
					$model = $data_pdu['nama_model'];
					$tipe = $data_pdu['nama_tipe'];
					$discount_unit = $data_pdu['discount_unit'];
					$pengajuan_disc = $data_pdu['pengajuan_disc'];
					$disc_bruto = $pengajuan_disc + $data_pdu['total_discount_accs'];
					$status_approved = $data_pdu['status_approved'];
					$proses_approve = $data_pdu['proses_approve'];	*/
					
				}
		//	}

if ($_SESSION['leveluser']=='admin' || $_SESSION['leveluser']=='MNGR' || $_SESSION['leveluser']=='DRKSI' || $_SESSION['leveluser']=='user' || $_SESSION['leveluser']=='supervisor' ){
?>

		<li class="unread">
			<?php
			$no_pengajuan_md5 = md5(md5($no_pengajuan));
				if ($_SESSION['leveluser']=='admin' || ($_SESSION['leveluser']=='DRKSI' and $rec['status_approved']=='AL')){
			?>
			<a href="media_showroom.php?module=prospek_pengajuandiscount&act=approvepengajuan&id=<?php echo $no_pengajuan_md5?>&notif=Y">
			
			<?php
				}elseif($_SESSION['leveluser']=='MNGR' and $rec['proses_approve']=='N'){
					//	if($rec['discount_unit'] >= ($rec['pengajuan_disc'] + $rec['total_discount_accs'])){
						if($discount_unit >= $disc_bruto){
			?>
				<a href="media_showroom.php?module=prospek_pengajuandiscount&act=approvepengajuan&id=<?php echo $no_pengajuan_md5 ?>">
					<?php
						}else{
					?>
				<a href="media_showroom.php?module=prospek_pengajuandiscount&act=ajukanapprove&id=<?php echo $no_pengajuan_md5 ?>">
			<?php
						}
				}elseif ($_SESSION['leveluser']=='DRKSI' and $rec['proses_approve']=='N'){
			?>
				<a href="media_showroom.php?module=prospek_pengajuandiscount&act=approvepengajuan&id=<?php echo $no_pengajuan_md5 ?>&info=Y">
			<?php
				}elseif($_SESSION['leveluser']=='user'){
			?>
				<a id="link_user" onclick = "testlink();" href="media_showroom.php?module=prospek_pengajuandiscount&act=ajukanapprove&id=<?php echo $no_pengajuan_md5 ?>">
				<script>
					function testlink(){
						var nopengajuan = "<?php echo $no_pengajuan_md5 ?>";
						var username = "<?php echo $_SESSION['username']?>";
						$.ajax({
							method: "post",
							data : {data : nopengajuan},
							url: "hapus_pesan_user.php",
							success: function(data){
								console.log(data);
							}
						});
					}
				</script>
			<?php
				}else{
			?>
				<a href="media_showroom.php?module=prospek_pengajuandiscount&act=lihat_approve&id=<?php echo $no_pengajuan?>&leveluser=<?php echo $_SESSION['leveluser']?>">
				
			<?php
				}
			?>
			
				<div class="clearfix" id="link_user<?php echo $rec['no_pengajuan'] ?>">
					<div class="thread-image" style="height:100px;">
						<img src="<?php echo "image/medium_".$fotonotif; ?>" width="100%" height="50%" style="border-radius:65px;">
					</div>
					<div class="thread-content">
					<?php
						if($rec['status_approved']=='AL'){
							$stat = "<span class='label label-warning'>Menunggu Persetujuan</span>";
						}elseif($rec['status_approved']=='N'){
							$stat = "<span class='label label-danger'>Belum Diproses</span>";
						}elseif($rec['status_approved']=='Y'){
							$stat = "<span class='label label-success'>Sudah Diproses</span>";
						}else{
							
						}
					?>
						<div class="author"><?php echo $stat; ?></div>
						<span class="author" style="margin-top:5px;"><?php echo $rec['nama_sales']."/".$rec['no_pengajuan']; ?></span>
						<span class="preview">Tipe : <?php echo $rec['nama_model'] .' - '. $rec['nama_tipe']; ?></br>
							<?php echo "Plafon Diskon : Rp ".number_format("$discount_unit",0,".",".") ;?></br>
							<?php 
							//	$disc_bruto = $rec['pengajuan_disc'] + $rec['total_discount_accs'];
							//	$disc_bruto = $data_pdu['pengajuan_disc'] + $data_pdu['total_discount_accs'];
								echo "Pengajuan : Rp ".number_format("$disc_bruto",0,".",".") ;?></br>
						</span>
						<span class="time"> <?php echo $rec['tgl_pengajuan_ulang'];  ?></span>
					</div>
				</div>
			</a>
		</li>
		
<?php 
	}
}
}


//	==============================	PEMASANGAN AKSESORIS	==============================	//	
if($_SESSION['leveluser'] == 'admin' or $_SESSION['leveluser'] == 'supervisor' or $_SESSION['leveluser'] == 'MNGR' or 
$_SESSION['leveluser'] == 'salesadm' or $_SESSION['leveluser'] == 'staff_salesadm' or $_SESSION['leveluser'] == 'mngr_finance' or $_SESSION['leveluser'] == 'staff_logistik'){
	$kode_spv = $_SESSION['kode_spv'];
	if($_SESSION['leveluser'] == 'admin'){
		$user_app = "where status_approved = '' and read_admin = 'N'";
	}elseif($_SESSION['leveluser'] == 'supervisor'){
		$user_app = "where status_approved = '' and kode_spv = '$kode_spv' and read_spv = 'N'";
	}elseif($_SESSION['leveluser'] == 'MNGR'){
		$user_app = "where status_approved = 'SPV_APP' and read_mngr = 'N'";
	}elseif($_SESSION['leveluser'] == 'salesadm' || $_SESSION['leveluser']=='staff_salesadm'){
		$user_app = "where status_approved = 'MNGR_APP' and read_salesadm = 'N'";
	}elseif($_SESSION['leveluser'] == 'mngr_finance'){
		$user_app = "where status_approved = 'ADM_APP' and read_finance = 'N'";
	}elseif($_SESSION['leveluser'] == 'staff_logistik'){
		$user_app = "where status_approved = 'ADM_APP' and read_logistik = 'N' and status_pasang = 'BP'";
	}else{
		$user_app = "";
	}
	
	
	
	$pemasangan_aksesoris = mysql_query("select * from pemasangan_aksesoris pa 
										left join notif_pemasangan_aksesoris n on pa.no_permohonan = n.no_permohonan
										$user_app");

	$cek_pemasangan_aksesoris = mysql_num_rows($pemasangan_aksesoris);
	if($cek_pemasangan_aksesoris > 0){
		while($data_pemasasangan_aksesoris = mysql_fetch_array($pemasangan_aksesoris)){
		//	$no_permohonan = $data_pemasasangan_aksesoris['no_permohonan'];
			$no_permohonan = substr(md5(md5(addslashes($data_pemasasangan_aksesoris['no_permohonan']))),0,28).md5($data_pemasasangan_aksesoris['no_permohonan']);
			$tipe_model = $data_pemasasangan_aksesoris['tipe_model'];
			$tahun_buat = $data_pemasasangan_aksesoris['tahun_buat'];
			$warna = $data_pemasasangan_aksesoris['warna'];
			$status_pesan = $data_pemasasangan_aksesoris['status_pemesanan'];
			$status_pasang = $data_pemasasangan_aksesoris['status_pasang'];
			
			if($_SESSION['leveluser'] == 'staff_logistik'){
				$link = "media_showroom.php?module=aksesoris_pemasangan_aksesoris&act=ubahstatuspemasangan&id=".$no_permohonan."&notif=Y";
			}else{
				$link = "media_showroom.php?module=aksesoris_pemasangan_aksesoris&act=approvedpemasangan&id=".$no_permohonan."&notif=Y";
			}

?>

			<li class="unread">
				<a href="<?php echo $link ?>">
					<div class="clearfix" id="link_user<?php echo $no_permohonan ?>">
						<div class="thread-content">
							<div class="author"><span class='label label-info'><?php echo "PEMASANGAN AKSESORIS"; ?></span></div><br>
							<span class="author" style="margin-top:5px;"><?php// echo "PEMASANGAN AKSESORIS" ;?></span>
							<div class="author">
								<?php// echo $stat; ?>
							</div>
							<span class="author" style="margin-top:5px;"><?php echo $data_pemasasangan_aksesoris['nama_sales']."/".$data_pemasasangan_aksesoris['no_permohonan']; ?></span>
							<span class="preview">Tipe : <?php echo $data_pemasasangan_aksesoris['tipe_model']; ?></span>
							<span class="preview">Warna : <?php echo $data_pemasasangan_aksesoris['warna']; ?></span>
							<span class="time"> <?php echo $data_pemasasangan_aksesoris['input_form'];  ?></span>
						</div>
					</div>
				</a>
			</li>
		
<?php 

		}	
	}else{
		
	}
}

if($_SESSION['leveluser'] == 'admin' or $_SESSION['leveluser'] == 'supervisor' or $_SESSION['leveluser'] == 'MNGR' or 
$_SESSION['leveluser'] == 'salesadm' or $_SESSION['leveluser'] == 'staff_salesadm' or $_SESSION['leveluser'] == 'mngr_finance' or $_SESSION['leveluser'] == 'staff_logistik'
or $_SESSION['leveluser'] == 'ar_finance' or $_SESSION['leveluser'] == 'spv_finance'){	
	$kode_spv = $_SESSION['kode_spv'];
	if($_SESSION['leveluser'] == 'admin'){
		$user_app = "where uk.spv_app = '' and n.read_admin = 'N'";
	}elseif($_SESSION['leveluser'] == 'supervisor'){
		$user_app = "where uk.spv_app = '' and kd_spv = '$kode_spv' and read_spv = 'N'";
	}elseif($_SESSION['leveluser'] == 'MNGR'){
		$user_app = "where uk.spv_app = 'Y' and read_mngr = 'N'";
	}elseif($_SESSION['leveluser'] == 'salesadm' || $_SESSION['leveluser']=='staff_salesadm'){
		$user_app = "where uk.mngr_app = 'Y' and read_salesadm = 'N'";
	}elseif($_SESSION['leveluser'] == 'mngr_finance' || $_SESSION['leveluser'] == 'ar_finance' || $_SESSION['leveluser'] == 'spv_finance'){
		$user_app = "where uk.salesadm_app = 'Y' and read_finance = 'N'";
	}elseif($_SESSION['leveluser'] == 'staff_logistik'){
		$user_app = "where uk.mngr_finance_app = 'Y' and read_staff_logistik = 'N'";
	}else{
		$user_app = "";
	}
	
	
	
	$permohonan_unit_keluar = mysql_query("select * from unit_keluar uk
										left join notif_permohonan_unit_keluar n on uk.no_spk = n.no_spk
										$user_app");

	$cek_permohonan_unit_keluar = mysql_num_rows($permohonan_unit_keluar);
		
	if($cek_permohonan_unit_keluar > 0){
		while($data_permohonan_unit_keluar = mysql_fetch_array($permohonan_unit_keluar)){
			$no_puk = $data_permohonan_unit_keluar['no_puk'];
			$no_spk = $data_permohonan_unit_keluar['no_spk'];
			
			$username = $data_permohonan_unit_keluar['nama_sales'];
			$get_kode_sales = mysql_query("select kode_sales, nama_lengkap from users where username = '$username'");
			$data_get_kode_sales = mysql_fetch_array($get_kode_sales);
			$kode_sales = $data_get_kode_sales['kode_sales'];
			$nama_lengkap = $data_get_kode_sales['nama_lengkap'];
?>
	<li class="unread">
		<a href="media_showroom.php?module=logistik_puk&act=approvedpermohonan&id=<?php echo md5(md5($no_spk)); ?>&notif=Y">
			<div class="clearfix" id="link_user<?php echo $no_puk ?>">
				<div class="thread-content">
					<div class="author"><span class='label label-info'><?php echo "PERMOHONAN UNIT KELUAR"; ?></span></div>
					<span class="author" style="margin-top:5px;">
						<?php echo strtoupper($nama_lengkap)."/".$data_permohonan_unit_keluar['no_puk']; ?>
					
					</span>
					<span class="preview">
						No SPK : <?php echo $data_permohonan_unit_keluar['no_spk']; ?><br>
						No Rangka : <?php echo $data_permohonan_unit_keluar['norangka']; ?><br>
						Waktu Keluar : <?php echo $data_permohonan_unit_keluar['waktu_keluar']; ?><br><br>
						<?php echo $data_permohonan_unit_keluar['keterangan'];  ?></br>
					</span>
					<span class="time"> <?php echo $data_permohonan_unit_keluar['input'];  ?></span>
				</div>
			</div>
		</a>
	</li>
<?php
		}	
	}else{
		
	}
}
?>
