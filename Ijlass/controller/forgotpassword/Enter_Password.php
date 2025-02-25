<?php
session_start();
require_once(__DIR__ . "/../../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if ($password == $confirmpassword) {
        
        $password = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $con->prepare("UPDATE tbl_users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $password, $_SESSION['email']);

        if ($stmt->execute()) {
            unset($_SESSION['email']);
            echo "<script>
                    window.location.href = '/?page=login';
                  </script>";
        } else {
            echo "<script>
                    alert('Error updating password. Please try again.');
                    window.location.href = '/?page=EnterPassword';
                  </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
                alert('Password and Confirm Password do not match');
                window.location.href = '/?page=EnterPassword';
              </script>";
    }
}
?>
