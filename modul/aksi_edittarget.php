<?php
include "../config/koneksi.php";
if(count($_POST)) {
		mysql_unbuffered_query("update target_sa set target_dealer = '$_POST[target_dealer]', target_unit = '$_POST[target_unit]',target_point = '$_POST[target_point]' where id_target = '$_POST[id]'");
		$msg = "							
							<div class='alert alert-success alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
							<h4><i class='icon fa fa-check'></i> Selamat!</h4>
							Data telah berhasil dirubah</div>";
							header('location:../media.php?module=sub_target_data');
	}
?>