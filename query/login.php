<?php

include_once '../index/dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim($_POST['email'])); // Sanitize and normalize the email
    $password = trim($_POST['password']);

    // Fetch user details from the database
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    if (!$stmt) {
        die("SQL error: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['name'];

           // Redirect first, no output before this
            header("Location: ../src/dashboard.php?login_success=1");
            exit; // Ensure no further code is executed

            // Display message (this won't run because of the exit)
            echo "Login successful! Welcome, " . htmlspecialchars($user['name']) . ".";

        } else {
            echo "Invalid email or password.";
             // Redirect to login page with error message
            header("Location: ../LoginPage?error=invalid_password");
            exit;
        }
    } else {
          // Redirect to signup page with error message
          header("Location: ../LoginPage?error=email_not_found");
          exit;
        echo "User not found. Please <a href='signup.php'>register</a> first.";
    }

    $stmt->close();
    $conn->close();
}
?>
