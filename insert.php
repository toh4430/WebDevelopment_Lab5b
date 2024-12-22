<?php
include 'Database.php';
include 'User.php';

// Create an instance of the Database class and get the connection
$database = new Database();
$db = $database->getConnection();

// Create an instance of the User class
$user = new User($db);

// Register the user using POST data
$result = $user->createUser($_POST['matric'], $_POST['name'], $_POST['password'], $_POST['role']);

if ($result === true) {
    echo "User registered successfully.";
} else {
    echo $result; // Display error message
}

// Close the connection
$db->close();
