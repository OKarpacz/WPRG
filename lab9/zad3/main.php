<?php
$counterFile = 'licznik.txt';

if (!file_exists($counterFile)) {
    $handle = fopen($counterFile, 'w');
    if ($handle === false) {
        die('Nie udało się utworzyć pliku licznik.txt');
    }
    fwrite($handle, '1');
    fclose($handle);
    $visitCount = 1;
} else {
    $handle = fopen($counterFile, 'r+');
    if ($handle === false) {
        die('Nie udało się otworzyć pliku licznik.txt');
    }
    $fileSize = filesize($counterFile);
    if ($fileSize > 0) {
        $visitCount = (int)fread($handle, $fileSize);
    } else {
        $visitCount = 0;
    }
    $visitCount++;
    fseek($handle, 0);
    fwrite($handle, (string)$visitCount);
    fclose($handle);
}
echo "Liczba odwiedzin: $visitCount";
?>
