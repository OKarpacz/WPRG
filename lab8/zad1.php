<?php
echo "Podaj ciąg znaków: ";
$string = (string)readline("");
modedString($string);

function modedString($string)
{
    echo strtoupper($string) . "\n";
    echo strtolower($string) . "\n";
    echo ucfirst($string) . "\n";
    echo ucwords($string);
}
?>