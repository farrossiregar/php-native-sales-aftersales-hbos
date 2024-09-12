<?php
/*$server_service = "localhost";
$username_service = "hondabintaro";
$password_service = "hondabintaro0102";

$database = "hondabin_showroom_online";
$database_service = "hondabin_service";

// Koneksi dan memilih database di server
$koneksi_showroom = mysql_connect($server_service,$username_service,$password_service) or die("Koneksi gagal");
$koneksi_service = mysql_connect($server_service,$username_service,$password_service,true) or die("Koneksi gagal");

mysql_select_db($database,$koneksi_showroom) or die("Database tidak bisa dibuka");
mysql_select_db($database_service,$koneksi_service) or die("Database tidak bisa dibuka");	*/


//	===================== PDO =====================	// 
$hostname ='localhost';
$username ='hondabintaro';
$password ='hondabintaro0102';
$database = "hondabin_showroom_online";

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database",$username,$password);
 //   $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
   // echo 'Connected to Database<br/>';
}
catch(PDOException $e){
echo $e->getMessage();
}


?> 