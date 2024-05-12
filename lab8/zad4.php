<?php
echo "Podaj ciąg znaków: ";
$string = readline("");
$counter = 0;
for($i = 0 ; $i < strlen($string); $i++){
    if(preg_match("/[aeiou]/", $string[$i])){
        $counter++;
    }
}
echo "Ilość samgołosek w ciągu znaków \"$string\" to: " . $counter;
?>