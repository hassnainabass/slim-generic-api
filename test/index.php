<?php

$login = 'username here';
$password = 'password here';
$url = 'url here';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
$result = curl_exec($ch);
echo "<pre>";
print_r($result);
echo "</pre>";
curl_close($ch);
echo($result);