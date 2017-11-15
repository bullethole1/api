<?php
$username = "root";
$password = "root";
$db = "customerinfo";
$server = "localhost";

$conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'];
$sql = 'SELECT * 
FROM customer
LEFT JOIN customer_adress ON customer.id = customer_adress.customer_id
WHERE customer.id = "'.$id.'"';
$rows = $conn->prepare($sql);
$rows->execute([]);
$data = $rows->fetch();

if (is_array($data)) {
    echo json_encode($data);
} else {
    header("HTTP/1.0 404 Not Found");
    echo json_encode(["message" => "Customer not found"]);

}