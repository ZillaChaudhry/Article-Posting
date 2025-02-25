<!-- Include Bootstrap and Custom CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/Admin/Admin_Dashboard.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

// Database queries to fetch counts
$newquery = "SELECT count(*) FROM tbl_form WHERE status = 0";
$commentedquery = "SELECT count(*) FROM tbl_form WHERE status = 1";
$approvedquery = "SELECT count(*) FROM tbl_form WHERE status = 2";
$rejectedquery = "SELECT count(*) FROM tbl_form WHERE status = 3";
$likesquery = "SELECT count(*) FROM tbl_likes";

// Execute queries and retrieve the results
$newresult = $con->query($newquery);
$commentedresult = $con->query($commentedquery);
$approvedresult = $con->query($approvedquery);
$rejectedresult = $con->query($rejectedquery);
$likesresult = $con->query($likesquery);

// Get the counts
$newCount = $newresult ? $newresult->fetch_row()[0] : 0;
$commentedCount = $commentedresult ? $commentedresult->fetch_row()[0] : 0;
$approvedCount = $approvedresult ? $approvedresult->fetch_row()[0] : 0;
$rejectedCount = $rejectedresult ? $rejectedresult->fetch_row()[0] : 0;
$likesCount = $likesresult ? $likesresult->fetch_row()[0] : 0;

// Calculate percentages
$totalArticles = $newCount + $commentedCount + $approvedCount + $rejectedCount;
$newPercentage = $totalArticles > 0 ? ($newCount / $totalArticles) * 100 : 0;
$commentedPercentage = $totalArticles > 0 ? ($commentedCount / $totalArticles) * 100 : 0;
$approvedPercentage = $totalArticles > 0 ? ($approvedCount / $totalArticles) * 100 : 0;
$rejectedPercentage = $totalArticles > 0 ? ($rejectedCount / $totalArticles) * 100 : 0;

// Function to determine color based on percentage
function getColorForPercentage($percentage) {
    if ($percentage < 30) {
        return 'red';  // Red for low percentage
    } elseif ($percentage < 70) {
        return 'orange';  // Orange for moderate percentage
    } else {
        return 'green';  // Green for high percentage
    }
}

// Get dynamic colors based on the percentage
$newColor = getColorForPercentage($newPercentage);
$commentedColor = getColorForPercentage($commentedPercentage);
$approvedColor = getColorForPercentage($approvedPercentage);
$rejectedColor = getColorForPercentage($rejectedPercentage);
?>

<div class="container mt-5">
    <div class="row text-center">
        <!-- New Articles -->
        <div class="col-md-3">
            <div class="icon-box">
                <i class="bi bi-file-earmark-text" style="color: <?php echo $newColor; ?>;"></i>
                <span class="count"><?php echo $newCount; ?></span>
            </div>
            <div class="progress-circle">
                <svg width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="lightgray" stroke-width="10" />
                    <circle cx="50" cy="50" r="45" fill="none" stroke="<?php echo $newColor; ?>" stroke-width="10"
                        stroke-dasharray="283" stroke-dashoffset="<?php echo 283 - (283 * $newPercentage / 100); ?>"
                        style="transition: stroke-dashoffset 0.5s ease;" />
                </svg>
                <span><?php echo round($newPercentage); ?>%</span>
            </div>
            <p>New Articles</p>
        </div>

        <!-- Commented Articles -->
        <div class="col-md-3">
            <div class="icon-box">
                <i class="bi bi-chat-dots" style="color: <?php echo $commentedColor; ?>;"></i>
                <span class="count"><?php echo $commentedCount; ?></span>
            </div>
            <div class="progress-circle">
                <svg width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="lightgray" stroke-width="10" />
                    <circle cx="50" cy="50" r="45" fill="none" stroke="<?php echo $commentedColor; ?>" stroke-width="10"
                        stroke-dasharray="283" stroke-dashoffset="<?php echo 283 - (283 * $commentedPercentage / 100); ?>"
                        style="transition: stroke-dashoffset 0.5s ease;" />
                </svg>
                <span><?php echo round($commentedPercentage); ?>%</span>
            </div>
            <p>Commented Articles</p>
        </div>

        <!-- Approved Articles -->
        <div class="col-md-3">
            <div class="icon-box">
                <i class="bi bi-check-circle" style="color: <?php echo $approvedColor; ?>;"></i>
                <span class="count"><?php echo $approvedCount; ?></span>
            </div>
            <div class="progress-circle">
                <svg width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="lightgray" stroke-width="10" />
                    <circle cx="50" cy="50" r="45" fill="none" stroke="<?php echo $approvedColor; ?>" stroke-width="10"
                        stroke-dasharray="283" stroke-dashoffset="<?php echo 283 - (283 * $approvedPercentage / 100); ?>"
                        style="transition: stroke-dashoffset 0.5s ease;" />
                </svg>
                <span><?php echo round($approvedPercentage); ?>%</span>
            </div>
            <p>Approved Articles</p>
        </div>

        <!-- Rejected Articles -->
        <div class="col-md-3">
            <div class="icon-box">
                <i class="bi bi-x-circle" style="color: <?php echo $rejectedColor; ?>;"></i>
                <span class="count"><?php echo $rejectedCount; ?></span>
            </div>
            <div class="progress-circle">
                <svg width="100" height="100" viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="lightgray" stroke-width="10" />
                    <circle cx="50" cy="50" r="45" fill="none" stroke="<?php echo $rejectedColor; ?>" stroke-width="10"
                        stroke-dasharray="283" stroke-dashoffset="<?php echo 283 - (283 * $rejectedPercentage / 100); ?>"
                        style="transition: stroke-dashoffset 0.5s ease;" />
                </svg>
                <span><?php echo round($rejectedPercentage); ?>%</span>
            </div>
            <p>Rejected Articles</p>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
