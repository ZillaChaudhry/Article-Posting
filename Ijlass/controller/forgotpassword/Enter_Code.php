<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if verification code is set in the session
    if (isset($_SESSION['verification_code'])) {
        $verificationCode = htmlspecialchars($_POST['verificationCode'], ENT_QUOTES, 'UTF-8');

        // Check if the verification code matches
        if ($_SESSION['verification_code'] == $verificationCode) {
            unset($_SESSION['verification_code']);
            header("Location: /?page=EnterPassword");
        } else {
            echo "<script>alert('Verification code does not match. Please try again.');
            window.location.href = '/?page=EnterCode';
            </script>";
        }
    } else {
        echo "<script>alert('Verification code is not set. Please request a new code.');</script>";
    }
}
?>
