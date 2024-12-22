<?php
include 'Database.php';
include 'User.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['matric'])) {
    // Retrieve the matric value from the GET request
    $matric = $_GET['matric'];

    // Create an instance of the Database class and get the connection
    $database = new Database();
    $db = $database->getConnection();

    // Fetch user details
    $user = new User($db);
    $userDetails = $user->getUser($matric);

    $db->close();

    // Check if user exists
    if ($userDetails) {
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update User</title>
        </head>

        <body>
            <h1>Update User</h1>
            <form action="update.php" method="post">
                <!-- Current Matric Number -->
                <input type="hidden" name="old_matric" value="<?php echo htmlspecialchars($userDetails['matric']); ?>">

                <!-- Editable Matric Number -->
                <label for="matric">Matric:</label>
                <input type="text" id="matric" name="matric" value="<?php echo htmlspecialchars($userDetails['matric']); ?>" required><br>

                <!-- Editable Name -->
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userDetails['name']); ?>" required><br>

                <!-- Editable Role -->
                <label for="role">Access level:</label>
                <select name="role" id="role" required>
                    <option value="">Please select</option>
                    <option value="lecturer" <?php if ($userDetails['role'] == 'lecturer') echo "selected"; ?>>Lecturer</option>
                    <option value="student" <?php if ($userDetails['role'] == 'student') echo "selected"; ?>>Student</option>
                </select><br>

                <!-- Submit and Cancel Buttons -->
                <input type="submit" value="Update">
                <a href="read.php">Cancel</a>
            </form>
        </body>

        </html>
        <?php
    } else {
        echo "User not found.";
    }
} else {
    echo "Invalid request.";
}
?>
