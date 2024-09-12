<?php
	$serverName = "OTOBITZSRV";
	 
	/* Get UID and PWD from application-specific files.  */
	$uid = "sa";
	$pwd = "fbsteam";
	$connectionInfo = array( "UID"=>$uid,
							 "PWD"=>$pwd,
							 "Database"=>"otobitz");
	 
	/* Connect using SQL Server Authentication. */
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
?>