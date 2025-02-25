<?php
require_once(__DIR__ . "/../DBConnection/connection.php");

// Set the number of records per page
$recordsPerPage = 10;

// Get the current page from the URL, default to 1 if not set or invalid
$page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;

// Ensure that $startFrom is not negative
$startFrom = max(0, ($page - 1) * $recordsPerPage);

// Query to fetch data with pagination
$homequery = "SELECT title, abstract, file,Time FROM tbl_form WHERE status = 2 order by id LIMIT $startFrom, $recordsPerPage";
$homeresult = $con->query($homequery);

// Query to count total records for pagination
$countQuery = "SELECT COUNT(*) as total FROM tbl_form WHERE status = 2";
$countResult = $con->query($countQuery);
$totalRecords = $countResult->fetch_assoc()['total'];
$totalPages = ceil($totalRecords / $recordsPerPage);
?>

<link rel="stylesheet" href="/css/Homes.css">

<?php while ($row = $homeresult->fetch_assoc()) : ?>
<div class="container">
  <div class="item">
    <div class="title">
      <span 
        class="text-content" 
        data-full-text="<?php echo htmlspecialchars($row['title']); ?>">
        <?php echo htmlspecialchars(substr($row['title'], 0, 100)); ?>...
      </span>
      <span class="show-more" onclick="toggleText(this)">...</span>
    </div>
  </div>

  <div class="item">
    <div class="abstract">
      <span 
        class="text-content" 
        data-full-text="<?php echo htmlspecialchars($row['abstract']); ?>">
        <?php echo htmlspecialchars(substr($row['abstract'], 0, 100)); ?>...
      </span>
      <span class="show-more" onclick="toggleText(this)">...</span>
    </div>
  </div>

  <div class="download-container">
    <span class="pdf-icon">📄</span>
    <a href="<?php echo htmlspecialchars($row['file']); ?>" download class="download-btn">Download</a>
    <!-- Display Date and Time (excluding seconds) -->
    <span class="time" style="float: right; margin-left: 10px;margin-top: 20px;color:white;">
        <?php
          // Format the time as "Y-m-d H:i" to exclude seconds
          $formattedTime = date("H:i | Y-m-d", strtotime($row['Time']));
          echo $formattedTime;
        ?>
      </span>
  </div>
</div>
<?php endwhile; ?>

<!-- Pagination controls -->
<div class="pagination" style="display: flex; justify-content: center; margin-left: auto; margin-right: auto; width: 100%; max-width: 400px;">
  <?php if ($page > 1) : ?>
    <a href="?page=<?php echo $page - 1; ?>">Previous</a>
  <?php endif; ?>

  <span>Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>

  <?php if ($page < $totalPages) : ?>
    <a href="?page=<?php echo $page + 1; ?>">Next</a>
  <?php endif; ?>
</div>

<script>
  function toggleText(element) {
    const textElement = element.previousElementSibling;
    const fullText = textElement.getAttribute("data-full-text");

    if (textElement.innerText.endsWith("...")) {
      textElement.innerText = fullText;
      element.innerText = "Show less";
    } else {
      textElement.innerText = fullText.substring(0, 100) + "...";
      element.innerText = "...";
    }
  }
</script>
