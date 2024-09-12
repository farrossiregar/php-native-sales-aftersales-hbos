<?php 
if (count($_POST)){
session_start();
include "../../../config/koneksi_sqlserver.php";
include "../../../config/koneksi_service.php";


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
											<table class="table table-striped table-bordered table-hover" id="table_filter">
												<thead>
													<tr>
														<th colspan = "2">
															<input type="text" class="form-control" name="search" id="search" onkeyup="cari_data()" autofocus>
														</th>
														
													</tr>
												</thead>
												<tbody id="isi_data">
													
													<?php
														
														
														$query = "select * from model ";
														$query = mysql_query($query);
														$n=0;
														while($data = mysql_fetch_array($query)){
															
														$n=$n+1;
														
														
													?>
								
													<tr id="tr" style="cursor: pointer; ">
														<td id="td" name="td<?php echo $n; ?>" data-dismiss="modal" onclick="post();" value="">
															<?php echo $data['kode_model']; ?>
														</td>
														<td data-dismiss="modal" onclick="post();"><?php echo $data['nama_model']; ?> </td>
													</tr>
													<?php
														}
													?>
													
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
<?php } ?>