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

	if (isset($_SESSION['sess2'])) {
		echo "<script>window.open('residents/homepage', '_self');</script>";
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
		<title>Brgy. Kaongkod</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- SweetAlert CSS -->
		<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
		<!-- SweetAlert JS -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
		<script src="https://www.google.com/recaptcha/api.js" async defer></script>

		<link rel="stylesheet" type="text/css" href="styles/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="styles/assets/css/typography.css">
		<link rel="stylesheet" type="text/css" href="styles/assets/css/shortcodes/shortcodes.css">
		<link rel="stylesheet" type="text/css" href="styles/assets/css/style.css">
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
			.account-heads a{
				display:block;
				width:100%;
			}
			.account-heads:after{
				opacity:0.9;
				content:"";
				position:absolute;
				left:0;
				top:0;
				z-index:-1;
				width:100%;
				height:100%;
				background: transparent;
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
		<style>
			.form-group {
				position: relative;
			}
			
			.eye-icon {
				position: absolute;
				top: 70%;
				right: 10px; /* Adjust this value to position it as desired */
				transform: translateY(-50%);
				cursor: pointer;
			}

			.ml-auto {
				color: #0866ff;
			}
		</style>
	</head>
	<?php include 'assets/css/color/color-1.php';  ?>
	<body id="bg">
		<div class="page-wraper">
			<div id="loading-icon-bx"></div>
			<div class="account-form">
				<div class="account-heads" style="background-image:url('assets/images/n1.jpg');"></div>
				<div class="account-form-inner">
				<div class="account-container">
					<div class="heading-bx left">
						<h2 class="title-head">Residents<span> Access</span></h2>
					</div>  
					<form class="contact-bx" method="POST">
						<div class="form-group">
							<label for="username">Email</label>
							<input name="username" id="username" type="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input name="password" id="password" type="password" class="form-control" minlength="5" maxlength="20" required>
							<span class="eye-icon" id="togglePassword">👁️</span>
						</div>
						<div class="form-group form-forget">
							<div class="g-recaptcha" data-sitekey="6LdCD2cqAAAAAHSmYSbeVAzzNbA_7khE_ALMqqY5" style="transform: scale(0.60); transform-origin: 0 0; height: 40px; width: 10px;"></div>
							<a href="admin.php" class="ml-auto" style="color: #0866ff;">Administrator Login</a>
						</div>
						<div class="form-group">
							<button name="submit" type="submit" value="Submit" class="btn btn-block">Login</button>
						</div>
							Account not verified yet? <a href="registration.php" style="color: #0866ff;">Click here</a>
						<br>
						<br>
							<center>
								Back to <a href="index.php" style="color: #0866ff;">Homepage</a>
							</center>
					</form>
				</div>
			</form>
					</div>
				</div>
			</div>
		</div>
		<?php
			if (isset($_POST['submit'])) {
				if (!isset($_COOKIE['srlimited'])) {
					$uname = $_POST['username'];
					$pword = $_POST['password'];
					$captchaResponse = $_POST['g-recaptcha-response'];
			
					// Verify reCAPTCHA
					$secretKey = '6LdCD2cqAAAAAFK0fCk9_gYtaSz_hWAlW66BzQ6y'; // Replace with your actual secret key
					$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captchaResponse}");
					$responseKeys = json_decode($response, true);
			
					if (intval($responseKeys["success"]) !== 1) {
						echo "<script>
								Swal.fire({
									icon: 'error',
									title: 'Error!',
									text: 'Please complete the CAPTCHA.',
									customClass: { popup: 'my-custom-swal' }
								});
							</script>";
					} else {
						$model = new Model();
						$response = $model->residentSignIn($uname, $uname, $pword); // Capture the response
			
						// Check for success or error in the response
						if (isset($response['success']) && $response['success']) {
							echo "<script>window.open('residents/homepage', '_self');</script>";
							exit();
						} elseif (isset($response['error'])) {
							// Display SweetAlert for errors
							if (isset($response['sweetalert']) && $response['sweetalert']) {
								echo "<script>
									Swal.fire({
										icon: 'warning',
										title: 'Warning!',
										text: '{$response['error']}',
										customClass: {
											popup: 'my-custom-swal'
										}
									});
								</script>";
							} else {
								echo "<script>
									Swal.fire({
										icon: 'error',
										title: 'Error!',
										text: '{$response['error']}',
										customClass: {
											popup: 'my-custom-swal'
										}
									});
								</script>";
							}
						}
					}
				} else {
					// Check if the user is locked out
					if (isset($_SESSION['lockout_time']) && time() < $_SESSION['lockout_time']) {
						$remainingTime = $_SESSION['lockout_time'] - time();
						$minutes = floor($remainingTime / 60);
						$seconds = $remainingTime % 60;
			
						echo "<script>
							Swal.fire({
								icon: 'warning',
								title: 'Warning!',
								text: 'You are temporarily locked out. Please try again in {$minutes} minute(s) and {$seconds} second(s).',
								customClass: {
									popup: 'my-custom-swal'
								}
							});
						</script>";
					} else {
						// User has reached the max attempts without a lockout
						echo "<script>
							Swal.fire({
								icon: 'warning',
								title: 'Warning!',
								text: 'You have reached the maximum login attempts. Please wait a moment before trying again.',
								customClass: {
									popup: 'my-custom-swal'
								}
							});
						</script>";
					}
				}
			}
		?>
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
		<script>
			// Get the password input field and the toggle button
			const passwordField = document.getElementById('password');
			const togglePassword = document.getElementById('togglePassword');

			// Toggle password visibility when the eye icon is clicked
			togglePassword.addEventListener('click', function() {
				const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
				passwordField.setAttribute('type', type);
				
				// Change eye icon accordingly
				togglePassword.textContent = type === 'password' ? '👁️' : '🔒';
			});
		</script>
	</body>
</html>