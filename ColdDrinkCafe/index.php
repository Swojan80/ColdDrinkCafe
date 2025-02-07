<?php
// Include the database connection script
include 'includes/db.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Drink</title>
    <!-- Link to the external CSS for styling -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>Cold Drink Cafe</header>
<div class="container">
    <h1>Add Drink</h1>
    <!-- Form for adding a new drink -->
    <form action="addDrink.php" method="post">
        <!-- Dropdown for selecting the drink category -->
        <label for="category">Category:</label>
        <select id="category" name="category">
            <?php
            // Fetch all categories from the database and display them as options
            $stmt = $pdo->query('SELECT * FROM Categories');
            while ($row = $stmt->fetch()) {
                echo "<option value='{$row['categoryID']}'>{$row['categoryName']}</option>";
            }
            ?>
        </select>
        <!-- Input field for the drink code -->
        <label for="code">Code:</label>
        <input type="text" id="code" name="code">
        <!-- Input field for the drink name -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <!-- Input field for the drink price -->
        <label for="price">List Price:</label>
        <input type="number" id="price" name="price" step="0.01">
        <!-- Submit button for the form -->
        <input type="submit" value="Add Drink">
    </form>
    <!-- Link to view the list of drinks -->
    <a href="viewDrinks.php">View Drink List</a>
</div>
<!-- Footer section with copyright and custom text -->
<footer>© 2024 Cold Drink Cafe, Inc. <br> Done by Swojan & Bijay</footer>
</body>
</html>
