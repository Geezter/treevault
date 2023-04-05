<?php
include 'navbar.php';
require 'lib/class.product.php';
require 'db/database.php';

$result = $conn->query("SELECT * FROM products");

?>
<br>
<br>
<div class="container-fluid col-12 col-md-6 align-content-center">
    <h1 class="lead text-center" style="font-size: 36px">
        Browse products
    </h1>
    <br>

    <?php
    while ($row = $result->fetch_assoc()) {
    ?>
        <div class="card row justify-content-center m-0">
            <div class="col-12 card p-0">
                <img class="m-0 card-img-top img-fluid" src="<?= $row['img_url']; ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $row['name']; ?></h5>
                    <p class="card-text"><?= $row['description']; ?></p>
                </div>
                <div  class="card-body">
                    <button class="border-dark btn btn-light m-3" onclick="window.location.href='./product.php?id=<?= $row['id']; ?>'">More info</button>

                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
    <?php
    }
    ?>

</div>

<?php
require'footer.php';
?>