<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz logowania</title>
</head>
<body>
<h1>Formularz logowania</h1>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "admin";
    $password = "admin123";

    if ($_POST["login"] == $username && $_POST["password"] == $password) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;

        echo "<p>Zalogowano poprawnie jako $username.</p>";
        echo '<a href="logout.php">Wyloguj</a>';
    } else {
        echo "<p>Błędny login lub hasło. Spróbuj ponownie.</p>";
        echo '<a href="autoClass.php">Powrót do formularza logowania</a>';
    }
}
?>

<?php if (!isset($_SESSION["loggedin"])) : ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required><br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Zaloguj">
    </form>
<?php endif; ?>

</body>
</html>

