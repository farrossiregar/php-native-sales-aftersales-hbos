<?php
	class hitung_data {
		
		function data1($nm_sa,$bulan,$kategori){
			date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
			
			$query_item = mysql_query("select itemcontrol.nm_item,itemcontrol.id_item,
			itemcontrol.id_kategori,kategori.nm_kategori,target_sa.target_unit,target_sa.target_point from itemcontrol 
			left join kategori on itemcontrol.id_kategori = kategori.id_kategori 
			left join target_sa on itemcontrol.id_item = target_sa.id_item
			where itemcontrol.aktif = 'Y' and kategori.id_kategori = '$kategori' and target_sa.bulan = '$bulan' order by nm_item");
			
			$ntotal = 0;
			$grandtotal_point_extracare = 0;
			while ($r=mysql_fetch_array($query_item)){
				//echo "Kategori :$r[nm_kategori] --> $r[id_item] - $r[nm_item] ";
				//echo "<tr><td>$no</td><td>target item</td><td>target point</td><td>";
				$jml = 0;
				if (!empty($r[id_item])){
					$grandtotal = 0;
					$data = mysql_query("select id_item,sum(total) as total,sum(package_point) as point from acchv where acchv.id_item 
					= $r[id_item] and bulan = '$bulan' and nm_sa = '$nm_sa' group by id_item");
					 while ($d=mysql_fetch_array($data)){
						//echo "Total = ". $d['sum(total)'];
						//echo "<td>$d['sum(total)']</td><td>result point</td>";														
							
						
						$total_ = $d[total];	
						
						$grandtotal = $grandtotal + $total_;
						
						if ($kategori == '23'){($grandtotal > $r[target_unit])?$total_point = $r[target_point] :$total_point = 0 ;	}
						else {
							$total_point = ($total_ * $r[target_point]) + $d[point] ; 
						}
						$grandtotal_point_carcare = $grandtotal_point_carcare + $total_point;
						$ratio_total = (($total_ / $r[target_unit]) < 1? ($total_ / $r[target_unit]): 1 ) ;
						$ntotal_carcare = ($ntotal_carcare + $ratio_total);
						
						
					 }
				}
				
			}
			$count = mysql_query("select count(id_item) as count from target_sa where id_kategori = '$kategori' and bulan = '$bulan'");
			$count = mysql_fetch_array($count);
			$ntotal_carcare = $ntotal_carcare / $count['count'];
			
			return array($grandtotal_point_carcare,$ntotal_carcare);
			
		}
		
		
		function data2($nm_sa,$bulan){
			$query_item = mysql_query("select itemcontrol.nm_item,itemcontrol.id_item,
			itemcontrol.id_kategori,kategori.nm_kategori,target_sa.target_unit,target_sa.target_point from itemcontrol 
			left join kategori on itemcontrol.id_kategori = kategori.id_kategori 
			left join target_sa on itemcontrol.id_item = target_sa.id_item
			where itemcontrol.aktif = 'Y' and kategori.id_kategori = 23 and target_sa.bulan = '$bulan' order by nm_item");
			
			$no = 1;
			
			while ($r=mysql_fetch_array($query_item)){
				//echo "Kategori :$r[nm_kategori] --> $r[id_item] - $r[nm_item] ";
				//echo "<tr><td>$no</td><td>target item</td><td>target point</td><td>";
				$jml = 0;
				if (!empty($r[id_item])){
					$grandtotal = 0;
					$data = mysql_query("select id_item,sum(total) as total from acchv where acchv.id_item 
					= $r[id_item] and bulan = '$bulan' and nm_sa = '$nm_sa' group by id_item");
					 while ($d=mysql_fetch_array($data)){
						//echo "Total = ". $d['sum(total)'];
						//echo "<td>$d['sum(total)']</td><td>result point</td>";
						$total_ = $d[total];	
						$grandtotal = $grandtotal + $total_;
						if ($grandtotal > $r[target_unit]){$total_point = $r[target_point] ;}else {$total_point = 0 ;}																
						//$total_point = $total_ * $r[target_point] ;
						$ratio = (($total_ / $r[target_unit]) < 1? round(($total_ / $r[target_unit]) *100,2): 1*100 ) ;
						$ratio = ($ratio < 100 ? "<span class='label label-danger label-mini'>$ratio%</span>" : "<span class='label label-info label-mini'>$ratio%</span>" );
						
						if ($d[id_item] == '48'){$jasabp = $jasabp + $total_ ;}
						if ($d[id_item] == '46'){$panelbp = $panelbp + $total_ ;}
						if ($d[id_item] == '47'){$iubp = $iubp + $total_ ;}
						if ($d[id_item] == '49'){$partbp = $partbp + $total_ ;}
						
						$no++;
					 }
				}
				
				
				
			}
			return array($jasabp,$panelbp,$iubp,$partbp);
		}
		
		
		function hitung_revenue_gr($nm_sa,$bulan){
			$query_item = mysql_query("select itemcontrol.nm_item,itemcontrol.id_item,
			itemcontrol.id_kategori,kategori.nm_kategori,target_sa.target_unit,target_sa.target_point from itemcontrol 
			left join kategori on itemcontrol.id_kategori = kategori.id_kategori 
			left join target_sa on itemcontrol.id_item = target_sa.id_item
			where itemcontrol.aktif = 'Y' and kategori.id_kategori = 21 and target_sa.bulan = '$bulan' order by nm_item");
			
			$no = 1;
			
			while ($r=mysql_fetch_array($query_item)){
				//echo "Kategori :$r[nm_kategori] --> $r[id_item] - $r[nm_item] ";
				//echo "<tr><td>$no</td><td>target item</td><td>target point</td><td>";
				$jml = 0;
				if (!empty($r[id_item])){
					$grandtotal = 0;
					$data = mysql_query("select id_item,sum(total) as total from acchv where acchv.id_item 
					= $r[id_item] and bulan = '$bulan' and nm_sa = '$nm_sa' group by id_item");
					 while ($d=mysql_fetch_array($data)){
						//echo "Total = ". $d['sum(total)'];
						//echo "<td>$d['sum(total)']</td><td>result point</td>";
						$total_ = $d[total];	
						$grandtotal = $grandtotal + $total_;
						if ($grandtotal > $r[target_unit]){$total_point = $r[target_point] ;}else {$total_point = 0 ;}																
						//$total_point = $total_ * $r[target_point] ;
						$ratio = (($total_ / $r[target_unit]) < 1? round(($total_ / $r[target_unit]) *100,2): 1*100 ) ;
						$ratio = ($ratio < 100 ? "<span class='label label-danger label-mini'>$ratio%</span>" : "<span class='label label-info label-mini'>$ratio%</span>" );
						
						if ($d[id_item] == '30'){$jasagr = $jasabp + $total_ ;}
						if ($d[id_item] == '31'){$partgr = $panelbp + $total_ ;}
						if ($d[id_item] == '29'){$iugr = $iubp + $total_ ;}
						
						
						$no++;
					 }
				}
				
				
				
			}
			return array($iugr,$jasagr,$partgr);
		}
	}
	 //end class
	 
	
	class hitung_persa{
								
		function sabp($nm_sa,$bulan,$kategori){
		
			
			
			$query_item = mysql_query("select itemcontrol.nm_item,itemcontrol.id_item,
			itemcontrol.id_kategori,kategori.nm_kategori,target_sa.target_unit,target_sa.target_point from itemcontrol 
			left join kategori on itemcontrol.id_kategori = kategori.id_kategori 
			left join target_sa on itemcontrol.id_item = target_sa.id_item
			where itemcontrol.aktif = 'Y' and kategori.id_kategori = '$kategori' and target_sa.bulan = '$bulan' order by nm_item");
			
			
			$no = 1;
			$ntotal = 0;
			$dttable = "";
			while ($r=mysql_fetch_array($query_item)){
				//echo "Kategori :$r[nm_kategori] --> $r[id_item] - $r[nm_item] ";
				//echo "<tr><td>$no</td><td>target item</td><td>target point</td><td>";
				$jml = 0;
				$grandtotal = 0;
				if (!empty($r[id_item])){
					$data = mysql_query("select id_item,sum(total) as total,sum(package_point) as point from acchv where acchv.id_item 
					= $r[id_item] and bulan = '$bulan' and nm_sa = '$nm_sa' group by id_item");
					 while ($d=mysql_fetch_array($data)){
						//echo "Total = ". $d['sum(total)'];
						//echo "<td>$d['s	um(total)']</td><td>result point</td>";
						
						$total_ = $d[total];															
						$grandtotal = $grandtotal + $total_;
						
						if ($kategori == '23'){($grandtotal > $r[target_unit])?$total_point = $r[target_point] :$total_point = 0 ;	}
						else {
							$total_point = ($total_ * $r[target_point]) + $d[point] ; 
						}
						$grandtotal_point = $grandtotal_point + $total_point;
						
						
						$ratio_total = (($total_ / $r[target_unit]) < 1? round(($total_ / $r[target_unit]) *100,2): 1*100 ) ;
						$ntotal = $ntotal + $ratio_total;						
						$ratio = (($total_ / $r[target_unit]) < 1? round(($total_ / $r[target_unit]) *100,2): 1*100 ) ;
						//$ratio = ($ratio < 100 ? "<span class='label label-danger label-mini'>$ratio%</span>" : "<span class='label label-info label-mini'>$ratio%</span>" );
						if ($ratio <= 50){$ratio = "<span class='label label-danger label-mini'>$ratio%</span>";}
						elseif ($ratio <= 80){$ratio = "<span class='label label-warning label-mini'>$ratio%</span>" ;}
						elseif ($ratio < 100){$ratio = "<span class='label label-info label-mini'>$ratio%</span>";}
						elseif ($ratio >= 100){$ratio = "<span class='label label-success label-mini'>$ratio%</span>";}
						
						$dttable .= "<tr><td>$no</td><td>$r[nm_item]</td><td>".number_format($r[target_unit],0,',','.')."</td>
						<td>$r[target_point]</td><td>".number_format($total_,0,',','.')."</td><td>$total_point</td><td>$ratio</td></tr>";
						
						$no++;
					 }
				}
				
			}
			$count = mysql_query("select count(id_item) as count from target_sa where id_kategori = '$kategori' and bulan = '$bulan'");
			$count = mysql_fetch_array($count);
			$ntotal_angka = ($ntotal*100)/$count['count'];
			$ntotal = round($ntotal / $count['count'],2);
			if ($ntotal <= 50){$ntotal = "<span class='label label-danger label-mini'>$ntotal%</span>";}
						elseif ($ntotal <= 80){$ntotal = "<span class='label label-warning label-mini'>$ntotal%</span>" ;}
						elseif ($ntotal < 100){$ntotal = "<span class='label label-info label-mini'>$ntotal%</span>";}
						elseif ($ntotal >= 100){$ntotal = "<span class='label label-success label-mini'>$ntotal%</span>";}
			return array($dttable,$ntotal,$grandtotal_point,$ntotal_angka);
		}
		
		function sagr($nm_sa,$bulan,$kategori){
			
			
			$query_item = mysql_query("select itemcontrol.nm_item,itemcontrol.id_item,
			itemcontrol.id_kategori,kategori.nm_kategori,target_sa.target_unit,target_sa.target_point from itemcontrol 
			left join kategori on itemcontrol.id_kategori = kategori.id_kategori 
			left join target_sa on itemcontrol.id_item = target_sa.id_item
			where itemcontrol.aktif = 'Y' and kategori.id_kategori = '$kategori' and target_sa.bulan = '$bulan' order by nm_item");
			
			
			$no = 1;
			$ntotal = 0;
			$dttable = "";
			while ($r=mysql_fetch_array($query_item)){
				//echo "Kategori :$r[nm_kategori] --> $r[id_item] - $r[nm_item] ";
				//echo "<tr><td>$no</td><td>target item</td><td>target point</td><td>";
				$jml = 0;
				$grandtotal = 0;
				if (!empty($r[id_item])){
					$data = mysql_query("select id_item,sum(total) as total,sum(package_point) as point from acchv where acchv.id_item 
					= $r[id_item] and bulan = '$bulan' and nm_sa = '$nm_sa' group by id_item");
					 while ($d=mysql_fetch_array($data)){
						//echo "Total = ". $d['sum(total)'];
						//echo "<td>$d['s	um(total)']</td><td>result point</td>";
						
						$total_ = $d[total];															
						$grandtotal = $grandtotal + $total_;
						
						if ($kategori == '21'){if ($grandtotal > $r[target_unit]){$total_point = $r[target_point] ;}else {$total_point = 0 ;}		}
						else {
							$total_point = ($total_ * $r[target_point]) + $d[point] ; 
						}
						$grandtotal_point = $grandtotal_point + $total_point;
						
						
						$ratio_total = (($total_ / $r[target_unit]) < 1? ($total_ / $r[target_unit]) : 1 ) ;
						$ntotal = $ntotal + $ratio_total;						
						$ratio = (($total_ / $r[target_unit]) < 1? round(($total_ / $r[target_unit]) *100,2): 1*100 ) ;
						//$ratio = ($ratio < 100 ? "<span class='label label-danger label-mini'>$ratio%</span>" : "<span class='label label-info label-mini'>$ratio%</span>" );
						if ($ratio <= 50){$ratio = "<span class='label label-danger label-mini'>$ratio%</span>";}
						elseif ($ratio <= 80){$ratio = "<span class='label label-warning label-mini'>$ratio%</span>" ;}
						elseif ($ratio < 100){$ratio = "<span class='label label-info label-mini'>$ratio%</span>";}
						elseif ($ratio >= 100){$ratio = "<span class='label label-success label-mini'>$ratio%</span>";}
						
						$dttable .= "<tr><td>$no</td><td>$r[nm_item]</td><td>".number_format($r[target_unit],0,',','.')."</td>
						<td>$r[target_point]</td><td>".number_format($total_,0,',','.')."</td><td>$total_point</td><td>$ratio</td></tr>";
						
						$no++;
					 }
				}
				
			}
			$count = mysql_query("select count(id_item) as count from target_sa where id_kategori = '$kategori' and bulan = '$bulan'");
			$count = mysql_fetch_array($count);
			$ntotal_angka = ($ntotal*100)/$count['count'];
			$ntotal = round($ntotal*100 / $count['count'],2);		
			
			if ($ntotal <= 50){$ntotal = "<span class='label label-danger label-mini'>$ntotal%</span>";}
						elseif ($ntotal <= 80){$ntotal = "<span class='label label-warning label-mini'>$ntotal%</span>" ;}
						elseif ($ntotal < 100){$ntotal = "<span class='label label-info label-mini'>$ntotal%</span>";}
						elseif ($ntotal >= 100){$ntotal = "<span class='label label-success label-mini'>$ntotal%</span>";}
			
			return array($dttable,$ntotal,$grandtotal_point,$ntotal_angka);
		}
		
		function summary($nm_sa,$bulan,$kategori){
			
			
			$query_item = mysql_query("select itemcontrol.nm_item,itemcontrol.id_item,
			itemcontrol.id_kategori,kategori.nm_kategori,target_sa.target_dealer,target_sa.target_unit,target_sa.target_point from itemcontrol 
			left join kategori on itemcontrol.id_kategori = kategori.id_kategori 
			left join target_sa on itemcontrol.id_item = target_sa.id_item
			where itemcontrol.aktif = 'Y' and kategori.id_kategori = '$kategori' and target_sa.bulan = '$bulan' order by nm_item");
			
			
			$no = 1;
			$ntotal = 0;
			$dttable = "";
			while ($r=mysql_fetch_array($query_item)){
				//echo "Kategori :$r[nm_kategori] --> $r[id_item] - $r[nm_item] ";
				//echo "<tr><td>$no</td><td>target item</td><td>target point</td><td>";
				$jml = 0;
				$grandtotal = 0;
				if (!empty($r[id_item])){
					$data = mysql_query("select id_item,sum(total) as total,sum(package_point) as point from acchv where acchv.id_item 
					= $r[id_item] and bulan = '$bulan'  group by id_item");
					 while ($d=mysql_fetch_array($data)){
						//echo "Total = ". $d['sum(total)'];
						//echo "<td>$d['s	um(total)']</td><td>result point</td>";
						
						$total_ = $d[total];															
						$grandtotal = $grandtotal + $total_;
						
						if ($kategori == '21'){if ($grandtotal > $r[target_unit]){$total_point = $r[target_point] ;}else {$total_point = 0 ;}		}
						else {
							$total_point = ($total_ * $r[target_point]) + $d[point] ; 
						}
						$grandtotal_point = $grandtotal_point + $total_point;
						
						
						$ratio_total = (($total_ / $r[target_dealer]) < 1? round(($total_ / $r[target_dealer]) *100,2): 1*100 ) ;
						$ntotal = $ntotal + $ratio_total;						
						$ratio = (($total_ / $r[target_dealer]) < 1? round(($total_ / $r[target_dealer]) *100,2): 1*100 ) ;
						//$ratio = ($ratio < 100 ? "<span class='label label-danger label-mini'>$ratio%</span>" : "<span class='label label-info label-mini'>$ratio%</span>" );
						
						if ($ratio <= 50){$ratio = "<span class='label label-danger label-mini'>$ratio%</span>";}
						elseif ($ratio <= 80){$ratio = "<span class='label label-warning label-mini'>$ratio%</span>" ;}
						elseif ($ratio < 100){$ratio = "<span class='label label-info label-mini'>$ratio%</span>";}
						elseif ($ratio >= 100){$ratio = "<span class='label label-success label-mini'>$ratio%</span>";}
						
						$dttable .= "<tr><td>$no</td><td>$r[nm_item]</td><td>".number_format($r[target_dealer],0,',','.')."</td>
						<td>$r[target_point]</td><td><b>".number_format($total_,0,',','.')."</b></td><td>$total_point</td><td>$ratio</td></tr>";
						
						$no++;
					 }
				}
				
			}
			$count = mysql_query("select count(id_item) as count from target_sa where id_kategori = '$kategori' and bulan = '$bulan'");
			$count = mysql_fetch_array($count);
			$ntotal = round($ntotal / $count['count'],2);
			/*
			if ($ntotal <= 50){$ntotal = "<span class='label label-danger label-mini'>$ntotal%</span>";}
						elseif ($ntotal <= 80){$ntotal = "<span class='label label-warning label-mini'>$ntotal%</span>" ;}
						elseif ($ntotal < 100){$ntotal = "<span class='label label-info label-mini'>$ntotal%</span>";}
						elseif ($ntotal >= 100){$ntotal = "<span class='label label-success label-mini'>$ntotal%</span>";}
				*/		
			return array($dttable,$ntotal,$grandtotal_point);
		}
		function summary_bp($nm_sa,$bulan,$kategori){
			
			
			$query_item = mysql_query("select itemcontrol.nm_item,itemcontrol.id_item,
			itemcontrol.id_kategori,kategori.nm_kategori,target_sa.target_dealer,target_sa.target_unit,target_sa.target_point from itemcontrol 
			left join kategori on itemcontrol.id_kategori = kategori.id_kategori 
			left join target_sa on itemcontrol.id_item = target_sa.id_item
			where itemcontrol.aktif = 'Y' and kategori.id_kategori = '$kategori' and target_sa.bulan = '$bulan' order by nm_item");
			
			
			$no = 1;
			$ntotal = 0;
			$dttable = "";
			while ($r=mysql_fetch_array($query_item)){
				//echo "Kategori :$r[nm_kategori] --> $r[id_item] - $r[nm_item] ";
				//echo "<tr><td>$no</td><td>target item</td><td>target point</td><td>";
				$jml = 0;
				$grandtotal = 0;
				if (!empty($r[id_item])){
					$data = mysql_query("select id_item,sum(total) as total,sum(package_point) as point from acchv where acchv.id_item 
					= $r[id_item] and bulan = '$bulan'  group by id_item");
					 while ($d=mysql_fetch_array($data)){
						//echo "Total = ". $d['sum(total)'];
						//echo "<td>$d['s	um(total)']</td><td>result point</td>";
						
						$total_ = $d[total];															
						$grandtotal = $grandtotal + $total_;
						
						if ($kategori == '21'){if ($grandtotal > $r[target_unit]){$total_point = $r[target_point] ;}else {$total_point = 0 ;}		}
						else {
							$total_point = ($total_ * $r[target_point]) + $d[point] ; 
						}
						$grandtotal_point = $grandtotal_point + $total_point;
						
						
						$ratio_total = (($total_ / $r[target_dealer]) < 1? round(($total_ / $r[target_dealer]) *100,2): 1*100 ) ;
						$ntotal = $ntotal + $ratio_total;						
						$ratio = (($total_ / $r[target_dealer]) < 1? round(($total_ / $r[target_dealer]) *100,2): 1*100 ) ;
						//$ratio = ($ratio < 100 ? "<span class='label label-danger label-mini'>$ratio%</span>" : "<span class='label label-info label-mini'>$ratio%</span>" );
						
						if ($ratio <= 50){$ratio = "<span class='label label-danger label-mini'>$ratio%</span>";}
						elseif ($ratio <= 80){$ratio = "<span class='label label-warning label-mini'>$ratio%</span>" ;}
						elseif ($ratio < 100){$ratio = "<span class='label label-info label-mini'>$ratio%</span>";}
						elseif ($ratio >= 100){$ratio = "<span class='label label-success label-mini'>$ratio%</span>";}
						
						$dttable .= "<tr><td>$no</td><td>$r[nm_item]</td><td>".number_format($r[target_dealer],0,',','.')."</td>
						<td>$r[target_point]</td><td><b>".number_format($total_,0,',','.')."</b></td><td>$total_point</td><td>$ratio</td></tr>";
						
						$no++;
					 }
				}
				
			}
			$count = mysql_query("select count(id_item) as count from target_sa where id_kategori = '$kategori' and bulan = '$bulan'");
			$count = mysql_fetch_array($count);
			$ntotal = round($ntotal / $count['count'],2);
			/*
			if ($ntotal <= 50){$ntotal = "<span class='label label-danger label-mini'>$ntotal%</span>";}
						elseif ($ntotal <= 80){$ntotal = "<span class='label label-warning label-mini'>$ntotal%</span>" ;}
						elseif ($ntotal < 100){$ntotal = "<span class='label label-info label-mini'>$ntotal%</span>";}
						elseif ($ntotal >= 100){$ntotal = "<span class='label label-success label-mini'>$ntotal%</span>";}
				*/		
			return array($dttable,$ntotal,$grandtotal_point);
		}
		
		function subtotal_ratio($ntotal){
			if ($ntotal <= 50){$ntotal = "<span class='label label-danger label-mini'>$ntotal%</span>";}
			elseif ($ntotal <= 80){$ntotal = "<span class='label label-warning label-mini'>$ntotal%</span>" ;}
			elseif ($ntotal < 100){$ntotal = "<span class='label label-info label-mini'>$ntotal%</span>";}
			elseif ($ntotal >= 100){$ntotal = "<span class='label label-success label-mini'>$ntotal%</span>";}
			return $ntotal;
		}
		
		
	}
	
	class hitung_asuransi {
		function tampil_asuransi($bulan){
			$query = mysql_query("select * from acchv_asuransi where bulan = '$bulan'");
			$no = 2;
			while ($r = mysql_fetch_array($query)){
				if ($r['id_asuransi'] != '20'){
				$data .= "<tr><td>$no</td><td>$r[nm_asuransi]</td><td>$r[total]</td><td align = center><a class='btn btn-xs btn-warning' 
				href = media.php?module=sub_bodyrepair_jobcontrol&act=edituser&id=$r[id_acchv] data-original-title='Update' data-placement='top' data-toggle='tooltip'>
				Edit <i class='fa fa-pencil'></i></a></td></tr>";
				$total_asuransi = $total_asuransi + $r[total];
				$no = $no +1;
				}else {
					$total_non_asuransi = $r[total];
					$id_non_asuransi = $r[id_acchv];
					
					
				}
			}
			return array($data,$total_asuransi,$total_non_asuransi,$id_non_asuransi);
		}
	}
	
?>

