<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista odnośników</title>
</head>
<body>
<h1>Odnośniki</h1>
<ul>

    <?php
    $filename = 'adresy';

    if ($fd = fopen($filename, 'r')) {
        while (($line = fgets($fd)) !== false) {
            $line = trim($line);
            list($link, $description) = explode(';', $line);
            echo "<li><a href=\"$link\"> $description </a></li>";
        }
        fclose($fd);
    } else {
        echo "Nie można otworzyć pliku $filename";
    }
    ?>

</ul>
</body>
</html>