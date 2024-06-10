<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz rejestracyjny</title>
</head>
<body>
<h1>Formularz rejestracyjny</h1>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*\W).{6,}$/', $password)) {
        $data = "$name $surname $email $password\n";
        file_put_contents('users.txt', $data, FILE_APPEND | LOCK_EX);
        header("Location: login_form.php");
        exit;
    } else {
        echo "<p>Błąd: Hasło nie spełnia wymagań.</p>";
    }
}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="name">Imię:</label>
    <input type="text" id="name" name="name" required><br>
    <label for="surname">Nazwisko:</label>
    <input type="text" id="surname" name="surname" required><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="password">Hasło (minimum 6 znaków, 1 wielka litera, 1 cyfra, 1 znak specjalny):</label>
    <input type="password" id="password" name="password" required><br>
    <input type="submit" value="Zarejestruj">
</form>

</body>
</html>
