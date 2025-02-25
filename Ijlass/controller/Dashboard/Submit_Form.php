<?php
session_start();
require_once(__DIR__ . "/../../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input values
    $title = htmlspecialchars($_POST['title']);
    $abstract = htmlspecialchars($_POST['abstract']);
    $description = htmlspecialchars($_POST['description']);
    
    // Parse and sanitize authors
    $authersInput = $_POST['authers'];
    $authersArray = array_map('trim', explode(',', $authersInput)); // Split by commas and trim whitespace
    $authersArray = array_filter($authersArray, fn($auther) => !empty($auther)); // Remove empty tags
    $authers = implode(',', $authersArray); // Rebuild the sanitized string

    // Handle the uploaded file
    $file = $_FILES['fileUpload'];
    $targetDir = __DIR__ . "/../../css/File_Image/"; // Target directory for file upload
    $targetFile = $targetDir . basename($file["name"]);
    
    $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is a PDF
    if ($fileExtension === "pdf") {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            // Get the file path relative to the server root
            $filePath = "/css/File_Image/" . basename($file["name"]);

            // Securely escape the session email before using it in the SQL query
            $email = $con->real_escape_string($_SESSION["Email"]);

            // Prepare the SQL query with placeholders for better security
            $formquery = "INSERT INTO tbl_form (title, abstract, description, file, status, `read`, useremail, authers) 
                          VALUES (?, ?, ?, ?, 0, 0, ?, ?)";
            
            $stmt = $con->prepare($formquery);
            $stmt->bind_param("ssssss", $title, $abstract, $description, $filePath, $email, $authers);

            // Execute the query
            if ($stmt->execute()) {
                echo "<script>window.location.href = '/view/Dashboard/?page=formsuccess';</script>";
                exit;
            } else {
                // Handle database errors
                echo "<script>alert('Error submitting form: " . $con->error . "');</script>";
            }
            $stmt->close();
        } else {
            // Handle file upload errors
            echo "<script>alert('Sorry, there was an error uploading your file.');
                  window.location.href = '/view/Dashboard/?page=Form';</script>";
        }
    } else {
        // Handle file type errors
        echo "<script>alert('Sorry, only PDF files are allowed.');
              window.location.href = '/view/Dashboard/?page=Form';</script>";
    }
}
?>
