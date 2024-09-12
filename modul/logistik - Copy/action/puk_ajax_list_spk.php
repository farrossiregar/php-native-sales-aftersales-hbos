<?php 
session_start();
include "../../../config/koneksi_sqlserver.php";
include "../../../config/koneksi.php";


?>
<script>

	function cari_data(){
		var $rows = $('#isi_data tr');
		$('#search').keyup(function() {
			var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
			
			$rows.show().filter(function() {
				var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
				return !~text.indexOf(val);
			}).hide();
		});
	}
</script>
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title" id="myModalLabel">Pilih Data</h4>
									</div>
									<div class="modal-body">
									
										<div class = "table-responsive">
											<table class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th colspan = "2">
															<input type="text" class="form-control" name="search" id="search" onkeyup="cari_data()" autofocus>
														</th>
														
													</tr>
												</thead>
												<tbody id="isi_data">
													
													<?php
														$query_salesman = mysql_query("select * from users where username = '$_SESSION[username]'");
														$kode_sales = mysql_fetch_array($query_salesman);
														
														if ($_SESSION['leveluser'] == 'admin' || $_SESSION['leveluser'] == 'MNGR'){
															$filter = "";
														}else{$filter = "and kode_sales = '$kode_sales[kode_sales]'"; }
														
														$query = "select SPK.NomorSPK,SPK.NamaCustomer from vw_PukSOS SPK
																where SPK.NoBSTK = '-' and SPK.norangka !='-' $filter ";
														$query = sqlsrv_query($conn, $query);
														$n=0;
														while($data = sqlsrv_fetch_array($query)){
															
														$n=$n+1;
														
														$query_puk = mysql_query("select * from unit_keluar where no_spk = '$data[NomorSPK]'");
														if (mysql_num_rows($query_puk) < 1){
													?>
								
													<tr id="tr" style="cursor: pointer; ">
														<td id="td" name="td<?php echo $n; ?>" data-dismiss="modal" onclick="post();" value="">
															<?php echo $data['NomorSPK']; ?>
														</td>
														<td data-dismiss="modal" onclick="post();"><?php echo $data['NamaCustomer']; ?> </td>
													</tr>
													<?php
														}}
													?>
													
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>