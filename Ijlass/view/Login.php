<link rel="stylesheet" href="/css/Loginzzz.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />
<!-- Include Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>



<div class="wrapper">
      <div class="title-text">
        <div class="title login">Login Form</div>
        <div class="title signup">Signup Form</div>
      </div>
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Login</label>
          <label for="signup" class="slide signup">Signup</label>
          <div class="slider-tab"></div>
        </div>
        <div class="form-inner">

        <form action="/controller/login.php" method="post" class="login">
    
    <div class="field">
        <input type="email" placeholder="Email Address" name="email" aria-label="Email Address" required>
    </div>
    <div class="field">
        <input type="password" placeholder="Password" name="password" aria-label="Password" required>
    </div>
    <div class="pass-link"><a href="?page=EnterEmail">Forgot password?</a></div>
    <div class="field btn">
        <div class="btn-layer"></div>
        <input type="submit" value="Login">
    </div>
    <div class="signup-link">Not a member? <a href="#">Signup now</a></div>
</form>





          <form method="post" action="/controller/signup.php" enctype="multipart/form-data" class="signup">
    <div class="field">
        <input type="text" placeholder="Full Name" name="name" required>
    </div>
    <div class="field">
        <input type="text" placeholder="Email Address" name="email" required>
    </div>
    <div class="field">
      <select id="fieldSelector" name="field" required>
        <option value="" disabled selected>Select Your Field</option>
        <option value="computer_science">Computer Science</option>
        <option value="information_technology">Information Technology</option>
        <option value="software_engineering">Software Engineering</option>
        <option value="marketing">Marketing</option>
        <option value="business_administration">Business Administration</option>
        <option value="medicine">Medicine</option>
        <option value="nursing">Nursing</option>
        <option value="literature">Literature</option>
        <option value="physics">Physics</option>
        <option value="other">Other</option>
      </select>
    </div>
    <div class="field">
        <input type="text" placeholder="University" name="txtuniversity" required>
    </div>
    <div class="field">
        <input type="password" placeholder="Password" name="password" required>
    </div>
    <div class="field">
        <input type="password" placeholder="Confirm password" name="confirm_password" required>
    </div>
    <div class="field">
        <input type="file" name="profile_picture" accept="image/*" required>
    </div>
    <div class="field btn">
        <div class="btn-layer"></div>
        <input type="submit" value="Signup">
    </div>
</form>



        </div>
      </div>
    </div>

    <script>
    // Initialize Select2 on the dropdown
    $(document).ready(function() {
        $('#fieldSelector').select2({
            placeholder: "Select Your Field",
            allowClear: true // Optionally allow clearing the selection
        });
    });
</script>