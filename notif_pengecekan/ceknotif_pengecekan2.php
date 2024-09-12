<?php
session_start();
include "../config/koneksi.php";
	$leveluser = $_POST['leveluser'];
	$action = $_POST['action'];
	$pengecekan = $_POST['pengecekan'];
	
	if($action == '1'){
		if($pengecekan == 'showroom'){
				if($leveluser == 'admin'){			
					$notif = "n.notif_admin = 'Y'";	

				}else{
					$notif = "n.notif_admin = 'Y'";	
				}
				
				$pesan = mysql_query("SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.keterangan_catatan_pengecekan, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kategori_penilaian, psd.tanggal, psd.no_pengecekan FROM pengecekan_showroom_detail psd
											left join notif_pengecekan n on psd.no_pengecekan = n.no_pengecekan
											where $notif and psd.hasil = 'N' and psd.catatan_pengecekan != '' ");
					while($sql = mysql_fetch_array($pesan)){
						$row = mysql_num_rows($pesan);
						$no = $sql['no'];
						$no_pengecekan = $sql['no_pengecekan'];
						$no_pengecekan_mingguan = $sql['no_pengecekan_mingguan'];
						$tanggal = substr($sql['tanggal'], 8, 2).'-'.substr($sql['tanggal'], 5, 2).'-'.substr($sql['tanggal'], 0, 4);
						$jam = $sql['jam'];
						$kategori_pengecekan = $sql['kategori_penilaian'];
						$catatan_pengecekan = $sql['catatan_pengecekan'];
						$keterangan_catatan_pengecekan = $sql['keterangan_catatan_pengecekan'];
					
						if($leveluser == 'admin' or $leveluser == 'HRD'){
							$link = "media_showroom.php?module=checklist_showroom&act=lihat&id=$no_pengecekan_mingguan&no=$no";
						}else{
							$link = "media_showroom.php?module=checklist_showroom&act=lihat&id=$no_pengecekan_mingguan";
						}
						if($row > 0){
							echo $no_pengecekan.','.$tanggal.','.$jam.','.$kategori_pengecekan.','.$catatan_pengecekan.','.$link.','.$keterangan_catatan_pengecekan;
						}else{
							echo "";
						}
					}
		}elseif($pengecekan == 'service'){
			if($leveluser == 'admin'){	
				$notif = "and n.notif_admin = 'Y' ";	
			}else{
				$notif = "and n.notif_hrd = 'Y' ";
			}
			
			$pesan = mysql_query("SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kategori_penilaian, psd.tanggal, psd.no_pengecekan FROM pengecekan_service_detail psd
										left join notif_pengecekan_service n on psd.no_pengecekan = n.no_pengecekan
										where psd.jam = n.jam and psd.kategori_penilaian = n.kategori_penilaian and psd.jam = n.jam and psd.kategori_penilaian = n.kategori_penilaian and psd.hasil = 'N' and psd.catatan_pengecekan != '' $notif", $koneksi_service);
			
				while($sql = mysql_fetch_array($pesan)){
					$row = mysql_num_rows($pesan);
					$no = $sql['no'];
					$no_pengecekan = $sql['no_pengecekan'];
					$no_pengecekan_mingguan = $sql['no_pengecekan_mingguan'];
					$tanggal = substr($sql['tanggal'], 8, 2).'-'.substr($sql['tanggal'], 5, 2).'-'.substr($sql['tanggal'], 0, 4);
					$jam = $sql['jam'];
					$kategori_pengecekan = $sql['kategori_penilaian'];
					$catatan_pengecekan = $sql['catatan_pengecekan'];
				
					
					if($leveluser == 'admin' or $leveluser == 'HRD'){
						$link = "media_showroom.php?module=service_checklist_service&act=lihat&id=$no_pengecekan_mingguan&no=$no";
					}else{
						$link = "media_showroom.php?module=service_checklist_service&act=lihat&id=$no_pengecekan_mingguan";
					}
					if($row > 0){
						echo $no_pengecekan.','.$tanggal.','.$jam.','.$kategori_pengecekan.','.$catatan_pengecekan.','.$link;
					}else{
						echo "";
					}
				}
		}elseif($pengecekan == 'sales'){
			if($leveluser == 'admin'){	
				$notif = "and n.notif_admin = 'Y'";
			}elseif($leveluser == 'supervisor' and $_SESSION['username']=='supervisor'){
				$notif = "and n.notif_spv = 'Y'";
			}else{
				$notif = "and n.notif_spv = 'A'";
			}
			
			$pesan = mysql_query("SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kode_sales, psd.tanggal, psd.no_pengecekan FROM pengecekan_penampilan_sales_detail psd 
												left join notif_penampilan_sales n on psd.no_pengecekan = n.no_pengecekan 
												where psd.jam = n.jam and psd.kode_sales = n.kode_sales and psd.hasil_penilaian = 'N' and psd.catatan_pengecekan != '' $notif group by no_pengecekan, kode_sales, jam order by tanggal desc, jam asc  ");
			
				while($sql = mysql_fetch_array($pesan)){
					$row = mysql_num_rows($pesan);
					$no = $sql['no'];
					$no_pengecekan = $sql['no_pengecekan'];
					$no_pengecekan_mingguan = $sql['no_pengecekan_mingguan'];
					$tanggal = substr($sql['tanggal'], 8, 2).'-'.substr($sql['tanggal'], 5, 2).'-'.substr($sql['tanggal'], 0, 4);
					$jam = $sql['jam'];
					$kode_sales = $sql['kode_sales'];
					$catatan_pengecekan = $sql['catatan_pengecekan'];
					$keterangan_catatan_pengecekan = $sql['keterangan_catatan_pengecekan'];
				
					if($leveluser == 'admin' or $leveluser == 'HRD'){
						$link = "media_showroom.php?module=checklist_penampilan_sales&act=lihat&id=$no_pengecekan_mingguan&no=$no";
					}else{
						$link = "media_showroom.php?module=checklist_penampilan_sales&act=lihat&id=$no_pengecekan_mingguan";
					}
					if($row > 0){
						echo $no_pengecekan.','.$tanggal.','.$jam.','.$kode_sales.','.$catatan_pengecekan.','.$link.','.$keterangan_catatan_pengecekan;
					}else{
						echo "";
					}
				}
		}elseif($pengecekan == 'sa'){
		/*	if($leveluser == 'admin'){		
				$notif = "and n.notif_admin = 'Y' ";
			}else{
				$notif = "and n.notif_admin = 's' ";
			}
			
			$pesan = mysql_query("SELECT psd.no, psd.no_pengecekan_mingguan, psd.jam, psd.catatan_pengecekan, psd.keterangan_catatan_pengecekan, psd.kode_sa, psd.tanggal, psd.no_pengecekan FROM pengecekan_penampilan_sa_detail psd 
												left join notif_penampilan_sa n on psd.no_pengecekan = n.no_pengecekan where psd.jam = n.jam and psd.kode_sa = n.kode_sa_bp and psd.hasil_penilaian = 'N' and psd.catatan_pengecekan != '' $notif
												group by kode_sa, catatan_pengecekan, no_pengecekan, jenis_penilaian, jam order by tanggal desc, jam desc");

			
				while($sql = mysql_fetch_array($pesan)){
					$row = mysql_num_rows($pesan);
					$no = $sql['no'];
					$no_pengecekan = $sql['no_pengecekan'];
					$no_pengecekan_mingguan = $sql['no_pengecekan_mingguan'];
					$tanggal = substr($sql['tanggal'], 8, 2).'-'.substr($sql['tanggal'], 5, 2).'-'.substr($sql['tanggal'], 0, 4);
					$jam = $sql['jam'];
					$kode_sales = $sql['kode_sa'];
					$catatan_pengecekan = $sql['catatan_pengecekan'];
					$keterangan_catatan_pengecekan = $sql['keterangan_catatan_pengecekan'];
				
					if($leveluser == 'admin' or $leveluser == 'HRD'){
						$link = "media_showroom.php?module=service_checklist_penampilan_sa&act=lihat&id=$no_pengecekan_mingguan&no=$no";
					}else{
						$link = "media_showroom.php?module=service_checklist_penampilan_sa&act=lihat&id=$no_pengecekan_mingguan";
					}
					if($row > 0){
						echo $no_pengecekan.','.$tanggal.','.$jam.','.$kode_sales.','.$catatan_pengecekan.','.$link.','.$keterangan_catatan_pengecekan;
					}else{
						echo "";
					}
				}	*/
		}else{
			
		}
	}elseif($action == '2'){
		if($pengecekan == 'showroom'){
			if(count($_POST)) {
				if($leveluser == 'admin'){
					$pesan = mysql_query("UPDATE notif_pengecekan set notif_admin = 'N' WHERE notif_admin = 'Y'");
				}elseif($leveluser == 'CCO'){
					$pesan = mysql_query("UPDATE notif_pengecekan set notif_cco = 'N' WHERE notif_cco = 'Y'");
				}elseif($leveluser == 'HRD' or $leveluser == 'MNGR' or $leveluser == 'DRKSI'){
					$pesan = mysql_query("UPDATE notif_pengecekan set notif_hrd = 'N' WHERE notif_hrd = 'Y'");
				}else{
					
				}
					$berhasil = "sukses showroom";
					echo $berhasil;
			}
		}elseif($pengecekan == 'service'){
			if(count($_POST)){
				if($leveluser == 'admin'){
					$pesan = mysql_query("UPDATE notif_pengecekan_service set notif_admin = 'N' WHERE notif_admin = 'Y'",$koneksi_service);
				}elseif($leveluser == 'CCO'){
					$pesan = mysql_query("UPDATE notif_pengecekan_service set notif_cco = 'N' WHERE notif_cco = 'Y'",$koneksi_service);
				}elseif($leveluser == 'HRD' or $leveluser == 'MNGR' or $leveluser == 'DRKSI'){
					$pesan = mysql_query("UPDATE notif_pengecekan_service set notif_hrd = 'N' WHERE notif_hrd = 'Y'",$koneksi_service);
				}else{
					
				}
			}
		}elseif($pengecekan == 'sales'){
			if(count($_POST)){
				if($leveluser == 'admin'){
					$pesan = mysql_query("UPDATE notif_penampilan_sales set notif_admin = 'N' WHERE notif_admin = 'Y'");
				}elseif($leveluser == 'CCO'){
					$pesan = mysql_query("UPDATE notif_penampilan_sales set notif_cco = 'N' WHERE notif_cco = 'Y'");
				}elseif($leveluser == 'supervisor' ){
					$pesan = mysql_query("UPDATE notif_penampilan_sales set notif_spv = 'N' WHERE notif_spv = 'Y'");
				}else{
					
				}
			}
		}elseif($pengecekan == 'sa'){
			if(count($_POST)) {
				if($leveluser == 'admin'){
					$pesan = mysql_query("UPDATE notif_penampilan_sa set notif_admin = 'N' WHERE notif_admin = 'Y'");
				}elseif($leveluser == 'CCO'){
					$pesan = mysql_query("UPDATE notif_penampilan_sa set notif_cco = 'N' WHERE notif_cco = 'Y'");
				}elseif($leveluser == 'HRD' or $leveluser == 'MNGR' or $leveluser == 'DRKSI'){
					$pesan = mysql_query("UPDATE notif_penampilan_sa set notif_cco = 's' WHERE notif_cco = 'Y'");
				}else{
					
				}
				$berhasil = "mantap";
				echo $berhasil;	
			}
		}else{
			
		}
	}else{
		
	}
	
	

?>