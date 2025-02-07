# ColdDrinkCafe
ColdDrinkCafe is a PHP-based web application for managing a café's drink inventory with features for adding, updating, deleting, and sorting drink items.

Features
Add Drinks: Easily add new drink items to the inventory.
Delete Drinks: Remove drinks from the inventory.
Update Drinks: Modify details of existing drinks.
Sort and Filter: View drinks in ascending or descending order by price and filter by categories.
Prerequisites
Before you begin installation, ensure you have the following installed:

XAMPP: For serving the web application locally using Apache and MySQL.
PHP: As a part of the XAMPP installation.
MySQL: Also included in XAMPP for database management.
Installation
Follow these steps to set up the ColdDrinkCafe on your local machine:

Clone the Repository

bash
Copy
git clone https://github.com/your-username/ColdDrinkCafe.git
Replace your-username with your actual GitHub username.

Start XAMPP

Launch XAMPP Control Panel and start the Apache and MySQL modules.
Create the Database

Open a browser and go to http://localhost/phpmyadmin.
Create a new database named ColdDrinkCafe.
Import the cold_drink_cafe.sql file located in the repository to set up the database schema and initial data.
Configure the Application

Ensure the PHP files in the repository are configured to connect to your local MySQL instance. Usually, this is managed in a db.php file:
php
Copy
$pdo = new PDO('mysql:host=localhost;dbname=ColdDrinkCafe', 'root', '');
Make sure the username and password match your MySQL credentials.
Access the Application

Move the ColdDrinkCafe folder to the htdocs directory in your XAMPP installation path.
Open a web browser and navigate to http://localhost/ColdDrinkCafe/index.php.
Usage
Once installed, navigate through the application using the links provided on the home page to add, delete, and update drinks. Sorting and filtering options are available on the drink list page.

Contributing
Contributions to the ColdDrinkCafe are welcome. Please ensure to update tests as appropriate when making changes to the application.

License
This project is open-sourced under the MIT license.
