<?php 
session_start();
?>
<link href="/css/Loginzzz.css" rel="stylesheet" />
<link href="/css/verifey.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

<div class="card-container" style="height: 85vh;">
    <div class="card">
        <div class="title-text">
            <h2 class="title verification">Verification Page</h2>
        </div>
        <div class="form-container">
            <div class="form-inner">
                <form action="/controller/forgotpassword/Enter_Password.php" method="post">
                    
                    <div class="field">
                        <label for="password" class="form-label visually-hidden">password</label>
                        <input type="password" name="password" id="password" placeholder="Enter New Password" required>
                    </div>
                    <div class="field">
                        <label for="confirmpassword" class="form-label visually-hidden">confirmpassword</label>
                        <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Enter Confirm Password" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Change" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
