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
            case 'Admin_dashboard':
                if (!isset($_SESSION["Email"])) {
                    session_destroy();
                  echo "<script>
                  window.location.href = '/view/?page=Home';
                </script>";
                    exit();
                } else {
                    require("Admin_Dashboard.php");
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
            case 'ViewTable':
                if (!isset($_SESSION["Email"])) {
                    session_destroy();
                  echo "<script>
                  window.location.href = '/view/?page=Home';
                </script>";
                    exit();
                } else {
                    require("ViewTable.php");
                }
                break;
            case 'ViewArticle':
                if (!isset($_SESSION["Email"])) {
                    session_destroy();
                  echo "<script>
                  window.location.href = '/view/?page=Home';
                </script>";
                    exit();
                } else {
                    require("View_Article.php");
                }
                break;
            case 'ViewCommentedArticle':
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
            case 'CommentedViewArticle':
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
            case 'ViewApprovedTable':
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
            case 'ApprovedViewArticle':
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

            case 'RejectedArticle':
                if (!isset($_SESSION["Email"])) {
              session_destroy();
            echo "<script>
                window.location.href = '/view/?page=Home';
              </script>";
                  exit();
              } else {
                require("Rejected_Article.php");
              }
                    break;
                


          case 'allcandidates':
              require("Show_users.php");
              break;
          default:
              require("Admin_Dashboard.php");
              break;
      }
        ?>
</main>
<!-- Footer -->
<?php require("Templete/Footer.php")?>

</body>
</html>
