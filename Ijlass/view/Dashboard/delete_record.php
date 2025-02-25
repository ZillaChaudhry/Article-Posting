<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']); // Ensure valid integer

    $deletequery = "DELETE FROM tbl_form WHERE id = ?";
    $stmt = $con->prepare($deletequery);

    if ($stmt) {
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            echo "success"; // Simple success response
        } else {
            echo "error"; // Simple error response
        }
        $stmt->close();
    } else {
        echo "error"; // Statement preparation error
    }

    $con->close();
} else {
    echo "invalid"; // Invalid request
}
?>
<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']); // Ensure valid integer

    $deletequery = "DELETE FROM tbl_form WHERE id = ?";
    $stmt = $con->prepare($deletequery);

    if ($stmt) {
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            echo "success"; // Simple success response
        } else {
            echo "error"; // Simple error response
        }
        $stmt->close();
    } else {
        echo "error"; // Statement preparation error
    }

    $con->close();
} else {
    echo "invalid"; // Invalid request
}
?>
<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']); // Ensure valid integer

    $deletequery = "DELETE FROM tbl_form WHERE id = ?";
    $stmt = $con->prepare($deletequery);

    if ($stmt) {
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            echo "success"; // Simple success response
        } else {
            echo "error"; // Simple error response
        }
        $stmt->close();
    } else {
        echo "error"; // Statement preparation error
    }

    $con->close();
} else {
    echo "invalid"; // Invalid request
}
?>
<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']); // Ensure valid integer

    $deletequery = "DELETE FROM tbl_form WHERE id = ?";
    $stmt = $con->prepare($deletequery);

    if ($stmt) {
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            echo "success"; // Simple success response
        } else {
            echo "error"; // Simple error response
        }
        $stmt->close();
    } else {
        echo "error"; // Statement preparation error
    }

    $con->close();
} else {
    echo "invalid"; // Invalid request
}
?>
<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']); // Ensure valid integer

    $deletequery = "DELETE FROM tbl_form WHERE id = ?";
    $stmt = $con->prepare($deletequery);

    if ($stmt) {
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            echo "success"; // Simple success response
        } else {
            echo "error"; // Simple error response
        }
        $stmt->close();
    } else {
        echo "error"; // Statement preparation error
    }

    $con->close();
} else {
    echo "invalid"; // Invalid request
}
?>
<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']); // Ensure valid integer

    $deletequery = "DELETE FROM tbl_form WHERE id = ?";
    $stmt = $con->prepare($deletequery);

    if ($stmt) {
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            echo "success"; // Simple success response
        } else {
            echo "error"; // Simple error response
        }
        $stmt->close();
    } else {
        echo "error"; // Statement preparation error
    }

    $con->close();
} else {
    echo "invalid"; // Invalid request
}
?>
<?php
require_once(__DIR__ . "/../../DBConnection/connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']); // Ensure valid integer

    $deletequery = "DELETE FROM tbl_form WHERE id = ?";
    $stmt = $con->prepare($deletequery);

    if ($stmt) {
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            echo "success"; // Simple success response
        } else {
            echo "error"; // Simple error response
        }
        $stmt->close();
    } else {
        echo "error"; // Statement preparation error
    }

    $con->close();
} else {
    echo "invalid"; // Invalid request
}
?>
