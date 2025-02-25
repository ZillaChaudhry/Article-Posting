<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

$email = $_SESSION["Email"];

// Database queries to fetch counts
$newquery = "SELECT count(*) FROM tbl_form WHERE status = 0 and useremail = '$email'";
$commentedquery = "SELECT count(*) FROM tbl_form WHERE status = 1 and useremail = '$email'";
$approvedquery = "SELECT count(*) FROM tbl_form WHERE status = 2 and useremail = '$email'";
$rejectedquery = "SELECT count(*) FROM tbl_form WHERE status = 3 and useremail = '$email'";

// Fetch the count values
$newcount = mysqli_fetch_assoc(mysqli_query($con, $newquery))['count(*)'];
$commentedcount = mysqli_fetch_assoc(mysqli_query($con, $commentedquery))['count(*)'];
$approvedcount = mysqli_fetch_assoc(mysqli_query($con, $approvedquery))['count(*)'];
$rejectedcount = mysqli_fetch_assoc(mysqli_query($con, $rejectedquery))['count(*)'];

// Calculate total articles to determine percentage
$totalcount = $newcount + $commentedcount + $approvedcount + $rejectedcount;
if ($totalcount > 0) {
    $newpercent = ($newcount / $totalcount) * 100;
    $commentedpercent = ($commentedcount / $totalcount) * 100;
    $approvedpercent = ($approvedcount / $totalcount) * 100;
    $rejectedpercent = ($rejectedcount / $totalcount) * 100;
} else {
    $newpercent = 0;
    $commentedpercent = 0;
    $approvedpercent = 0;
    $rejectedpercent = 0;
}

// Function to determine color based on percentage
function getColorForPercentage($percentage) {
    if ($percentage < 30) {
        return 'red';
    } elseif ($percentage < 70) {
        return 'yellow';
    } else {
        return 'green';
    }
}

// Get dynamic colors based on the percentage
$newColor = getColorForPercentage($newpercent);
$commentedColor = getColorForPercentage($commentedpercent);
$approvedColor = getColorForPercentage($approvedpercent);
$rejectedColor = getColorForPercentage($rejectedpercent);
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/Dashboard/Dashboard.css" />

<div class="container mt-5">
    <div class="row">
        <!-- Approved Articles -->
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-check-circle" style="color: green;"></i>
                <div class="count"><?php echo $approvedcount; ?></div>
                <p>Approved Articles</p>
                <div class="circle">
                    <div class="progress" style="background-image: conic-gradient(<?php echo $approvedColor; ?> 0% <?php echo $approvedpercent; ?>%, white <?php echo $approvedpercent; ?>% 100%);"></div>
                    <span style="color: black; font-weight: bold;"><?php echo round($approvedpercent); ?>%</span>
                </div>
            </div>
        </div>

        <!-- Pending Articles -->
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-clock" style="color: blue;"></i>
                <div class="count"><?php echo $newcount; ?></div>
                <p>Pending Articles</p>
                <div class="circle">
                    <div class="progress" style="background-image: conic-gradient(<?php echo $newColor; ?> 0% <?php echo $newpercent; ?>%, white <?php echo $newpercent; ?>% 100%);"></div>
                    <span style="color: black; font-weight: bold;"><?php echo round($newpercent); ?>%</span>
                </div>
            </div>
        </div>

        <!-- Commented Articles -->
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-comments" style="color: orange;"></i>
                <div class="count"><?php echo $commentedcount; ?></div>
                <p>Commented Articles</p>
                <div class="circle">
                    <div class="progress" style="background-image: conic-gradient(<?php echo $commentedColor; ?> 0% <?php echo $commentedpercent; ?>%, white <?php echo $commentedpercent; ?>% 100%);"></div>
                    <span style="color: black; font-weight: bold;"><?php echo round($commentedpercent); ?>%</span>
                </div>
            </div>
        </div>

        <!-- Rejected Articles -->
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-times-circle" style="color: red;"></i>
                <div class="count"><?php echo $rejectedcount; ?></div>
                <p>Rejected Articles</p>
                <div class="circle">
                    <div class="progress" style="background-image: conic-gradient(<?php echo $rejectedColor; ?> 0% <?php echo $rejectedpercent; ?>%, white <?php echo $rejectedpercent; ?>% 100%);"></div>
                    <span style="color: black; font-weight: bold;"><?php echo round($rejectedpercent); ?>%</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
