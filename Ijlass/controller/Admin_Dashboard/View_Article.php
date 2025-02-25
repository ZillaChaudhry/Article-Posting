<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");
require_once(__DIR__ . "/../../controller/EmailSenderClass.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve'])) {
    $formid = $_POST['id'];

    $approvedquery = "UPDATE tbl_form SET status = 2, Time = NOW() WHERE id = ?";

    $stmt = $con->prepare($approvedquery);
    $stmt->bind_param("i", $formid);
    
    if ($stmt->execute()) {
        // Redirect upon success
        header("Location: /view/Admin_Dashboard/?page=ViewTable");
        exit;
    } else {
        echo "Error updating record: " . $con->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reject'])) {
    $formid = $_POST['id'];

    $approvedquery = "UPDATE tbl_form SET status = 3 WHERE id = ?";
    $stmt = $con->prepare($approvedquery);
    $stmt->bind_param("i", $formid);
    
    if ($stmt->execute()) {
        // Redirect upon success
        header("Location: /view/Admin_Dashboard/?page=ViewTable");
        exit;
    } else {
        echo "Error updating record: " . $con->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment'])) {
    $formid = $_POST['id'];  // Article ID
    $useremail = $_POST['useremail'];  // User email
    $comment = $_POST['newcomment'];  // New comment text
    
    // Send verification email
    $sender = new EmailSenderClass();

    // Store email in session (if required)
    $_SESSION['user_email'] = $useremail;

    $message = '
    <div style="max-width: 600px; margin: 20px auto; font-family: Arial, sans-serif; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div style="background: linear-gradient(to right, #003366, #004080, #0059b3, #0073e6); color: #ffffff; padding: 15px; text-align: center;">
            <h4 style="margin: 0; font-size: 24px;">Welcome</h4>
        </div>
        <div style="padding: 25px; font-size: 16px; line-height: 1.6; color: #333;">
            <p style="margin: 0 0 15px;">You have a new comment on your article.</p>
            <h5 style="font-size: 18px; margin: 0 0 8px; color: #004080;">Comment Details:</h5>
            <p style="margin: 8px 0; padding: 10px; border-left: 4px solid #0073e6; background-color: #f9f9f9;">
                <strong>Comment:</strong><br>
                ' . nl2br(htmlspecialchars($comment)) . '
            </p>
            <p style="margin: 15px 0 0;">We appreciate your feedback and will get back to you soon!</p>
        </div>
        <div style="padding: 15px; text-align: center; background-color: #f1f1f1;">
            <a href="http://ijlass.000.pe/view/Dashboard/?page=Commented" style="text-decoration: none; color: #ffffff; background: linear-gradient(to right, #003366, #004080, #0059b3, #0073e6); padding: 12px 20px; border-radius: 5px; display: inline-block; font-size: 16px;">
                Visit Your Dashboard
            </a>
        </div>
    </div>';


    // Send the email
    $sender->send($useremail, $message);

    // Start a transaction to ensure both queries are executed together
    $con->begin_transaction();

    try {
        // Update status in tbl_form
        $commentstatus = "UPDATE tbl_form SET status = 1 WHERE id = ?";
        $stmt = $con->prepare($commentstatus);
        $stmt->bind_param("i", $formid);  // Bind the form ID as an integer
        $stmt->execute();

        // Insert the comment into tbl_comments
        $approvedquery = "INSERT INTO tbl_comments (form_id, useremail, comment) VALUES (?, ?, ?)";
        $stmt = $con->prepare($approvedquery);
        $stmt->bind_param("iss", $formid, $useremail, $comment);  // Bind parameters for form_id, useremail, and comment
        $stmt->execute();

        // If both queries succeed, commit the transaction
        $con->commit();

        // Redirect to the view page
        header("Location: /view/Admin_Dashboard/?page=ViewTable");
        exit;
    } catch (Exception $e) {
        // If an error occurs, roll back the transaction
        $con->rollback();
        echo "Error: " . $e->getMessage();
    }
}
?>
