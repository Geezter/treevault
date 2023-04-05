<?php
require'navbar.php';
require'lib/class.product.php';
require'lib/class.cart.php';
require'db/database.php';

session_start();
$sessionId = session_id();
$cart = new cart($sessionId, $conn);
$allCartItems = $cart->getCartItems();
$i = 0;
?>

<br>
<br>

<h1 class="lead text-center" style="font-size: 36px">
        Browse products
</h1>

<br>

<!-- List cart items -->

<div class="container text-center justify-content-center col-12 col-sm-7">   

    <table id="cartTable" class="table table-light d-flex justify-content-center">
    <th id="th">Product</th>
    <th id="th">Amount (years)</th>
    <th id="th">Price €</th>
    <th id="th">Price no tax €</th>
    <th id="th">Remove</th>
    <?php

    $totalPrice = 0;
    $totalPriceNotax = 0;

    while(count($allCartItems) > $i) {
        
        $id = $allCartItems[$i]['product_id'];
        $quantity = $allCartItems[$i]['quantity'];
        $product = new product($id, $conn);
        $price = $product->price*$quantity;
        $price_formatted = round($price, 2);
        $price_notax = $product->price_notax*$quantity;
        $price_notax_formatted = round($price_notax, 2);
        ?>

        <tr class="text-center" id=row<?=$i?>>
            <td class="pb-2"><?= $product->name ?></td>
            <input id="hidden<?=$i?>" type="hidden" value="<?=$allCartItems[$i]['id']?>">
            <td class="pb-2">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle changeQuantity" id="<?=$allCartItems[$i]['id']?>" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $quantity ?>
                    </button>
                    <ul class="dropdown-menu" id="dropdownQuantity">
                        <li><a class="dropdown-item" id="dropdown1<?=$allCartItems[$i]['id']?>" value="1">1</a></li>
                        <li><a class="dropdown-item" id="dropdown2<?=$allCartItems[$i]['id']?>" value="3">3</a></li>
                        <li><a class="dropdown-item" id="dropdown3<?=$allCartItems[$i]['id']?>" value="5">5</a></li>
                    </ul>
                </div>
            </td>
            <input id="quantity<?=$i?>" type="hidden" value="<?=$quantity?>">
            <input id="price<?=$i?>" type="hidden" value="<?=$product->price?>">
            <td class="pb-2"><?=$price_formatted?></td>
            <td class="pb-2"><?=$price_notax_formatted?></td>
            <td class="pb-2"><i value="<?=$i?>" id="<?=$i?>" style="cursor:pointer" class='deleteItem bi bi-cart-x text-danger'></td>
        </tr>

        <?php
             
        $i++;
    }

    $totalPrice = $cart->getCostOfWholeCart();
    $totalPriceNotax = $cart->getCostOfWholeCartNotax();

    ?>
    
    </table>

    <p class="lead" style="font-size: 15px" value="<?= $totalPrice ?>" id="totalPrice">Total: <?= $totalPrice ?> € (no tax <?= $totalPriceNotax ?> €)</p>
    <input type="hidden" id="hiddenTotalPrice" value="<?= $totalPrice ?>">

    <?php
    if(empty($allCartItems)) {
        echo "Your cart is empty";
    } else {
        echo '<a href="checkout.php"><button class="btn btn-light" type="button">Checkout</button></a>';
    }
    ?>

    <br>
    <br>
    <br>

</div>
<script type="text/javascript" src="javascript/cart.js"></script>

<?php
require'footer.php';
?>