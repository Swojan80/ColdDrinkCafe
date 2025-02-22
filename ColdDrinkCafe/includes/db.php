<?php
$host = 'localhost'; // Server where your MySQL is hosted
$dbname = 'ColdDrinkCafe'; // Database name
$username = 'root'; // Your MySQL username, default is 'root' in XAMPP
$password = ''; // Your MySQL password, default is empty in XAMPP

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4"; // Data Source Name
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>
