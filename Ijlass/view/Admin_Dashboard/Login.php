<link rel="stylesheet" href="/css/Loginzzz.css">

<div class="wrapper" style="margin-top: 10px;">
  <div class="title-text">
    <div class="title login">Admin Login</div>
  </div>
  <div class="form-container">
    <div class="form-inner">
      <form action="/controller/Admin_login.php" method="post" class="login">

        <div class="field">
            <input type="email" placeholder="Email Address" name="email" aria-label="Email Address" required>
        </div>
        <div class="field">
            <input type="password" placeholder="Password" name="password" aria-label="Password" required>
        </div>
        <div class="field btn">
            <div class="btn-layer"></div>
            <input type="submit" value="Login">
        </div>
      </form>
    </div>
  </div>
</div>
