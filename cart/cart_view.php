<?php include '../view/header.php'; ?>
<main>
    <h1>Your Cart</h1>
    <?php if ($_SESSION['cart']->productCount() == 0) : ?>
        <p>There are no products in your cart.</p>
    <?php else: ?>
        <p>To remove an item from your cart, change its quantity to 0.</p>
        <form action="." method="post">
            <input type="hidden" name="action" value="update">
            <table id="cart">
            <tr id="cart_header">
                <th class="left">Item</th>
                <th class="right">Price</th>
                <th class="right">Quantity</th>
                <th class="right">Total</th>
            </tr>
<!--             foreach ($cart as $product_id => $item) :   -->
                <?php 
                print_r($cart); 
                foreach ($_SESSION['cart']->getItems() as $item) : ?>
            <tr>
                <td><?php echo htmlspecialchars($item->getName()); ?></td>
                <td class="right">
                    <?php echo sprintf('$%.2f', $item->getUnit_price()); ?>
                </td>
                <td class="right">
                    <input type="text" size="3" class="right"
                           name="items[<?php echo $product_id; ?>]"
                           value="<?php echo $item->getQuantity(); ?>">
                </td>
                <td class="right">
                    <?php echo sprintf('$%.2f', $item->getLine_price()); ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr id="cart_footer" >
                <td colspan="3" class="right" ><b>Subtotal</b></td>
                <td class="right">
                    <?php 
                    echo sprintf('$%.2f', $_SESSION['cart']->getSubtotal()); ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="right">
                    <input type="submit" value="Update Cart">
                </td>
            </tr>
            </table>
        </form>
        
    <?php endif; ?>

    <p>Return to: <a href="../">Home</a></p>

    <!-- display most recent category -->
    <?php if (isset($_SESSION['last_category_id'])) :
            $category_url = '../product_catalog' .
                '?category_id=' . $_SESSION['last_category_id'];
        ?>
        <p>Return to: <a href="<?php echo $category_url; ?>">
            <?php echo $_SESSION['last_category_name']; ?></a></p>
    <?php endif; ?>

    <!-- if cart has items, display the Checkout link -->
    <?php if ($_SESSION['cart']->productCount() > 0) : ?>
        <p>
            Proceed to: <a href="../checkout">object not found error</a>
        </p>
    <?php endif; ?>
</main>
<?php include '../view/footer.php'; ?>