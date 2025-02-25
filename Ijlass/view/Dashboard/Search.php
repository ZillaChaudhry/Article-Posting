<link rel="stylesheet" href="/css/Admin/Search.css" />

<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

$searchtext = ''; // Default empty search text
$results = []; // To store search results

// Check if form is submitted and search text is provided
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['txtsearch'])) {
    $searchtext = $_POST['txtsearch']; // Capture search text

    // Sanitize the input to prevent SQL injection
    $searchtext = mysqli_real_escape_string($con, $searchtext);

    // Define the search query
    $searchquery = "SELECT u.profile_pic, f.title, f.abstract, f.id, f.useremail 
                    FROM tbl_form AS f
                    INNER JOIN tbl_users AS u ON f.useremail = u.email 
                    WHERE f.title LIKE '%$searchtext%'";

    // Execute the query
    $resultsearch = $con->query($searchquery);

    if ($resultsearch->num_rows > 0) {
        // Fetch all results
        while ($row = $resultsearch->fetch_assoc()) {
            $results[] = $row;
        }
    }
}
?>

<div class="search-results">
    <?php if (count($results) > 0): ?>
        <?php foreach ($results as $result): ?>
            <div class="result-item">
                <div class="result-icon">
                    <img src="<?php echo htmlspecialchars($result['profile_pic']); ?>" alt="User Profile Picture">
                </div>
                <div class="result-content">
                    <h3 class="result-title"><?php echo htmlspecialchars($result['title']); ?></h3>
                    <p class="result-description">
                        <?php
                        // Truncate the abstract to 20 words
                        $abstract = $result['abstract'];
                        $words = explode(' ', $abstract);
                        if (count($words) > 20) {
                            $abstract = implode(' ', array_slice($words, 0, 20)) . '...';
                        }
                        echo htmlspecialchars($abstract);
                        ?>
                    </p>
                    <button class="view-button" data-id="<?php echo htmlspecialchars($result['id']); ?>">View</button>



                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No results found for "<?php echo htmlspecialchars($searchtext); ?>"</p>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $(".view-button").click(function() {
        var id = $(this).data("id"); 

        // Update the browser URL without reloading the page
        var newUrl = window.location.pathname + "?page=SearchView&id=" + id;
        window.history.pushState({ path: newUrl }, '', newUrl);

        // Show a loading spinner
        $("#loading").show();

        // Make an AJAX request to load the article content dynamically
        $.ajax({
            url: 'Search_View.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                $("#loading").hide(); // Hide the spinner
                $('main').html(response); // Inject loaded content into <main>
            },
            error: function(xhr, status, error) {
                $("#loading").hide(); // Hide the spinner on error
                console.error("Error: " + error);
                alert("Failed to load article content.");
            }
        });
    });
});
</script>
