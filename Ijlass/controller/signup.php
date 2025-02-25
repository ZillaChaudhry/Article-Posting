<?php
session_start();
require_once(__DIR__ . "/../DBConnection/connection.php");
require_once(__DIR__ . "/EmailSenderClass.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $field = filter_input(INPUT_POST, 'field', FILTER_SANITIZE_STRING);
    $university = filter_input(INPUT_POST, 'txtuniversity', FILTER_SANITIZE_STRING);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
                    alert('Invalid email format');
                    window.location.href = '/view/?page=login';
                </script>";
        exit;
    }

    // Sanitize the email for SQL query
    $email = $con->real_escape_string($email);
    $checkemail = "SELECT COUNT(*) AS count FROM tbl_users WHERE email = '$email'";
    $checkresult = $con->query($checkemail);

    if ($checkresult) {
        $row = $checkresult->fetch_assoc();
        if ($row['count'] > 0) {
            echo "<script>
                    alert('Email Already Registered');
                    window.location.href = '/view/?page=login';
                </script>";
        } else {
            // Check for file upload error
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
                $profile_picture = file_get_contents($_FILES['profile_picture']['tmp_name']);
                $_SESSION["profile_picture"] = $profile_picture; // Store in session
            } else {
                echo "<script>alert('Error uploading profile picture.');</script>";
                $profile_picture = null;
            }

            // Password validation
            if ($password === $confirm_password) {
                // Set session variables
                $_SESSION["fullname"] = $fullname;
                $_SESSION["email"] = $email;
                $_SESSION["field"] = $field;
                $_SESSION["university"] = $university;
                $_SESSION["password"] = password_hash($password, PASSWORD_BCRYPT);

                // Send verification email
                $sender = new EmailSenderClass();
                $random = mt_rand(100000, 999999);

                $_SESSION['verification_code'] = $random;
                $_SESSION['user_email'] = $email;  // Store email in session

                // Build the email message
                $message = '
                    <div style="max-width: 400px; margin: 20px auto; font-family: Arial, sans-serif; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <div style="background: -webkit-linear-gradient(left,#003366,#004080,#0059b3, #0073e6); color: #ffffff; padding: 15px; text-align: center;">
                            <h4 style="margin: 0;">Welcome!</h4>
                        </div>
                        <div style="padding: 20px; text-align: center;">
                            <p style="margin: 0;">Hello <strong>' . htmlspecialchars($fullname) . '</strong>,</p>
                            <p style="margin: 10px 0;">Your registration code is:</p>
                            <h5 style="margin: 0; color: rgb(0, 0, 0);"><strong>' . $random . '</strong></h5>
                        </div>
                        <div style="padding: 10px; text-align: center; background-color: #f1f1f1;">
                            <a href="http://ijlass.000.pe/?page=email_verification" style="text-decoration: none; color: #ffffff; background: -webkit-linear-gradient(left,#003366,#004080,#0059b3, #0073e6); padding: 10px 15px; border-radius: 5px; display: inline-block;">Get Started</a>
                        </div>
                    </div>';
                
                // Send the email
                $sender->send($email, $message);
                $_SESSION['email_sent'] = true;

                // Redirect to the email verification page
                header("Location: /?page=email_verification");
                exit;
            } else {
                // Display the alert and redirect to login page if passwords don't match
                echo "<script>
                    alert('Passwords do not match');
                    window.location.href = '/view/?page=login';
                </script>";
                exit;
            }
        }
    } else {
        echo "<script>alert('Database query failed. Please try again.');</script>";
        exit;
    }
}
?>
