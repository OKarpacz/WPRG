<?php
while(true) {
    echo "Podaj liczbe zmiennoprzecinkową: ";
    $number = (float)readline("");
    if (preg_match("/[0-9]+\.[0-9]+/", $number))
        break;
    echo "Niepoprawny format!\n";
}

preg_match("/[0-9]+\.[0-9]+/",$number,$matches);

$numCounter = strlen($matches[0]) - strpos($matches[0], '.') - 1;
echo "Ilość cyfr po przecinku to: ". $numCounter;
?>