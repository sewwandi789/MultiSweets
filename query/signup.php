<?php
include_once 'dbconfig.php';

// Initialize variables for messages
$alertMessage = '';
$alertType = 'error';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate inputs
    $name = trim($_POST['name']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate inputs
    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        $alertMessage = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $alertMessage = "Please enter a valid email address.";
    } elseif ($password !== $confirmPassword) {
        $alertMessage = "Passwords do not match.";
    } else {
        // Check if the email already exists
        $checkEmailQuery = "SELECT id FROM users WHERE email = ?";
        $checkStmt = $conn->prepare($checkEmailQuery);
        
        if ($checkStmt) {
            $checkStmt->bind_param("s", $email);
            $checkStmt->execute();
            $checkStmt->store_result();

            if ($checkStmt->num_rows > 0) {
                $alertMessage = "Email is already registered. Please use a different email.";
            } else {
                // Proceed to insert the user
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $insertQuery = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
                $insertStmt = $conn->prepare($insertQuery);

                if ($insertStmt) {
                    $insertStmt->bind_param("sss", $name, $email, $hashedPassword);
                    if ($insertStmt->execute()) {
                        $alertMessage = "Signup successful!";
                        $alertType = 'success';

                        // Optionally, log the user in automatically after successful signup
                        session_start(); // Start session before setting session variables
                        $_SESSION['user_id'] = $conn->insert_id; // Store the user ID in session
                        $_SESSION['user_name'] = $name;

                        // Redirect to the login page or user dashboard
                        header("Location: ../LoginPage.php?signup_success=1");
                        exit();
                    } else {
                        $alertMessage = "Error: " . $conn->error;
                    }
                    $insertStmt->close();
                } else {
                    $alertMessage = "Error preparing the statement: " . $conn->error;
                }
            }
            $checkStmt->close();
        } else {
            $alertMessage = "Error preparing the check statement: " . $conn->error;
        }
    }
}

$conn->close();

// Display the alert message (this should be in the front-end for user feedback)
echo "<div class='alert alert-$alertType'>$alertMessage</div>";
?>
