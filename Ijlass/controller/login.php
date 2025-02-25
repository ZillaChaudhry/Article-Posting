<?php
session_start(); // Start the session

// Check if the session is already active and prevent logging in again
if (isset($_SESSION['Email'])) {
    header("Location: /view/Dashboard/?page=dashboard");
    exit();
}

require_once(__DIR__ . "/../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve input data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use a prepared statement to prevent SQL injection
    $stmt = $con->prepare("SELECT password, name, profile_pic, email, 'user' role FROM tbl_users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Bind the result to variables
        $stmt->bind_result($hashed_password, $name, $profile_pic, $email, $userType);
        $stmt->fetch();

        // Verify the password using password_verify
        if (password_verify($password, $hashed_password)) {
            // Store user details in the session
            $_SESSION["Name"] = $name;
            $_SESSION["Profile_Pic"] = $profile_pic;
            $_SESSION["Email"] = $email;
            $_SESSION["UserType"] = $userType;

            // Redirect to the dashboard
            echo "<script>
                    window.location.href = '/view/Dashboard/?page=dashboard';
                  </script>";
        } else {
            // Password mismatch
            echo "<script>
                    alert('Incorrect password.');
                    window.location.href = '/?page=login';
                  </script>";
        }
    } else {
        // No user found
        echo "<script>
                alert('No such user found.');
                window.location.href = '/?page=login';
              </script>";
    }

    $stmt->close();
}
?>
