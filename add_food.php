<!-- add_food.php -->
<?php
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_food'])) {
    $food_name = $_POST['food_name'];
    $food_price = $_POST['food_price'];
    $food_category = $_POST['food_category'];
    $image_link = $_POST['image_link'];

    // Perform validation and sanitization as needed

    // Insert data into the food_menu table
    $sql = "INSERT INTO food_menu (food_name, food_price, food_category, image_link) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $food_name, $food_price, $food_category, $image_link);
    $stmt->execute();

    // Close the statement
    $stmt->close();
}

$conn->close();
header("Location: admin.html");
exit();
?>
