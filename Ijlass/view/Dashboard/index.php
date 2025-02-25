<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IJLASS</title>
    <link rel="stylesheet" href="/css/Indexs.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/css/Login.js"></script>
</head>
<body>
<!-- Header -->
<?php require("Templete/Header.php")?>

<main>
<?php
        $defaultPage = 'Home'; // Set default page here
        $page = isset($_GET['page']) ? $_GET['page'] : $defaultPage;

        switch ($page) {
          case 'dashboard':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("Dashboard.php");
          }
            break;

          case 'Form':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("Submit_Form.php");
          }
            break;
          case 'Profile':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("Profile.php");
          }
            break;
          case 'profilesuccess':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("popup/profilesuccesspopup.php");
          }
            break;
          case 'formsuccess':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("popup/formsuccesspopup.php");
          }
            break;
          case 'Commented':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("CommentedViewTable.php");
          }
            break;
          case 'CommentedArticleView':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("Commented_View_Article.php");
          }
            break;
          case 'UpdateForm':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("Update_Form.php");
          }
            break;
          case 'Search':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("Search.php");
          }
            break;
          case 'SearchView':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("Search_View.php");
          }
              break;
          case 'ApprovedTable':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("ApprovedViewTable.php");
          }
            break;
          case 'Approvedarticle':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("Approved_View_Article.php");
          }
            break;
          case 'PendingTable':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("PendingViewTable.php");
          }
            break;
          case 'PendingArticle':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("Pending_View_Article.php");
          }
            break;
          case 'Additional':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("Additionals.php");
          }
            break;
          case 'TitleClick':
            if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
            window.location.href = '/view/?page=Home';
          </script>";
              exit();
          } else {
            require("TopTitleClick.php");
          }
            break;

            case 'Rejected':
              if (!isset($_SESSION["Email"])) {
                session_destroy();
              echo "<script>
              window.location.href = '/view/?page=Home';
            </script>";
                exit();
            } else {
              require("RejectedViewTable.php");
            }
              break;
              case 'RejectedArticks':
                if (!isset($_SESSION["Email"])) {
                  session_destroy();
                echo "<script>
                window.location.href = '/view/?page=Home';
              </script>";
                  exit();
              } else {
                require("RejectedViewTable.php");
              }
                break;




          default:
              require("Home.php");
              break;
      }
        ?>
</main>
<!-- Footer -->
<?php require("Templete/Footer.php")?>

</body>
</html>
