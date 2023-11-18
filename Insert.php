<?php
include "Connection/Connection.php";

$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $product_name = filter_input(INPUT_POST, "product_name", FILTER_SANITIZE_STRING);
    $product_description = filter_input(INPUT_POST, "product_description", FILTER_SANITIZE_STRING);
    $product_price = filter_input(INPUT_POST, "product_price", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    // Validate data
    if (empty($product_name) || empty($product_description) || empty($product_price)) {
        $errors[] = "All fields are required.";
    }

    // Validate and handle image upload
    $uploadDir = 'Assets/img/'; 
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

    if (!empty($_FILES['product_image']['name'])) {
        $fileName = $_FILES['product_image']['name'];
        $tmpName = $_FILES['product_image']['tmp_name'];
        $fileSize = $_FILES['product_image']['size'];
        $fileType = $_FILES['product_image']['type'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        // Check if the file has a valid extension
        if (!in_array($fileExtension, $allowedExtensions)) {
            $errors[] = "Invalid file type. Allowed types: " . implode(', ', $allowedExtensions);
        }

        // Check if the file size is within the allowed limit (e.g., 5MB)
        $maxFileSize = 5 * 1024 * 1024; 
        if ($fileSize > $maxFileSize) {
            $errors[] = "File size exceeds the limit. Maximum allowed size: " . $maxFileSize / (1024 * 1024) . "MB";
        }

        // Generate a unique filename to prevent overwriting existing files
        $uniqueFileName = uniqid('product_image_') . '.' . $fileExtension;

        // Move the uploaded file to the specified directory
        $uploadPath = $uploadDir . $uniqueFileName;
        if (move_uploaded_file($tmpName, $uploadPath)) {
            // File upload successful
            $product_image = $uniqueFileName;
        } else {
            $errors[] = "Error uploading the file. Please try again.";
        }
    } else {
        $errors[] = "Product image is required.";
    }

    // Check if there are no validation errors
    if (empty($errors)) {
        // Prepare and execute the INSERT query
        $register_user_query = "INSERT INTO `crud_application`(`product_name`, `product_description`, `product_price`, `product_image`) VALUES (:product_name, :product_description, :product_price, :product_image)";
        $register_user_query_prepare = $connection->prepare($register_user_query);
        $register_user_query_prepare->bindParam(':product_name', $product_name);
        $register_user_query_prepare->bindParam(':product_description', $product_description);
        $register_user_query_prepare->bindParam(':product_price', $product_price);
        $register_user_query_prepare->bindParam(':product_image', $product_image);

        if ($register_user_query_prepare->execute()) {
            // Registration successful
            // You can redirect to a login page or perform other actions
            header("location: index.php");
            exit();
        } else {
            // Registration failed
            $errors[] = "Registration failed. Please try again.";
        }
    }
}

// Close the database connection
$connection = null; 
?>

<?php
// Display validation errors
if (!empty($errors)) {
    echo '<div class="alert alert-danger">';
    foreach ($errors as $error) {
        echo '<p>' . $error . '</p>';
    }
    echo '</div>';
}
?>

<!-- Rest of your HTML code -->
