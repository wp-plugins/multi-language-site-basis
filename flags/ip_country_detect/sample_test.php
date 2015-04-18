<?php
$user_ippp = $_SERVER['REMOTE_ADDR'];
if (!class_exists("GeoIP")){ include_once( __DIR__ ."/geoip.inc"); }
$gi = geoip_open( __DIR__ ."/GeoIP.dat", GEOIP_STANDARD); 
$country_name = geoip_country_name_by_addr($gi, $user_ippp );
geoip_close($gi);
//if ($country_name=="France") 	{ echo "Hi, you are from France!"; 
//we get country names from "country_names.txt"
?>