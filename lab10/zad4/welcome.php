<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login_form.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Witaj!</title>
</head>
<body>
<h1>Witaj,!</h1>
<p>To jest strona powitalna. Jesteś zalogowany.</p>
<p><a href="logout.php">Wyloguj</a></p
