<!-- food_list.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food List</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>

<?php
include("db_connection.php");

// Retrieve data from the food_menu table
$sql = "SELECT * FROM food_menu";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $food_name = $row['food_name'];
        $food_price = $row['food_price'];
        $food_category = $row['food_category'];
        $image_link = $row['image_link'];

        // Display food information
        echo "<div>";
        echo "<h2>$food_name</h2>";
        echo "<p>Price: $food_price</p>";
        echo "<p>Category: $food_category</p>";
        echo "<img src='$image_link' alt='$food_name'>";
        echo "</div>";
    }
} else {
    echo "<p>No food items available.</p>";
}

$conn->close();
?>
<a href="admin.html">Back to Admin Page</a>

</body>
</html>
