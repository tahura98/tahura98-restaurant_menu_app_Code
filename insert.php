<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $origin = $_POST['origin'];

    $sql = "INSERT INTO food_menu (name, price, origin) VALUES ('$name', '$price', '$origin')";
    $conn->query($sql);

    $conn->close();
    header("Location: index.php");
}
?>
