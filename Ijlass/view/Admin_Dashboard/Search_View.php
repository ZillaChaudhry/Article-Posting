<link rel="stylesheet" href="/css/Admin/View_Article.css" />
<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Fetch article data
    $query = "SELECT useremail, id, title, abstract, description, file,authers FROM tbl_form WHERE id = ?";
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
        <?php
    } else {
        echo "Article not found.";
    }
} else {
    echo "Invalid article ID.";
}
?>

