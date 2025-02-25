<?php
session_start();
require_once(__DIR__ . "/../../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $targetDir = __DIR__ . "/../../../css/image/";
    $oldProfilePic = $_SESSION["Profile_Pic"] ?? null;

    // Ensure the email variable is set from the session or POST request
    $email = $_SESSION['Email'] ?? ($_POST['email'] ?? '');

    if (empty($email)) {
        echo "<script>alert('Error: Email is not set.');
        window.location.href = '/view/Admin_Dashboard/?page=Profile';</script>";
        exit;
    }

    // Initialize variables for query construction
    $fieldsToUpdate = [];
    $params = [];
    $paramTypes = "";

    // Handle profile picture update
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_pic']['tmp_name'];
        $fileName = uniqid('profile_', true) . '.' . pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
        $targetFilePath = $targetDir . $fileName;
        $dbFilePath = "/css/image/" . $fileName;

        // Delete old profile picture
        if ($oldProfilePic) {
            $oldFilePath = __DIR__ . "/../../../" . $oldProfilePic;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            $_SESSION["Profile_Pic"] = $dbFilePath;
            $fieldsToUpdate[] = "profile_pic = ?";
            $params[] = $dbFilePath;
            $paramTypes .= "s";
        } else {
            echo "<script>alert('Error uploading new profile picture.');
            window.location.href = '/view/Admin_Dashboard/?page=Profile';</script>";
            exit;
        }
    }

    // Handle name update
    if (!empty($_POST['name'])) {
        $name = $con->real_escape_string($_POST['name']);
        $fieldsToUpdate[] = "name = ?";
        $params[] = $name;
        $paramTypes .= "s";
        $_SESSION["Name"] = $name;
    }

    // Handle field update
    if (!empty($_POST['field'])) {
        $fieldsToUpdate[] = "field = ?";
        $params[] = $con->real_escape_string($_POST['field']);
        $paramTypes .= "s";
    }

    // Validate and update password if provided
    if (!empty($_POST['oldPassword']) && !empty($_POST['newPassword'])) {
        $oldPassword = $_POST['oldPassword'];
        $newPassword = $_POST['newPassword'];

        // Check old password against the hashed password in the database
        $passwordCheckQuery = "SELECT password FROM tbl_admin WHERE email = ?";
        $stmt = $con->prepare($passwordCheckQuery);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedPasswordHash = $row['password'];

            // Verify the old password
            if (password_verify($oldPassword, $storedPasswordHash)) {
                // If old password is correct, hash the new password and prepare it for update
                $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $fieldsToUpdate[] = "password = ?";
                $params[] = $hashedNewPassword;
                $paramTypes .= "s";
            } else {
                echo "<script>alert('Old password is incorrect.');
                window.location.href = '/view/Admin_Dashboard/?page=Profile';</script>";
                exit;
            }
        } else {
            echo "<script>alert('User not found.');
            window.location.href = '/view/Admin_Dashboard/?page=Profile';</script>";
            exit;
        }
    } elseif (!empty($_POST['oldPassword']) || !empty($_POST['newPassword'])) {
        // If one of the password fields is empty, show an alert
        echo "<script>alert('Both old and new passwords are required to update the password.');
        window.location.href = '/view/Admin_Dashboard/?page=Profile';</script>";
        exit;
    }

    // Only run the update query if there are fields to update
    if (!empty($fieldsToUpdate)) {
        $query = "UPDATE tbl_admin SET " . implode(", ", $fieldsToUpdate) . " WHERE email = ?";
        $params[] = $email; // Add email to the end of parameters
        $paramTypes .= "s";

        $stmt = $con->prepare($query);
        $stmt->bind_param($paramTypes, ...$params);
        if ($stmt->execute()) {
            echo "<script>window.location.href = '/view/Admin_Dashboard/?page=profilesuccess';</script>";
        } else {
            echo "<script>alert('Error updating profile: " . $stmt->error . "');
            window.location.href = '/view/Admin_Dashboard/?page=Profile';</script>";
        }
    } else {
        echo "<script>alert('No changes made.');
        window.location.href = '/view/Admin_Dashboard/?page=Profile';</script>";
    }
}
?>
