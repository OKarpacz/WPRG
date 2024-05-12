<!DOCTYPE html>
<html>
<head>
    <title>Operacje na ciągach znaków</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<h2>Operacje na ciągach znaków</h2>

<form method="post" action="process.php">
    <label for="text">Wprowadź ciąg znaków:</label><br>
    <input type="text" id="text" name="text"><br><br>

    <label for="operation">Wybierz operację:</label><br>
    <select name="operation" id="operation">
        <option value="reverse">Odwrócenie ciągu znaków</option>
        <option value="uppercase">Zamiana na duże litery</option>
        <option value="lowercase">Zamiana na małe litery</option>
        <option value="char_count">Liczenie liczby znaków</option>
        <option value="trim">Usuwanie białych znaków</option>
    </select><br><br>

    <input type="submit" value="Wykonaj">
</form>

</body>
</html>
