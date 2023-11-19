<!-- Database Connection -->
<?php include "Connection/Connection.php"; ?>

<!-- PHP Code -->
<?php
$prodId = $_SESSION['prodId'];

// Fetch existing data
$fetch_doctor_query = "SELECT * FROM `crud_application` WHERE `user_id` = :prodId";
$fetch_doctor_prepare = $connection->prepare($fetch_doctor_query);
$fetch_doctor_prepare->bindParam(':prodId', $prodId);
$fetch_doctor_prepare->execute();
$doctorInfo = $fetch_doctor_prepare->fetch(PDO::FETCH_ASSOC);

// Update existing data if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_image'])) {
    // Handle image upload
    if ($_FILES['update_image']['name'] !== "") {
        $uploadDir = "Assets/img/";
        $uploadedFile = $uploadDir . basename($_FILES['update_image']['name']);
        move_uploaded_file($_FILES['update_image']['tmp_name'], $uploadedFile);

        // Update image in the database
        $update_image_query = "UPDATE `crud_application` SET `product_image` = :product_image WHERE `user_id` = :prodId";
        $update_image_prepare = $connection->prepare($update_image_query);
        $update_image_prepare->bindParam(':product_image', $_FILES['update_image']['name']);
        $update_image_prepare->bindParam(':prodId', $prodId);
        $update_image_prepare->execute();
    }

    // Update the rest of the product information
    $update_product_query = "UPDATE `crud_application` SET 
        `product_name` = :product_name, 
        `product_description` = :product_description, 
        `product_price` = :product_price
        WHERE `user_id` = :prodId";

    $update_product_prepare = $connection->prepare($update_product_query);
    $update_product_prepare->bindParam(':product_name', $_POST['update_name']);
    $update_product_prepare->bindParam(':product_description', $_POST['update_description']);
    $update_product_prepare->bindParam(':product_price', $_POST['update_price']);
    $update_product_prepare->bindParam(':prodId', $prodId);
    $update_product_prepare->execute();

    // Respond with success or failure
    if ($update_product_prepare) {
        echo json_encode(['success' => true]);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Error updating record.']);
        exit();
    }
}
?>