<?php
// No output, whitespace, or HTML before this point
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IJLASS</title>
    <link rel="stylesheet" href="/css/Index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/css/Login.js"></script>
</head>
<body>
<!-- Header -->
<?php 
require("view/Header.php")
?>

<!-- Main Content -->
<main>
<?php
        $defaultPage = 'Home'; // Set default page here
        $page = isset($_GET['page']) ? $_GET['page'] : $defaultPage;

        switch ($page) {
            case 'login':
                if (!isset($_SESSION["Email"])) {
                    require("view/Login.php");
                } else {
                    session_destroy();
                    require("view/Home.php");
                }
                break;            
          case 'email_verification':
                require("view/Signup_Email_Verification.php");
                break; 
          case 'successful':
                require("view/popup/successfulpopup.php");
                break;
          case 'EnterEmail':
                require("view/forgotpassword/Enter_Email.php");
                break;
          case 'EnterCode':
                  require("view/forgotpassword/Enter_Code.php");
                  break;
          case 'EnterPassword':
                    require("view/forgotpassword/Enter_Password.php");
                    break;
          case 'Admin':
            if (!isset($_SESSION["Email"])) {
                require("view/Admin_Dashboard/Login.php");
            } else {
                session_destroy();
                require("view/Home.php");
            }
              break;
                    

           case 'about':
                require("view/Additional/AboutUs.php");
                break;
           case 'services':
               require("view/Additional/Services.php");
               break;
           case 'contact':
            require("view/Additional/Contactus.php");
            break;
           case 'privacy':
               require("view/Additional/Privacypolices.php");
               break;
           case 'Termofservices':
            require("view/Additional/Termofservicess.php");
            break;
           case 'Developer':
               require("view/Additional/Developer.php");
               break;
    

          default:
              require("view/Home.php");
              break;
      }
        ?>
</main>

<!-- Footer -->
<?php require("view/Footer.php")?>

</body>
</html>
