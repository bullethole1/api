<?php
$username = "root";
$password = "root";
$db = "customerinfo";
$server = "localhost";

$conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['customer_id'];
$address = $_GET['address'];
$address_sql = 'SELECT street, postcode, city
FROM customer_adress
WHERE customer_id ="'.$id.'"';

$rows = $conn->prepare($address_sql);
$rows->execute([]);
$data = $rows->fetch();

if(isset($address) && $address == 'true' && is_array($data)){
    echo json_encode($data);
} else {
    header("HTTP/1.0 404 Not Found");
    echo json_encode(["message" => "Address not found"]);
}