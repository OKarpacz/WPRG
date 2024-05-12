<!DOCTYPE html>
<html>
<head>
    <title>Wyniki operacji na ciągach znaków</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h2>Wyniki operacji na ciągach znaków</h2>

<?php
$text = $_POST["text"];
$operation = $_POST["operation"];

if (empty($text)) {
    echo "<p class='error'>Błąd: Wprowadź ciąg znaków.</p>";
} else {
    switch ($operation) {
        case "reverse":
            echo "<p>Odwrócony ciąg znaków: " . strrev($text) . "</p>";
            break;
        case "uppercase":
            echo "<p>Ciąg znaków dużymi literami: " . strtoupper($text) . "</p>";
            break;
        case "lowercase":
            echo "<p>Ciąg znaków małymi literami: " . strtolower($text) . "</p>";
            break;
        case "char_count":
            echo "<p>Liczba znaków w ciągu: " . strlen($text) . "</p>";
            break;
        case "trim":
            echo "<p>Ciąg po usunięciu białych znaków z początku i końca: " . trim($text) . "</p>";
            break;
        default:
            echo "<p class='error'>Błąd: Niepoprawna operacja.</p>";
    }
}
?>

<p><a href="index.php">Powrót do formularza</a></p>

</body>
</html>
