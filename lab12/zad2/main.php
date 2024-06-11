<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0 20%;
            padding: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 15px;
        }

        form {
            background-color: #fff;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"],
        input[type="datetime-local"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-buttons input {
            padding: 5px 10px;
            cursor: pointer;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .action-buttons input:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<?php
include "table.php";

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = "Lab";

$db = new PDO("mysql:host=$dbhost", $dbuser, $dbpass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
$db->exec($sql);

try {
    $db = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    echo "Error connecting to database";
    exit();
}

$db = new PDO("mysql:dbname=Lab;host=localhost", "root", "" );
$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$tablePerson = "Person";
$tableCars = "Cars";

if (!tableExists($db,$tablePerson)) {
    try {
        $sql = "CREATE table $tablePerson(
     Person_id INT AUTO_INCREMENT PRIMARY KEY,
     Person_firstname VARCHAR(255),
     Person_secondname VARCHAR(255)) ; ";
        $db->exec($sql);
        print("Created $tablePerson Table.\n");

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    echo "table $tablePerson already exists";
}

if (!tableExists($db,$tableCars)) {
    try {
        $sql = "CREATE table $tableCars(
     Cars_id INT AUTO_INCREMENT PRIMARY KEY,
     Cars_model VARCHAR(255),
     Cars_price float,
     Cars_day_of_buy datetime,
     Person_id INT,
     FOREIGN KEY (Person_id) REFERENCES $tablePerson(Person_id)
     ); ";
        $db->exec($sql);
        print("Created $tableCars Table.\n");

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
} else {
    echo "<br>table $tableCars already exists";
}

if (isset($_POST['firstname']) && isset($_POST['secondname'])) {
    $firstname = $_POST['firstname'];
    $secondname = $_POST['secondname'];
    try {
        $stmt = $db->prepare("INSERT INTO $tablePerson (Person_firstname, Person_secondname) VALUES (:firstname, :secondname)");
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':secondname', $secondname);
        $stmt->execute();
        echo "<br>New person record created successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if (isset($_POST['model']) && isset($_POST['price']) && isset($_POST['day_of_buy']) && isset($_POST['person_id'])) {
    $model = $_POST['model'];
    $price = $_POST['price'];
    $day_of_buy = $_POST['day_of_buy'];
    $person_id = $_POST['person_id'];
    try {
        $stmt = $db->prepare("INSERT INTO $tableCars (Cars_model, Cars_price, Cars_day_of_buy, Person_id) VALUES (:model, :price, :day_of_buy, :person_id)");
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':day_of_buy', $day_of_buy);
        $stmt->bindParam(':person_id', $person_id);
        $stmt->execute();
        echo "New car record created successfully";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<form action="" method="post">
    <h2>Add Person:</h2>
    <label for="firstname">First Name:</label><br>
    <input required type="text" id="firstname" name="firstname"><br>
    <label for="secondname">Second Name:</label><br>
    <input required  type="text" id="secondname" name="secondname"><br><br>
    <input required type="submit" name="addPerson" value="Submit">
</form>

<form action="" method="post">
    <h2>Add Car:</h2>
    <label for="model">Car Model:</label><br>
    <input required type="text" id="model" name="model"><br>
    <label for="price">Car Price:</label><br>
    <input required type="text" id="price" name="price"><br>
    <label for="day_of_buy">Date of Purchase:</label><br>
    <input required type="datetime-local" id="day_of_buy" name="day_of_buy"><br>
    <label for="person_id">Person ID:</label><br>
    <select required id="person_id" name="person_id">
        <?php
        $stmt = $db->prepare("SELECT Person_id FROM $tablePerson");
        $stmt->execute();
        $persons = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($persons as $person) {
            echo "<option value=\"" . $person['Person_id'] . "\">" . $person['Person_id'] . "</option>";
        }
        ?>
    </select><br><br>
    <input type="submit" name="addCar" value="Submit">
</form>

<form action="" method="get">
    <h2>Sort Persons By:</h2>
    <select name="sort_by_person">
        <option value="Person_id">ID</option>
        <option value="Person_firstname">First Name</option>
        <option value="Person_secondname">Second Name</option>
    </select>
    <input type="submit" value="Sort">
</form>

<form action="" method="get">
    <h2>Search Persons By:</h2>
    <select name="search_field_person">
        <option value="Person_id">ID</option>
        <option value="Person_firstname">First Name</option>
        <option value="Person_secondname">Second Name</option>
    </select>
    <input type="text" name="search_query_person" required>
    <input type="submit" value="Search">
    <input type="button" value="Reset" onclick="window.location.href='index.php'">

</form>

<?php
if(isset($_GET['search_field_person']) && isset($_GET['search_query_person'])){
    $search_field = $_GET['search_field_person'];
    $search_query = $_GET['search_query_person'];
    try {
        $stmt = $db->prepare("SELECT * FROM $tablePerson WHERE $search_field LIKE :search_query");
        $stmt->bindValue(':search_query', '%' . $search_query . '%');
        $stmt->execute();
        $persons = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} elseif(isset($_GET['sort_by_person'])){
    $sort_by = $_GET['sort_by_person'];
    try {
        $stmt = $db->prepare("SELECT * FROM $tablePerson ORDER BY $sort_by");
        $stmt->execute();
        $persons = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    $stmt = $db->prepare("SELECT * FROM $tablePerson");
    $stmt->execute();
    $persons = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

echo "<h2>Persons:</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>First Name</th><th>Second Name</th></tr>";
foreach ($persons as $person) {
    echo "<tr>";
    echo "<td>".$person['Person_id']."</td>";
    echo "<td>".$person['Person_firstname']."</td>";
    echo "<td>".$person['Person_secondname']."</td>";
    echo "<td><form method='post'><input type='hidden' name='editPersonId' value='".$person['Person_id']."'><input type='submit' name='editPerson' value='Edit'></form></td>";
    echo "<td><form method='post'><input type='hidden' name='deletePersonId' value='".$person['Person_id']."'><input type='submit' name='deletePersonButton' value='Delete'></form></td>";
    echo "</tr>";
}
echo "</table>";
?>

<?php
if(isset($_POST['deletePersonId'])) {
    $deletePersonId = $_POST['deletePersonId'];
    try {
        $stmt = $db->prepare("DELETE FROM $tablePerson WHERE Person_id = :deletePersonId");
        $stmt->bindParam(':deletePersonId', $deletePersonId);
        $stmt->execute();
        echo "Person record deleted successfully, refresh to see changes";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if(isset($_POST['editPersonId'])) {
    $editPersonId = $_POST['editPersonId'];
    $stmt = $db->prepare("SELECT * FROM $tablePerson WHERE Person_id = :editPersonId");
    $stmt->bindParam(':editPersonId', $editPersonId);
    $stmt->execute();
    $personData = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['updatePerson'])) {
        $editPersonId = $_POST['editPersonId'];
        $editFirstname = $_POST['editFirstname'];
        $editSecondname = $_POST['editSecondname'];
        try {
            $stmt = $db->prepare("UPDATE $tablePerson SET Person_firstname = :firstname, Person_secondname = :secondname WHERE Person_id = :editPersonId
");
            $stmt->bindParam(':firstname', $editFirstname);
            $stmt->bindParam(':secondname', $editSecondname);
            $stmt->bindParam(':editPersonId', $editPersonId);
            $stmt->execute();
            echo "Person record updated successfully";
            echo("<meta http-equiv='refresh' content='1'>");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>

    <h2>Edit Person:</h2>
    <form action="" method="post">
        <input type="hidden" name="editPersonId" value="<?php echo $personData['Person_id']; ?>">
        <label for="editFirstname">First Name:</label><br>
        <input required type="text" id="editFirstname" name="editFirstname" value="<?php echo $personData['Person_firstname']; ?>"><br>
        <label for="editSecondname">Second Name:</label><br>
        <input required type="text" id="editSecondname" name="editSecondname" value="<?php echo $personData['Person_secondname']; ?>"><br><br>
        <input type="submit" name="updatePerson" value="Update">
    </form>
<?php }?>
<form action="" method="get">
    <h2>Sort Cars By:</h2>
    <select name="sort_by_car">
        <option value="Cars_id">ID</option>
        <option value="Cars_model">Model</option>
        <option value="Cars_price">Price</option>
        <option value="Cars_day_of_buy">Day of Buy</option>
        <option value="Person_id">Person ID</option>
    </select>
    <input type="submit" value="Sort">
</form>

<form action="" method="get">
    <h2>Search Cars By:</h2>
    <select name="search_field_car">
        <option value="Cars_id">ID</option>
        <option value="Cars_model">Model</option>
        <option value="Cars_price">Price</option>
        <option value="Cars_day_of_buy">Day of Buy</option>
        <option value="Person_id">Person ID</option>
    </select>
    <input type="text" name="search_query_car" required>
    <input type="submit" value="Search">
    <input type="button" value="Reset" onclick="window.location.href='index.php'">

</form>

<?php
if(isset($_GET['search_field_car']) && isset($_GET['search_query_car'])){
    $search_field = $_GET['search_field_car'];
    $search_query = $_GET['search_query_car'];
    try {
        $stmt = $db->prepare("SELECT * FROM $tableCars WHERE $search_field LIKE :search_query");
        $stmt->bindValue(':search_query', '%' . $search_query . '%');
        $stmt->execute();
        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} elseif(isset($_GET['sort_by_car'])){
    $sort_by = $_GET['sort_by_car'];
    try {
        $stmt = $db->prepare("SELECT * FROM $tableCars ORDER BY $sort_by");
        $stmt->execute();
        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    $stmt = $db->prepare("SELECT * FROM $tableCars");
    $stmt->execute();
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

echo "<h2>Cars:</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Model</th><th>Price</th><th>Day of Buy</th><th>Person ID</th><th>Action</th></tr>";
foreach ($cars as $car) {
    echo "<tr>";
    echo "<td>".$car['Cars_id']."</td>";
    echo "<td>".$car['Cars_model']."</td>";
    echo "<td>".$car['Cars_price']."</td>";
    echo "<td>".$car['Cars_day_of_buy']."</td>";
    echo "<td>".$car['Person_id']."</td>";
    echo "<td><form method='post'><input type='hidden' name='editCarId' value='".$car['Cars_id']."'><input type='submit' name='editCar' value='Edit'></form></td>";
    echo "<td><form method='post'><input type='hidden' name='deleteCarId' value='".$car['Cars_id']."'><input type='submit' name='deleteCarButton' value='Delete'></form></td>";
    echo "</tr>";
}
echo "</table>";
?>

<?php
if(isset($_POST['deleteCarId'])) {
    $deleteCarId = $_POST['deleteCarId'];
    try {
        $stmt = $db->prepare("DELETE FROM $tableCars WHERE Cars_id = :deleteCarId");
        $stmt->bindParam(':deleteCarId', $deleteCarId);
        $stmt->execute();
        echo "Car record deleted successfully, refresh to see changes";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
if(isset($_POST['editCarId'])) {
    $editCarId = $_POST['editCarId'];
    $stmt = $db->prepare("SELECT * FROM $tableCars WHERE Cars_id = :editCarId");
    $stmt->bindParam(':editCarId', $editCarId);
    $stmt->execute();
    $carData = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['updateCar'])) {
        $editCarId = $_POST['editCarId'];
        $editModel = $_POST['editModel'];
        $editPrice = $_POST['editPrice'];
        $editDayOfBuy = $_POST['editDayOfBuy'];
        $editPersonId = $_POST['editPersonId'];
        try {
            $stmt = $db->prepare("UPDATE $tableCars SET Cars_model = :model, Cars_price = :price, Cars_day_of_buy = :day_of_buy, Person_id = :person_id WHERE Cars_id = :editCarId");
            $stmt->bindParam(':model', $editModel);
            $stmt->bindParam(':price', $editPrice);
            $stmt->bindParam(':day_of_buy', $editDayOfBuy);
            $stmt->bindParam(':person_id', $editPersonId);
            $stmt->bindParam(':editCarId', $editCarId);
            $stmt->execute();
            echo "Car record updated successfully";
            echo("<meta http-equiv='refresh' content='1'>");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>

    <h2>Edit Car:</h2>
    <form action="" method="post">
        <input type="hidden" name="editCarId" value="<?php echo $carData['Cars_id']; ?>">
        <label for="editModel">Car Model:</label><br>
        <input required type="text" id="editModel" name="editModel" value="<?php echo $carData['Cars_model']; ?>"><br>
        <label for="editPrice">Car Price:</label><br>
        <input required type="text" id="editPrice" name="editPrice" value="<?php echo $carData['Cars_price']; ?>"><br>
        <label for="editDayOfBuy">Date of Purchase:</label><br>
        <input required type="datetime-local" id="editDayOfBuy" name="editDayOfBuy" value="<?php echo date('Y-m-d\TH:i', strtotime($carData['Cars_day_of_buy'])); ?>"><br>
        <label for="editPersonId">Person ID:</label><br>
        <select required id="editPersonId" name="editPersonId">
            <?php
            $stmt = $db->prepare("SELECT Person_id FROM $tablePerson");
            $stmt->execute();
            $persons = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($persons as $person) {
                $selected = ($person['Person_id'] == $carData['Person_id']) ? 'selected' : '';
                echo "<option value=\"" . $person['Person_id'] . "\" $selected>" . $person['Person_id'] . "</option>";
            }
            ?>
        </select><br><br>
        <input type="submit" name="updateCar" value="Update">
    </form>
<?php }?>
</body>
</html>