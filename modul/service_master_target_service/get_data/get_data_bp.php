										<?php
 
 										include "../../../config/koneksi_service.php";
 										$sa = $_POST['data_ajax'];
										$data=mysql_query("select * from master_target_sa_bp order by urutan");
										    $sql = $data;
										    $nomor = 0;
										    while($data = mysql_fetch_assoc($sql)){
										    $nomor += 1;
										        
										    
										    
										    
                                            //$jumlah=2;
                                            //for($i=0; $i<$jumlah; $i++){;
                                            ?>
									
										<div class="row">
											
											 <input type="hidden" name="<?php echo 'urutan'.$nomor; ?>" value="<?php echo trim($data['urutan']); ?>" >
											 <input type="hidden" name="<?php echo 'nama_kategori'.$nomor; ?>" value="<?php echo trim($data['nama_kategori']); ?>">
											 
											<div class="col-md-2">
											    <label class="control-label">
													Kategori <span class="symbol required"></span>
												</label>
												
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'kode_kategori'.$nomor; ?>" value="<?php echo trim($data['kode_kategori']); ?>" readonly required>
											
									    	</div>

									    	<div class="col-md-2">
											    <label class="control-label">
														Kode Item <span class="symbol required"></span>
												</label>
												
											    <input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'kode_item'.$nomor; ?>" value="<?php echo trim($data['kode_item']); ?>"  required>
											
									    	</div>
									    	
									    	<div class="col-md-2">
									    		<div class="form-group">
													<label class="control-label">
														Nama Item <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'nama_item'.$nomor; ?>" value="<?php echo trim($data['nama_item']); ?>" required>
												</div>
									    	</div>
											<div class="col-md-2">
									    		<div class="form-group">
													<label class="control-label">
														Pembagi <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'fix_pembagi'.$nomor; ?>" value="<?php echo trim($data['fix_pembagi']); ?>" required>
												</div>
									    	</div>
									    	<div class="col-md-2">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																Target Unit <span class="symbol required"></span>
															</label>
															<input type="text" onkeypress="return hanyaAngka(event)" class="form-control" size="3" id="target" name="<?php echo 'target_unit'.$nomor; ?>" value="<?php echo ceil($data['target_unit'] / 4); ?>" required>
														</div>
														</div>
													<div class="col-md-6">
														<div class="form-group">
															<label class="control-label">
																Target Point <span class="symbol required"></span>
															</label>
															<input type="text" onkeypress="return hanyaAngka(event)" class="form-control" size="3" id="target" name="<?php echo 'target_point'.$nomor; ?>" value="<?php echo $data['target_point']; ?>" required>
														</div>
													</div>
												</div>
									    	</div>
											<div class="col-md-2">
									    		<div class="form-group">
													<label class="control-label">
														Program <span class="symbol required"></span>
													</label>
													<input type="text" style="text-transform:uppercase" placeholder="0" class="form-control" id="target" name="<?php echo 'program'.$nomor; ?>" value="<?php echo trim($data['program']); ?>" required>
												</div>
									    	</div>

									    	
								    	</div>
									   	
									    	<?php
                                            }
                                            ?>