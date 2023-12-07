<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="dynamic.css">
    <link rel="stylesheet" type="text/css" href="menu.css">
    <title>Cart</title>
    <style>
        /* Add your styles as needed */
        .cart-item {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .cart-quantity {
            width: 50px;
        }

        .remove-all-button,
        .remove-item-button {
            background-color: #dc3545;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<header>
    <!----navigation section---->
    <div class="nav">
        <nav>
            <div class="navlink">
                <i class="fa fa-bars"></i>
                <ul>
                    <li>
                        <a href="home2.html" >Home</a>
                    </li>
                    <li>
                        <a href="Menu.html">menu</a>
                    </li>
                    <a href="Gallery.html">Gallery</a>
                    </li>
                    <li>
                        <a href="Contact.html">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<section>
    <div class="titleimg">
        <div class="title">CAFE MENU<br>
            <h6>make your choose</h6>
        </div>
    </div>
</section>

<h1>Shopping Cart</h1>

<?php
if (!empty($_SESSION['cart'])) {
    $totalAmount = 0; // Initialize total amount

    echo "<div class='cart-options'>";
    // Remove all items from the cart
    echo "<form action='cart.php' method='post'>";
    echo "<input type='submit' name='remove_all' value='Remove All' class='remove-all-button'>";
    echo "</form>";

    echo "<form action='checkout.php' method='post'>";
    // Proceed to Checkout
    echo "<input type='submit' name='proceed_to_checkout' value='Proceed to Checkout'>";
    echo "</form>";
    echo "</div>";

    foreach ($_SESSION['cart'] as $key => $item) {
        echo "<div class='cart-item'>";
        echo "<p><strong>Name:</strong> " . $item['name'] . "</p>";
        echo "<p><strong>Price:</strong> $" . $item['price'] . "</p>";
        

        // Quantity form for updating
        echo "<form action='cart.php' method='post'>";
        echo "<label for='update_quantity'>Quantity:</label>";
        echo "<input type='number' name='update_quantity' class='cart-quantity' min='1' value='{$item['quantity']}'>";
        echo "<input type='hidden' name='update_quantity_id' value='{$key}'>";
        echo "<input type='submit' value='Update'>";
        echo "</form>";

        // Calculate and display subtotal for each item
        $subtotal = (float)$item['price'] * (int)$item['quantity'];
        echo "<p><strong>Subtotal:</strong> $" . $subtotal . "</p>";

        // Add a remove link for each item
        echo "<p><a href='cart.php?remove={$key}' class='remove-item-button' onclick='return confirm(\"Remove {$item['name']} from cart?\")'>Remove</a></p>";
        echo "</div>";

        // Add subtotal to the total amount
        $totalAmount += $subtotal;
    }

    echo "<p><strong>Total Amount:</strong> $" . $totalAmount . "</p>";

    // Check if the "Remove All" button is clicked
    if (isset($_POST['remove_all'])) {
        unset($_SESSION['cart']); // Clear the cart
        header('location: cart.php'); // Redirect to refresh the page
    }

    // Check if the quantity update form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_quantity'])) {
        $updatedQuantity = $_POST['update_quantity'];
        $updateKey = $_POST['update_quantity_id'];

        // Update the quantity in the cart
        if (isset($_SESSION['cart'][$updateKey])) {
            $_SESSION['cart'][$updateKey]['quantity'] = $updatedQuantity;
        }

        // Redirect to refresh the page
        header('location: cart.php');
    }
} else {
    echo "<p>Your cart is empty.</p>";
}
?>
</body>
</html>
