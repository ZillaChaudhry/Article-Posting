<!-- Add this to the <head> section of your HTML to load Font Awesome icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<!-- Top Header (Login / Signup) -->
<div style="position: relative; width: 100%; padding: 10px 0; margin-bottom: 42px;background-color: white;">
    
    <a href="mailto:duakhanwazir@gmail.com" class="contact-link" style="position: absolute; left: 10px; display: flex; align-items: center; color: white;">
        <i class="fas fa-envelope" style="margin-right: 5px;"></i>
        <span>Support</span>
    </a>
    
    <a href="?page=login" class="button rounded shadow-hover" style="position: absolute; right: 10px; padding: 12px 24px; background-color: #f00; color: #fff; border-radius: 5px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        Login
    </a>
</div>


<!-- Main Header (Logo and Navigation) -->
<header class="main-header">
    <div class="main-header__logo">IJLASS</div>
    <nav class="main-header__nav">
        <ul class="main-header__nav-list">
            <li class="main-header__nav-item"><a href="?page=home">Home</a></li>
            <li class="main-header__nav-item"><a href="?page=about">About Us</a></li>
            <li class="main-header__nav-item"><a href="?page=services">Services</a></li>
            <li class="main-header__nav-item"><a href="?page=contact">Contact</a></li>
        </ul>
    </nav>
    <div class="main-header__menu-icon" id="menu-icon">
        <span>&#9776;</span> <!-- Menu icon for mobile view -->
    </div>
</header>

<script>
    // Toggle the navigation menu on hamburger icon click
document.getElementById("menu-icon").addEventListener("click", function() {
    const nav = document.querySelector(".main-header__nav");
    nav.classList.toggle("active");
});

</script>