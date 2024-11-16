<?php
	
	session_start();

	include('../global/model.php');
	$model = new Model();
	include('department.php');

	if (empty($_SESSION['sess2'])) {
		echo "<script>window.open('../','_self');</script>";
	}

	if (isset($_POST['save_pass'])) {
		$cpass = $_POST['cpass'];
		$npass = $_POST['npass'];
		$newpword = password_hash($npass, PASSWORD_DEFAULT);
		$model = new Model();
		$model->changeResidentPassword($_SESSION['sess2'], $cpass, $newpword);	
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

		<meta name="description" content="" />

		<meta property="og:title" content="" />
		<meta property="og:description" content="" />
		<meta property="og:image" content="" />
		<meta name="format-detection" content="telephone=no">

		<link rel="icon" href="../assets/images/icon.png" type="image/x-icon" />
		<link rel="shortcut icon" type="image/x-icon" href="../assets/images/k.png" />

		<title><?php echo $web_name; ?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/vendors/calendar/fullcalendar.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/typography.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/shortcodes/shortcodes.css">

		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/style.css">
		<link rel="stylesheet" type="text/css" href="../dashboard/assets/css/dashboard.css">
	</head>
	<style type="text/css">
		.btn.dropdown-toggle.btn-default:hover {
			color: #000!important;
		}

		.btn.dropdown-toggle.btn-default:focus {
			color: #000!important;
		}


		.widget-card .icon {
			position: absolute;
			top: auto;
			bottom: -20px;
			right: 5px;
			z-index: 0;
			font-size: 65px;
			color: rgba(0, 0, 0, 0.15);
		}
		.col-xs-5ths,
		.col-sm-5ths,
		.col-md-5ths,
		.col-lg-5ths {
				position: relative;
				min-height: 1px;
				padding-right: 15px;
				padding-left: 15px;
		}

		.col-xs-5ths {
				width: 20%;
				float: left;
		}

		@media (min-width: 768px) {
				.col-sm-5ths {
						width: 20%;
						float: left;
				}
		}

		@media (min-width: 992px) {
				.col-md-5ths {
						width: 20%;
						float: left;
				}
		}

		@media (min-width: 1200px) {
				.col-lg-5ths {
						width: 20%;
						float: left;
				}
		}
	</style>
	<style>
			.form-group {
				position: relative;
			}
			
			.eye-icon {
				position: absolute;
				top: 50%;
				right: 20px; /* Adjust this value to position it as desired */
				transform: translateY(-50%);
				cursor: pointer;
			}
		</style>
	<?php include '../assets/css/color/color-1.php';  ?>
	<body class="ttr-opened-sidebar ttr-pinned-sidebar" style="background-color: #F3F3F3;">

		<?php include 'navbar.php'; ?>

		<div class="ttr-sidebar">
			<div class="ttr-sidebar-wrapper content-scroll">
				
				<?php 
			
				include 'sidebar.php';
				
				$page = 'dashboard';
				$secondnav = '';

				include 'nav.php'; 

				?>

			</div>
		</div>
		<main class="ttr-wrapper" style="background-color: #F3F3F3;">
			<div class="container-fluid">
				<div class="db-breadcrumb">
					<h4 class="breadcrumb-title">Settings</h4>
					<ul class="db-breadcrumb-list">
						<li><i class="ti-settings"></i>Change Password</li>
					</ul>
				</div> 
				
				<?php include 'widget.php'; ?>

				<div class="row">
							<div class="col-lg-12 m-b30">
								
										<form class="edit-profile" method="POST">
											<div class="">
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Current Password</label>
													<div class="col-sm-7">
														<input class="form-control" type="password" name="cpass" minlength="5" maxlength="20" required>
														<span class="eye-icon" id="togglePassword">👁️</span>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">New Password</label>
													<div class="col-sm-7">
														<input class="form-control" type="password" name="npass" minlength="5" maxlength="20" id="password" required>
														<span class="eye-icon" id="toggleNewPassword">👁️</span>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-sm-2 col-form-label">Re Type Password</label>
													<div class="col-sm-7">
														<input class="form-control" type="password" name="rpass" minlength="5" maxlength="20" id="confirm_password" required>
														<span class="eye-icon" id="toggleRetypePassword">👁️</span>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-2">
												</div>
												<div class="col-sm-7">
													<label class="col-sm-2 col-form-label" id="message"></label><br>
													<button name="save_pass" type="submit" class="btn blue radius-xl" style="color: white;"><i class="ti-lock"></i> Save changes</button>
													<a href="homepage" class="btn-secondry radius-xl"><i class="ti-arrow-left"></i> Cancel</a>
												</div>
											</div>
										</form>

							</div>
						</div>
			</div>
		</main>
		<script src="../dashboard/assets/js/jquery.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap/js/popper.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="../dashboard/assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
		<script src="../dashboard/assets/vendors/magnific-popup/magnific-popup.js"></script>
		<script src="../dashboard/assets/vendors/counter/waypoints-min.js"></script>
		<script src="../dashboard/assets/vendors/counter/counterup.min.js"></script>
		<script src="../dashboard/assets/vendors/imagesloaded/imagesloaded.js"></script>
		<script src="../dashboard/assets/vendors/masonry/masonry.js"></script>
		<script src="../dashboard/assets/vendors/masonry/filter.js"></script>
		<script src="../dashboard/assets/vendors/owl-carousel/owl.carousel.js"></script>
		<script src='../dashboard/assets/vendors/scroll/scrollbar.min.js'></script>
		<script src="../dashboard/assets/js/functions.js"></script>
		<script src="../dashboard/assets/vendors/chart/chart.min.js"></script>
		<script src="../dashboard/assets/js/admin.js"></script>
		<script src='../dashboard/assets/vendors/calendar/moment.min.js'></script>
		<script src='../dashboard/assets/vendors/calendar/fullcalendar.js'></script>
		<script type="text/javascript">
    var password = document.getElementById("password");
    var confirm_password = document.getElementById("confirm_password");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.addEventListener('keyup', validatePassword);
    confirm_password.addEventListener('keyup', validatePassword);
</script>
	<script>
			document.addEventListener('DOMContentLoaded', function() {
			const togglePassword = document.querySelector('#togglePassword');
			const passwordField = document.querySelector('input[name="cpass"]');
			
			togglePassword.addEventListener('click', function() {
				const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
				passwordField.setAttribute('type', type);
				// Toggle eye icon between open and closed eye
				togglePassword.textContent = type === 'password' ? '👁️' : '🔒';
			});
		});

		document.addEventListener('DOMContentLoaded', function() {
			const togglePassword = document.querySelector('#toggleNewPassword');
			const passwordField = document.querySelector('input[name="npass"]');
			
			togglePassword.addEventListener('click', function() {
				const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
				passwordField.setAttribute('type', type);
				// Toggle eye icon between open and closed eye
				togglePassword.textContent = type === 'password' ? '👁️' : '🔒';
			});
		});

		document.addEventListener('DOMContentLoaded', function() {
			const togglePassword = document.querySelector('#toggleRetypePassword');
			const passwordField = document.querySelector('input[name="rpass"]');
			
			togglePassword.addEventListener('click', function() {
				const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
				passwordField.setAttribute('type', type);
				// Toggle eye icon between open and closed eye
				togglePassword.textContent = type === 'password' ? '👁️' : '🔒';
			});
		});
	</script>
	</body>

</html>