<?php

require_once "vendor/autoload.php";

use App\Storage;
use App\Person;

$data = new Storage("app/data.csv");


if (isset($_POST['name'])) {
    $person = new Person($_POST["name"], $_POST["surname"], $_POST["personalNumber"], $_POST["addInfo"]);
    $data->writer()->insertOne($person->toArray());
    header("location: http://localhost:8000");

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personal Data List</title>
</head>
<body>

<form method="post">
    <label for="name">Name:
        <input name="name" type="text" required></label><br><br>
    <label for="surname">Surname:
        <input name="surname" type="text" required></label><br><br>
    <label for="personalNumber">Personal code:
        <input name="personalNumber" type="text" required></label><br><br>
    <label for="addInfo">Additional information:
        <textarea name="addInfo"></textarea></label><br><br>
    <button type="submit">Add</button>
    <br><br>
</form>

<form method="get">
    <label for="search">Search person by code:
        <input name="search" type="text" required>
    </label>
    <button type="submit">Search</button>
    <br>

</form>
<?php
if (isset($_GET["search"])) {
    $person = $data->search($_GET["search"]);
    echo "<form method='post'> <button name='delete' type='submit'>Delete?</button> </form><br>";
   if (isset($_POST['delete'])) {
   $data->delete($person);
    }

}

?>


</body>
</html>
