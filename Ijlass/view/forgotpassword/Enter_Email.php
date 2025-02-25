<link href="/css/Loginzzz.css" rel="stylesheet" />
<link href="/css/verifey.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

<div class="card-container">
    <div class="card">
        <div class="title-text">
            <div class="title verification">
                Verification Page
            </div>
        </div>
        <div class="form-container">
            <div class="form-inner">
                <form action="/controller/forgotpassword/Enter_Email.php" method="post">
                    <div class="field">
                        <input type="text" name="email" id="Email" placeholder="Enter Your Account Email" required>
                    </div>
                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Send">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
