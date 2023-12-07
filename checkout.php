<?php
session_start();
include("db_connection.php"); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_order'])) {
    // Get user input from the address form
    $address = $_POST['address'];
    // Add more fields as needed

    // Get cart details
$cartItems = $_SESSION['cart'];

// Insert order details into the database
$stmt = $conn->prepare("INSERT INTO orders (user_address, food_id, price) VALUES (?, ?, ?)");

foreach ($cartItems as $item) {
    $foodId = $item['food_id'];
    $price = $item['price'];
    $stmt->bind_param("ssi", $address, $foodId, $price);
    
    // Check if the statement is executed successfully before continuing
    if (!$stmt->execute()) {
        echo "Error: " . $stmt->error;
    }
}

// Close the statement
$stmt->close();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="dynamic.css">
    <link rel="stylesheet" type="text/css" href="menu.css">
    <title>Checkout</title>
    <!-- Add your styles as needed -->
    <style>
        .address-form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<header>
    <!-- Add your header content here -->
</header>
<section>
    <!-- Add your section content here -->
</section>
<h1>Checkout</h1>

<div class="address-form">
    <h2>Enter Your Address</h2>
    <form action='checkout.php' method='post'>
        <label for='address'>Address:</label>
        <input type='text' name='address' required>
        <!-- Add more fields as needed -->

        <!-- Submit button -->
        <input type='submit' value='Confirm Order' name='confirm_order'>
    </form>
</div>
</body>
</html>
