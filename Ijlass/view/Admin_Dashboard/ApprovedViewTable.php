<link rel="stylesheet" href="/css/Admin/ViewTables.css" />

<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

// Query to fetch data
$pendingquery = "SELECT u.name, f.id, f.title 
                 FROM tbl_form AS f 
                 INNER JOIN tbl_users AS u 
                 ON f.useremail = u.email 
                 WHERE f.status = 2 
                 ORDER BY f.id DESC;";
$pendingresult = $con->query($pendingquery);
?>
<div id="loading" style="display: none;margin-left: 50%;">
  <div class="spinner"></div>
</div>

<table class="table table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Title</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
  if ($pendingresult->num_rows > 0) {
      while ($row = $pendingresult->fetch_assoc()) {
          $truncatedTitle = mb_substr($row['title'], 0, 10) . (strlen($row['title']) > 10 ? '...' : '');
          echo "<tr id='row_" . htmlspecialchars($row['id']) . "'>";
          echo "<td>" . htmlspecialchars($row['id']) . "</td>";
          echo "<td>" . htmlspecialchars($row['name']) . "</td>";
          echo "<td>" . htmlspecialchars($truncatedTitle) . "</td>";
          echo "<td>
                  <button class='btn-view' data-id='" . htmlspecialchars($row['id']) . "'>View</button>
                  <button class='btn-delete' data-id='" . htmlspecialchars($row['id']) . "' data-name='" . htmlspecialchars($row['name']) . "'>Delete</button>
                </td>";
          echo "</tr>";
      }
  } else {
      echo "<tr><td colspan='4'>No pending records found.</td></tr>";
  }
  ?>
</tbody>

</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $(".btn-delete").click(function() {
        var id = $(this).data("id");
        var name = $(this).data("name");

        if (confirm("Are you sure you want to delete '" + name + "' article?")) {
          $.ajax({
                    url: 'delete_record.php',  // This should work if both files are in the same folder
                    type: 'POST',
                    data: { id: id },
                    success: function(response) {
                        console.log(response); // Log the server response for debugging
                        if (response.trim() === "success") {
                            $("#row_" + id).remove(); // Remove the row from the table
                        } else if (response.trim() === "error") {
                            alert("Failed to delete the record.");
                        } else if (response.trim() === "invalid") {
                            alert("Invalid request.");
                        } else {
                            alert("Unexpected response: " + response); // Show unexpected response
                        }
                    },
                    error: function(xhr, status, error) {
                        alert("AJAX error: " + error); // Detailed error logging
                  }
              });

        }
    });


$(".btn-view").click(function() {
        var id = $(this).data("id"); 

        // Update the browser URL without reloading the page
        var newUrl = window.location.pathname + "?page=ApprovedViewArticle";
        window.history.pushState({ path: newUrl }, '', newUrl);

        // Show the loading spinner
        $("#loading").show();

        // Make an AJAX request to load the article content dynamically
        $.ajax({
            url: 'Approved_View_Article.php',
            type: 'GET',
            data: { id: id },
            success: function(response) {
                $("#loading").hide(); // Hide the spinner after content is loaded
                $('main').html(response); 
            },
            error: function(xhr, status, error) {
                $("#loading").hide(); // Hide the spinner in case of an error
                console.error("Error: " + error);
                alert("Failed to load article content.");
            }
        });
    });

});
</script>
