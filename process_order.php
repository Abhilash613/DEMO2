<!-- process_order.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="nstyle.css">
</head>
<body>
<div class="cart">
<?php
session_start();

// Display selected items and calculate the grand total
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $grandTotal = 0;

    echo "<h2>Selected Items:</h2>";

    foreach ($_SESSION['cart'] as $item) {
        $itemName = $item['name'];
        $itemPrice = $item['price'];
        $itemQuantity = $item['quantity'];
        $itemTotal = $itemPrice * $itemQuantity;

        echo "<p>{$itemQuantity} x {$itemName} - ${$itemTotal}</p>";

        $grandTotal += $itemTotal;
    }

    echo "<h3>Grand Total: ${$grandTotal}</h3>";

    // Further processing (e.g., storing in the database) can be done here
} else {
    echo "<p>No items in the cart.</p>";
}
?>
</div>

<!-- Proceed button -->
<form action='' method='post'>
    <input type='submit' value='Proceed to Process' name='proceed_to_process' class='proceed-button'>
</form>

<?php
// Handle the proceed button click
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['proceed_to_process'])) {
    // Add your processing logic here

    // For example, you can clear the cart after processing
    unset($_SESSION['cart']);

    echo "<p>Order processed successfully!</p>";
}
?>

</body>
</html>
