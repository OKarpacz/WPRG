<?php
function czyLiczbaPierwsza($liczba) {
    if ($liczba < 2) {
        return false;
    }
    for ($i = 2; $i <= sqrt($liczba); $i++) {
        if ($liczba % $i == 0) {
            return false;
        }
    }
    return true;
}

function wypiszLiczbyPierwsze($poczatek, $koniec) {
    for ($i = $poczatek; $i <= $koniec; $i++) {
        if (czyLiczbaPierwsza($i)) {
            echo $i . " ";
        }
    }
}

wypiszLiczbyPierwsze(10, 50);
?>
