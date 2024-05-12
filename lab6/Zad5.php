<?php
function czyPangram($tekst)
{
    $tekst = strtolower($tekst);
    $alfabet = range('a', 'z');
    foreach ($alfabet as $litera) {
        if (strpos($tekst, $litera) === false) {
            return false;
        }
    }
    return true;
}

$tekst = "The quick brown fox jumps over the lazy dog.";
echo czyPangram($tekst) ? "true" : "false";
?>