<?php
include_once '../query/dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $role = $_POST['role'];

    // Basic validation
    if (empty($name) || empty($email) || empty($role)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address.";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (name, email, role) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $name, $email, $role);
            if ($stmt->execute()) {
                $success_message = "User added successfully!";
            } else {
                $error_message = "Error adding user: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error_message = "Error preparing statement: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: transparent;
            color: #5a3d2b;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #5a3d2b;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #a37449;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2em;
            cursor: pointer;
            transition: background 0.3s;
        }

        .close-btn:hover {
            background: #8a6241;
        }

        .close-btn:active {
            background: #6f4e33;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #d6b89c;
            border-radius: 5px;
            font-size: 1em;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #a37449;
            box-shadow: 0 0 5px rgba(163, 116, 73, 0.5);
        }

        button {
            background: #a37449;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #8a6241;
        }

        button:active {
            background: #6f4e33;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }

        .success-message {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <form action="addUser.php" method="POST">
        <button type="button" class="close-btn" onclick="closeForm()">&times;</button>
        <h1>Add New User</h1>

        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php elseif (!empty($success_message)): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="Admin">Admin</option>
                <option value="User">User</option>
            </select>
        </div>

        <button type="submit">Add User</button>
    </form>

    <script>
        function closeForm() {
            window.location.href = "userView.php"; // Redirect to the desired page
        }
    </script>
</body>
</html>
