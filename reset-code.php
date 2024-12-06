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

			.otp-input {
				display: flex;
				justify-content: space-between;
				flex-wrap: wrap;
			}

			.otp-box {
				width: 45px;
				height: 45px;
				text-align: center;
				font-size: 24px;
				margin: 0 5px;
				border: 1px solid #ccc;
				border-radius: 5px;
				width: 12.5%;
    			margin-bottom: 10px;
			}

			.otp-box:focus {
				outline: none;
				border-color: #007bff;
				box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
			}
		</style>
</head>
<?php include 'assets/css/color/color-1.php';  ?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-10 col-md-4 offset-md-4 form" style="max-width: 350px; margin: 0 auto;">
                <form action="reset-code" method="POST" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        ?>
                        <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
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
                    <div class="form-group text-center">
						<div class="otp-input">
							<input type="tel" class="otp-box" id="otp1" name="otp1" maxlength="1" required inputmode="numeric" pattern="[0-9]" aria-label="OTP Box 1" oninput="moveFocus(this, 'otp2')" onkeydown="moveBack(this, event, 'otp1')" onkeypress="return isNumber(event)">
							<input type="tel" class="otp-box" id="otp2" name="otp2" maxlength="1" required inputmode="numeric" pattern="[0-9]" aria-label="OTP Box 2" oninput="moveFocus(this, 'otp3')" onkeydown="moveBack(this, event, 'otp1')" onkeypress="return isNumber(event)">
							<input type="tel" class="otp-box" id="otp3" name="otp3" maxlength="1" required inputmode="numeric" pattern="[0-9]" aria-label="OTP Box 3" oninput="moveFocus(this, 'otp4')" onkeydown="moveBack(this, event, 'otp2')" onkeypress="return isNumber(event)">
							<input type="tel" class="otp-box" id="otp4" name="otp4" maxlength="1" required inputmode="numeric" pattern="[0-9]" aria-label="OTP Box 4" oninput="moveFocus(this, 'otp5')" onkeydown="moveBack(this, event, 'otp3')" onkeypress="return isNumber(event)">
							<input type="tel" class="otp-box" id="otp5" name="otp5" maxlength="1" required inputmode="numeric" pattern="[0-9]" aria-label="OTP Box 5" oninput="moveFocus(this, 'otp6')" onkeydown="moveBack(this, event, 'otp4')" onkeypress="return isNumber(event)">
							<input type="tel" class="otp-box" id="otp6" name="otp6" maxlength="1" required inputmode="numeric" pattern="[0-9]" aria-label="OTP Box 6" onkeydown="moveBack(this, event, 'otp5')" onkeypress="return isNumber(event)">
						</div>
                	</div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-reset-otp" value="Submit">
                    </div>
					<div>
                        <center>
                            <a href="forgot-password" style="color: #0866ff;">Back</a>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>

	<script>
    function moveFocus(current, nextId) {
        // Move focus to the next field if the current one is filled
        if (current.value.length === 1) {
            var nextField = document.getElementById(nextId);
            if (nextField) {
                nextField.focus();
            }
        }
    }

    function moveBack(current, event, prevId) {
        // If backspace is pressed and the current input is empty, move focus to the previous input
        if (event.key === "Backspace" && current.value === "") {
            var prevField = document.getElementById(prevId);
            if (prevField) {
                prevField.focus();
            }
        }
    }
</script>

<script>
	function isNumber(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (charCode < 48 || charCode > 57) {
        return false; // Allow only numbers (key codes for 0-9)
    }
    return true;
}
</script>
    
</body>
</html>