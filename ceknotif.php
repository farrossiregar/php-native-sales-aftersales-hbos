<?php
session_start();
include "config/koneksi.php";
	
	$leveluser_notif = $_POST['leveluser'];


	if($leveluser_notif=='admin'){
	//	$pesan = mysql_query("SELECT t.nama_tipe,m.nama_model,pd.* FROM pengajuan_discount pd left join model m on m.kode_model = pd.model left join tipe t on t.kode_tipe = pd.tipe_mobil where pd.notif_admin = 'Y' and pd.proses_approve != '' order by tgl_pengajuan_ulang desc");
		$pesan = mysql_query("SELECT n.read_admin, n.notif_admin, pd.no_pengajuan, pd.nama_sales, pd.discount_unit, pd.pengajuan_disc, pd.total_discount_accs, pd.status_approved, pd.proses_approve FROM pengajuan_discount pd 
								left join notif n on pd.no_pengajuan = n.no_pengajuan  
								where n.notif_admin = 'Y' and (pd.proses_approve = 'N' or pd.status_approved='AL') order by pd.tgl_pengajuan_ulang");
	}elseif($leveluser_notif=='DRKSI'){
		$pesan = mysql_query("SELECT n.read_admin, n.notif_admin, pd.no_pengajuan, pd.nama_sales, pd.discount_unit, pd.pengajuan_disc, pd.total_discount_accs, pd.status_approved, pd.proses_approve FROM pengajuan_discount pd 
								left join notif n on pd.no_pengajuan = n.no_pengajuan 
								where n.notif_drksi = 'Y' and (pd.proses_approve = 'N' or pd.status_approved='AL') order by pd.tgl_pengajuan_ulang");
	}elseif($leveluser_notif=='MNGR'){
		$pesan = mysql_query("SELECT n.read_admin, n.notif_admin, pd.no_pengajuan, pd.nama_sales, pd.discount_unit, pd.pengajuan_disc, pd.total_discount_accs, pd.status_approved, pd.proses_approve FROM pengajuan_discount pd 
								left join notif n on pd.no_pengajuan = n.no_pengajuan 
								where n.notif_mngr = 'Y' and pd.proses_approve = 'N' order by pd.tgl_pengajuan_ulang");
	}elseif($leveluser_notif=='user'){
		$pesan = mysql_query("SELECT n.read_admin, n.notif_admin, pd.no_pengajuan, pd.nama_sales, pd.discount_unit, pd.pengajuan_disc, pd.total_discount_accs FROM pengajuan_discount pd 
								left join notif n on pd.no_pengajuan = n.no_pengajuan 
								where n.notif_user = 'Y' and pd.proses_approve = 'Y' and (pd.status_approved = 'Y' or pd.status_approved = 'N') order by pd.tgl_pengajuan_ulang limit 20");
	}else{
		$pesan = mysql_query("SELECT t.nama_tipe,m.nama_model,pd.* FROM pengajuan_discount pd left join model m on m.kode_model = pd.model left join tipe t on t.kode_tipe = pd.tipe_mobil where pd.proses_approve != '' and kode_spv ='ucok' order by tgl_pengajuan_ulang desc");
	}
	
		while($sql = mysql_fetch_array($pesan)){
			$row = mysql_num_rows($pesan);
			$no_pengajuan = $sql['no_pengajuan'];
			$no_pengajuan_md5 = md5(md5($sql['no_pengajuan']));
			$nama_sales = $sql['nama_sales'];
			$discount_unit = $sql['discount_unit'];
			$pengajuan_disc = $sql['pengajuan_disc'];
			$disc_bruto = $pengajuan_disc + $sql['total_discount_accs'];
		//	$status_approved = $sql['status_approved'];
			$proses_approve = $sql['proses_approve'];
			
			$pdu = mysql_query("select * from pengajuan_discount_ulang where no_pengajuan = '$no_pengajuan' and aktif = 'Y'");
			$data_pdu = mysql_fetch_array($pdu);
			$num_pdu = mysql_num_rows($pdu);
			if($num_pdu > 0){
				$discount_unit = $data_pdu['discount_unit'];
				$disc_bruto = $data_pdu['pengajuan_disc'] + $data_pdu['total_discount_accs'];
			}
			
			if($leveluser_notif=='admin'){
				$link = "media_showroom.php?module=prospek_pengajuandiscount&act=ajukanapprove&id=".$no_pengajuan_md5;
			}elseif($leveluser_notif=='DRKSI'){
				if($proses_approve == 'N'){
					$link = "media_showroom.php?module=prospek_pengajuandiscount&act=approvepengajuan&id=".$no_pengajuan_md5."&info=Y";
				}else{
					$link = "media_showroom.php?module=prospek_pengajuandiscount&act=approvepengajuan&id=".$no_pengajuan_md5;
				}
			}elseif($leveluser_notif=='MNGR'){
				if($discount_unit > $disc_bruto){
					$link = "media_showroom.php?module=prospek_pengajuandiscount&act=approvepengajuan&id=".$no_pengajuan_md5;
				}else{
					$link = "media_showroom.php?module=prospek_pengajuandiscount&act=ajukanapprove&id=".$no_pengajuan_md5;
				}
			}else{
				
			}
			
			
			if($row > 0){
				echo $no_pengajuan.','.$nama_sales.','.$discount_unit.','.$pengajuan_disc.','.$link.'|';
			}else{
				echo "";
			}
		}
?>