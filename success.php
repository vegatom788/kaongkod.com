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
		
		<link rel="icon" href="assets/images/<?php echo $web_icon; ?>.png"" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="assets/images/<?php echo $web_icon; ?>.png"" />
		<title><?php echo $web_name; ?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">


		<link rel="stylesheet" type="text/css" href="assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="assets/css/typography.css">
		<link rel="stylesheet" type="text/css" href="assets/css/shortcodes/shortcodes.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<style type="text/css">
			.red-hover:hover {
				background-color: #8d0e2b!important
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
	<?php include 'assets/css/color/color-1.php';  ?>
	<body id="bg">
		<div class="page-wraper">
			<div id="loading-icon-bx"></div>
			<div class="account-form">
				<div class="account-heads" style="background-image:url(assets/images/n1.jpg);"></div>
				<div class="account-form-inner">
					<div class="">
						<div class="heading-bx left" align="center">
							<h3><span>You have <span style='color: green;'>successfully verified your account</span>.<!-- <br>The admin needs to approve your<br>account before you can login. --><br><img src='assets/images/k.png' style='width: 200px; height: 200px;'><br></span>
							<?php
							$details_id = 1;
							if ($details_id == 0) {
								echo "<p>Log in your account <a href='faculty.php' style='color: #be1630;'>Click here</a></p>";
							}
							else {
								echo "<p>Log in your account <a href='residents.php' style='color: green;'>Click here</a></p>";
							}
							?>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/vendors/bootstrap/js/popper.min.js"></script>
		<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
		<script src="assets/vendors/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendors/counter/waypoints-min.js"></script>
		<script src="assets/vendors/counter/counterup.min.js"></script>
		<script src="assets/vendors/imagesloaded/imagesloaded.js"></script>
		<script src="assets/vendors/masonry/masonry.js"></script>
		<script src="assets/vendors/masonry/filter.js"></script>
		<script src="assets/vendors/owl-carousel/owl.carousel.js"></script>
		<script src="assets/js/functions.js"></script>
		<script src="assets/js/contact.js"></script>
	</body>
</html>