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

			body {
    			font-family: rubik;
			}

			.modal {
				display: none;
				position: fixed;
				z-index: 1000;
				left: 0;
				top: 0;
				max-width: 100%;
				height: 100%;
				overflow: auto;
				background-color: rgba(0, 0, 0, 0.7);
			}

			.modal-content {
				background-color: white;
				margin: 1.5% auto;
				padding: 60px 30px;
				max-width: 460px; /* Smaller modal width */
			}

			.close {
				color: #aaa;
				float: right;
				font-size: 20px; /* Smaller close button */
				font-weight: bold;
			}

			.close:hover,
			.close:focus {
				color: black;
				text-decoration: none;
				cursor: pointer;
			}

			.modal-scroll {
				height: 350px; /* Change this value to your desired height */
				overflow-y: auto;
				margin-bottom: 20px;
			}

			.modal-scroll p,
			.modal-scroll ul {
				font-size: 0.8em; /* Smaller text size for paragraphs and lists */
			}

			.modal-scroll::-webkit-scrollbar{
				width: 2px;
				background-color: #f1f1f1;
			}
			.modal-scroll::-webkit-scrollbar-thumb{
				background-color: #282828;
			}

			.modal-content h4{
				text-transform: uppercase;
			}

			.modal-content h6 span{
				color: red;
			}

			.modal-buttons {
				display: flex;
				justify-content: center; /* Center the buttons */
				gap: 10px; /* Add space between the buttons */
			}

			button {
				background-color: #4CAF50;
				color: white;
				padding: 12px 20px; /* Increased padding for larger buttons */
				border: none;
				border-radius: 5px;
				cursor: pointer;
				font-size: 16px; /* Increased font size for larger text */
			}

			button:hover {
				background-color: #45a049;
			}

			button.decline {
				background-color: gray; /* Change decline button color to gray */
				color: white; /* Ensure text is visible */
			}

			button.decline:hover {
				background-color: darkgray; /* Darker shade on hover */
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
		<div id="termsModal" class="modal">
				<div class="modal-content">
				<div class="modal-scroll">
					<center><h4>Terms and Conditions</h4></center>
					<p>Last updated: October 28, 2024</p>
					<p>Please read these terms and conditions carefully before using our Service.</p>
					<p>The Terms and Conditions of the Service are a set of guidelines that govern the use of the Service and the agreement between the user and the Company. The terms are based on the following definitions: Affiliate refers to an entity that controls, is controlled by, or is under common control with a party, Country refers to the Philippines, Company refers to Brgy. Kaongkod, Device refers to any device that can access the Service, Service refers to the Website, and Terms and Conditions form the entire agreement between the user and the Company regarding the use of the Service.</p>
					<p>The Terms and Conditions set out the rights and obligations of all users regarding the use of the Service. Access to and use of the Service is conditioned on acceptance and compliance with these Terms and Conditions. By accessing or using the Service, users agree to be bound by these Terms and Conditions.</p>
					<p>Access to and use of the Service is also conditioned on acceptance and compliance with the Company's Privacy Policy. The Company has no control over the content, privacy policies, or practices of any third-party websites or services and is not responsible for any damage or loss caused by or in connection with the use of or reliance on such content, goods, or services.</p>
					</div>
					<center><h6>I Agree to the <span>Terms and Conditions</span> and I read the Privacy Notice.</h6></center>
					<div class="modal-buttons">
						<button id="acceptBtn">Accept</button>
						<!-- <button id="declineBtn" style="background-color: #333333; color: white;">Decline</button> -->
					</div>
			</div>
		</div>
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
							<input name="password" id="password" type="password" class="form-control" minlength="8" maxlength="20" required>
							<span class="eye-icon" id="togglePassword">👁️</span>
						</div>
						<div class="form-group form-forget">
							<div class="g-recaptcha" data-sitekey="6LdCD2cqAAAAAHSmYSbeVAzzNbA_7khE_ALMqqY5" style="transform: scale(0.52); transform-origin: 0 0; height: 28px; width: 10px;"></div>
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
		<script type="text/javascript">
			// Get modal elements
			const termsModal = document.getElementById('termsModal');
			const acceptBtn = document.getElementById('acceptBtn');
			const declineBtn = document.getElementById('declineBtn');

			// Function to open the modal (You might call this when the user first visits the page)
			function openModal() {
				termsModal.style.display = 'block';
			}

			// Function to close the modal
			function closeModal() {
				termsModal.style.display = 'none';
			}

			// Event listener for the Accept button
			acceptBtn.addEventListener('click', () => {
				// Store user consent (this could also be done via localStorage or cookies)
				localStorage.setItem('termsAccepted', 'true');
				closeModal();
				
				// Use SweetAlert for the confirmation message
				Swal.fire({
					title: 'Thank you!',
					text: 'You have accepted the terms and conditions.',
					icon: 'success',
					confirmButtonText: 'OK'
				});
			});

			// Event listener for the Decline button
			declineBtn.addEventListener('click', () => {
				closeModal();
				
				// Use SweetAlert to show a notification
				Swal.fire({
					title: 'Declined!',
					text: 'You must accept the terms and conditions to use the service.',
					icon: 'warning',
					confirmButtonText: 'Okay'
				}).then(() => {
					// Redirect to index.html after the alert is closed
					window.location.href = 'index.php';
				});
			});

			// Example to open the modal when the page loads
			window.onload = () => {
				// Check if terms have already been accepted
				const termsAccepted = localStorage.getItem('termsAccepted');
				if (!termsAccepted) {
					openModal();
				}
			};
		</script>
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