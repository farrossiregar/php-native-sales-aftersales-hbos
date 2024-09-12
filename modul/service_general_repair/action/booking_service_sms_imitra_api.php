<?php

$hari_indo = ($hari_booking == "Mon" ? "Senin": ($hari_booking == "Tue" ? "Selasa" : ($hari_booking == "Wed" ? "Rabu" : ($hari_booking == "Thu" ? 
"Kamis" :($hari_booking == "Fri" ? "Jum'at" : ($hari_booking == "Sat" ? "Sabtu" :($hari_booking == "Sun" ? "Minggu" : "")))))));

$tgl_indo = date('d-m-Y',strtotime($waktu_booking));

$jam_indo = substr($jam_booking,0,5);



//$telepon = "081296931988";

$nohp = "62".trim(substr($telepon,1,12));


$url = "http://webapps.imitra.com:29003/sms_applications/smsb/api_mt_send_message.php";
$xml = "data=<bulk_sending>
<username>hondabintaro</username>
<password>4c9878878ef993da8591ab98ed10b45f</password>
<priority>high</priority>
<sender>HONDABNTARO</sender>
<dr_url></dr_url>
<allowduplicate></allowduplicate>
<data_packet>
<packet>
<msisdn>$nohp</msisdn>
<sms>Terima kasih telah melakukan booking service untuk kendaraan $no_polisi di Honda Bintaro. Harap datang tepat waktu pada Hari $hari_indo, $tgl_indo Pukul $jam_indo</sms>
<is_long_sms>Y</is_long_sms>
</packet>

</data_packet>
</bulk_sending>";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);

//echo $response;




?>