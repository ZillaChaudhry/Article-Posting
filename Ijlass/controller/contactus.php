<?php
require_once(__DIR__ . "/../DBConnection/connection.php");
require_once(__DIR__ . "/EmailSenderClass.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $userMessage = $_POST['message'];
    
    // Recipient email address
    $recipientEmail = 'duakhanwazir@gmail.com';
    
    // Email sender instance
    $sender = new EmailSenderClass();
    
    // Build the email message
    $message = '
        <div style="max-width: 600px; margin: 20px auto; font-family: Arial, sans-serif; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div style="background: -webkit-linear-gradient(left,#003366,#004080,#0059b3
, #0073e6); color: #ffffff; padding: 20px; text-align: center;">
                <h2 style="margin: 0; font-size: 24px;">New Contact Us Message</h2>
            </div>
            <div style="padding: 20px;">
                <p style="font-size: 18px; margin: 10px 0;">You have received a new message from:</p>
                <p style="font-size: 16px; margin: 5px 0;"><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>
                <p style="font-size: 16px; margin: 5px 0;"><strong>Message:</strong></p>
                <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px; font-size: 16px; line-height: 1.6; color: #333;">
                    ' . nl2br(htmlspecialchars($userMessage)) . '
                </div>
            </div>
            <div style="padding: 10px; text-align: center; background: -webkit-linear-gradient(left,#003366,#004080,#0059b3
, #0073e6);">
                <p style="font-size: 14px; margin: 0;color:white;">Please respond promptly to the user\'s message.</p>
            </div>
        </div>';
        $sender->send($recipientEmail, $message);
        header("Location: /?page=Home");
    
}
?>
