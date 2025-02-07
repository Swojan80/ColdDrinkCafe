<?php
// Include the database connection setup
include 'includes/db.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the posted form data
    $productID = $_POST['id'];
    $productName = $_POST['name'];
    $listPrice = $_POST['price'];

    // Prepare an SQL statement to update drink details
    $sql = "UPDATE Products SET productName = ?, listPrice = ? WHERE productID = ?";
    $stmt = $pdo->prepare($sql);
    // Execute the statement with provided data
    $stmt->execute([$productName, $listPrice, $productID]);

    // Redirect to the drink list page after updating
    header("Location: viewDrinks.php");
    exit();
} elseif (isset($_GET['id'])) { // Check if a drink ID was passed in the URL
    // Fetch the drink data to be modified
    $productID = $_GET['id'];
    $sql = "SELECT * FROM Products WHERE productID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$productID]);
    $product = $stmt->fetch();

    // If no drink is found with the ID, redirect to the drink list
    if (!$product) {
        header("Location: viewDrinks.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modify Drink</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to the external CSS -->
</head>
<body>
<header>Cold Drink Cafe</header>
<div class="container">
    <h1>Modify Drink</h1>
    <!-- Form for submitting drink modifications -->
    <form action="modifyDrink.php" method="post">
        <!-- Hidden input to hold the drink ID -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($product['productID']) ?>">
        <label for="name">Name:</label>
        <!-- Input for editing the drink name -->
        <input type="text" name="name" value="<?= htmlspecialchars($product['productName']) ?>"><br>
        <label for="price">Price:</label>
        <!-- Input for editing the drink price -->
        <input type="number" name="price" value="<?= htmlspecialchars($product['listPrice']) ?>" step="0.01"><br>
        <input type="submit" value="Update Drink">
    </form>
    <!-- Link to view the list of all drinks -->
    <a href="viewDrinks.php">View Drink List</a>
</div>
<footer>© 2024 Cold Drink Cafe, Inc. <br> Done by Swojan & Bijay</footer>
</body>
</html>
<?php
} else {
    // Redirect to the drink list if no drink ID is specified
    header("Location: viewDrinks.php");
    exit();
}
?>
