<?php

	session_start();
	include('global/model.php');

	$model = new Model();
	$rows = $model->website_details();

	if (!empty($rows)) {
		foreach ($rows as $row) {
			$web_name = $row['web_name'];
			$web_code = strtoupper($row['web_code']);
			$web_header = $row['web_header'];
			$primary_color = $row['primary_color'];
			$secondary_color = $row['secondary_color'];
			$web_icon = $row['web_icon'];
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="keywords" content="" />
		<meta name="author" content="" />
		<meta name="robots" content="" />
		<meta name="format-detection" content="telephone=no">
		
		<link rel="icon" href="assets/images/<?php echo $web_icon; ?>.png" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="assets/images/<?php echo $web_icon; ?>.png" />
		<title><?php echo $web_name; ?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">


		<link rel="stylesheet" type="text/css" href="styles/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="styles/assets/css/typography.css">
		<link rel="stylesheet" type="text/css" href="styles/assets/css/shortcodes/shortcodes.css">
		<link rel="stylesheet" type="text/css" href="styles/assets/css/style.css">
		<style type="text/css">
			.red-hover:hover {
				background-color: #8d0e2b!important
			}

			.btn.dropdown-toggle:hover, .btn.dropdown-toggle:focus {
				color: black;
			}
			.account-heads {
				position: sticky;
				left: 0;
				top: 0;
				z-index: 1;
				width: 500px;
				min-width: 500px;
				height: 100vh;
				background-image: url('assets/images/n1.jpg'); /* Original background image */
				background-position: left;
				background-repeat: no-repeat;
				background-size: cover; /* Adjust as needed */
				text-align: center;
				align-items: center;
				display: flex;
				vertical-align: middle;
			}

			@media only screen and (max-width: 1200px) {
				.account-heads {
					width: 350px;
					min-width: 350px;
				}
			}

			@media only screen and (max-width: 991px) {
				.account-heads {
					width: 100%;
					min-width: 100%;
					height: 200px;
					background-color: #90ee90; /* Light green color */
					background-image: none; /* Remove the background image */
				}
			}
		</style>
	</head>
	<?php include 'assets/css/color/color-1.php'; ?>
	<body id="bg">
		<div class="page-wraper">
			<div id="loading-icon-bx"></div>
			<div class="account-form">
				<div class="account-heads" style="background-image:url(assets/images/n1.jpg);"></div>
				<div class="account-form-inner">
					<div class="account-container">
						<div class="heading-bx left">
							<h2 class="title-head">Account Verification <span></span></h2>
						</div>	
						<form class="contact-bx" method="POST">
							<div class="row placeani">
								<div class="col-lg-12">
								<div class="form-group">
									<label for="id_number">ID Number</label>
									<input id="id_number" class="form-control" type="text" name="id_number" required maxlength="20">
								</div>
								</div>
								<div class="col-lg-12">
								<div class="form-group">
									<label for="last_name">Last Name</label>
									<input id="last_name" class="form-control" type="text" name="last_name" required maxlength="150">
								</div>
								</div>
								<div class="col-lg-12 m-b30">
									<button name="submit" type="submit" value="Submit" class="red-hover btn button-md" style="background-color: #267621!important;" onclick="return validateSelect()">Verify Account</button>
								</div>
								<div class="col-lg-12 m-b30">Is your account already verified? <a href="residents.php" style="color: #0866ff;">Login here</a></div>
								<div class="col-lg-12 m-b30">
									<?php

										if (isset($_POST['submit'])) {
											$status = $model->searchResident($_POST['id_number'], $_POST['last_name']);

											if($status != false) {
												if ($status == 'verified') {
													echo "<h4 style='color: red;'>Account is already verified.</h4>";
												}

												else {
													$_SESSION['verify_resident'] = $status;
													echo "<script>window.open('verify-registration', '_self');</script>";
												}
											}

											else {
												echo "<h4 style='color: red;'>ID Number or Last Name not found in database!</h4>";
											}
										}

									?>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script src="styles/assets/js/jquery.min.js"></script>
		<script src="styles/assets/vendors/bootstrap/js/popper.min.js"></script>
		<script src="styles/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="styles/assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="styles/assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
		<script src="styles/assets/vendors/magnific-popup/magnific-popup.js"></script>
		<script src="styles/assets/vendors/counter/waypoints-min.js"></script>
		<script src="styles/assets/vendors/counter/counterup.min.js"></script>
		<script src="styles/assets/vendors/imagesloaded/imagesloaded.js"></script>
		<script src="styles/assets/vendors/masonry/masonry.js"></script>
		<script src="styles/assets/vendors/masonry/filter.js"></script>
		<script src="styles/assets/vendors/owl-carousel/owl.carousel.js"></script>
		<script src="styles/assets/js/functions.js"></script>
		<script src="styles/assets/js/contact.js"></script>
	</body>
</html>
