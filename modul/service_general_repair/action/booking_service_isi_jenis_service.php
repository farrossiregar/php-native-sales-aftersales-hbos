<?php
if (count($_POST)){
	
	if ($_POST['jenisperbaikan'] == 'REPAIR'){

?>
<option value="" selected disabled>REPAIR</option>
															
															<option value="40.000 KM" <?php echo ($_POST['perbaikan'] == '40.000 KM' ? "selected" : "") ;?> >40.000 KM</option>
															<option value="60.000 KM" <?php echo ($_POST['perbaikan'] == '60.000 KM' ? "selected" : "") ;?> >60.000 KM</option>
															<option value="80.000 KM" <?php echo ($_POST['perbaikan'] == '80.000 KM' ? "selected" : "") ;?> >80.000 KM</option>
															<option value="100.000 KM" <?php echo ($_POST['perbaikan'] == '100.000 KM' ? "selected" : "") ;?> >100.000 KM</option>
															<option value="120.000 KM" <?php echo ($_POST['perbaikan'] == '120.000 KM' ? "selected" : "") ;?> >120.000 KM</option>
															<option value="140.000 KM" <?php echo ($_POST['perbaikan'] == '140.000 KM' ? "selected" : "") ;?> >140.000 KM</option>
															<option value="160.000 KM" <?php echo ($_POST['perbaikan'] == '160.000 KM' ? "selected" : "") ;?> >160.000 KM</option>
															<option value="180.000 KM" <?php echo ($_POST['perbaikan'] == '180.000 KM' ? "selected" : "") ;?> >180.000 KM</option>
															<option value="200.000 KM" <?php echo ($_POST['perbaikan'] == '200.000 KM' ? "selected" : "") ;?> >200.000 KM</option>
															<option value="LAIN-LAIN" <?php echo ($_POST['perbaikan'] == 'LAIN-LAIN' ? "selected" : "") ;?> >LAIN-LAIN</option>
															
	<?php  }elseif ($_POST['jenisperbaikan'] == 'PM') {?>
	
	<option value="" selected disabled>PM</option>
															<option value="30.000 KM" <?php echo ($_POST['perbaikan'] == '30.000 KM' ? "selected" : "") ;?> >30.000 KM</option>
															<option value="50.000 KM" <?php echo ($_POST['perbaikan'] == '50.000 KM' ? "selected" : "") ;?> >50.000 KM</option>
															<option value="70.000 KM" <?php echo ($_POST['perbaikan'] == '70.000 KM' ? "selected" : "") ;?> >70.000 KM</option>
															<option value="90.000 KM" <?php echo ($_POST['perbaikan'] == '90.000 KM' ? "selected" : "") ;?> >90.000 KM</option>
															<option value="130.000 KM" <?php echo ($_POST['perbaikan'] == '130.000 KM' ? "selected" : "") ;?> >130.000 KM</option>
															<option value="150.000 KM" <?php echo ($_POST['perbaikan'] == '150.000 KM' ? "selected" : "") ;?> >150.000 KM</option>
															<option value="170.000 KM" <?php echo ($_POST['perbaikan'] == '170.000 KM' ? "selected" : "") ;?> >170.000 KM</option>
															<option value="190.000 KM" <?php echo ($_POST['perbaikan'] == '190.000 KM' ? "selected" : "") ;?> >190.000 KM</option>
	
	
	
	
	
	
	
	
	<?php }
	
}?>