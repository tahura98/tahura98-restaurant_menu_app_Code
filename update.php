<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $origin = $_POST['origin'];

    $sql = "UPDATE food_menu SET name='$name', price='$price', origin='$origin' WHERE id=$id";
    $conn->query($sql);

    $conn->close();
    header("Location: index.php");
}
?>