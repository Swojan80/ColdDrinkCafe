<?php
include 'includes/db.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $categoryID = $_POST['category'];
    $productCode = $_POST['code'];
    $productName = $_POST['name'];
    $listPrice = $_POST['price'];

    // SQL query to insert data into Products table
    $sql = "INSERT INTO Products (categoryID, productCode, productName, listPrice) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$categoryID, $productCode, $productName, $listPrice]);

    // Redirect to the main page or wherever you wish
    header("Location: index.php");
    exit();
}
?>
