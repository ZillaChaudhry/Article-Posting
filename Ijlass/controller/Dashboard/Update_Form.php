<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate inputs
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $title = isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '';
    $abstract = isset($_POST['abstract']) ? htmlspecialchars($_POST['abstract']) : '';
    $authers = isset($_POST['authers']) ? htmlspecialchars($_POST['authers']) : '';
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';
    $currentFile = isset($_POST['currentFile']) ? htmlspecialchars($_POST['currentFile']) : '';

    // Define the target directory for the uploaded file
    $targetDir = __DIR__ . "/../../../css/File_Image/";  // Corrected to absolute path from current file
    $filePath = $currentFile; // Default to current file path

    // Validate that required fields are not empty
    if (empty($id) || empty($title) || empty($abstract) || empty($description)) {
        echo "Missing required fields.";
        exit;
    }

    // Handle new file upload
    if (!empty($_FILES['fileUpload']['tmp_name']) && is_uploaded_file($_FILES['fileUpload']['tmp_name'])) {
        $allowedTypes = ['application/pdf'];  // Allowed MIME types
        $fileType = mime_content_type($_FILES['fileUpload']['tmp_name']);
        
        // Debug: Check if the file type is correct
        echo "File type: " . $fileType . "<br>";

        if (in_array($fileType, $allowedTypes)) {
            // Generate unique filename
            $fileName = uniqid('article_', true) . '.' . pathinfo($_FILES['fileUpload']['name'], PATHINFO_EXTENSION);
            $newFilePath = $targetDir . $fileName;  // File path for saving the file
            $dbFilePath = "/css/File_Image/" . $fileName;  // Path to store in DB

            // Ensure the directory exists
            if (!is_dir($targetDir)) {
                if (mkdir($targetDir, 0777, true)) {
                    echo "Directory created successfully.<br>";
                } else {
                    echo "Failed to create directory.<br>";
                    exit;
                }
            }

            // Debug: Check if the file exists before moving
            echo "Current file: " . $_FILES['fileUpload']['tmp_name'] . "<br>";
            echo "Target path: " . $newFilePath . "<br>";

            // Delete the old file if it exists and is different
            if (!empty($currentFile)) {
                $oldFilePath = __DIR__ . "/../../../" . ltrim($currentFile, '/');
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $newFilePath)) {
                // Debug: Check if the file is successfully moved
                echo "File moved successfully to: " . $newFilePath . "<br>";

                // Set new file path for the database
                $filePath = $dbFilePath;
            } else {
                echo "Failed to move uploaded file. Error: " . $_FILES['fileUpload']['error'] . "<br>";
                exit;
            }
        } else {
            echo "Invalid file type. Allowed types: PDF only.<br>";
            exit;
        }
    } 

    // Update query
    $formquery = "UPDATE tbl_form SET 
                        title = ?, 
                        abstract = ?, 
                        description = ?, 
                        file = ?, 
                        authers = ?,
                        status = ? 
                  WHERE id = ?";

    // Prepare and bind statement
    $stmt = $con->prepare($formquery);
    $status = 0;  // Assuming 0 means inactive or similar

    $stmt->bind_param('sssssii', $title, $abstract, $description, $filePath, $authers,$status, $id);

    // Execute the update query
    if ($stmt->execute()) {
        echo "<script>window.location.href = '/view/Dashboard/?page=dashboard';</script>";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $con->close();
} else {
    echo "Invalid request.";
    exit;
}
?>
