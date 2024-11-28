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
		<script src="https://www.google.com/recaptcha/api.js?render=6LcP2YgqAAAAADeSXtHMjFqXMTffjg5X3olzBra1"></script>

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
					<p>Last updated: November 28, 2024</p>
					<p>Please read these terms and conditions carefully before using our Service.</p>
					<p>The Terms and Conditions of the Service are a set of guidelines that govern the use of the Service and the agreement between the user and the Company. The terms are based on the following definitions: Affiliate refers to an entity that controls, is controlled by, or is under common control with a party, Country refers to the Philippines, Company refers to Brgy. Kaongkod, Device refers to any device that can access the Service, Service refers to the Website, and Terms and Conditions form the entire agreement between the user and the Company regarding the use of the Service.</p>
					<p>The Terms and Conditions set out the rights and obligations of all users regarding the use of the Service. Access to and use of the Service is conditioned on acceptance and compliance with these Terms and Conditions. By accessing or using the Service, users agree to be bound by these Terms and Conditions.</p>
					<p>Access to and use of the Service is also conditioned on acceptance and compliance with the Company's Privacy Policy. The Company has no control over the content, privacy policies, or practices of any third-party websites or services and is not responsible for any damage or loss caused by or in connection with the use of or reliance on such content, goods, or services.</p>
					<h6>Interpretation</h6>
					<p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>
					<h6>Definitions</h6>
					<p>For the purposes of these Terms and Conditions:</p>
					<ul>
					<li>
					<p><strong>Affiliate</strong> means an entity that controls, is controlled by or is under common control with a party, where &quot;control&quot; means ownership of 50% or more of the shares, equity interest or other securities entitled to vote for election of directors or other managing authority.</p>
					</li>
					<li>
					<p><strong>Country</strong> refers to:  Philippines</p>
					</li>
					<li>
					<p><strong>Company</strong> (referred to as either &quot;the Company&quot;, &quot;We&quot;, &quot;Us&quot; or &quot;Our&quot; in this Agreement) refers to Brgy. Kaongkod.</p>
					</li>
					<li>
					<p><strong>Device</strong> means any device that can access the Service such as a computer, a cellphone or a digital tablet.</p>
					</li>
					<li>
					<p><strong>Service</strong> refers to the Website.</p>
					</li>
					<li>
					<p><strong>Terms and Conditions</strong> (also referred as &quot;Terms&quot;) mean these Terms and Conditions that form the entire agreement between You and the Company regarding the use of the Service. This Terms and Conditions agreement has been created with the help of the <a href="https://www.termsfeed.com/terms-conditions-generator/" target="_blank">Terms and Conditions Generator</a>.</p>
					</li>
					<li>
					<p><strong>Third-party Social Media Service</strong> means any services or content (including data, information, products or services) provided by a third-party that may be displayed, included or made available by the Service.</p>
					</li>
					<li>
					<p><strong>Website</strong> refers to Brgy. Kaongkod, accessible from <a href="https://kaongkod.com" rel="external nofollow noopener" target="_blank">https://kaongkod.com</a></p>
					</li>
					<li>
					<p><strong>You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</p>
					</li>
					</ul>
					<h6>Acknowledgment</h6>
					<p>These are the Terms and Conditions governing the use of this Service and the agreement that operates between You and the Company. These Terms and Conditions set out the rights and obligations of all users regarding the use of the Service.</p>
					<p>Your access to and use of the Service is conditioned on Your acceptance of and compliance with these Terms and Conditions. These Terms and Conditions apply to all visitors, users and others who access or use the Service.</p>
					<p>By accessing or using the Service You agree to be bound by these Terms and Conditions. If You disagree with any part of these Terms and Conditions then You may not access the Service.</p>
					<p>You represent that you are over the age of 18. The Company does not permit those under 18 to use the Service.</p>
					<p>Your access to and use of the Service is also conditioned on Your acceptance of and compliance with the Privacy Policy of the Company. Our Privacy Policy describes Our policies and procedures on the collection, use and disclosure of Your personal information when You use the Application or the Website and tells You about Your privacy rights and how the law protects You. Please read Our Privacy Policy carefully before using Our Service.</p>
					<h6>Links to Other Websites</h6>
					<p>Our Service may contain links to third-party web sites or services that are not owned or controlled by the Company.</p>
					<p>The Company has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. You further acknowledge and agree that the Company shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with the use of or reliance on any such content, goods or services available on or through any such web sites or services.</p>
					<p>We strongly advise You to read the terms and conditions and privacy policies of any third-party web sites or services that You visit.</p>
					<h6>Termination</h6>
					<p>We may terminate or suspend Your access immediately, without prior notice or liability, for any reason whatsoever, including without limitation if You breach these Terms and Conditions.</p>
					<p>Upon termination, Your right to use the Service will cease immediately.</p>
					<h6>Limitation of Liability</h6>
					<p>Notwithstanding any damages that You might incur, the entire liability of the Company and any of its suppliers under any provision of this Terms and Your exclusive remedy for all of the foregoing shall be limited to the amount actually paid by You through the Service or 100 USD if You haven't purchased anything through the Service.</p>
					<p>To the maximum extent permitted by applicable law, in no event shall the Company or its suppliers be liable for any special, incidental, indirect, or consequential damages whatsoever (including, but not limited to, damages for loss of profits, loss of data or other information, for business interruption, for personal injury, loss of privacy arising out of or in any way related to the use of or inability to use the Service, third-party software and/or third-party hardware used with the Service, or otherwise in connection with any provision of this Terms), even if the Company or any supplier has been advised of the possibility of such damages and even if the remedy fails of its essential purpose.</p>
					<p>Some states do not allow the exclusion of implied warranties or limitation of liability for incidental or consequential damages, which means that some of the above limitations may not apply. In these states, each party's liability will be limited to the greatest extent permitted by law.</p>
					<h6>&quot;AS IS&quot; and &quot;AS AVAILABLE&quot; Disclaimer</h6>
					<p>The Service is provided to You &quot;AS IS&quot; and &quot;AS AVAILABLE&quot; and with all faults and defects without warranty of any kind. To the maximum extent permitted under applicable law, the Company, on its own behalf and on behalf of its Affiliates and its and their respective licensors and service providers, expressly disclaims all warranties, whether express, implied, statutory or otherwise, with respect to the Service, including all implied warranties of merchantability, fitness for a particular purpose, title and non-infringement, and warranties that may arise out of course of dealing, course of performance, usage or trade practice. Without limitation to the foregoing, the Company provides no warranty or undertaking, and makes no representation of any kind that the Service will meet Your requirements, achieve any intended results, be compatible or work with any other software, applications, systems or services, operate without interruption, meet any performance or reliability standards or be error free or that any errors or defects can or will be corrected.</p>
					<p>Without limiting the foregoing, neither the Company nor any of the company's provider makes any representation or warranty of any kind, express or implied: (i) as to the operation or availability of the Service, or the information, content, and materials or products included thereon; (ii) that the Service will be uninterrupted or error-free; (iii) as to the accuracy, reliability, or currency of any information or content provided through the Service; or (iv) that the Service, its servers, the content, or e-mails sent from or on behalf of the Company are free of viruses, scripts, trojan horses, worms, malware, timebombs or other harmful components.</p>
					<p>Some jurisdictions do not allow the exclusion of certain types of warranties or limitations on applicable statutory rights of a consumer, so some or all of the above exclusions and limitations may not apply to You. But in such a case the exclusions and limitations set forth in this section shall be applied to the greatest extent enforceable under applicable law.</p>
					<h6>Governing Law</h6>
					<p>The laws of the Country, excluding its conflicts of law rules, shall govern this Terms and Your use of the Service. Your use of the Application may also be subject to other local, state, national, or international laws.</p>
					<h6>Disputes Resolution</h6>
					<p>If You have any concern or dispute about the Service, You agree to first try to resolve the dispute informally by contacting the Company.</p>

					<h6>Severability and Waiver</h6>
					<h6>Severability</h6>
					<p>If any provision of these Terms is held to be unenforceable or invalid, such provision will be changed and interpreted to accomplish the objectives of such provision to the greatest extent possible under applicable law and the remaining provisions will continue in full force and effect.</p>
					<h6>Waiver</h6>
					<p>Except as provided herein, the failure to exercise a right or to require performance of an obligation under these Terms shall not affect a party's ability to exercise such right or require such performance at any time thereafter nor shall the waiver of a breach constitute a waiver of any subsequent breach.</p>
					<h6>Translation Interpretation</h6>
					<p>These Terms and Conditions may have been translated if We have made them available to You on our Service.
					You agree that the original English text shall prevail in the case of a dispute.</p>
					<h6>Changes to These Terms and Conditions</h6>
					<p>We reserve the right, at Our sole discretion, to modify or replace these Terms at any time. If a revision is material We will make reasonable efforts to provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at Our sole discretion.</p>
					<p>By continuing to access or use Our Service after those revisions become effective, You agree to be bound by the revised terms. If You do not agree to the new terms, in whole or in part, please stop using the website and the Service.</p>
					<h6>Contact Us</h6>
					<p>If you have any questions about these Terms and Conditions, You can contact us:</p>
					<ul>
					<li>
					<p>By email:  barangaykaongkod15@gmail.com</p>
					</li>
					<li>
					<p>By visiting this page on our website: <a href="https://kaongkod.com/contact" rel="external nofollow noopener" target="_blank">https://kaongkod.com/contact</a></p>
					</li>
					<li>
					<p>By phone number:  09631296743</p>
					</li>
					</ul>
					</div>
					<center><h6>I Agree to the <span>Terms and Conditions</span> and I read the Privacy Notice.</h6></center>
					<br>
					<div class="modal-buttons">
						<button id="acceptBtn">Accept</button>
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
					<form class="contact-bx" method="POST" id="loginForm">
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
							<div class="link forget-pass text-left"><a href="forgot-password1.php" style="color: #0866ff;">Forgot password?</a></div>
							<a href="admin.php" class="ml-auto" style="color: #0866ff;">Administrator Login</a>
						</div>
						<div class="form-group">
							<button name="g-recaptcha-response" type="hidden" value="token" class="btn btn-block">Login</button>
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
			if (isset($_POST['g-recaptcha-response'])) {
				if (!isset($_COOKIE['srlimited'])) {
					$uname = $_POST['username'];
					$pword = $_POST['password'];
					$captchaResponse = $_POST['g-recaptcha-response'];  // Get the reCAPTCHA response
			
					// Verify reCAPTCHA using the provided API verification code
					$secretKey = '6LcP2YgqAAAAAHTk3mUot-UFAYd1-oOpL1DijVol';  // Replace with your actual secret key
					$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captchaResponse");
					$responseKeys = json_decode($response, true);
			
					if (intval($responseKeys["success"]) !== 1) {
						echo "<script>
								Swal.fire({
									icon: 'error',
									title: 'Error!',
									text: 'reCAPTCHA verification failed. Please try again.',
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
		<script>
			grecaptcha.ready(function() {
				// Trigger reCAPTCHA when the form is submitted
				document.getElementById('loginForm').addEventListener('submit', function(event) {
					event.preventDefault();  // Prevent form from submitting immediately

					grecaptcha.execute('6LcP2YgqAAAAADeSXtHMjFqXMTffjg5X3olzBra1', {action: 'login'}).then(function(token) {
						// Add the token to a hidden input field in the form
						var hiddenInput = document.createElement('input');
						hiddenInput.setAttribute('type', 'hidden');
						hiddenInput.setAttribute('name', 'g-recaptcha-response');
						hiddenInput.setAttribute('value', token);
						
						// Append the hidden input to the form
						document.getElementById('loginForm').appendChild(hiddenInput);

						// Now submit the form
						document.getElementById('loginForm').submit();
					});
				});
			});
		</script>
	</body>
</html>