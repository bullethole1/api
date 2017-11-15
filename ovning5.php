<?php
$username = "root";
$password = "root";
$db = "customerinfo";
$server = "localhost";

$conn = new PDO("mysql:host=$server;dbname=$db", $username, $password);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$customer_sql = 'SELECT * FROM customer';
$rows = $conn->query($customer_sql);
$customer_data = $rows->fetchAll();

$companies = [];

foreach ($customer_data as $customer) {
    $companies[] = $customer['customer_company'];
}

/*foreach (array_unique($companies) as $company) {
    $companies_stm = $conn->prepare("INSERT INTO companies (company_name) VALUES (:company_name)");
    $companies_stm->execute([
        ':company_name' => $company
    ]);*/


$customers = 'SELECT * FROM companies';
$rows = $conn->query($customers);
$customer_data = $rows->fetchAll();
echo json_encode($customer_data);

foreach ($customer_data as $customer){
    $customer_stm = $conn->prepare('UPDATE customer SET company_id = :company_id WHERE customer_company = :customer_company');

    $customer_stm->execute([
        ':company_id' => $customer['id'],
        ':customer_company' => $customer['company_name']
        ]);
}
