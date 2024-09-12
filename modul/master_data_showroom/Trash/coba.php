<?php  
// Koneksi
mysql_connect("localhost","root","");  
mysql_select_db("hondabin_showroom");  
$result = mysql_query("select * from salesman");
$jsArray = "var prdName = new Array();\n";
echo 'Kode Produk : <select name="prdId" onchange="document.getElementById(\'prd_name\').value = prdName[this.value]">';
echo '<option>-------</option>';
while ($row = mysql_fetch_array($result)) {
    echo '<option value="' . $row['kode_sales'] . '">' . $row['kode_sales'] . '</option>';
    $jsArray .= "prdName['" . $row['kode_sales'] . "'] = '" . addslashes($row['nama_sales']) . "';\n";
}
echo '</select>';
?>
<br />
Nama Produk : <input type="text" name="prod_name" id="prd_name"/>
<script type="text/javascript">
<?php echo $jsArray; ?>
</script>




<html>
<div id="smallRight"><h3 style="background-color:#A6D44D">Jadwal Dokter</h3>
<table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
<tr>
<td colspan="5">
<form method="post" action="">
<select name="cid">
<option value="" disabled="disabled">--informasi--</option>
 <?php
 $a="SELECT * FROM supervisor";
 $sql=mysql_query($a);
 while($data=mysql_fetch_array($sql)){
 ?>
 if($_POST[cid]==$data[kode_supervisor]){
 <option value="<?php echo $data['kode_supervisor']?>" selected><?php echo $data['kode_supervisor']?></option>
 }else{
 <option value="<?php echo $data['kode_supervisor']?>"><?php echo $data['kode_supervisor']?></option>
 }
 <?php
 }
 ?>
 </select>
 <input type="submit" value="cari"/>
 </form>
 </td>
 </tr>
 </table>
 <table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
 <tr>
 <td style="border: none;padding: 4px;"><b>Hari</b></td>
 <td style="border: none;padding: 4px;"><b>Jam</b></td>
 </tr>
 <?php
 if(isset($_POST['cid'])){
 $b="SELECT * FROM salesman where kode_supervisor='$_POST[cid]'";
 $sql=mysql_query($b);
 while($data=mysql_fetch_array($sql)){
 ?>
 <tr>
 <td style="border: none;padding: 4px;"><?php echo $data['kode_sales'];?></td>
 <td style="border: none;padding: 4px;"><?php echo $data['nama_sales'];?></td>
 </tr>
 <?php
 }
 }
 ?>
  </table>
 </div>
</html>