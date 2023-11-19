<input type="hidden" name="doctorId" value="<?php echo $doctor['user_id']; ?>">

    <a href="profile.php" class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="assets/img/<?php echo $doctor['select_image']; ?>" alt="User Image"></a>

#####################################################################################################

    $response = array();

if (isset($\_POST['delete_product'])) {
// Get the user_id from the form
$user_id = $\_POST['user_id'];

    // Prepare and execute the DELETE query
    $delete_product_query = "DELETE FROM `crud_application` WHERE `user_id` = :user_id";
    $delete_product_query_prepare = $connection->prepare($delete_product_query);
    $delete_product_query_prepare->bindParam(':user_id', $user_id);

    if ($delete_product_query_prepare->execute()) {
        // Deletion successful
        $response['success'] = true;
    } else {
        // Deletion failed
        $response['success'] = false;
    }

} else {
// Invalid request
$response['success'] = false;
}

// Close the database connection
$connection = null;

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
#####################################################################################################

<p><a href="product-single.php?prodId=<?php echo $related['prod_id'] ?>" class="btn btn-primary btn-outline-primary">View</a></p>

#####################################################################################################

<?php require "header/navbar.php" ?>
<?php require "connection/connection.php" ?>

<?php

	$prodId = $_GET['prodId'];

	$single_product_query = "SELECT * FROM products WHERE prod_id = :id";

	$single_product_prepare = $connection->prepare($single_product_query);
	$single_product_prepare->bindParam(':id',$prodId);
	$single_product_prepare->execute();

	$single_product = $single_product_prepare->fetch(PDO::FETCH_ASSOC);

	// print_r($single_product);



	// RELATED PRODUCTS START

	$related_product_query = "SELECT * FROM products WHERE prod_id != :id AND prod_type = :type";

	$related_product_prepare = $connection->prepare($related_product_query);
	$related_product_prepare->bindParam(':id',$prodId);
	$related_product_prepare->bindParam(':type',$single_product['prod_type']);
	$related_product_prepare->execute();

	$related_product = $related_product_prepare->fetchAll(PDO::FETCH_ASSOC);

	// print_r($related_product);



	// RELATED PRODUCTS END




	// ADD TO CART START



	if(isset($_POST['cart_button'])){

		if(isset($_SESSION['userId'])){

			$price = $_POST['inputPrice'];
		$size = $_POST['size'];
		$quantity = $_POST['quantity'];

		$cart_insert_query = "INSERT INTO `cart`(`prod_name`, `prod_price`, `prod_description`, `quantity`, `size`, `prod_image`,`prod_id`, `user_id`) VALUES (:prodName, :prodPrice, :prodDescription, :quantity, :size, :prodImage, :prodId, :userId)
		";

		$cart_insert_prepare = $connection->prepare($cart_insert_query);
		$cart_insert_prepare->bindParam(':prodName',$single_product['prod_name']);
		$cart_insert_prepare->bindParam(':prodPrice',$price);
		$cart_insert_prepare->bindParam(':prodDescription',$single_product['prod_description']);
		$cart_insert_prepare->bindParam(':quantity',$quantity);
		$cart_insert_prepare->bindParam(':size',$size);
		$cart_insert_prepare->bindParam(':prodImage',$single_product['prod_image']);
		$cart_insert_prepare->bindParam(':prodId',$prodId);
		$cart_insert_prepare->bindParam(':userId',$_SESSION['userId']);

		$cart_insert_prepare->execute();

		// header("location:cart.php");


		}else{
			echo "<script>alert('Kindly login to add to cart your product')</script>";
		}
	}

	// ADD TO CART END


	// CART DATA START

	
	$cart_fetch_query = "SELECT * FROM `cart` where prod_id = :prodId";
	$cart_fetch_prepare = $connection->prepare($cart_fetch_query);
	$cart_fetch_prepare->bindParam(':prodId',$prodId);
	$cart_fetch_prepare->execute();
	
	$cart_data = $cart_fetch_prepare->fetch(PDO::FETCH_ASSOC);
	
	
	// print_r(is_array($cart_data['prod_id']));
	



	// CART DATA END









?>
