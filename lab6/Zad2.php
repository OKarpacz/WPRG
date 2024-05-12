<?php

function sumaCiągu($pierwszy, $różnica, $ilość)
{
    $suma_arytmetyczna = ($ilość * ($pierwszy + ($pierwszy + ($ilość - 1) * $różnica))) / 2;
    $suma_geometryczna = $pierwszy * ((1 - pow($różnica, $ilość)) / (1 - $różnica));
    echo "Suma ciągu arytmetycznego: " . $suma_arytmetyczna . "<br>";
    echo "Suma ciągu geometrycznego: " . $suma_geometryczna;
}

sumaCiagu(1, 2, 5);
?>