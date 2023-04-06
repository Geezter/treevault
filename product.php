<?php
include'navbar.php';
require'db/database.php';
require'lib/class.product.php';

$itemId = $_GET['id'];
$product = new product($itemId, $conn);

?> 

<div class="container-fluid p-1">
    <div class="col text-center">
        <h2 class="lead" style="font-size: 36px"><?= $product->name; ?></h2>
    </div>
    <br>

    <div class="row productCard justify-content-center">
        <div class="col-12-p-4 col-md-6">

            <br>

            <img class="productImg p-1" src="<?= $product->img_URL; ?>" width="100%">

            <br>
            <br>
            
            <!-- Google Maps map is in this div -->
            <div id="map" class="p-1"></div>

            <br>
            <br>
            <br>
                   
            <script
            src="https://maps.googleapis.com/maps/api/js?key=MYKEY&callback=initMap&v=weekly"
            defer
            ></script>

            <input type="hidden" value="<?=$product->latitude?>" id="latitude">
            <input type="hidden" value="<?=$product->longitude?>" id="longitude">

            <script>

                // google maps javascript

                const latitude = document.getElementById('latitude').value;
                const longitude = document.getElementById('longitude').value;

                latitudeFloat = parseFloat(latitude);
                longitudeFloat = parseFloat(longitude);
                
                function initMap() {
                    
                    const targetLocation = { lat: latitudeFloat, lng: longitudeFloat};
                    
                    const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 16,
                        center: targetLocation,
                        mapTypeId: google.maps.MapTypeId.SATELLITE,
                    });
                    
                    const marker = new google.maps.Marker({
                        position: targetLocation,
                        map: map,
                    });
                }

            window.initMap = initMap;

            </script>

        </div>

        <!-- product card -->

        <div class="col-12 col-md-6">
            <div class="card p-1 mx-auto">
                <div class="card-body">
                    <h5 class="card-title lead p-2">Description</h5>
                    <p class="card-text"><?= $product->description; ?></p>
                    <p>
                        <?= $product->short_desc; ?>
                    </p>

                    <div class="dropdown">
                        <button type="button" class="border-dark btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
                            Aquire Badge
                        </button>

                        <form class="dropdown-menu p-2">
                            <div class="mb-3">
                                <label for="exampleDropdownFormEmail2" class="form-label">Length of the acquirement</label>
                            </div>

                            <div class="dropdown">
                                <button id="dropdownBtn" class="border-dark btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Years
                                </button>

                                <br>
                                <br>

                                <input type='hidden' value='<?= $product->price; ?>' id="hiddenPrice">
                                <input type='hidden' value='<?= $product->id; ?>' id="hiddenId">
                                <p class="muted" id="price">Cost per year: <?= $product->price; ?> €</p>
                                <ul class="dropdown-menu" id="dropdownMenu" style="background-color: #EED8C9;">
                                    <li><a class="dropdown-item" id="dropdown1" onclick="document.getElementById('dropdownBtn').innerHTML = '1 year'">1 year</a></li>
                                    <li><a class="dropdown-item" id="dropdown2" onclick="document.getElementById('dropdownBtn').innerHTML = '3 years'">3 years</a></li>
                                    <li><a class="dropdown-item" id="dropdown3" onclick="document.getElementById('dropdownBtn').innerHTML = '5 years'">5 years</a></li>
                                </ul>
                            </div>

                            <div class="mb-3">
                                <div class="mb-3">
                                </div>

                                <button id="addToCart" class="border-dark btn btn-light">Add to Cart</i></button>
                        </form>
                    </div>
                </div>

                <a href="#" class="btn border-dark btn btn-light mt-3">
                    <i class="bi bi-chevron-right"></i>Read more about <?= $product->name; ?>
                </a>
                <p></p>
            </div>
        </div>
    </div>
</div>

<?php
require'footer.php';
?>

</body>

<script type="text/javascript" src="javascript/product.js"></script>
