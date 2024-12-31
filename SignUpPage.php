<?php
// Include the database configuration file
include_once '../index/dbconfig.php';

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
                        header("Location: ../loginandsignup.php?signup_success=1");
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap" rel="stylesheet">
    <!-- Icon Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/owl.carousel.min.css" rel="stylesheet">
    <!-- Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .cont {
            width: 900px;
            height: 550px;
            background: #ffffff;
            border-radius: 15px;
            display: flex;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .form {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form label {
            margin-bottom: 15px;
            display: block;
        }

        .form label span {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }

        .form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .form input:focus {
            border-color: #d4af7a;
            outline: none;
            box-shadow: 0 0 5px rgba(212, 175, 122, 0.5);
        }

        .form .forgot-pass {
            font-size: 12px;
            color: #888;
            text-align: right;
            margin-top: -10px;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .form button {
            background: #d4af7a;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        .form button:hover {
            background: #c4956d;
        }

        .sub-cont {
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: #d4af7a;
            color: #fff;
        }

        .sub-cont h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .img__btn {
            background: #fff;
            color: #d4af7a;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 14px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.3s;
        }

        .img__btn:hover {
            background: #c4956d;
            color: #fff;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="cont">
        <!-- Sign-Up Form -->
        <div class="form sign-up">
            <h2>Create Account</h2>
            
            <?php if ($alertMessage): ?>
                <p class="<?= $alertType ?>-message"><?= htmlspecialchars($alertMessage) ?></p>
            <?php endif; ?>
            
            <form action="" method="POST" onsubmit="return validateForm()">
                <label>
                    <span>Name</span>
                    <input type="text" name="name" required>
                </label>
                <label>
                    <span>Email</span>
                    <input type="email" name="email" required>
                </label>
                <label>
                    <span>Password</span>
                    <input type="password" name="password" required>
                </label>
                <label>
                    <span>Confirm Password</span>
                    <input type="password" name="confirm_password" required>
                </label>
                <button type="Submit">Sign Up</button>
            </form>
        </div>

        <!-- Right-Side Image/Text -->
        <div class="sub-cont">
            <h3>Already have an account?</h3>
            <p>Sign in to continue your journey with us!</p>
            <a href="signin.php" class="img__btn">Sign In</a>
        </div>
    </div>
</body>
</html>
