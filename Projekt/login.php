<?php
session_start();
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Wykonaj zapytanie do bazy danych, aby znaleźć użytkownika
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Weryfikacja hasła (zakładamy, że hasła są przechowywane jako hashe)
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];
            header("Location: home.php");
        } else {
            echo "Nieprawidłowe dane logowania.";
        }
    } else {
        echo "Nieprawidłowe dane logowania.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logowanie</title>
</head>
<body>
<h2>Zaloguj się</h2>
<form method="post" action="login.php">
    <label for="username">Nazwa użytkownika:</label>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Hasło:</label>
    <input type="password" id="password" name="password" required><br>
    <button type="submit">Zaloguj się</button>
</form>
<p>Nie masz konta? <a href="register.php">Zarejestruj się</a></p>
</body>
</html>
