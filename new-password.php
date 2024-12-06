<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: login-user.php');
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
		
		<link rel="icon" href="assets/images/k.png" type="image/png" />
        <link rel="shortcut icon" href="assets/images/k.png" type="image/png" />

		<title>Brgy. Kaongkod</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- SweetAlert CSS -->
		<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    
		<!-- SweetAlert JS -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

		<link rel="stylesheet" type="text/css" href="styles/assets/css/assets.css">
		<link rel="stylesheet" type="text/css" href="styles/assets/css/typography.css">
		<link rel="stylesheet" type="text/css" href="styles/assets/css/shortcodes/shortcodes.css">
		<link rel="stylesheet" type="text/css" href="styles/assets/css/style.css">
        <link rel="stylesheet" href="style.css">
        <style type="text/css">
			.red-hover:hover {
				background-color: #8d0e2b!important
			}
			.account-heads {
				position: sticky;
				left:0;
				top:0;
				z-index: 1;
				width: 500px;
				min-width: 500px;
				height: 100vh;
				background-position: left;
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
				.account-heads{
					width: 350px;
					min-width: 350px;
				}

			}

			@media only screen and (max-width: 991px) {
				.account-heads {
					width: 100%;
					min-width: 100%;
					height: 200px;
				}
			}
			.my-custom-swal .dropdown-toggle {
				display: none; 
			}
		</style>
        <style>
			.form-group {
				position: relative;
			}
			
			.eye-icon {
				position: absolute;
				top: 55%;
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
<body>
    <div class="container">
        <div class="row">
            <div class="col-10 col-md-4 offset-md-4 form" style="max-width: 350px; margin: 0 auto;">
                <form action="new-password" method="POST" autocomplete="off">
                    <h2 class="text-center">New Password</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input 
                            class="form-control" 
                            type="password" 
                            name="password" 
                            placeholder="Create new password" 
                            required 
                            minlength="8"
                            pattern="^(?=.*[A-Z])(?=.*[0-9]).{8,}$" 
                            title="Password must be at least 8 characters long, include at least one uppercase letter, and one number."
                            aria-label="Create new password"
                        >
                        <span class="eye-icon" id="togglePassword">👁️</span>
                    </div>

                    <div class="form-group">
                        <input 
                            class="form-control"
                            type="password" 
                            name="cpassword" 
                            placeholder="Confirm your password" 
                            required 
                            minlength="8"
                            pattern="^(?=.*[A-Z])(?=.*[0-9]).{8,}$"
                            title="Password must be at least 8 characters long, include at least one uppercase letter, and one number."
                            aria-label="Confirm your password"
                        >
                        <span class="eye-icon" id="toggleCPassword">👁️</span>
                    </div>

                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="Change">
                    </div>
                </form>
            </div>
        </div>
    </div>
            <script>
					document.addEventListener('DOMContentLoaded', function() {
					const togglePassword = document.querySelector('#togglePassword');
					const passwordField = document.querySelector('input[name="password"]');
					
					togglePassword.addEventListener('click', function() {
						const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
						passwordField.setAttribute('type', type);
						// Toggle eye icon between open and closed eye
						togglePassword.textContent = type === 'password' ? '👁️' : '🔒';
					});
				});

				document.addEventListener('DOMContentLoaded', function() {
					const togglePassword = document.querySelector('#toggleCPassword');
					const passwordField = document.querySelector('input[name="cpassword"]');
					
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