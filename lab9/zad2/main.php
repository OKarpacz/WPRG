<?php
function fileManager($path, $name, $operationType = "read")
{
$pathName = $path . $name;
switch ($operationType) {
case "read":
if (is_dir($pathName)) {
echo "Lista plików w katalogu $pathName : <br/>";
foreach (scandir($pathName) as $file) {
if ($file != '.' && $file != '..')
echo "$file<br/>";
}
} else {
echo "Nie mogę otworzyć katalogu $pathName";
}
break;

case "delete":
if (file_exists($pathName) && is_dir($pathName)) {
$files = scandir($pathName);
$fileCounter = 0;
foreach ($files as $file) {
if ($file != '.' && $file != '..') {
$fileCounter++;
}
}

if ($fileCounter < 1) {
rmdir($pathName);
echo "Pomyślnie usunięto katalog";
} else {
echo "Katalog nie jest pusty.";
}
} else {
echo "Wybrany katalog nie istnieje lub nie jest katalogiem";
}
break;

case "create":
if(!is_dir($pathName) && mkdir($pathName))
echo "Pomyślnie utworzono katalog";
elseif (is_dir($pathName))
echo "Katalog już istnieje";
else
echo "Nie udało się utworzyć katalogu";
break;

}
}
?>