<?php

$username = "root";
$password = "root";
$database = "customerinfo";
$server = "localhost";

$conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['company_id'];
$sql = 'SELECT *
FROM customer
LEFT JOIN customer_adress ON customer.id = customer_adress.customer_id
WHERE customer.company_id = "'.$id.'"';
$rows = $conn->query($sql);
$data = $rows->fetchAll();
echo json_encode($data);