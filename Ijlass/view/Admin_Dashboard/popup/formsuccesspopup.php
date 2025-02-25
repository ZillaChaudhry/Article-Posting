<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Success</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        
        main {
            min-height: calc(70vh - 70px); /* Adjust this based on header/footer height */
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .popup {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            background: #f8f8f8;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            padding: 20px;
        }
        .popup i {
            font-size: 50px;
            color: #4caf50;
        }
        .popup h2 {
            font-size: 24px;
            margin: 15px 0 10px;
        }
        .popup p {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
        <div class="popup" id="successPopup">
            <i class="fas fa-check-circle"></i>
            <h2>Registration Successful!</h2>
            <p>You will be redirected shortly...</p>
        </div>
    <script>
        document.getElementById("successPopup").style.display = "block";
        setTimeout(function() {
            window.location.href = "/Article/view/Dashboard/?page=Form";
        }, 2000);
    </script>
</body>
</html>
