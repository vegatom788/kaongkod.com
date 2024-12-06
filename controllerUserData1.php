<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // If you used Composer
// Or include the files directly if you downloaded PHPMailer
// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';

function sendEmail($email, $subject, $message) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'vegatom788@gmail.com'; // Your email
        $mail->Password = 'pkat xohl akmh ncfa'; // Your email password or app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('vegatom788@gmail.com', 'Barangay Kaongkod'); // Change as needed
        $mail->addAddress($email); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Failed to send email
    }
}

?>

<?php 
session_start();
require "connection1.php";
$email = "";
$name = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }
    $email_check = "SELECT * FROM residents WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    if(count($errors) === 0){
        $encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO residents (fname, mname, lname, email, password, status, verified, email_verif, code)
                        values('$name', '$email', '$encpass', '$code', '$status')";
        $data_check = mysqli_query($con, $insert_data);
        if ($data_check) {
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            
            if (sendEmail($email, $subject, $message)) {
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            } else {
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }

}
    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM residents WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE admin SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: home.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $check_email = "SELECT * FROM residents WHERE email = '$email'";
        $res = mysqli_query($con, $check_email);
        if(mysqli_num_rows($res) > 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            if(password_verify($password, $fetch_pass)){
                $_SESSION['email'] = $email;
                $status = $fetch['status'];
                if($status == 'verified'){
                  $_SESSION['email'] = $email;
                  $_SESSION['password'] = $password;
                    header('location: home.php');
                }else{
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
            }else{
                $errors['email'] = "Incorrect email or password!";
            }
        }else{
            $errors['email'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM residents WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $expiry_time = date("Y-m-d H:i:s", strtotime("+1 minute")); // Set expiration time to 1 minute from now
            
            // Update the reset code and expiration time
            $insert_code = "UPDATE residents SET code = $code, code_expiry = '$expiry_time' WHERE email = '$email'";
            $run_query = mysqli_query($con, $insert_code);
            
            if ($run_query) {
                $reset_link = "http://localhost/capstone2/reset-code1.php";
                $subject = "Password Reset Code";
                $message = "
                <p>Hello,</p>
                <p>We received a request to reset your password. Please use the following code to reset your password:</p> <p><strong>The code expires in 1 minute.</strong></p>
                <p><b>Your password reset code is: $code</b></p>
                <p>Alternatively, you can <a href='$reset_link'>click here</a> to reset your password directly.</p>
                <p>If you did not request a password reset, please ignore this email.</p>
                ";
                    
                if (sendEmail($email, $subject, $message)) {
                    $info = "We've sent a password reset OTP to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code1.php');
                    exit();
                } else {
                    $errors['otp-error'] = "Failed while sending code!";
                }
            } else {
                $errors['db-error'] = "Something went wrong!";
            }
        } else {
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button
    if (isset($_POST['check-reset-otp'])) {
        $_SESSION['info'] = "";  // Reset any session info
    
        // Concatenate OTP values into a single string
        $otp_code = mysqli_real_escape_string($con, $_POST['otp1'] . $_POST['otp2'] . $_POST['otp3'] . $_POST['otp4'] . $_POST['otp5'] . $_POST['otp6']);
        
        // Use placeholder for OTP code
        $check_code = "SELECT * FROM residents WHERE code = ?";
        
        // Prepare the SQL statement
        $stmt = mysqli_prepare($con, $check_code);
        
        // Bind the OTP code to the prepared statement (parameter type is 's' for string)
        mysqli_stmt_bind_param($stmt, "s", $otp_code);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Get the result of the query
        $code_res = mysqli_stmt_get_result($stmt);
        
        // Check if the OTP exists in the database
        if (mysqli_num_rows($code_res) > 0) {
            // Fetch the user data
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];  // Assuming 'email' is the column for the user's email
            $code_expiry = $fetch_data['code_expiry'];  // Retrieve the expiration time from the database
            
            // Get the current time
            $current_time = date("Y-m-d H:i:s");
            
            // Check if the code has expired
            if (strtotime($current_time) > strtotime($code_expiry)) {
                // The code has expired
                $errors['otp-error'] = "Your code has expired. Please request a new one.";
            } else {
                // OTP is valid and has not expired
                // Store the email in session and redirect to password reset page
                $_SESSION['email'] = $email;
                $_SESSION['info'] = "Please create a new password that you don't use on any other site.";
                header('Location: new-password1.php');
                exit();
            }
        } else {
            // OTP did not match
            $errors['otp-error'] = "You've entered an incorrect code!";
        }
        
        // Close the prepared statement
        mysqli_stmt_close($stmt);
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE residents SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed1.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }
?>