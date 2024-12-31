<?php
include_once '../index/dbconfig.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    
    // Delete user
    $sql = "DELETE FROM users WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId);
        if ($stmt->execute()) {
            echo "User deleted successfully!";
            header("Location: viewUsers.php"); // Redirect after deletion
            exit;
        } else {
            echo "Error deleting user: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "User ID is required!";
}
?>