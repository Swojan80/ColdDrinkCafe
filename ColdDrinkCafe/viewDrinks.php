<?php
include 'includes/db.php'; // Include database connection

// Initialize categories and drinks arrays
$categories = [];
$drinks = [];

// Fetch all categories from the database
try {
    $categoriesStmt = $pdo->query('SELECT * FROM Categories');
    $categories = $categoriesStmt->fetchAll();
} catch (Exception $e) {
    error_log("Error fetching categories: " . $e->getMessage()); // Log error message
}

// Set the current category to the first available or from the user selection
$currentCategory = $categories[0]['categoryID'] ?? null;
if (isset($_GET['category']) && in_array($_GET['category'], array_column($categories, 'categoryID'))) {
    $currentCategory = $_GET['category'];
}

// Handle single drink deletion
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    try {
        $deleteSql = "DELETE FROM Products WHERE productID = ?";
        $deleteStmt = $pdo->prepare($deleteSql);
        $deleteStmt->execute([$deleteId]);
        header("Location: ?category=$currentCategory"); // Redirect to avoid form resubmission
        exit();
    } catch (Exception $e) {
        error_log("Error deleting drink: " . $e->getMessage()); // Log error message
    }
}

// Fetch drinks for the selected category
if ($currentCategory) {
    try {
        $sql = "SELECT * FROM Products WHERE categoryID = ? ORDER BY productName";
        $drinksStmt = $pdo->prepare($sql);
        $drinksStmt->execute([$currentCategory]);
        $drinks = $drinksStmt->fetchAll();
    } catch (Exception $e) {
        error_log("Error fetching drinks: " . $e->getMessage()); // Log error message
    }
}

// Implement sorting functionality if requested
if (isset($_GET['sort']) && in_array($_GET['sort'], ['asc', 'desc'])) {
    $sortOrder = $_GET['sort'] === 'asc' ? 'ASC' : 'DESC';
    $sql = "SELECT * FROM Products WHERE categoryID = ? ORDER BY listPrice $sortOrder";
    $drinksStmt = $pdo->prepare($sql);
    $drinksStmt->execute([$currentCategory]);
    $drinks = $drinksStmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Drinks</title>
    <link rel="stylesheet" href="style.css"> <!-- Include CSS for styling -->
</head>
<body>
<header>Cold Drink Cafe</header>
<div class="container">
    <h1>Drink List</h1>

    <!-- Categories Navigation -->
    <div class="categories">
        <?php foreach ($categories as $category): ?>
            <a href="?category=<?= $category['categoryID'] ?>" class="<?= $currentCategory == $category['categoryID'] ? 'active' : '' ?>">
                <?= htmlspecialchars($category['categoryName']) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Drinks Table -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($drinks as $drink): ?>
                <tr>
                    <td><?= htmlspecialchars($drink['productName']) ?></td>
                    <td><?= htmlspecialchars($drink['listPrice']) ?></td>
                    <td>
                        
                        <a href="modifyDrink.php?id=<?= $drink['productID'] ?>">Modify</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Sorting Buttons -->
    <div class="sorting">
    <a href="?category=<?= $currentCategory ?>&delete_id=<?= $drink['productID'] ?>"
    onclick="return confirm('Are you sure you want to delete this drink?')">Delete</a>
        <a href="?category=<?= $currentCategory ?>&sort=asc">Sort Drinks in Ascending Order</a>
        <a href="?category=<?= $currentCategory ?>&sort=desc">Sort Drinks in Descending Order</a>
    </div>

    <!-- Link to add a new drink -->
    <a href="index.php">Add Drink</a>
</div>
<footer>© 2024 Cold Drink Cafe, Inc. <br> Done by Swojan & Bijay</footer>
</body>
</html>
