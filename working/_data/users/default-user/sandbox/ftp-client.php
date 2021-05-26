<?php 

$ftp = new \FtpClient\FtpClient();
$ftp->connect('host');
$ftp->login('user','pwd');

var_dump($ftp->scanDir('.'));


