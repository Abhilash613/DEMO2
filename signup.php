<?php
// Database connection parameters
include("db_connection.php");

// Error reporting (comment out in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $u_name = $_POST["u_name"];
    $u_email = $_POST["email"];
    $u_password = $_POST["password"];
    $phone_no = $_POST["phone_number"];
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, phone_number) VALUES (?, ?, ?, ?)");
    
    if (!$stmt) {
        die('Error in preparing the statement: ' . $conn->error);
    }

    $stmt->bind_param("ssss", $u_name, $u_email, $u_password, $phone_no);

    if ($stmt->execute()) {
        $last_inserted_id = $stmt->insert_id;
        header("Location: menu.html");
        // You can redirect the user to another page or perform other actions after successful registration
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
