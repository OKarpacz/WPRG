<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

// Połączenie z MySQL
$conn = new mysqli($servername, $username, $password);

// Sprawdź połączenie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Import pliku db.sql, jeśli baza danych nie istnieje
function importSQL($filename, $conn) {
    $sql = file_get_contents($filename);
    if ($conn->multi_query($sql)) {
        do {
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->next_result());
    }
}

// Sprawdź, czy baza danych istnieje
$db_selected = $conn->select_db($dbname);
if (!$db_selected) {
    // Importuj plik db.sql
    importSQL('includes/db.sql', $conn);
    // Wybierz bazę danych
    $conn->select_db($dbname);
} else {
    // Wybierz bazę danych
    $conn->select_db($dbname);
}
?>
