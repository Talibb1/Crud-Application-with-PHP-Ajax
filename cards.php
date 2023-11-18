<?php include "Connection/Connection.php";?>
<?php session_start(); ?>

<?php
$single_product_query = "SELECT * FROM `crud_application`";
$single_product_prepare = $connection->prepare($single_product_query);
$single_product_prepare->execute();
$single_product = $single_product_prepare->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pen 6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Assets/css/card_style.css">
  </head>
  <body>
  <div class="container">
  <div class="row mt-5">
       <!-- Topic Cards -->
       <div id="cards_landscape_wrap-2">
        <div class="container">
            <div class="row">

            <?php foreach ($single_product as $product): ?>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                    <a href="">
                        <div class="card-flyer">
                            <div class="text-box">
                                <div class="image-box">
                                    <img src="assets/img/<?php echo $product['product_image']; ?>" alt="User Image">
                                </div>
                                <div class="text-container">
                                    <h6><?php echo $product['product_name']; ?></h6>
                                    <p><?php echo $product['product_description']; ?></p>
                                    <h2><?php echo $product['product_price']; ?></h2>
                                </div>
                            </div>
                        </div>
                    </a>
                </div> 
                <?php endforeach; ?>
                
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
</body>
</html>