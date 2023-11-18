<?php include "Connection/Connection.php"; ?>
<?php session_start(); ?>

<?php
$single_product_query = "SELECT * FROM `crud_application`";
$single_product_prepare = $connection->prepare($single_product_query);
$single_product_prepare->execute();
$single_product = $single_product_prepare->fetchAll(PDO::FETCH_ASSOC);

// deleted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
	$doctorId = $_POST['delete_product'];

	// Your SQL query to delete the doctor from the database
	$deleteQuery = "DELETE FROM `crud_application` WHERE `user_id` = :delete_product";
	$deleteStatement = $connection->prepare($deleteQuery);
	$deleteStatement->bindParam(':delete_product', $doctorId, PDO::PARAM_INT);

	if ($deleteStatement->execute()) {
		// echo 'Doctor deleted successfully!';
	}

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="Assets/img/circle-user-solid-min.png" type="image/x-icon">
	<title>Crud Application</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="Assets/css/card_style.css">
	<link rel="stylesheet" href="Assets/css/crud_style.css">

</head>

<body>
	<!-- crud table  -->
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2>Product <b>Cards</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
									class="material-icons">&#xE147;</i> <span>Add New Card</span></a>
							<a href="cards.php" class="btn btn-success"><i class="material-icons">&#xE417;</i>
								<span>View All</span></a>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>
								<span class="custom-checkbox">
									<input type="checkbox" id="selectAll">
									<label for="selectAll"></label>
								</span>
							</th>
							<th>Product Name</th>
							<th>product Description</th>
							<th>product Price</th>
							<th>Product Image</th>
							<th>Actions</th>
						</tr>
					</thead>
					<?php foreach ($single_product as $product): ?>
						<tbody>
							<tr>
								<td>
									<span class="custom-checkbox">
										<input type="checkbox" id="checkbox5" name="options[]" value="1">
										<label for="checkbox5"></label>
									</span>
								</td>
								<td>
									<?php echo $product['product_name']; ?>
								</td>
								<td>
									<?php echo $product['product_description']; ?>
								</td>
								<td>
									<?php echo $product['product_price']; ?>
								</td>
								<td><img width="100px" height="100px"
										src="assets/img/<?php echo $product['product_image']; ?>" alt="User Image"></td>
								<td>
									<a href="#viewEmployeeModal" type="submit" class="view" title="View"
										data-toggle="modal"><i class="material-icons">&#xE417;</i></a>
									<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons"
											data-toggle="tooltip" title="Edit">&#xE254;</i></a>
									<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i
											class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
								</td>
							</tr>
						</tbody>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
	<!-- / crud table  -->

	<!-- Add Product Cards -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">

				<form action="Insert.php" method="post" enctype="multipart/form-data">

					<div class="modal-header">
						<h4 class="modal-title">Add Product Cards</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Product Name</label>
							<input type="text" name="product_name" id="product_name" title="Insert Product Name"
								class="form-control">
						</div>
						<div class="form-group">
							<label>product Description</label>
							<textarea class="form-control" name="product_description" id="product_description"
								title="Insert product Description"></textarea>
						</div>
						<div class="form-group">
							<label>product Price</label>
							<input type="text" name="product_price" id="product_price" title="Insert Product Price"
								class="form-control">
						</div>
						<div class="form-group">
							<label>Product Image</label>
							<input type="file" name="product_image" id="product_image"
								accept="image/png, image/gif, image/jpeg" title="Insert Product Image"
								class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" title="Cancel" data-dismiss="modal" value="Cancel">
						<input type="submit" name="submit" id="submit" title="Add Card" class="btn btn-success"
							value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- / Add Product Cards -->

	<!-- Update Product Cards -->
	<div id="editEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Update Product Card</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Product Name</label>
							<input type="text" name="update_name" id="update_name" title="Update product Name"
								class="form-control">
						</div>
						<div class="form-group">
							<label>product Description</label>
							<textarea class="form-control" name="update_description" id="update_description"
								title="Update product Description"></textarea>
						</div>
						<div class="form-group">
							<label>product Price</label>
							<input type="email" name="update_price" id="update_price" title="Update Product Price"
								class="form-control">
						</div>
						<div class="form-group">
							<label>Product Image</label>
							<input type="text" name="update_image" id="update_image" title="Update Product Image"
								class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name="update_submit" id="update_submit" title="Update Card"
							class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- / Update Product Cards -->

	<!-- Delete Product Cards -->
	<div id="deleteEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

					<input type="hidden" name="user_id" value="<?php echo $doctor['user_id']; ?>">
					<div class="modal-header">
						<h4 class="modal-title">Delete Cards</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name="delete_product" id="submit" title="Delete Card" class="btn btn-danger"
							value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- / Delete Product Cards -->

	<!-- View Product Cards -->
	<div id="viewEmployeeModal" class="modal fade">
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
		<div id="cards_landscape_wrap-2">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<a href="">
							<div class="card-flyer">
								<div class="text-box">
									<div class="image-box">
										<img src="assets/img/<?php echo $product['product_image']; ?>"
											alt="User Image" />
									</div>
									<div class="text-container">
										<h6>
											<?php echo $product['product_name']; ?>
										</h6>
										<p>
											<?php echo $product['product_description']; ?>
										</p>
										<h2>
											<?php echo $product['product_price']; ?>
										</h2>
										<input type="button" class="btn btn-default" data-dismiss="modal"
											value="Cancel">
									</div>
								</div>
							</div>
					</div>
					</a>
				</div>
			</div>
		</div>
	</form>
	</div>
	</div>
	<!-- / View Product Cards -->


	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="Assets/js/crud.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>

</html>