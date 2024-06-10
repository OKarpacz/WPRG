<?php
function handleDirectory($path, $directory, $operation = 'read') {
    $fullPath = $path . $directory;

    if ($operation == 'read') {
        if (is_dir($fullPath)) {
            $elements = scandir($fullPath);
            $elements = array_diff($elements, array('.', '..'));
            if (!empty($elements)) {
                echo "Zawartość katalogu $fullPath:<br>";
                foreach ($elements as $element) {
                    echo $element . "<br>";
                }
            } else {
                echo "Katalog $fullPath jest pusty.";
            }
        } else {
            echo "Katalog $fullPath nie istnieje.";
        }
    } elseif ($operation == 'create') {
        if (!is_dir($fullPath)) {
            if (mkdir($fullPath, 0777, true)) {
                echo "Katalog $fullPath został pomyślnie stworzony.";
            } else {
                echo "Nie udało się stworzyć katalogu $fullPath.";
            }
        } else {
            echo "Katalog $fullPath już istnieje.";
        }
    } elseif ($operation == 'delete') {
        if (is_dir($fullPath)) {
            $elements = scandir($fullPath);
            $elements = array_diff($elements, array('.', '..'));
            if (empty($elements)) {
                if (rmdir($fullPath)) {
                    echo "Katalog $fullPath został pomyślnie usunięty.";
                } else {
                    echo "Nie udało się usunąć katalogu $fullPath.";
                }
            } else {
                echo "Katalog $fullPath nie jest pusty i nie może być usunięty.";
            }
        } else {
            echo "Katalog $fullPath nie istnieje.";
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $path = rtrim($_POST["path"], '/') . '/';
    $directory = $_POST["directory"];
    $operation = $_POST["operation"] ?? 'read';

    handleDirectory($path, $directory, $operation);
}
?>
