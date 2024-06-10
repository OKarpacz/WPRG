<?php
function isSpecialIp($ip, $filename = 'ListaIp') {
    if (!file_exists($filename)) {
        return false;
    }

    $specialIp = file($filename, FILE_IGNORE_NEW_LINES);
    return in_array($ip, $specialIp);
}

$ip = $_SERVER['REMOTE_ADDR'];

//Ip do potestowania działania skrytpu (trzeba odkomentować)
//$ip = "555.666.777.888";

if (isSpecialIp($ip)) {
    include 'redirect_page.html';
} else {
    include 'normal_page.html';
}
?>
