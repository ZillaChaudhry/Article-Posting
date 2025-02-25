    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .profile-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ccc;
            margin: 20px auto;
            display: block;
            cursor: pointer;
        }
        .profile-image:hover {
            border-color: #007bff;
        }
        .form-control {
            border-radius: 5px;
        }
        .update-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .update-btn:hover {
            background-color: #0056b3;
        }
        .red-text {
            color: red;
        }
        </style>


<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

// Ensure session is active; avoid calling session_start() if already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Fetch the user's profile data
$profilequery = "SELECT * FROM tbl_users WHERE email = ?";
$stmt = $con->prepare($profilequery);
$stmt->bind_param("s", $_SESSION['Email']);
$stmt->execute();
$profileresult = $stmt->get_result();
$row = $profileresult->fetch_assoc();

// Set variables only if data is retrieved
$profilepic = $row['profile_pic'] ?? 'profile-placeholder.jpg';  // Default placeholder if null
$name = $row['name'] ?? '';
$field = $row['field'] ?? '';
$email = $row['email'] ?? '';
?>

<form method="POST" action="/controller/Dashboard/update_profile.php" enctype="multipart/form-data">
    <!-- Profile Image Section -->
    <div class="text-center">
        <img src="<?php echo htmlspecialchars($profilepic); ?>" 
             alt="Profile Image" 
             class="profile-image" 
             id="profileImage" 
             onclick="document.getElementById('fileInput').click()">
        <input type="file" name="profile_pic" id="fileInput" class="d-none" accept="image/*">
    </div>

    <!-- Name Section -->
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" >
    </div>

    <!-- Field Dropdown Section -->
    <div class="mb-3">
    <label for="field" class="form-label">Field</label>
    <select class="form-select" id="field" name="field" required>
        <option value="" disabled <?php if (empty($field)) echo 'selected'; ?>>Select Your Field</option>
        <option value="computer_science" <?php if ($field == "computer_science") echo 'selected'; ?>>Computer Science</option>
        <option value="information_technology" <?php if ($field == "information_technology") echo 'selected'; ?>>Information Technology</option>
        <option value="software_engineering" <?php if ($field == "software_engineering") echo 'selected'; ?>>Software Engineering</option>
        <option value="marketing" <?php if ($field == "marketing") echo 'selected'; ?>>Marketing</option>
        <option value="business_administration" <?php if ($field == "business_administration") echo 'selected'; ?>>Business Administration</option>
        <option value="medicine" <?php if ($field == "medicine") echo 'selected'; ?>>Medicine</option>
        <option value="nursing" <?php if ($field == "nursing") echo 'selected'; ?>>Nursing</option>
        <option value="literature" <?php if ($field == "literature") echo 'selected'; ?>>Literature</option>
        <option value="physics" <?php if ($field == "physics") echo 'selected'; ?>>Physics</option>
        <option value="other" <?php if ($field == "other") echo 'selected'; ?>>Other</option>
    </select>
</div>


    <!-- Email Section -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
    </div>

    <!-- Password Section -->
    <div class="mb-3">
        <label for="oldPassword" class="form-label">Old Password</label>
        <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Enter old password" autocomplete="off">
    </div>
    <div class="mb-3">
        <label for="newPassword" class="form-label">New Password</label>
        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password" autocomplete="new-password">
    </div>
    

    <!-- Update Button -->
    <button type="submit" class="update-btn">Update Profile</button>
</form>



<script>
    document.getElementById('fileInput').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
