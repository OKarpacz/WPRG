<?php
function sumaCyfr($liczba) {
    $suma = 0;
    while ($liczba > 0) {
        $suma += $liczba % 10;
        $liczba = (int)($liczba / 10);
    }
    return $suma;
}

$liczba = 12345;
while (sumaCyfr($liczba) >= 10) {
    $liczba = sumaCyfr($liczba);
}
echo "Ostateczna suma: " . $liczba;
?>