
<link href="/css/Loginzzz.css" rel="stylesheet" />
<link href="/css/Verife.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

<div class="card-container" style="height: 85vh;">
    <div class="card">
        <div class="title-text">
            <div class="title verification">
                Verification Page
            </div>
        </div>
        <div class="form-container">
            <div class="form-inner">
                <form action="/controller/Code_Matching.php" method="post">
                    <div class="alert alert-info d-flex align-items-center mt-3" style="font-size: 14px; border-radius: 8px;">
                        <i class="bi bi-envelope-fill me-2" style="color: #007bff; font-size: 18px;"></i>
                        <span>
                            A verification code has been sent to <strong><?php echo htmlspecialchars($_SESSION["email"], ENT_QUOTES, 'UTF-8'); ?></strong>.
                        </span>
                    </div>

                    <div class="field">
                        <input type="text" name="verificationCode" id="verificationCode" placeholder="Enter Verification Code" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Verify">
                    </div>
                    <input type="hidden" id="hiddenuserEmail" value="" />
<!--<div class="verification-link" style="margin-top:10px;">Didn't receive the code? <a href="#" onclick="ResendCode(event)">Resend Code</a></div>-->
                </form>
            </div>
        </div>
    </div>
</div>
