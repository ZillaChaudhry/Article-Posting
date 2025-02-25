<?php
session_start(); // Start the session
require_once(__DIR__ . "/../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $verificationCode = filter_input(INPUT_POST, 'verificationCode', FILTER_SANITIZE_STRING);

    if (isset($_SESSION['verification_code']) && $verificationCode == $_SESSION['verification_code']) {

        if (isset($_SESSION['profile_picture'])) {
            $imageData = $_SESSION['profile_picture'];
            $uploadDir = __DIR__ . '/../css/image/';
            $uniqueFileName = uniqid('profile_', true) . '.png';
            $filePath = $uploadDir . $uniqueFileName;
            if (file_put_contents($filePath, $imageData)) {
                $dbPath = '/css/image/' . $uniqueFileName;

                $insertquery = "INSERT INTO tbl_users (name, email, field,university, password, profile_pic, time, status) 
                                VALUES (?, ?, ?,?, ?, ?, NOW(), 1)";
                
                if ($stmt = $con->prepare($insertquery)) {
                    $stmt->bind_param(
                        "ssssss",
                        $_SESSION['fullname'],
                        $_SESSION['email'],
                        $_SESSION['field'],
                        $_SESSION['university'],
                        $_SESSION['password'],
                        $dbPath
                    );
                    
                    if ($stmt->execute()) {
                        session_unset();
                        session_destroy();
                        header("Location: /?page=successful");
                        exit;
                    } else {
                        echo '<script>alert("Failed to insert data into database. Please try again.");</script>';
                    }
                    
                    $stmt->close();
                } else {
                    echo '<script>alert("Database query preparation failed.");</script>';
                }
            } else {
                echo '<script>alert("Failed to save image file. Please try again.");</script>';
            }
        } else {
            echo '<script>alert("No profile picture found in session.");</script>';
        }
    } else {
        echo '<script>alert("Invalid verification code. Please try again.");
        window.location.href = "/?page=Home";</script>';
    }

    $con->close(); // Close the connection
}
?>
