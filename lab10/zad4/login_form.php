<?php
session_start();

function isUserLoggedIn() {
    return isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;
}

function isPasswordCorrect($email, $password){
    if (file_exists('users.txt')) {
        $users = file('users.txt', FILE_IGNORE_NEW_LINES);
        foreach ($users as $user) {
            $userData = explode(' ', $user);
            if (count($userData) >= 4 && $email === $userData[2] && password_verify($password, $userData[3])) {
                return true;
            }
        }
    }else{
        return "Nie powstał plik user.txt";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isPasswordCorrect($email, $password)) {
        $_SESSION["loggedin"] = true;
        $_SESSION["email"] = $email;
        header("Location: welcome.php");
        exit;
    } else {
        echo "<p>Błędny email lub hasło. Spróbuj ponownie.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz logowania</title>
</head>
<body>
<h1>Formularz logowania</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="password">Hasło:</label>
    <input type="password" id="password" name="password" required><br>
    <input type="submit" value="Zaloguj">
</form>

</body>
</html>
