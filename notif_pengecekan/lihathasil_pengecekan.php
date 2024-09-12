<script language="JavaScript">
	function warning() {
		return confirm('Anda yakin menghapus data ini?');
	}
	
	function link_approve($no_pengecekan_mingguan, $no){
		var no_pengecekan_mingguan = "PS" + $no_pengecekan_mingguan;
		var pengecekan = $no;
		var leveluser = "<?php echo $_POST['leveluser']; ?>";
		if(pengecekan == '1'){
			var link = "media_showroom.php?module=checklist_showroom&act=approve&id="+no_pengecekan_mingguan;
		}else if(pengecekan == '2'){
			var link = "media_showroom.php?module=service_checklist_service&act=approve&id="+no_pengecekan_mingguan;
		}else if(pengecekan == '3'){
			var link = "media_showroom.php?module=checklist_penampilan_sales&act=approve&id="+no_pengecekan_mingguan;
		}else{
			var link = "media_showroom.php?module=service_checklist_penampilan_sa&act=approve&id="+no_pengecekan_mingguan;
		}
		window.location.href = link;
	}



</script>

<?php
session_start();
include "../config/koneksi_service.php";

$leveluser = $_POST['leveluser'];


	if($leveluser =='admin'){
		$approve_showroom = mysql_query("SELECT * FROM pengecekan_showroom where sign_atasan1 = ''", $koneksi_showroom);
	}else if($leveluser =='DRKSI'){
		$approve_showroom = mysql_query("SELECT * FROM pengecekan_showroom where sign_atasan2 = 'Y' and sign_atasan1 = ''", $koneksi_showroom);
	}else if($leveluser =='MNGR'){
		$approve_showroom = mysql_query("SELECT * FROM pengecekan_showroom where sign_atasan2 = ''", $koneksi_showroom);
	}else{
		$approve_showroom = mysql_query("SELECT * FROM pengecekan_showroom where sign_atasan2 = 'K'", $koneksi_showroom);
	}
	
	 while ($data_approve_showroom = mysql_fetch_array($approve_showroom)){
			$no_pengecekan_mingguan = $data_approve_showroom['no_pengecekan_mingguan'];	
	
?>
	<li class="unread" >
		<!--a style="background-color: rgb(232, 240, 255);"-->
		<a onclick = "link_approve(<?php echo substr($data_approve_showroom['no_pengecekan_mingguan'], 2,2).','.'1' ?>); ">
			<div class="clearfix" id="link_user" >
				<div class="thread-content">
					<div class="author"><span class='label label-info'>Hasil Pengecekan Showroom</span></div>
					<span class="author" style="margin-top:5px;"><!--i class = 'fa fa-check-square-o fa-2x'></i--></span>
					<span class="preview">
						<?php 
							$periode_pengecekan = mysql_query("select min(tanggal) as tgl_awal, max(tanggal) as tgl_akhir from pengecekan_showroom_detail where no_pengecekan_mingguan = '$no_pengecekan_mingguan'",$koneksi_showroom);
							$data_periode_pengecekan = mysql_fetch_array($periode_pengecekan);
							$tanggal_awal = $data_periode_pengecekan['tgl_awal'];
							$tanggal_akhir = $data_periode_pengecekan['tgl_akhir'];
							echo "Hasil Pengecekan Showroom pada Periode ".$tanggal_awal." - ".$tanggal_akhir."";
						
						?>
						</br>
					</span>
					<br>
					<!--div>
						<span class='label label-warning' onclick = "link_approve(<?php echo substr($data_approve_showroom['no_pengecekan_mingguan'], 2,2).','.'1' ?>); ">Setujui Pengecekan Showroom</span> 
					</div-->
				</div>
			</div>
		</a>
	</li>

<?php	
	}

	if($leveluser =='admin'){
		$approve_service = mysql_query("SELECT * FROM pengecekan_service where sign_atasan1 = ''", $koneksi_service);
	}else if($leveluser =='DRKSI'){
		$approve_service = mysql_query("SELECT * FROM pengecekan_service where sign_atasan2 = 'Y' and sign_atasan1 = ''", $koneksi_service);
	}else if($leveluser =='mngr_bengkel'){
		$approve_service = mysql_query("SELECT * FROM pengecekan_service where sign_atasan2 = ''", $koneksi_service);
	}else{
		$approve_service = mysql_query("SELECT * FROM pengecekan_service where sign_atasan1 = 'K'", $koneksi_service);
	}

	 while ($data_approve_service = mysql_fetch_array($approve_service)){
		 
			$no_pengecekan_mingguan = $data_approve_service['no_pengecekan_mingguan'];	
			
?>
	<li class="unread">
		<a onclick = "link_approve(<?php echo substr($data_approve_service['no_pengecekan_mingguan'], 2,2).','.'2' ?>); ">
			<div class="clearfix" id="link_user">
				<div class="thread-content">
					<div class="author"><span class='label label-info'>Hasil Pengecekan Service</span></div>
					<span class="author" style="margin-top:5px;"></span>
					<span class="preview">
						<?php 
							$periode_pengecekan = mysql_query("select min(tanggal) as tgl_awal, max(tanggal) as tgl_akhir from pengecekan_service_detail where no_pengecekan_mingguan = '$no_pengecekan_mingguan'",$koneksi_service);
							$data_periode_pengecekan = mysql_fetch_array($periode_pengecekan);
							$tanggal_awal = $data_periode_pengecekan['tgl_awal'];
							$tanggal_akhir = $data_periode_pengecekan['tgl_akhir'];
							echo "Hasil Pengecekan Service pada Periode ".$tanggal_awal." - ".$tanggal_akhir."";
						
						?>
						</br>
					</span>
					<span class="time"><?php echo substr($data_approve_service['tanggal'], 8, 2).'-'.substr($data_approve_service['tanggal'], 5, 2).'-'.substr($data_approve_service['tanggal'], 0, 4); ?></span>
					<br>
					<!--div>
						<span class='label label-warning' onclick = "link_approve(<?php echo substr($data_approve_service['no_pengecekan_mingguan'], 2,2).','.'2' ?>); ">Setujui Pengecekan Service</span> 
					</div-->
				</div>
			</div>
		</a>
	</li>

<?php
	 }

	if($leveluser =='admin'){
		$approve_penampilan_sales = mysql_query("SELECT * FROM pengecekan_penampilan_sales where sign_atasan1 = ''", $koneksi_showroom);
	}else if($leveluser =='DRKSI'){
		$approve_penampilan_sales = mysql_query("SELECT * FROM pengecekan_penampilan_sales where sign_atasan2 = 'Y' and sign_atasan1 = ''", $koneksi_showroom);
	}else if($leveluser =='MNGR'){
		$approve_penampilan_sales = mysql_query("SELECT * FROM pengecekan_penampilan_sales where sign_atasan2 = ''", $koneksi_showroom);
	}else{
		$approve_penampilan_sales = mysql_query("SELECT * FROM pengecekan_penampilan_sales where sign_atasan1 = 'K'", $koneksi_showroom);
	}
	
	 while ($data_approve_penampilan_sales = mysql_fetch_array($approve_penampilan_sales)){
			$no_pengecekan_mingguan = $data_approve_penampilan_sales['no_pengecekan_mingguan'];	
?>

	<li class="unread">
		<a onclick = "link_approve(<?php echo substr($data_approve_penampilan_sales['no_pengecekan_mingguan'], 2,2).','.'3' ?>); ">
			<div class="clearfix" id="link_user">
				<div class="thread-content">
					<div class="author"><span class='label label-info'>Hasil Pengecekan Penampilan Sales</span></div>
					<span class="author" style="margin-top:5px;"></span>
					<span class="preview">
						<?php 
							$periode_pengecekan = mysql_query("select min(tanggal) as tgl_awal, max(tanggal) as tgl_akhir from pengecekan_penampilan_sales_detail where no_pengecekan_mingguan = '$no_pengecekan_mingguan'",$koneksi_showroom);
							$data_periode_pengecekan = mysql_fetch_array($periode_pengecekan);
							$tanggal_awal = $data_periode_pengecekan['tgl_awal'];
							$tanggal_akhir = $data_periode_pengecekan['tgl_akhir'];
							echo "Hasil Pengecekan Penampilan Sales pada Periode ".$tanggal_awal." - ".$tanggal_akhir."";
						
						?>
						</br>
					</span>
					<span class="time"><?php echo substr($data_approve_penampilan_sales['tanggal'], 8, 2).'-'.substr($data_approve_penampilan_sales['tanggal'], 5, 2).'-'.substr($data_approve_penampilan_sales['tanggal'], 0, 4); ?></span>
					<br>
					<!--div>
						<span class='label label-warning' onclick = "link_approve(<?php echo substr($data_approve_penampilan_sales['no_pengecekan_mingguan'], 2,2).','.'3' ?>); ">Setujui Pengecekan Penampilan Sales</span> 
					</div-->
				</div>
			</div>
		</a>
	</li>
	
<?php
	 }
	 
	 
	if($leveluser =='admin'){
		$approve_penampilan_sales = mysql_query("SELECT * FROM pengecekan_penampilan_sa where sign_atasan1 = ''", $koneksi_service);
	}else if($leveluser =='DRKSI'){
		$approve_penampilan_sales = mysql_query("SELECT * FROM pengecekan_penampilan_sa where sign_atasan2 = 'Y' and sign_atasan1 = ''", $koneksi_service);
	}else if($leveluser =='mngr_bengkel'){
		$approve_penampilan_sales = mysql_query("SELECT * FROM pengecekan_penampilan_sa where sign_atasan2 = ''", $koneksi_service);
	}else{
		$approve_penampilan_sales = mysql_query("SELECT * FROM pengecekan_penampilan_sa where sign_atasan1 = 'K'", $koneksi_service);
	}
	
	 while ($data_approve_penampilan_sales = mysql_fetch_array($approve_penampilan_sales)){
			$no_pengecekan_mingguan = $data_approve_penampilan_sales['no_pengecekan_mingguan'];	
?>
	<li class="unread">
		<a onclick = "link_approve(<?php echo substr($data_approve_penampilan_sales['no_pengecekan_mingguan'], 2,2).','.'4' ?>); ">
			<div class="clearfix" id="link_user">
				<div class="thread-content">
					<div class="author"><span class='label label-info'>Hasil Pengecekan Penampilan SA</span></div>
					<span class="author" style="margin-top:5px;"></span>
					<span class="preview">
						<?php 
							$periode_pengecekan = mysql_query("select min(tanggal) as tgl_awal, max(tanggal) as tgl_akhir from pengecekan_penampilan_sa_detail where no_pengecekan_mingguan = '$no_pengecekan_mingguan'",$koneksi_service);
							$data_periode_pengecekan = mysql_fetch_array($periode_pengecekan);
							$tanggal_awal = $data_periode_pengecekan['tgl_awal'];
							$tanggal_akhir = $data_periode_pengecekan['tgl_akhir'];
							echo "Hasil Pengecekan Service pada Periode ".$tanggal_awal." - ".$tanggal_akhir."";
						
						?>
						</br>
					</span>
					<span class="time"><?php echo substr($data_approve_penampilan_sales['tanggal'], 8, 2).'-'.substr($data_approve_penampilan_sales['tanggal'], 5, 2).'-'.substr($data_approve_penampilan_sales['tanggal'], 0, 4); ?></span>
					<br>
					<!--div>
						<span class='label label-warning' onclick = "link_approve(<?php echo substr($data_approve_penampilan_sales['no_pengecekan_mingguan'], 2,2).','.'4' ?>); ">Setujui Pengecekan Penampilan SA</span> 
					</div-->
				</div>
			</div>
		</a>
	</li>
	
<?php
	}
?>



