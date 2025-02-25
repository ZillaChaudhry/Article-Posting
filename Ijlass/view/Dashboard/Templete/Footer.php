<link rel="stylesheet" href="/css/Dashboard/style.css" />
</div>
<?php
require_once(__DIR__ . "/../../../DBConnection/connection.php");

// Updated query to fetch required columns and correct ordering
$toparticlequery = "SELECT u.profile_pic,f.id, f.title 
FROM tbl_users AS u 
INNER JOIN tbl_form AS f ON u.email = f.useremail 
ORDER BY f.id DESC 
LIMIT 10";

$toparticleresult = $con->query($toparticlequery);
?>

<div class="top-sales box" style="display: flex; flex-direction: column; align-items: center;">
  <div class="title" style="text-align: center; font-weight: bold; font-size: 18px; margin-bottom: 10px;">
    Updated Articles
  </div>
  <ul class="top-sales-details" style="list-style: none; padding: 0; margin: 0;">
    <?php if ($toparticleresult && $toparticleresult->num_rows > 0): ?>
      <?php while ($row = $toparticleresult->fetch_assoc()): ?>
        <li style="display: flex; align-items: center; margin-bottom: 10px;">
          <form method="post" action="?page=TitleClick" style="margin: 0; padding: 0; display: flex; width: 100%;">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>" />
            <button type="submit" style="display: flex; align-items: center; text-decoration: none; background: none; border: none;">
              <img src="<?php echo htmlspecialchars($row['profile_pic']); ?>" alt="Profile Picture" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;" />
              <span class="product" style="font-size: 14px; color: #333;">
                <?php 
                  $title = $row['title']; 
                  echo htmlspecialchars(strlen($title) > 25 ? substr($title, 0, 25) . '...' : $title); 
                ?>
              </span>
            </button>
          </form>
        </li>
      <?php endwhile; ?>
    <?php else: ?>
      <li style="text-align: center; color: #999;">No articles found.</li>
    <?php endif; ?>
  </ul>
</div>



        </div>
      </div>
    </section>

    <script>
      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".sidebarBtn");
      sidebarBtn.onclick = function () {
        sidebar.classList.toggle("active");
        if (sidebar.classList.contains("active")) {
          sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
        } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      };
    </script>
  </body>
</html>
