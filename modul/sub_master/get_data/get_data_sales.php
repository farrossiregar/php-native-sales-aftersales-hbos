										<?php
 
 										include "../../../config/koneksi.php";
 										$spv = $_POST['data_ajax'];
										$data=mysql_query("select * from salesman where kode_supervisor='$spv' and aktif = 'Y' order by grade desc");
										    $sql = $data;
										    $nomor = 0;
										    while($data = mysql_fetch_assoc($sql)){
										    $nomor += 1;  
										        
										    
										    
										    
                                            //$jumlah=2;
                                            //for($i=0; $i<$jumlah; $i++){;
                                            ?>
									<div class="col-md-12">
										<div class="row">
											
											
											<div class="col-md-2">
											    <label class="control-label">
													Nama Sales <span class="symbol required"></span>
												</label>
												
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'kode_sales'.$nomor; ?>" value="<?php echo trim($data['kode_sales']); ?>" readonly required>
											
									    	</div>

									    	<div class="col-md-2">
											    <label class="control-label">
														Grade <span class="symbol required"></span>
												</label>
												
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'grade'.$nomor; ?>" value="<?php echo trim($data['grade']); ?>" readonly required>
											
									    	</div>
									    	
									    	<div class="col-md-2">
									    		<div class="form-group">
													<label class="control-label">
														Target Unit <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" onkeypress="return hanyaAngka(event)" placeholder="0" class="form-control" id="target" name="<?php echo 'target_unit'.$nomor; ?>" >
												</div>
									    	</div>

									    	<div class="col-md-2">
									    		<div class="form-group">
													<label class="control-label">
														Target Poin <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" onkeypress="return hanyaAngka(event)" placeholder="0" class="form-control" id="target" name="<?php echo 'target_point'.$nomor; ?>" >
												</div>
									    	</div>

									    	
								    	</div>
									 </div>   	
									    	<?php
                                            }
                                            ?>