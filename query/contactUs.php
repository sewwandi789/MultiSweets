<?php
// Include your database connection file
include_once 'dbconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['emailbody']);

    // Validate form data
    if (empty($name) || empty($email) || empty($message)) {
        echo "All fields are required.";
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Insert data into the database
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        echo "Failed to prepare statement: " . $conn->error;
        exit;
    }

    // Bind the parameters and execute the query
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "Thank you for your message. We will get back to you soon.";
        header("Location: ../contact.php?signup_success=1");
    } else {
        echo "Error saving your message: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
