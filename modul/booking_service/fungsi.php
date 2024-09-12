
<?php session_start();?>
<script>
					function warning() {
						return confirm('Anda yakin menghapus data ini?');
					}
					
					function status_kedatangan(){
						if($("#radio9").is(":checked")){
							$('#tidak_datang1').hide();
							$('#tidak_datang2').hide();
							//$('#datang').show();
							
							$('#ket_tidak_datang').val("");
							$('#reschedule').attr('checked', false);
							$('#reschedule').prop('checked', false);
						}
						if($("#radio1").is(":checked")){
							$('#tidak_datang1').show();
							$('#tidak_datang2').show();
							$('#datang').hide();
						//	alert($('#reschedule').is(':checked'));
						//	alert(jQuery('input[name="kedatangan"]:checked').val());
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
							isi_jenis_service("",$("#srv2").val());
							
							$('#perbaikan2').val("").show();
							$('#perbaikan_repair').show();
							$('#perbaikan_pud_qs').hide();
							$('#perbaikan_pm').hide();
						}else if($("#srv1").is(":checked")){
							isi_jenis_service("",$("#srv1").val());
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
						$('#konfirmasi').hide();
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
								$("#booking_via").val("");
								$("#lain-lain").val("");
								$("#lain_lain").hide();
								
								
								
								
							}
						})
					}	
					
				
				
					
					function cari_data_booking(){
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
						if ($('#search').val() == ""){
							var waktu = setTimeout("cari_data_booking()",60000);
							}
						//console.log("ad");
					}
					
				
					
					
					
					
					
					
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

					function pilih_hari(){
						var no_booking = $('#no_booking').val();
						//alert(no_booking);
						var tgl = $('#tgl_booking').val();
						var hari = tgl.substr(-3, 3);
						var tgl2 = tgl.substr(0, 10);
						var jenis_perbaikan = jQuery('input[name="jenis_perbaikan"]:checked').val();
						$.ajax({
							method : "post",
							url : "modul/booking_service/get_hari.php",
							data : 'data='+hari+'&data1='+tgl2+'&jenis_perbaikan='+jenis_perbaikan+'&no_booking='+no_booking,
							success : function(data){
								$('#jam_booking').html(data);
							}
						})
						
					}
					
					function pilih_hari2(){
						var tgl3 = $('#tgl_booking3').val();
						var hari2 = tgl3.substr(-3, 3);
						var tgl4 = tgl3.substr(0, 10);
						var jenis_perbaikan = jQuery('input[name="jenis_perbaikan"]:checked').val();
						$.ajax({
							method : "post",
							url : "modul/booking_service/get_hari.php",
							data : 'data='+hari2+'&data1='+tgl4+'&jenis_perbaikan='+jenis_perbaikan,
							success : function(data){
								$('#jam_booking3').html(data);
							}
						})
						
					}
					
					
					
					function isi_jenis_service(perbaikan,jenisperbaikan){
						//alert(id);
						
						$.ajax({
							method : "post",
							url : "modul/booking_service/isi_jenis_service.php",
							data : '&perbaikan='+perbaikan+'&jenisperbaikan='+jenisperbaikan,
							success : function(data){
								$('#perbaikan2').html(data);
								$('#perbaikan1').html(data);
							}
						})
							
					}
					// ==============	EDIT ============================ //
			
					function edit_modal($id){
						
						var periode = $('#periode_booking').val();
						var no_booking = $('#edit'+$id).val();
						var lim = add();
						var z = y;
						var id = $id;
						$('#reschedule').attr('checked', false);
						$('#reschedule').prop('checked', false);
						
						
						//$('#checkbox4').prop('checked', false);
						//$('#checkbox5').prop('checked', false);
						var session_level_user = "<?php echo $_SESSION['leveluser'] ; ?>";
						
						if (session_level_user == "admin" || session_level_user == "CCO"){
							$('#konfirmasi').show();
							
						}
						
						
						
						$('#waktu3').hide();
						$.ajax({
							method : "post",
							url : "modul/booking_service/data_edit.php",
							data : 'data='+no_booking+'&data2='+periode,
							success : function(data){
								
								var dat = JSON.parse(data);
								
								
								var tanggal = new Date(dat['waktu_booking']);
								var hari = tanggal.toString().substring(0,3);
								//alert(pothari);

								$('#Modal2').modal('show');		
								$('#no_booking').val(dat['no_booking']).prop("readonly", true);								
								$('#nama_cust').val(dat['nama']).prop("readonly", true);
								$('#waktu1').show();
								$('#waktu2').hide();
								$('#tgl_booking').val(dat['waktu_booking']+" "+hari).attr("readonly", true);
								//$('#tgl_booking2').val(dat['waktu_booking']).attr("disabled", true);
								//$('#jam_booking2').val(dat['jam_booking']).attr("disabled", true);
								
								
								$('#no_polisi').val(dat['no_polisi']).prop("readonly", true);
								$('#tipe').val(dat['tipe']).attr("disabled", true);
								$('#telepon').val(dat['telepon']).prop("readonly", true);
								$('#perbaikan').val(dat['perbaikan']);
								$('#keterangan').val(dat['keterangan'].trim()).prop("readonly", false);
								$('#no_rangka_mesin').show();
								
								if (dat['konfirmasi_telp'] == 'Y'){
									$('#checkbox4').prop('checked', true);
								}else{
									$('#checkbox4').prop('checked', false);
								}
								
								if (dat['konfirmasi_sms'] == 'Y'){
									$('#checkbox5').prop('checked', true);
								}else{
									$('#checkbox5').prop('checked', false);
								}
								
								if (dat['booking_via'] == 'SMS'){
									document.getElementById("booking_via").selectedIndex = "1";
									$('#lain_lain').hide();
								}else if (dat['booking_via'] == 'WA'){
									document.getElementById("booking_via").selectedIndex = "2";
									$('#lain_lain').hide();
								}else if (dat['booking_via'] == 'TELP'){
									document.getElementById("booking_via").selectedIndex = "3";
									$('#lain_lain').hide();
								}else if (dat['booking_via'] == 'PROGRAM'){
									document.getElementById("booking_via").selectedIndex = "4";
									$('#lain_lain').hide();
								}else if (dat['booking_via'] == 'WEBSITE'){
									document.getElementById("booking_via").selectedIndex = "5";
									$('#lain_lain').hide();
								}else
								{
									document.getElementById("booking_via").selectedIndex = "6";
									$('#lain_lain').show();
									$('#lain-lain').val(dat['booking_via']);
								}
								
								
								if(dat['kedatangan'] == 'Y'){
									$('#radio1').prop('checked', true);
									
									$("input[name=kedatangan][value='" + dat['kedatangan'] + "']").prop("checked",true);
									//$('#datang').show();
								//	$('#datetimepicker2').val(dat[10]).show();
									$('#tidak_datang1').hide();
									$('#tidak_datang2').hide();
									$('#upd').hide();
									$('#radio_button').show();
									$('#radio1').attr("disabled", true);
									$('#radio2').attr("disabled", true);
									$('#radio9').attr("disabled", true);
								}else if(dat['kedatangan'] == 'N'){
									
									
									$('#radio2').prop('checked', true);
									
									//$('#datang').hide();
									$('#ket_tidak_datang').val(dat['ket_kedatangan']).show();
									$('#tidak_datang1').show();
									$('#tidak_datang2').show();
									$('#upd').hide();
									$('#radio_button').show();
									$('#radio1').attr("disabled", true);
									$('#radio2').attr("disabled", true);
									$('#radio9').attr("disabled", true);
									
									if(dat['reschedule'] == 'Y'){
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
									
								}else if(dat['kedatangan'] == 'Sudah Service'){
									$('#radio9').prop('checked', true);
									$('#radio1').attr("disabled", true);
									$('#radio2').attr("disabled", true);
									$('#radio9').attr("disabled", true);
								}else{
									$('#radio1').attr("disabled", false);
									$('#radio2').attr("disabled", false);
									$('#radio9').attr("disabled", false);
									
									$('#radio1').prop('checked', false);
									$('#radio2').prop('checked', false);
									$('#radio9').prop('checked', false);
									//$('#datang').hide();
									$('#ket_tidak_datang').val("").show();
									$('#tidak_datang1').hide();
									$('#tidak_datang2').hide();
									$('#upd').show();
									$('#radio_button').show();
								}
								$('#norangka').val(dat['norangka']).prop("readonly", false);
								$('#nomesin').val(dat['nomesin']).prop("readonly", false);
							/*	if(dat[16] != '' && dat[17] != ''){
									$('#norangka').val(dat[16]).prop("readonly", true);
									$('#nomesin').val(dat[17]).prop("readonly", true);
								}else{
									$('#norangka').val("").prop("readonly", false);
									$('#nomesin').val("").prop("readonly", false);
								}	*/
								
								if (session_level_user != "admin" && session_level_user != "CCO"){
								$("#srv1").attr("disabled",true);
								$("#srv2").attr("disabled",true);
								$("#srv3").attr("disabled",true);
								$("#srv4").attr("disabled",true);
								
								}
								
								if(dat['jenis_perbaikan'] == ''){
									$("input[name=jenis_perbaikan][value='PM']").prop("checked",false);
									$("input[name=jenis_perbaikan][value='REPAIR']").prop("checked",false);
									$("input[name=jenis_perbaikan][value='QS']").prop("checked",false);
									$("input[name=jenis_perbaikan][value='PUD']").prop("checked",false);
									
								}else{
									
									
										
										/*
										$("input[name=jenis_perbaikan][value='" + dat['jenis_perbaikan'] + "']").prop("checked",true);
											$('#perbaikan_pm').show();
											$('#perbaikan_repair').show();
											$('#perbaikan_pud_qs').show();
											
											
										*/
										
										//	$('#perbaikan').val(dat['perbaikan']);
										
										if(dat['jenis_perbaikan'] == 'PM' ){
											
											$("input[name=jenis_perbaikan][value='PM']").prop("checked",true);
												$('#perbaikan_pm').show();
												$('#perbaikan_repair').hide();
												$('#perbaikan1').show();
												$('#perbaikan_pud_qs').hide();
											
										}else if(dat['jenis_perbaikan'] == 'REPAIR'){
											
											$("input[name=jenis_perbaikan][value='REPAIR']").prop("checked",true);
												$('#perbaikan_pm').hide();
												$('#perbaikan_repair').show();
												$('#perbaikan2').show();
												$('#perbaikan_pud_qs').hide();
												
										}else if(dat['jenis_perbaikan'] == 'QS'){
											
											$("input[name=jenis_perbaikan][value='QS']").prop("checked",true);
												$('#perbaikan_pud_qs').show();
												$('#perbaikan_pm').hide();
												$('#perbaikan').show();
												$('#perbaikan_repair').hide();
												
											
										}else{
											
											$("input[name=jenis_perbaikan][value='" + dat['jenis_perbaikan'] + "']").prop("checked",true);
												$('#perbaikan_pud_qs').show();
												$('#perbaikan_pm').hide();
												$('#perbaikan').show();
												$('#perbaikan_repair').hide();
												
												
										}	
									
								}
						
							//	jQuery('input[name="kedatangan"]:checked').val(dat[9]);
								
								$('#bn').hide();
								$('#upd2').hide();
								$('#myModal2Label').html("Edit Booking Stock");
								
								isi_jenis_service(dat['perbaikan'],dat['jenis_perbaikan']);
								
								pilih_hari();
							}
							
						})
										
					
						
					}
					
						//	===============	UPDATE	============================
					function update_booking(){
						
							var no_booking = $('#no_booking').val();
							var nama = $('#nama_cust').val();
							var jam = $('#jam_booking').val();
							var tanggal = $('#tgl_booking').val();
							var no_polisi = $('#no_polisi').val();
							var tipe = $('#tipe').val();
							var telepon = $('#telepon').val();
							
							var perbaikan = $('#perbaikan').val();
							
							if($("#srv3").is(":checked") || $("#srv4").is(":checked")){
								var perbaikan = $('#perbaikan').val();
							}else if($("#srv1").is(":checked")){
								var perbaikan = $('#perbaikan1').val();
								
							}else{
								var perbaikan = $('#perbaikan2').val();
							}
							
							
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
							var user_input = "<?php echo $_SESSION['username']?>";
							var jenis_perbaikan = jQuery('input[name="jenis_perbaikan"]:checked').val();
							var konfirmasi_telp = $('#checkbox4').is(':checked');
							var konfirmasi_sms = $('#checkbox5').is(':checked');
							
							var booking_via = $('#booking_via').val();
							var lainlain = $('#lain-lain').val();
							
							if (konfirmasi_telp == true){
								konfirmasi_telp = "Y";
							}else{
								konfirmasi_telp = "";
							}
							
							if (konfirmasi_sms == true){
								konfirmasi_sms = "Y";
							}else{
								konfirmasi_sms = "";
							}
							
						//	var periode = $('#periode_booking').val();
							//alert(konfirmasi_sms);
							
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
										'&data18='+jenis_perbaikan+
										'&data_konfirmasi_telp='+konfirmasi_telp+
										'&data_booking_via='+booking_via+
										'&data_lainlain='+lainlain+
										'&data_konfirmasi_sms='+konfirmasi_sms,
								success : function(data){
									
									var data_ajax = JSON.parse(data);
									
									if (data_ajax['status'] == 'Kosong'){
										
										$('#id_double').html(data_ajax['pesan']);
										$('#id_double').show();
										var asaa = setTimeout(function(){$('#id_double').fadeOut("slow");},5000);
									}	
									else{
									
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
										$('#message').html(data_ajax['pesan']);
										$('#message').show();
										$('#upd').hide();
									}
									
									cari_data_booking();
								//	console.log(reschedule);
									var waktu = setTimeout(function(){$('#message').fadeOut("slow");},5000);
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
						var booking_via = $('#booking_via').val();
						var lainlain = $('#lain-lain').val();
						
						var tgl = $('#tgl_booking').val();
						var hari = tgl.substr(-3, 3);
						
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
					
						var user_input = "<?php echo $_SESSION['username']?>";
						
							$.ajax({
								method : "post",
								url : "modul/booking_service/insert_data.php",
								data: 'data='+no_booking+'&data1='+nama+'&data2='+jam+'&data3='+tanggal+'&data4='+no_polisi+'&data5='+tipe+'&data6='+
								telepon+'&data7='+perbaikan+'&data8='+keterangan2+'&data9='+user_input+'&data10='+jenis_perbaikan+'&data11='+norangka+
								'&data12='+nomesin+'&data13='+booking_via+'&data14='+lainlain+'&nama_hari='+hari,
								success : function(data){
									
									var data_ajax = JSON.parse(data);
									
									if (data_ajax['status'] == "Kosong"){
										
										$('#id_double').html(data_ajax['pesan']);
										$('#id_double').show();
										var asaa = setTimeout(function(){$('#id_double').fadeOut("slow");},5000);
										
									}else
									
									if (data_ajax['status'] == "YA"){
										pilih_hari();
										
										
										$('#id_double').html(data_ajax['pesan']);
										$('#id_double').show();
										var asaa = setTimeout(function(){$('#id_double').fadeOut("slow");},5000);
									}else{
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
										$('#message').html(data_ajax['pesan']);
										$('#message').show();
										
										var waktu = setTimeout(function(){$('#message').fadeOut("slow");},5000);
										$('#reschedule').prop('checked', false);
										$('#reschedule').attr('checked', false);
										var booking_via = $('#booking_via').val("");
										var lainlain = $('#lain-lain').val("");
										cari_data_booking();
									
									}
								}
							})
						
					} 
					
					
					
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
						var booking_via = $('#booking_via').val("");
						var lainlain = $('#lain-lain').val("");
						
					}
				
	</script>			