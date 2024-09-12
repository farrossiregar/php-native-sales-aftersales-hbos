<script language="JavaScript">
	function warning() {
		return confirm('Anda yakin menghapus data ini?');
	}
	
	
	function link_pengecekan($no_pengecekan_mingguan, $no, $tipe){
		var no_pengecekan_mingguan = "PS" + $no_pengecekan_mingguan;
		var no = $no;
		var pengecekan = $tipe;
		var leveluser = "<?php echo $_POST['leveluser']; ?>";
		if(pengecekan == '1'){
			if(leveluser == 'admin' || leveluser == 'HRD'){
				var link = "media_showroom.php?module=checklist_showroom&act=lihat&id="+no_pengecekan_mingguan+'&no='+no;
			}else{
				var link = "media_showroom.php?module=checklist_showroom&act=lihat&id="+no_pengecekan_mingguan;
			}
		}else if(pengecekan == '2'){
			if(leveluser == 'admin' || leveluser == 'HRD'){
				var link = "media_showroom.php?module=service_checklist_service&act=lihat&id="+no_pengecekan_mingguan+'&no='+no;
			}else{
				var link = "media_showroom.php?module=service_checklist_service&act=lihat&id="+no_pengecekan_mingguan;
			}
		}else if(pengecekan == '3'){
			if(leveluser == 'admin' || leveluser == 'supervisor'){
				var link = "media_showroom.php?module=checklist_penampilan_sales&act=lihat&id="+no_pengecekan_mingguan+'&no='+no;
			}else{
				var link = "media_showroom.php?module=checklist_penampilan_sales&act=lihat&id="+no_pengecekan_mingguan;
			}
		}else {
			if(leveluser == 'admin' || leveluser == 'mngr_bengkel'){
				var link = "media_showroom.php?module=service_checklist_penampilan_sa&act=lihat&id="+no_pengecekan_mingguan+'&no='+no;
			}else{
				var link = "media_showroom.php?module=service_checklist_penampilan_sa&act=lihat&id="+no_pengecekan_mingguan;
			}
		}
		
		window.location.href = link;
		$('#Modal_catatan').modal('show');
	}

	
/*	function hapus_notif_showroom($id, $tipe){
		var no = $id;
		var leveluser = '<?php echo $_POST['leveluser'] ?>';
		var pengecekan = $tipe;
		if(pengecekan == '1'){
			var jenis_pengecekan = 'showroom';
			$.ajax({
				method: "post",
				url: "notif_pengecekan/hapus_pesan_pengecekan.php",
				data: 'jenis_pengecekan='+jenis_pengecekan+'&leveluser='+leveluser+'&no='+no,
				cache: false,
				success: function(data){
					console.log(data);
				}
			});
		}else{
			var jenis_pengecekan = 'service';
			$.ajax({
				method: "post",
				url: "notif_pengecekan/hapus_pesan_pengecekan.php",
				data: 'jenis_pengecekan='+jenis_pengecekan+'&leveluser='+leveluser+'&no='+no,
				cache: false,
				success: function(data_service){
					console.log(data_service);
				}
			});
		}
	}	*/

</script>

<?php
session_start();
include "../config/koneksi_service.php";

