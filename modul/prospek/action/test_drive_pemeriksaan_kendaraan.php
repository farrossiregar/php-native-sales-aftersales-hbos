<?php 
if (count($_POST)){
session_start();
include "../../../config/koneksi_sqlserver.php";
include "../../../config/koneksi_service.php";
include "../../../config/koneksi_service_pdo.php";

$model_mobil = $_POST['model'];

$pengecekan_mobil = $pdo->query("SELECT * from test_drive_pengecekan_kendaraan where model = 'BRIO' and aktif = 'Y'");
while($data_pengecekan_mobil = $pengecekan_mobil->fetch()){

?>

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Pilih Data</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<img src ="modul/prospek/action/kondisi_kendaraan/type-sedan.jpg" width = "100%">
					</div>
					
				</div>
			</div>
		</div>
	</div>
<?php 
		}
	} 
?>