<link rel="stylesheet" href="/css/Admin/View_Article.css" />
<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Fetch article data
    $query = "SELECT useremail, id, title, abstract, description, file,authers FROM tbl_form WHERE id = ? order by id desc;";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $useremail = $row['useremail']; // Now correctly set after fetching the result

        ?>
        <div class="header">
            <h1><?php echo htmlspecialchars($row['title']); ?></h1>
        </div>
        <div class="section">
            <h2>Authers</h2>
            <p><?php echo htmlspecialchars($row['authers']); ?></p>
        </div>
        <div class="section">
            <h2>Abstract</h2>
            <p><?php echo htmlspecialchars($row['abstract']); ?></p>
        </div>
        <div class="section">
            <h2>Description</h2>
            <p><?php echo htmlspecialchars($row['description']); ?></p>
        </div>
        <div class="pdf-viewer">
            <h2>PDF Document</h2>
            <iframe src="<?php echo htmlspecialchars($row['file']); ?>" title="Document PDF"></iframe>
        </div>

        <div class="approval-reject">
            <form action="/controller/Admin_Dashboard/View_Article.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <button type="submit" name="approve" id="approve-<?php echo htmlspecialchars($id); ?>">Approve</button>
            </form>
        </div>


        <!-- Comment Section (This remains unchanged as requested) -->
        <div class="comments">
            <h3>Comment</h3>
            <form action="/controller/Admin_Dashboard/View_Article.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"> <!-- Hidden field for article ID -->
                <input type="hidden" name="useremail" value="<?php echo htmlspecialchars($useremail); ?>"> <!-- Hidden field for user email -->

                <textarea name="newcomment" placeholder="Write your comment..." style="color: white; background-color: #333333; border: 1px solid #444444; border-radius: 5px; padding: 10px; width: 100%; min-height: 100px;"></textarea>
                <button type="submit" name="comment" id="comment-<?php echo htmlspecialchars($id); ?>" 
                        style="background: -webkit-linear-gradient(left, #003366, #004080, #0059b3, #0073e6); 
                               color: white; border: none; padding: 10px 20px; font-size: 16px; 
                               border-radius: 5px; cursor: pointer; transition: background 0.3s;">
                    Comment
                </button>
            </form>
        </div>


        <?php
        // Fetch the comments for the article
        $showcommentquery = "SELECT comment FROM tbl_comments WHERE form_id = ? order by id desc";  // Corrected query to use form_id
        $stmt_comments = $con->prepare($showcommentquery);
        $stmt_comments->bind_param("i", $id); // Bind article ID
        $stmt_comments->execute();
        $showcommentresult = $stmt_comments->get_result();

        if ($showcommentresult->num_rows > 0) {
            // Display the previous comments
            echo '<div class="comments">';
            echo '<h3>Previous Comments</h3>';
            while ($comment_row = $showcommentresult->fetch_assoc()) {
                echo '<p>' . htmlspecialchars($comment_row['comment']) . '</p>';
            }
            echo '</div>';
        } else {
            // If no comments, show a message
            echo '<div class="comments">';
            echo '<h3>No comments yet.</h3>';
            echo '</div>';
        }

    } else {
        echo "Article not found.";
    }
} else {
    echo "Invalid article ID.";
}
?>
