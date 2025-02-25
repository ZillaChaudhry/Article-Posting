<?php
session_start();
?>
<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/Dashboard/style.css" />
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <style>
.nav-links {
  list-style: none;
  padding: 0;
  margin: 0;
}

.nav-links li {
  position: relative;
}

.nav-links a {
  display: flex;
  align-items: center;
  text-decoration: none;
  color: white;
  padding: 10px 20px;
  transition: background 0.3s ease;
}

.nav-links a .bx {
  margin-right: 10px; /* Slightly reduce the spacing for a closer alignment */
  margin-left: -20px; /* Move icons slightly to the left */
}

.nav-links a:hover {
  background: #444; /* Optional hover effect */
}

.nav-links .log_out button {
  display: flex;
  align-items: center;
}

.nav-links .log_out button .bx {
  margin-right: 8px; /* Specific adjustment for logout button icon */
  margin-left: -5px; /* Align logout icon consistently with others */
}

.nav-links .links_name {
  flex: 1;
  margin-right: 0; /* Reset margin to avoid extra space */
}

  </style>
  
  <body>
    <div class="sidebar">
      <div class="logo-details">
        <i class="bx bxl-c-plus-plus"></i>
        <span class="logo_name">Admin</span>
      </div>
<ul class="nav-links">
  <li>
    <a href="?page=Admin_dashboard" class="active">
      <i class="bx bx-grid-alt"></i> <!-- Dashboard icon -->
      <span class="links_name">Dashboard</span>
    </a>
  </li>
  <li>
    <a href="?page=ViewTable">
      <i class="bx bx-file"></i> <!-- New icon (represents a new file or item) -->
      <span class="links_name">New</span>
    </a>
  </li>
  <li>
    <a href="?page=ViewCommentedArticle">
      <i class="bx bx-comment-detail"></i> <!-- Commented icon -->
      <span class="links_name">Commented</span>
    </a>
  </li>
  <li>
    <a href="?page=ViewApprovedTable">
      <i class="bx bx-check-circle"></i> <!-- Approved icon -->
      <span class="links_name">Approved</span>
    </a>
  </li>
  <li>
    <a href="?page=Rejected">
      <i class="bx bx-x-circle"></i> <!-- Rejected icon -->
      <span class="links_name">Rejected</span>
    </a>
  </li>

        
        <li class="log_out">
    <form action="/controller/Admin_Dashboard/Logout.php" method="POST" style="display: inline;">
        <button type="submit" style="border: none; background: none; color: white; cursor: pointer; display: flex; align-items: center; padding: 0; gap: 20px; padding-left: 7px;">
            <i class="bx bx-log-out" style="margin-right: 2px;"></i>
            <span class="links_name" style="margin: 0;">Log out</span>
        </button>
    </form>
</li>
        
        
        
        
      </ul>
    </div>
    <section class="home-section">
      <nav>
        <div class="sidebar-button">
          <i class="bx bx-menu sidebarBtn"></i>
          <span class="dashboard">Dashboard</span>
        </div>
        <form method="POST" action="?page=Search" style="margin: 0; padding: 0; display: flex; width: 100%;">
            <div class="search-box">
                <input type="text" placeholder="Search Title..." name="txtsearch"/>
                <button type="submit"><i class="bx bx-search"></i></button>
            </div>
        </form>
        
        
        
        <div class="profile-details">
            <a href="?page=Profile" style="text-decoration: none; color: inherit; display: flex; align-items: center;">
                <img src="<?php echo $_SESSION['Profile_Pic']; ?>" alt="profilepic" style="margin-right: 8px;"/>
                <span class="admin_name"><?php echo $_SESSION['Name']; ?></span>
            </a>
            <i class="bx bx-chevron-down"></i>
        </div>
        
      </nav>

      <div class="home-content">

        <div class="sales-boxes">
        <div class="recent-sales box" style="width: 100%; max-width: 800px;">
            

