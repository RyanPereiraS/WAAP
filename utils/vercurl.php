<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'localhost:8080/waap_oficial/web3/utils/testemailer.php?email=puuppyadr1@gmail.com');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
curl_close($ch);