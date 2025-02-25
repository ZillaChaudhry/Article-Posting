<?php
session_start();
// Include the file that defines EmailSenderClass
include_once "../EmailSenderClass.php"; // Update the path accordingly
require_once(__DIR__ . "/../../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];  // Use lowercase "email" to match the input name

    $searchemailquery = "SELECT COUNT(*) AS count FROM tbl_users WHERE email = '$email'";

    // Assuming you're using MySQLi to query the database
    $searchemailresult = mysqli_query($con, $searchemailquery);
    
    if ($searchemailresult) {
        $row = mysqli_fetch_assoc($searchemailresult);

        if ($row['count'] > 0) {
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
                <p style="margin: 10px 0;">Your Password Reset code is:</p>
                <h5 style="margin: 0; color: rgb(0, 0, 0);"><strong>' . $random . '</strong></h5>
            </div>
            <div style="padding: 10px; text-align: center; background-color: #f1f1f1;">
                <a href="http://ijlass.000.pe/?page=EnterCode" style="text-decoration: none; color: #ffffff; background: -webkit-linear-gradient(left,#003366,#004080,#0059b3, #0073e6); padding: 10px 15px; border-radius: 5px; display: inline-block;">Get Started</a>
            </div>
        </div>';

        // Send the email
        $sender->send($email, $message);
        unset($_SESSION['email']);
        $_SESSION['email'] = $email;

        // Redirect to the email verification page
           header("Location: /?page=EnterCode");
           exit;
           } else {
               echo "<script>
                alert('Sorry, account not found!');
                window.location.href = '/?page=EnterEmail';
              </script>";
           }
       }else {
           echo '<script>alert("Error in database query!");</script>';
        }
}
?>
