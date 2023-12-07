<html>
    <head>
        <title>food delivery</title>
        <link rel="stylesheet" href="nstyle.css">
    </head>
    <body>
      <div class="wel_image">
          <h1>WELCOME</h1>
      </div>
      <?php
        session_start();

        // Cart handling
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart_final'])) {
            $productName = $_POST['product_name'];
            $productPrice = $_POST['product_price'];
            $quantity = $_POST['quantity'];

          // Assuming you have a food_id associated with each item
$item = [
    'food_id' => $foodId,
    'name' => $productName,
    'price' => $productPrice,
    'quantity' => $quantity,
];


            $_SESSION['cart'][] = $item;
            echo "<div class='alert'>Added to cart: {$quantity} x {$productName}</div>";
        }

        // Redirect to a new page for further processing (e.g., pushing to the database)
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['proceed_to_checkout'])) {
            header("Location: cart.php");
            exit();
        }
      ?>

      <div class="menu">
          <h2>THE FOOD RESTO</h2>
          <ul>
              <div class="menu-category">
                <h2>DESSERT</h2>
                <?php
                include("db_connection.php");
                $result = $conn->query("SELECT * FROM food_menu WHERE food_category = 'dessert'");
                ?>

                <ul class="food-list">
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <li class="food-item">
                            <img src="<?= $row['image_link'] ?>" alt="<?= $row['food_name'] ?>" style="max-width: 100px; max-height: 100px;">
                            <p><strong><?= $row['food_name'] ?></strong> - $<?= $row['food_price'] ?></p>
                            <form action='' method='post'>
                                <label for='quantity'>Quantity:</label>
                                <select name='quantity'>
                                    <?php for ($i = 0; $i <= 4; $i++): ?>
                                        <option value='<?= $i ?>'><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                                <input type='hidden' name='product_name' value='<?= $row['food_name'] ?>'>
                                <input type='hidden' name='product_price' value='<?= $row['food_price'] ?>'>
                                <input type='submit' value='Add to Cart' name='add_to_cart_final' class='add-to-cart-button'>
                            </form>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
          </ul>
      </div>

      <!-- Checkout button -->
      <form action='' method='post'>
          <input type='submit' value='Proceed to Checkout' name='proceed_to_checkout' class='checkout-button'>
      </form>

  </body>
  
</html>