$leveluser = $_POST['leveluser'];


	if($leveluser =='admin' or $leveluser =='CCO' or $leveluser =='HRD'){
	if($leveluser =='admin'){
		$read = "n.read_admin = 'N'";
	}else{
		$read = "n.read_hrd = 'N'";
	}

		$pesan_showroom = mysql_query("SELECT n.tipe_pengecekan, psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kategori_penilaian, psd.tanggal, psd.no_pengecekan FROM pengecekan_showroom_detail psd
								left join notif_pengecekan n on psd.no_pengecekan = n.no_pengecekan
								where $read and psd.hasil = 'N' and psd.catatan_pengecekan != '' group by no order by tanggal desc, jam asc", $koneksi_showroom);
	
    while ($data_showroom = mysql_fetch_array($pesan_showroom)){
			$no_pengecekan = $data_showroom['no_pengecekan'];
			$no_pengecekan_mingguan = $data_showroom['no_pengecekan_mingguan'];

?>

		<li class="unread">
			<a onclick = "link_pengecekan(<?php echo substr($data_showroom['no_pengecekan_mingguan'], 2,2).','.$data_showroom['no'].','.'1' ?>); ">
				<div class="clearfix" id="link_user">
					<div class="thread-content">
						<!--button type="button" class="close" data-dismiss="modal" aria-label="Close" id = "abaikan" onclick='hapus_notif_showroom(<?php echo $data_showroom['no'] ?>);'>
							<span aria-hidden="true">&times;</span>
						</button-->
						<div class="author"><span class='label label-info'><?php echo strtoupper(substr($data_showroom['tipe_pengecekan'], 11, 10)); ?></span></div>
						<span class="author" style="margin-top:5px;"><?php echo $data_showroom['kategori_penilaian'] ;?></span>
						<br>
						<span class="preview">
							<?php 
								if($leveluser == 'admin' or $leveluser == 'HRD' or $leveluser =='MNGR'){
									echo $data_showroom['catatan_pengecekan'] ;
								}else{
									echo $data_showroom['keterangan_catatan_pengecekan'] ;
								}
							?>
							</br>
						</span>
						<span class="time"><?php echo substr($data_showroom['tanggal'], 8, 2).'-'.substr($data_showroom['tanggal'], 5, 2).'-'.substr($data_showroom['tanggal'], 0, 4) .' '. $data_showroom['jam']; ?></span>
						<br>
						<!--div>
							<span class='label label-success' onclick = "link_pengecekan(<?php echo substr($data_showroom['no_pengecekan_mingguan'], 2,2).','.$data_showroom['no'].','.'1' ?>); ">Tambahkan Keterangan</span> 
						</div-->
					</div>
				</div>
			</a>
		</li>
		
<?php 
	}
	}

	if($leveluser =='admin' or $leveluser =='CCO' or $leveluser =='HRD'){
	if($leveluser =='admin'){
		$read = "and n.read_admin = 'N'";
	}else{
		$read = "and n.read_hrd = 'N'";
	}
	
		$pesan_service1 = "SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kategori_penilaian, psd.tanggal, psd.no_pengecekan FROM pengecekan_service_detail psd
										left join notif_pengecekan_service n on psd.no_pengecekan = n.no_pengecekan
										where psd.jam = n.jam and psd.kategori_penilaian = n.kategori_penilaian and psd.hasil = 'N' and psd.catatan_pengecekan != '' $read group by no order by tanggal desc, jam asc";
	
	$pesan_service = mysql_query("$pesan_service1",$koneksi_service);

    while ($data_service = mysql_fetch_array($pesan_service)){
			$no_pengecekan = $data_service['no_pengecekan'];
			$no_pengecekan_mingguan = $data_service['no_pengecekan_mingguan'];

?>
		<li class="unread" >
			<a onclick = "link_pengecekan(<?php echo substr($no_pengecekan_mingguan, 2, 2).','.$data_service['no'].','.'2'; ?>);">
				<div class="clearfix" id="link_user">
					<div class="thread-content">
						<div class="author"><span class='label label-info'><?php echo "SERVICE"; ?></span></div>
						<span class="author" style="margin-top:5px;"><?php echo $data_service['kategori_penilaian'] ;?></span>
						<br>
						<span class="preview">
							<?php 
								if($leveluser == 'admin' or $leveluser == 'HRD' or $leveluser =='mngr_bengkel'){
									echo $data_service['catatan_pengecekan'] ;
								}else{
									echo $data_service['keterangan_catatan_pengecekan'] ;
								}
							?>
							</br>
						</span>
						<span class="time"><?php echo substr($data_service['tanggal'], 8, 2).'-'.substr($data_service['tanggal'], 5, 2).'-'.substr($data_service['tanggal'], 0, 4) .' '. $data_service['jam']; ?></span>
						<br>
						<!--div>
							<span class='label label-success' onclick = "link_pengecekan(<?php echo substr($no_pengecekan_mingguan, 2, 2).','.$data_service['no'].','.'2'; ?>);">Tambahkan Keterangan</span>
						</div-->
					</div>
				</div>
			</a>
		</li>
		
<?php 
	}
	}
	
	
	if($leveluser =='admin' or $leveluser =='CCO' or ($leveluser =='supervisor' and $_SESSION['username'] == 'supervisor') or ($leveluser =='supervisor' and $_SESSION['username'] == 'sudi123')){
		
	if($leveluser =='admin'){
		$read = "and n.read_admin = 'N'";
	}else{
		$read = "and n.read_spv = 'N'";
	}
	
		$pesan_penampilan_sales1 = "SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kode_sales, psd.tanggal, psd.no_pengecekan FROM pengecekan_penampilan_sales_detail psd 
									left join notif_penampilan_sales n on psd.no_pengecekan = n.no_pengecekan 
									where (psd.catatan_pengecekan != 'PAMERAN' and psd.catatan_pengecekan != 'SAKIT' and psd.catatan_pengecekan != 'TEST DRIVE' and psd.catatan_pengecekan != 'KE GUDANG' and psd.catatan_pengecekan != 'CUTI' and psd.catatan_pengecekan != 'OFF' and 
									psd.catatan_pengecekan != 'ANTAR MOBIL' and psd.catatan_pengecekan != 'BERTEMU DENGAN CUSTOMER' )
									and psd.jam = n.jam and psd.kode_sales = n.kode_sales and psd.hasil_penilaian = 'N' and psd.catatan_pengecekan != '' $read group by no_pengecekan, kode_sales, jam order by tanggal desc, jam asc";
	
	$pesan_penampilan_sales = mysql_query("$pesan_penampilan_sales1",$koneksi_showroom);

    while ($data_pesan_penampilan_sales = mysql_fetch_array($pesan_penampilan_sales)){
			$no_pengecekan = $data_pesan_penampilan_sales['no_pengecekan'];
			$no_pengecekan_mingguan = $data_pesan_penampilan_sales['no_pengecekan_mingguan'];
?>
	<li class="unread" >
		<a onclick = "link_pengecekan(<?php echo substr($no_pengecekan_mingguan, 2, 2).','.$data_pesan_penampilan_sales['no'].','.'3'; ?>);">
			<div class="clearfix" id="link_user">
				<div class="thread-content">
					<div class="author"><span class='label label-info'><?php echo "PENGECEKAN PENAMPILAN SALES"; ?></span></div>
					<span class="author" style="margin-top:5px;"><?php echo $data_pesan_penampilan_sales['kode_sales'] ;?></span>
					
					<span class="preview">
						<?php 
							if($leveluser == 'admin' or $leveluser == 'supervisor' or $leveluser =='MNGR' or $leveluser =='DRKSI'){
								echo $data_pesan_penampilan_sales['catatan_pengecekan'] ;
							}else{
								echo $data_pesan_penampilan_sales['keterangan_catatan_pengecekan'] ;
							}
						?>
						</br>
					</span>
					<span class="time"><?php echo substr($data_pesan_penampilan_sales['tanggal'], 8, 2).'-'.substr($data_pesan_penampilan_sales['tanggal'], 5, 2).'-'.substr($data_pesan_penampilan_sales['tanggal'], 0, 4) .' '. $data_pesan_penampilan_sales['jam']; ?></span>
					<br>
					<!--div>
						<span class='label label-success' onclick = "link_pengecekan(<?php echo substr($no_pengecekan_mingguan, 2, 2).','.$data_pesan_penampilan_sales['no'].','.'3'; ?>);">Tambahkan Keterangan</span>
					</div-->
				</div>
			</div>
		</a>
	</li>
	

<?php
	}
	}

	
	if($leveluser =='admin' or $leveluser =='CCO' or $leveluser =='mngr_bengkel' ){
	if($leveluser =='admin'){
		$pesan_penampilan_sa1 = "SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kode_sa, psd.tanggal, psd.no_pengecekan FROM pengecekan_penampilan_sa_detail psd 
										left join notif_penampilan_sa n on psd.no_pengecekan = n.no_pengecekan where (psd.catatan_pengecekan != 'OFF' and psd.catatan_pengecekan != 'SAKIT') and  n.read_admin = 'N' and psd.jam = n.jam and psd.kode_sa = n.kode_sa_bp and n.read_admin = 'N' and psd.hasil_penilaian = 'N' and psd.catatan_pengecekan != '' 
										group by kode_sa, catatan_pengecekan, no_pengecekan, jenis_penilaian, jam order by tanggal desc, jam desc ";
	}elseif($leveluser =='CCO'){
		$pesan_penampilan_sa1 = "SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kode_sa, psd.tanggal, psd.no_pengecekan FROM pengecekan_penampilan_sa_detail psd 
										left join notif_penampilan_sa n on psd.no_pengecekan = n.no_pengecekan where n.read_cco = 'N' and psd.jam = n.jam and psd.kode_sa = n.kode_sa_bp and n.read_cco = 'N' and psd.hasil_penilaian = 'N' and psd.catatan_pengecekan != '' 
										group by kode_sa, catatan_pengecekan, no_pengecekan, jenis_penilaian, jam order by tanggal desc, jam desc ";
	}elseif($leveluser =='mngr_bengkel'){
		$pesan_penampilan_sa1 = "SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kode_sa, psd.tanggal, psd.no_pengecekan FROM pengecekan_penampilan_sa_detail psd 
										left join notif_penampilan_sa n on psd.no_pengecekan = n.no_pengecekan where (psd.catatan_pengecekan != 'OFF' and psd.catatan_pengecekan != 'SAKIT') and  n.read_spv = 'N' and psd.jam = n.jam and psd.kode_sa = n.kode_sa_bp and psd.hasil_penilaian = 'N' and psd.catatan_pengecekan != '' 
										group by kode_sa, catatan_pengecekan, no_pengecekan, jenis_penilaian, jam order by tanggal desc, jam desc  ";
	}else{
		$pesan_penampilan_sa1 = "SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kode_sa, psd.tanggal, psd.no_pengecekan FROM pengecekan_penampilan_sa_detail psd 
										left join notif_penampilan_sa n on psd.no_pengecekan = n.no_pengecekan where psd.jam = n.jam and psd.kode_sa = n.kode_sa_bp and psd.hasil_penilaian = 'S' and psd.catatan_pengecekan != '' 
										group by kode_sa, catatan_pengecekan, no_pengecekan, jenis_penilaian, jam order by tanggal desc, jam desc  ";
	}
	
	$pesan_penampilan_sales = mysql_query("$pesan_penampilan_sa1",$koneksi_service);

    while ($data_pesan_penampilan_sales = mysql_fetch_array($pesan_penampilan_sales)){
			$no_pengecekan = $data_pesan_penampilan_sales['no_pengecekan'];
			$no_pengecekan_mingguan = $data_pesan_penampilan_sales['no_pengecekan_mingguan'];
?>

	<!--li class="unread" >
		<a>
			<div class="clearfix" id="link_user">
				<div class="thread-content">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close" id = "abaikan" onclick='hapus_notif(<?php echo $data_pesan_penampilan_sales['no'].','.'2' ?>);'>
						<span aria-hidden="true">&times;</span>
					</button>
					<div class="author"><span class='label label-info'><?php echo "PENGECEKAN PENAMPILAN SA"; ?></span></div>
					<span class="author" style="margin-top:5px;"><?php echo $data_pesan_penampilan_sales['kode_sa'] ;?></span>
					
					<span class="preview">
						<?php 
							if($leveluser == 'admin' or $leveluser == 'supervisor' or $leveluser =='mngr_bengkel'){
								echo $data_pesan_penampilan_sales['catatan_pengecekan'] ;
							}else{
								echo $data_pesan_penampilan_sales['keterangan_catatan_pengecekan'] ;
							}
						?>
						</br>
					</span>
					<span class="time"><?php echo substr($data_pesan_penampilan_sales['tanggal'], 8, 2).'-'.substr($data_pesan_penampilan_sales['tanggal'], 5, 2).'-'.substr($data_pesan_penampilan_sales['tanggal'], 0, 4) .' '. $data_pesan_penampilan_sales['jam']; ?></span>
					<br>
					<div>
						<span class='label label-success' onclick = "link_pengecekan(<?php echo substr($no_pengecekan_mingguan, 2, 2).','.$data_pesan_penampilan_sales['no'].','.'4'; ?>);">Tambahkan Keterangan</span>
					</div>
				</div>
			</div>
		</a>
	</li-->
	
<?php
	}
	}
?>


