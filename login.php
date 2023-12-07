<?php
// Database connection parameters
include("db_connection.php");

// Error reporting (comment out in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST["u_name"];
    $password = $_POST["password"];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username,password FROM users WHERE username = ?");

    // Check if the prepare statement was successful
    if (!$stmt) {
        die('Error in preparing the statement: ' . $conn->error);
    }

    // Bind parameters
    $bindResult = $stmt->bind_param("s", $username);

    // Check if bind_param was successful
    if (!$bindResult) {
        die('Error binding parameters: ' . $stmt->error);
    }

    // Execute the statement
    if ($stmt->execute()) {
        $last_inserted_id = $stmt->insert_id;
        header("Location: menu.html");
    } else {
        die('Error in executing the statement: ' . $stmt->error);
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
