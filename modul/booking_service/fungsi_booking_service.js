function warning() {
						return confirm('Anda yakin menghapus data ini?');
					}
					
					function status_kedatangan(){
						if($("#radio1").is(":checked")){
							$('#tidak_datang1').hide();
							$('#tidak_datang2').hide();
							$('#datang').show();
							$('#reschedule').val();
							$('#ket_tidak_datang').val();
						}
						
						if($("#radio2").is(":checked")){
							$('#tidak_datang1').show();
							$('#tidak_datang2').show();
							$('#datang').hide();
						//	alert($('#reschedule').is(':checked'));
						//	alert(jQuery('input[name="kedatangan"]:checked').val());
						}
					}
					
					
					function status_reschedule(){
						var x = document.getElementById('waktu3');
						if (x.style.display === "none") {
							x.style.display = "block";
						} else {
							x.style.display = "none";
						}
					}
					
					
					function service_type(){
					//	if($("#repair").is(":checked") || $("#warranty").is(":checked") ){
						if($("#srv3").is(":checked") || $("#srv4").is(":checked")){
							$('#perbaikan').val("").show();
							$('#perbaikan_repair').hide();
							$('#perbaikan_pm').hide();
							$('#perbaikan_pud_qs').show();
						}else if($("#srv2").is(":checked")){
							$('#perbaikan2').val("").show();
							$('#perbaikan_repair').show();
							$('#perbaikan_pud_qs').hide();
							$('#perbaikan_pm').hide();
						}else if($("#srv1").is(":checked")){
							$('#perbaikan1').val("").show();
							$('#perbaikan_pm').show();
							$('#perbaikan_pud_qs').hide();
							$('#perbaikan_repair').hide();
						}else{
							$('#perbaikan_repair').hide();
							$('#perbaikan_pm').hide();
							$('#perbaikan_pud_qs').hide();
						}
					}
					
					
					function tambah_data(){
						$.ajax({
							method : "post",
							url : "modul/booking_service/no_booking.php",
							success : function(data){
								$("Modal2").modal('show');
								$('#myModal2Label').html("Tambah Booking Stock");
								$("#no_booking").val(data).prop("readonly", true);
								$('#nama_cust').val("").prop("readonly", false);
								pilih_hari();
								$('#waktu1').show();
								$('#waktu2').hide();
								$('#jam_booking').val("").attr("disabled", false);
								$('#tgl_booking').val("").attr("disabled", false);
								$('#no_polisi').val("").prop("readonly", false);
								$('#tipe').val("").attr("disabled", false);
								$('#norangka').val("").prop("readonly", false);
								$('#nomesin').val("").prop("readonly", false);
								$('#telepon').val("").prop("readonly", false);
								$('#perbaikan').val("").prop("readonly", false).hide();
								$('#keterangan').val("").prop("readonly", false);
								$('#bn').show();
								$('#radio_button').hide();
								$('#upd').hide();
								$('#upd2').hide();
								$("input[name=jenis_perbaikan][value='PM']").prop("checked",false);
								$("input[name=jenis_perbaikan][value='REPAIR']").prop("checked",false);
								$("input[name=jenis_perbaikan][value='PUD']").prop("checked",false);
								$("input[name=jenis_perbaikan][value='QS']").prop("checked",false);
								$("#srv1").attr("disabled",false);
								$("#srv2").attr("disabled",false);
								$("#srv3").attr("disabled",false);
								$("#srv4").attr("disabled",false);
								$("#perbaikan").val("").hide();
								$("#perbaikan1").val("").hide();
								$("#perbaikan2").val("").hide();
								$("#perbaikan_pud_qs").hide();
								$("#perbaikan_repair").hide();
								$("#perbaikan_pm").hide();
								
							}
						})
					}	
					
				
					
				/*	function resch_modal($id){
						var periode = $('#periode_booking').val();
						var no_booking = $('#resch'+$id).val();
						var id = $id;
						$.ajax({
							method : "post",
							url : "modul/booking_service/data_edit.php",
							data : 'data='+no_booking+'&data2='+periode,
							success : function(data){
								var dd = data.toString();
								var d = dd.trim();
								var dat = d.split(",");
								$('#Modal2').modal('show');		
								$('#no_booking').val(dat[0]).prop("readonly", true);								
								$('#nama_cust').val(dat[1]).prop("readonly", true);
								pilih_hari();
								$('#waktu1').show();
								$('#waktu2').hide();
								$('#tgl_booking').val("").attr("disabled", false);
								$('#jam_booking').val("").attr("disabled", false);
								$('#no_polisi').val(dat[4]).prop("readonly", true);
								$('#tipe').val(dat[5]).attr("disabled", true);
								$('#telepon').val(dat[6]).prop("readonly", true);
								$('#perbaikan').val(dat[7]).prop("readonly", false);
								$('#keterangan').val(dat[8]).prop("readonly", false);
								$('#upd2').show();
								$('#radio_button').hide();
								$('#bn').hide();
								$('#upd').hide();
								$('#myModal2Label').html("Reschedule Booking Stock");
							}
						})
						$('#upd2').on('click', function(){
							
							var periode = $('#periode_booking').val();
							var no_booking = $('#no_booking').val();
							var nama = $('#nama_cust').val();
							var jam = $('#jam_booking').val();
							var tanggal = $('#tgl_booking').val();
							var no_polisi = $('#no_polisi').val();
							var tipe = $('#tipe').val();
							var telepon = $('#telepon').val();
							var perbaikan = $('#perbaikan').val();
							var keterangan = $('#keterangan').val();
							
							var user_input = "<?php echo $_SESSION['username_service']?>";
							if($('#tgl_booking').val("") && $('#jam').val("")){
							$.ajax({
								method : "post",
								url : "modul/booking_service/reschedule_data.php",
								data: 'data='+no_booking+'&data1='+nama+'&data2='+jam+'&data3='+tanggal+'&data4='+no_polisi+'&data5='+tipe+'&data6='+telepon+'&data7='+perbaikan+'&data8='+keterangan+'&data9='+user_input,
								success : function(data){
									$('#no_booking').val("");
									$('#nama_cust').val("");
									$('#jam_booking').val("");
									$('#tgl_booking').val("");
									$('#no_polisi').val("");
									$('#tipe').val("");
									$('#telepon').val("");
									$('#perbaikan').val("");
									$('#keterangan').val("");
									$('.kedatangan').val("");
									$('.terlambat').val("");
									$('#Modal2').modal('hide');
									var mess = setTimeout(function(){ $('#message').html(data);},3000);
									
									cari_data_booking();
									console.log(jam);
								}
							})
							}
						})
					}	*/
					
				/*	function cari_data_booking(){
						var tanggal = $('#periode_booking').val();
						if ($('#periode_booking').val() != ''){
							$.ajax({
								method : "post",
								url : "modul/booking_service/tampil_data_booking.php",
								data : {data_ajax : tanggal},
								success : function(data){
									var str = data.toString();
									var trm = str.trim();
									var splt = trm.split(",");
									$('#table_booking').html(data);
									$('#header_table').show();
									$('#export').attr('href', 'modul/booking_service/export_data_booking.php?periode_booking='+tanggal);
								}
							})
						}
					}
					
					function pilih_hari(){
						var tgl = $('#tgl_booking').val();
						var hari = tgl.substr(-3, 3);
						var tgl2 = tgl.substr(0, 10);
						$.ajax({
							method : "post",
							url : "modul/booking_service/get_hari.php",
							data : 'data='+hari+'&data1='+tgl2,
							success : function(data){
								$('#jam_booking').html(data);
							}
						})
					}
					
					function pilih_hari2(){
						var tgl3 = $('#tgl_booking3').val();
						var hari2 = tgl3.substr(-3, 3);
						var tgl4 = tgl3.substr(0, 10);
						$.ajax({
							method : "post",
							url : "modul/booking_service/get_hari.php",
							data : 'data='+hari2+'&data1='+tgl4,
							success : function(data){
								$('#jam_booking3').html(data);
							}
						})
					}	*/
					
					
					function search() {
						var input, filter, table, tr, td, i, x;
						input = document.getElementById("search");
						filter = input.value.toUpperCase();
						table = document.getElementById("table_booking");
						tr = table.getElementsByTagName("tr");
						td = table.getElementsByTagName("td");
						for (i = 0; i < tr.length; i++) {
							for (j = 0; j < td.length; j++) {
								x = tr[i];
								y = x[j];
								if (x) {
									if (x.innerHTML.toUpperCase().indexOf(filter) > -1) {
										tr[i].style.display = "";
									} else {
										tr[i].style.display = "none";
									}
								}   
							}								
						}
					}
				
					var add = (function () {
						var counter = 1;
						var x = 15;
						return function () {
							counter += 1;
							return y = counter * x;
						}
					})();

					
					
					// ==============	EDIT ============================ //
			
				/*	function edit_modal($id){
						
						var periode = $('#periode_booking').val();
						var no_booking = $('#edit'+$id).val();
						var lim = add();
						var z = y;
						var id = $id;
						$('#reschedule').attr('checked', false);
						$('#reschedule').prop('checked', false);
						$('#waktu3').hide();
						$.ajax({
							method : "post",
							url : "modul/booking_service/data_edit.php",
							data : 'data='+no_booking+'&data2='+periode,
							success : function(data){
								var dd = data.toString();
								var d = dd.trim();
								var dat = d.split(",");
								$('#Modal2').modal('show');		
								$('#no_booking').val(dat[0]).prop("readonly", true);								
								$('#nama_cust').val(dat[1]).prop("readonly", true);
								$('#waktu1').hide();
								$('#waktu2').show();
								$('#tgl_booking2').val(dat[3]).attr("disabled", true);
								$('#jam_booking2').val(dat[2]).attr("disabled", true);
								$('#no_polisi').val(dat[4]).prop("readonly", true);
								$('#tipe').val(dat[5]).attr("disabled", true);
								$('#telepon').val(dat[6]).prop("readonly", true);
								$('#perbaikan').val(dat[7]).prop("readonly", true);
								$('#keterangan').val(dat[8]).prop("readonly", false);
								$('#no_rangka_mesin').show();
								if(dat[9] == 'Y'){
									console.log(dat[9]);
									$('#radio1').attr('checked', true);
									$('#datang').show();
								//	$('#datetimepicker2').val(dat[10]).show();
									$('#tidak_datang1').hide();
									$('#tidak_datang2').hide();
									$('#upd').hide();
									$('#radio_button').hide();
								}else if(dat[9] == 'N'){
									console.log(dat[9]);
									$('#radio2').attr('checked', true);
									$('#datang').hide();
									$('#ket_tidak_datang').val(dat[12]).show();
									$('#tidak_datang1').show();
									$('#tidak_datang2').show();
									$('#upd').hide();
									$('#radio_button').hide();
									if(dat[11] == 'Y'){
									//	$('#reschedule').attr('checked', true);
									//	$('#reschedule').prop('checked', true);
									//	$('#reschedule')[0].checked = true;
									//	$('#reschedule').prop('checked');
									//	$('.reschedule').attr('checked');
										$("input[name=reschedule][value='Y']").prop("checked",true);
										$('#waktu3').show();
									}else{
									//	$('#reschedule').attr('checked', false);
									//	$('#reschedule').prop('checked', false);
									//	$('#reschedule')[0].checked = false;
									//	$('.reschedule').removeAttr('checked');
										$("input[name=reschedule][value='']").prop("checked",false);
										$('#waktu3').hide();
									}
									
								}else{
									$('#radio1').attr('checked', false);
									$('#radio2').attr('checked', false);
									$('#datang').hide();
									$('#ket_tidak_datang').val("").show();
									$('#tidak_datang1').hide();
									$('#tidak_datang2').hide();
									$('#upd').show();
									$('#radio_button').show();
								}
								$('#norangka').val(dat[16]).prop("readonly", false);
								$('#nomesin').val(dat[17]).prop("readonly", false);
							/*	if(dat[16] != '' && dat[17] != ''){
									$('#norangka').val(dat[16]).prop("readonly", true);
									$('#nomesin').val(dat[17]).prop("readonly", true);
								}else{
									$('#norangka').val("").prop("readonly", false);
									$('#nomesin').val("").prop("readonly", false);
								}	*/
							/*	$("#srv1").attr("disabled",true);
								$("#srv2").attr("disabled",true);
								$("#srv3").attr("disabled",true);
								$("#srv4").attr("disabled",true);
								if(dat[15] == ''){
									$("input[name=jenis_perbaikan][value='PM']").prop("checked",false);
									$("input[name=jenis_perbaikan][value='REPAIR']").prop("checked",false);
									$("input[name=jenis_perbaikan][value='QS']").prop("checked",false);
									$("input[name=jenis_perbaikan][value='PUD']").prop("checked",false);
									
								}else{
									if(dat[15] != ''){
										$("input[name=jenis_perbaikan][value='" + dat[15] + "']").prop("checked",true);
											$('#perbaikan_pm').hide();
											$('#perbaikan_repair').hide();
											$('#perbaikan_pud_qs').show();
											$('#perbaikan').val(dat[7]).prop("readonly", true);
									/*	if(dat[15] == 'PM' ){
											$("input[name=jenis_perbaikan][value='PM']").prop("checked",true);
												$('#perbaikan_pm').hide();
												$('#perbaikan_repair').hide();
												$('#perbaikan_pud_qs').show();
												$('#perbaikan').val(dat[7]).attr("disabled", true);
										}else if(dat[15] == 'REPAIR'){
											$("input[name=jenis_perbaikan][value='REPAIR']").prop("checked",true);
												$('#perbaikan_pm').hide();
												$('#perbaikan_repair').hide();
												$('#perbaikan_pud_qs').show();
												$('#perbaikan').val(dat[7]).attr("disabled", true);
										}else{
											$("input[name=jenis_perbaikan][value='" + dat[15] + "']").prop("checked",true);
												$('#perbaikan_pm').hide();
												$('#perbaikan_repair').hide();
												$('#perbaikan_pud_qs').show();
												$('#perbaikan').val(dat[7]).prop("readonly", true);
										}	*/
								/*	}
								}
						
							//	jQuery('input[name="kedatangan"]:checked').val(dat[9]);
								
								$('#bn').hide();
								$('#upd2').hide();
								$('#myModal2Label').html("Edit Booking Stock");
							}
							
						})
										
					
						
					}
					
						//	===============	UPDATE	============================
					function update_booking(){
						
							var no_booking = $('#no_booking').val();
							var nama = $('#nama_cust').val();
							var jam = $('#jam_booking2').val();
							var tanggal = $('#tgl_booking2').val();
							var no_polisi = $('#no_polisi').val();
							var tipe = $('#tipe').val();
							var telepon = $('#telepon').val();
							var perbaikan = $('#perbaikan').val();
							var keterangan = $('#keterangan').val();
							var datang = jQuery('input[name="kedatangan"]:checked').val();
						//	var jam_datang = $('#datetimepicker2').val();
							var hour = $('#hour').val();
							var min = $('#min').val();
							var jam_datang = hour + ":" + min;
							var reschedule = $('#reschedule').is(':checked');
							var ket_tidak_datang = $('#ket_tidak_datang').val();
								if(datang == 'Y'){
									reschedule = 'N';
									ket_tidak_datang = "";
								}else{
									jam_datang = "00:00:00";
									if($('#reschedule').is(':checked') == true){
										reschedule = 'Y';
										
									}else{
										reschedule = 'N';
										
									}
								}
							var norangka = $('#norangka').val();
							var nomesin = $('#nomesin').val();
							var jam_reschedule = $('#jam_booking3').val();
							var tgl_reschedule = $('#tgl_booking3').val();
							var user_input = "<?php echo $_SESSION['username_service']?>";
							var jenis_perbaikan = jQuery('input[name="jenis_perbaikan"]:checked').val();
						//	var periode = $('#periode_booking').val();
							
							
							$.ajax({
								method : "post",
								url : "modul/booking_service/update_data.php",
								data : 	'data_update='+no_booking+
										'&data1='+nama+
										'&data2='+jam+
										'&data3='+tanggal+
										'&data4='+no_polisi+
										'&data5='+tipe+
										'&data6='+telepon+
										'&data7='+perbaikan+
										'&data8='+keterangan+
										'&data9='+datang+
										'&data10='+jam_datang+
										'&data11='+reschedule+
										'&data12='+ket_tidak_datang+
										'&data13='+norangka+
										'&data14='+nomesin+
										'&data15='+jam_reschedule+
										'&data16='+tgl_reschedule+
										'&data17='+user_input+
										'&data17='+user_input+
										'&data18='+jenis_perbaikan,
								success : function(data){
									$('#nama_cust').val("");
									$('#tgl_booking').val("");
									$('#jam_booking').val("");
									$('#no_polisi').val("");
									$('#tipe').val("");
									$('#norangka').val("");
									$('#nomesin').val("");
									$('#telepon').val("");
									$('#perbaikan').val("");
									$('#keterangan').val("");
									$('#Modal2').modal('hide');
									$('#message').html(data);
									cari_data_booking();
									console.log(reschedule);
									
								}
							})
					}
				
					
					//	===============	SIMPAN	============================//
					function simpan(){
						
						var periode = $('#periode_booking').val();
						var no_booking = $('#no_booking').val();
						var nama = $('#nama_cust').val();
						var jam = $('#jam_booking').val();
						var tanggal = $('#tgl_booking').val();
						var no_polisi = $('#no_polisi').val();
						var tipe = $('#tipe').val();
						var telepon = $('#telepon').val();
						var perbaikan = $('#perbaikan').val();
						var norangka = $('#norangka').val();
						var nomesin = $('#nomesin').val();
						if($("#srv3").is(":checked") || $("#srv4").is(":checked")){
							var perbaikan = $('#perbaikan').val();
						}else if($("#srv1").is(":checked")){
							var perbaikan = $('#perbaikan1').val();
						}else{
							var perbaikan = $('#perbaikan2').val();
						}
						var jenis_perbaikan = jQuery('input[name="jenis_perbaikan"]:checked').val();
						var keterangan = $('#keterangan').val();
						var keterangan2 = keterangan.replace(/,/g, ".");
					
						var user_input = "<?php echo $_SESSION['username_service']?>";
						if($('#nama_cust').val("")){
							$.ajax({
								method : "post",
								url : "modul/booking_service/insert_data.php",
								data: 'data='+no_booking+'&data1='+nama+'&data2='+jam+'&data3='+tanggal+'&data4='+no_polisi+'&data5='+tipe+'&data6='+telepon+'&data7='+perbaikan+'&data8='+keterangan2+'&data9='+user_input+'&data10='+jenis_perbaikan+'&data11='+norangka+'&data12='+nomesin,
								success : function(data){
									$('#no_booking').val("");
									$('#nama_cust').val("");
									$('#jam_booking').val("");
									$('#tgl_booking').val("");
									$('#no_polisi').val("");
									$('#tipe').val("");
									$('#telepon').val("");
									$('#perbaikan').val("");
									$('#keterangan').val("");
								//	$('.kedatangan').val("");
								//	$('.terlambat').val("");
									$('#Modal2').modal('hide');
									$('#message').html(data);
									$('#reschedule').prop('checked', false);
									$('#reschedule').attr('checked', false);
									cari_data_booking();
								}
							})
						}
					} 	*/
					
					
					
					//	===============	KELUAR	============================//
					function exit_modal(){
						$('#nama_cust').val("");
						$('#jam_booking').val("");
						$('#tgl_booking').val("");
						$('#tgl_booking').attr("disabled", false);
						$('#no_polisi').val("");
						$('#tipe').val("");
						$('#telepon').val("");
						$('#perbaikan').val("");
						$('#keterangan').val("");
						$('#Modal2').modal('hide');
						$('#upd').hide();
						jQuery('input[name="kedatangan"]:checked').val();
						$('#radio_button').hide();
						$('#reschedule').prop('checked', false);
						$('#reschedule').attr('checked', false);
					}