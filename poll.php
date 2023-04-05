<?php
$title ='Pikkujouluäänestys';
require"navbar.php";
require"../db/database.php";

?>



<section class="bg-danger text-center">
    <div class="container"></div>
        <div class="col mx-auto">
           
            <div class="col-md-8 g-5 p-4 pt-3 mx-auto">
                <div class="card w-auto bg-light p2">
                    <div class="card-body">
                        <h4 class="card-title bg-danger text-light p-2">
                            ÄÄNESTÄ PIKKUJOULUJEN AJANKOHTA
                        </h4>
                            <p class="card-text lead bg-dark text-light p-2 mt-3 d-lg-p-5 d-sm-p-0">Äänestä pikkujoulujen ajankohta</p>
                            <p class="card-text lead text-dark p-3">Valitse kaikki haluamasi ajankohdat</p>
                            <p class="card-text h3 text-dark p-3">Lähetä vain kerran. Sivun alaosaan tulee kuittaus että ääni on lähetetty.</p>
                        <div class="input-group">
                            <form action="<?php echo htmlspecialchars($_SERVER ["PHP_SELF"]); ?>" method="POST" class="pt-3 mx-auto w-75 pb-4">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="eight" name="eight">
                                        <label class="form-check-label" for="firstCheckbox">8.2.</label>
                                    </li>
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="fifteen" name="fifteen">
                                        <label class="form-check-label" for="secondCheckbox">15.2.</label>
                                    </li>
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="twentytwo" name="twentytwo">
                                        <label class="form-check-label" for="thirdCheckbox">22.2.</label>
                                    </li>
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="first" name="first">
                                        <label class="form-check-label" for="thirdCheckbox">1.3.</label>
                                    </li>
                                </ul>
                                    <button class="btn btn-outline-light bg-dark" type="submit" name="submit" value="send" type="button">Lähetä</button>
                                </div>  
                            </form>
                        </div>
                        
                    </div>
                </div>  
            </div>  
        </div>
    </div>
</section>

<?php
$eight = filter_input(INPUT_POST, "eight", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$fifteen = filter_input(INPUT_POST, "fifteen", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$twentytwo = filter_input(INPUT_POST, "twentytwo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$first = filter_input(INPUT_POST, "first", FILTER_SANITIZE_FULL_SPECIAL_CHARS);



if(isset($eight)) {
    $sql = "INSERT INTO xmas2 (eight) VALUE(1)";
    if(mysqli_query($conn, $sql)) {
        // success
        echo "kiitos äänestä";
    }   else {
        // error
        
        echo 'Error: ' . mysqli_error($conn);
    }
}

if(isset($fifteen)) {
    $sql = "INSERT INTO xmas2 (fifteen) VALUE(1)";
    if(mysqli_query($conn, $sql)) {
        // success
        echo "kiitos äänestä";
    }   else {
        // error
        
        echo 'Error: ' . mysqli_error($conn);
    }
}

if(isset($twentytwo)) {
    $sql = "INSERT INTO xmas2 (twentytwo) VALUE(1)";
    if(mysqli_query($conn, $sql)) {
        // success
        echo "kiitos äänestä";
    }   else {
        // error
        
        echo 'Error: ' . mysqli_error($conn);
    }
}

if(isset($first)) {
    $sql = "INSERT INTO xmas2 (first) VALUE(1)";
    if(mysqli_query($conn, $sql)) {
        // success
        echo "kiitos äänestä";
    }   else {
        // error
        
        echo 'Error: ' . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM xmas2";
$result = mysqli_query($conn, $sql);
$xmas2 = mysqli_fetch_all($result, MYSQLI_ASSOC);

$eightresult = 0;
$fifteenresult = 0;
$twentytworesult = 0;
$firstresult = 0;

foreach($xmas2 as $item):
    
    if ($item['eight'] == 1) {
        $eightresult++;
    }

    if ($item['fifteen'] == 1) {
        $fifteenresult++;
    }
    if ($item['twentytwo'] == 1) {
        $twentytworesult++;
    }
    if ($item['first'] == 1) {
        $firstresult++;
    }
endforeach;
    ?>

<table class='table'§>
    <thead>
        <th>Päivämäärä</th>
        <th>8.2.</th>
        <th>15.2.</th>
        <th>22.2</th>
        <th>1.3.</th>
    </thead>
    <tbody>
        <tr>
            <td>Äänimäärä</td>
            <td><?= $eightresult; ?></td>
            <td><?= $fifteenresult; ?></td>
            <td><?= $twentytworesult; ?></td>
            <td><?= $firstresult; ?></td>
        </tr>
    </tbody>
</table>

