<?php

function getdata($url, $xml){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FAILONERROR,1);
	//curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); If Safe mode = On than not working
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
	curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml");
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	$retValue = curl_exec($ch);
  curl_close($ch);

	return $retValue;
}


$url = 'https://devapi.multisafepay.com/ewx/';

$xml_data ='<status ua="custom-1.1">'.
'<merchant>'.
'<account>10015043</account>'.
'<site_id>183</site_id>'.
'<site_secure_code>029834</site_secure_code>'.
'</merchant>'.
'<transaction>'.
'<id>ORDER-SAMPLE-1</id>'.
'</transaction>'.
'</status>';

$sUrl = getdata($url, $xml_data);

// which format we need
$xml = simplexml_load_string($sUrl);
$json = json_encode($xml);
// $array = json_decode($json,TRUE);

echo($json);

?>
