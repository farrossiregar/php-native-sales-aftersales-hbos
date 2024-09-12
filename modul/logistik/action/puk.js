					$(document).ready(function() {
							$('.datepicker').datepicker({autoclose: true, todayHighlight: true}
								
								).on('changeDate', function(e) {
								
								
								//$('#other-input').val(e.format(0,"dd/mm/yyyy"));
								//alert(e.date);
								//alert(e.format(0,"yyyy/mm/dd"));
								//console.log(e.date); 
								
								var tanggal = e.format(0,"yyyy/mm/dd");
								
								$.ajax({
									method : "GET",
									url : "modul/logistik/action/puk_ajax.php?type=kuota",
									data : {data_ajax : tanggal},
									success : function(data){
										//alert(data);
										if (level_lokal != "odj0933*&^%&f.,s2@^#&%$*()_;"){
										
											if (data > 5){
												$('#tanggal_keluar').val("");
												swal({
													title: "Peringatan!",
													text: "Kuota penuh, sudah terpakai : " + data + ". Silahkan Koordinasi dengan SPV anda",
													type: "warning",
													confirmButtonColor: "#007AFF"
												});
											}
										
										
										}else{
											
												swal({
													title: "Peringatan!",
													text: "Kuota yang sudah terpakai : " + data,
													type: "warning",
													confirmButtonColor: "#007AFF"
												});
											
										}
									}	
								})
							});
							
							
							
							
							$('#simpan').on('click',function(){
								
								var tanggal_keluar = $('#tanggal_keluar').val();
								nospk = $('#nospk').val();
								norangka = $('#no_rangka').val();
								jam = $('#jam').val();
								menit = $('#menit').val();
								keterangan = ($('#keterangan').val()).length;
								
								if (nospk == ""){
									swal({
										title: "Peringatan!",
										text: "Nomor SPK Masih Kosong..!! ",
										type: "warning",
										confirmButtonColor: "#007AFF"
									});
									
									
									return false;
									
								}
								
								if (norangka == ""){
									swal({
										title: "Peringatan!",
										text: "Nomor Rangka Masih Kosong..!! ",
										type: "warning",
										confirmButtonColor: "#007AFF"
									});
									
									
									return false;
									
								}
								if (tanggal_keluar == ""){
									swal({
										title: "Peringatan!",
										text: "Tanggal Kirim Masih Kosong..!! ",
										type: "warning",
										confirmButtonColor: "#007AFF"
									});
									
									
									return false;
									
								}
								if (jam == ""){
									swal({
										title: "Peringatan!",
										text: "Jam Masih Kosong..!! ",
										type: "warning",
										confirmButtonColor: "#007AFF"
									});
									
									
									return false;
									
								}
								if (menit == ""){
									swal({
										title: "Peringatan!",
										text: "Menit Masih Kosong..!! ",
										type: "warning",
										confirmButtonColor: "#007AFF"
									});
									
									
									return false;
									
								}
								if (keterangan < 10){
									swal({
										title: "Peringatan!",
										text: "Keterangan minimal 10 karakter..!! ",
										type: "warning",
										confirmButtonColor: "#007AFF"
									});
									
									
									return false;
									
								}
								
								//return false;
								
								document.getElementById("form").submit(); 
							})
							
							
						});
				
					function puk(){
					
							var isipd = $('#nospk').val();
								
								$.ajax({
									method : "GET",
									url : "modul/logistik/action/puk_ajax.php?type=pembayaran",
									data : {data_ajax : isipd},
									success : function(data){
										$('#depe').html(data);
									}
								})
								
					}
					
					function myFunction() {
					  var input, filter, table, tr, td, i;
					  input = document.getElementById("search");
					  filter = input.value.toUpperCase();
					  table = document.getElementById("sample");
					  tr = table.getElementsByTagName("tr");
					  for (i = 0; i < tr.length; i++) {
						td = tr[i].getElementsByTagName("td")[0];
						if (td) {
						  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
							tr[i].style.display = "";
						  } else {
							tr[i].style.display = "none";
						  }
						}       
					  }
					}
					
					function reload(){
						if($("#search").val("")){
							$(this).html();
						}
						setTimeout(myFunction());
					}
					
					
					
					function post() {
						var table = document.getElementsByTagName("table")[0];
						var tbody = table.getElementsByTagName("tbody")[0];
						tbody.onclick = function (e) {
							e = e || window.event;
							var data = [];
							var target = e.srcElement || e.target;
							while (target && target.nodeName !== "TR") {
								target = target.parentNode;
							}
							if (target) {
								var cells = target.getElementsByTagName("td");
								for (var i = 0; i < cells.length; i++) {
									data.push(cells[i].innerHTML);
									dt = data.toString();
								
								}
							}
							
							dt = data.toString();
							dt_split = dt.split(",");
							
							x = document.getElementById('nospk');
							x.value = dt_split[0].trim();
								$.ajax({
									method : "GET",
									url : "modul/logistik/action/puk_ajax.php?type=tampildata",
									data : {data_ajax : x.value},
									success : function(data){
										
										var dd = data.toString();
										var dat = dd.split("--");
										
										
										$('#nospk').val(dat[0]);
										$('#tipe_mobil').val(dat[2])
										$('#warna').val(dat[3]);
										$('#no_rangka').val(dat[5]);
										$('#no_mesin').val(dat[6]);
										$('#customer').val(dat[1]);
										$('#cara_bayar').val(dat[4]);
										$('#leasing').val(dat[9]);
										$('#tenor').val(dat[7]);
										
										
										total_diskon = dat[8];											
										
										disc_format_angka = kurensi(total_diskon.toString());	
										$('#disc').val(disc_format_angka);	
										
										puk();
											
										
									}	
								})
						};
					}
					
					
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
					
					function tampil_modal(){						
						x = document.getElementById('nospk');
						$.ajax({
									method : "GET",
									url : "modul/logistik/action/puk_ajax.php?type=listspk",
									data : {data_ajax : x.value},
									success : function(data){
										
										$('#modal').html(data);
										$("#modal").modal('show');
										
									}	
								})
						
					}
				
				
				