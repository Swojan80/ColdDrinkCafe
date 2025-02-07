<?php
include 'includes/db.php'; // Include the database connection

if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    // SQL query to delete the drink from the Products table
    $sql = "DELETE FROM Products WHERE productID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$productID]);

    // Redirect to the drink list page
    header("Location: viewDrinks.php");
    exit();
} else {
    // Redirect to the drink list if no ID is specified
    header("Location: viewDrinks.php");
    exit();
}
?>
