<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 500px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            color: #007bff;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px 24px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            margin-top: 20px;
            font-weight: bold;
            color: #333;
        }
    </style
</head>
<body>

<form method="post">
    <div>
        <label>Ścieżka: </label>
        <input type="text" name="path">
        <br>
        <label>Nazwa katalogu: </label>
        <input type="text" name="catalogName">
        <br>
        <label>Rodzaj operacji: </label>
        <select name="operationType">
            <option value="read">Odczyt plików</option>
            <option value="delete">Usuń katalog</option>
            <option value="create">Stwórz katalog</option>
        </select>
        <br>
        <input type="submit" value="Wykonaj operację">
    </div>
</form>

<?php
include "main.php";
fileManager($_POST['path'], $_POST['catalogName'], $_POST['operationType']);
?>
</body>
</html>
