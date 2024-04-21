<?php
function pomnóżMacierze($macierz1, $macierz2) {
    $wiersze1 = count($macierz1);
    $kolumny1 = count($macierz1[0]);
    $wiersze2 = count($macierz2);
    $kolumny2 = count($macierz2[0]);

    if ($kolumny1 != $wiersze2) {
        echo "Niepoprawne wymiary macierzy!";
        return;
    }

    $wynik = array();
    for ($i = 0; $i < $wiersze1; $i++) {
        for ($j = 0; $j < $kolumny2; $j++) {
            $wynik[$i][$j] = 0;
            for ($k = 0; $k < $kolumny1; $k++) {
                $wynik[$i][$j] += $macierz1[$i][$k] * $macierz2[$k][$j];
            }
        }
    }
    return $wynik;
}

$macierz1 = array(array(1, 2), array(3, 4));
$macierz2 = array(array(5, 6), array(7, 8));
$wynik = pomnóżMacierze($macierz1, $macierz2);
var_dump($wynik);
?>