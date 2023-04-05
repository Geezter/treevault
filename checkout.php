<?php
require'navbar.php';
require'lib/class.cart.php';
require'lib/class.product.php';
require'db/database.php';

session_start();
$sessionId = session_id();
$cart = new cart($sessionId, $conn);
$allCartItems = $cart->getCartItems();
$i = 0;

?>
<br>

<div class="container text-center col-12 col-sm-5">
    <h1 class="lead text-center" style="font-size: 36px">
        Checkout
    </h1>

    <br>

    <!-- List cart items -->

    <p class="nav-link">Cart Items</p>

    <table id="cartTable" class="table d-flex justify-content-center">
        <th id="th">Product</th>
        <th id="th">Length</th>
        <th id="th">Price</th>
        <th id="th">Price no tax</th>

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
        $totalPrice = $cart->getCostOfWholeCart();
        ?>

        <tr class="text-center" id=row<?=$i?>>
            <td id="td" class="pb-2 td"><?= $product->name ?></td>
            <input id="hidden<?=$i?>" type="hidden" value="<?=$allCartItems[$i]['id']?>">
            <td id="td" class="pb-2 td"><?= $quantity ?> years</td>
            <input id="quantity<?=$i?>" type="hidden" value="<?=$quantity?>">
            <input id="price<?=$i?>" type="hidden" value="<?=$product->price?>">
            <td id="td" class="pb-2"><?= $price_formatted ?> €</td>
            <td id="td" class="pb-2"><?=$price_notax_formatted?> $</td>
        </tr>
        

        <?php
             
        $i++;
    }
?>

</table>
<p class="nav-link">Total cost: <?=$totalPrice?> €</p>
</div>

<br>

<!-- order form -->

<div class="container text-center checkout col-10 col-sm-8 col-lg-4">
    <br>
    <form action="" method="">
        <div class="form-group">
            <label class="formtext text-muted" for="exampleInputEmail1">Email address</label>
            <input width="100vh" type="email" name="email" id="emailInput" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <div class="invalid-feedback lead" id="invalidFeedbackEmail">
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="formtext text-muted" for="firstNameInput">First Name</label>
            <input type="text" name="firstname" class="form-control" id="firstNameInput" placeholder="Enter First Name">
            <div class="invalid-feedback lead" id="invalidFeedbackFirstName">
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="formtext text-muted" for="lastNameInput">Last Name</label>
            <input type="text" name="lastname" class="form-control" id="lastNameInput" aria-describedby="emailHelp" placeholder="Enter Last Name">
            <div class="invalid-feedback lead" id="invalidFeedbackLastName">
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="formtext text-muted" for="addressInput">Street Address</label>
            <input type="text" name="streetAddress" class="form-control" id="addressInput" placeholder="Enter Street Name">
            <div class="invalid-feedback lead" id="invalidFeedbackAddress">
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="formtext text-muted" for="zipCodeInput">Zip Code</label>
            <input type="number" name="zipCode" class="form-control" id="zipCodeInput" placeholder="Enter Zip Code">
            <div class="invalid-feedback lead" id="invalidFeedbackZipCode">
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="formtext text-muted" for="cityInput">City</label>
            <input type="text" name="city" class="form-control" id="cityInput" placeholder="Enter City">
            <div class="invalid-feedback lead" id="invalidFeedbackCity">
            </div>
        </div>
        <br>
        <div class="form-group">
            <label class="formtext text-muted" for="phoneNumInput">Phone Number</label>
            <input type="text" name="phoneNumber" class="form-control" id="phoneNumInput" placeholder="Enter Phone Number">
            <div class="invalid-feedback lead" id="invalidFeedbackPhone">
            </div>
        </div>
        <br>
        <div class=text-center">
            <button type="submit" id="submitBtn" class="align-self-center btn">Order</button>
        </div>
        <br>
        <br>
        
    </form>
</div>


<?php
require'footer.php';
?>

<script type="text/javascript" src="javascript/checkout.js"></script>