<?php
include_once '../query/dbconfig.php';

if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    // Fetch user data
    $sql = "SELECT * FROM users WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user) {
            echo "User not found!";
            exit;
        }

        // Handle form submission for updating user
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $role = $_POST['role'];

            $updateSql = "UPDATE users SET name = ?, email = ?, role = ? WHERE id = ?";
            if ($updateStmt = $conn->prepare($updateSql)) {
                $updateStmt->bind_param("sssi", $name, $email, $role, $userId);
                if ($updateStmt->execute()) {
                    echo "User updated successfully!";
                } else {
                    echo "Error updating user: " . $updateStmt->error;
                }
                $updateStmt->close();
            } else {
                echo "Error preparing statement: " . $conn->error;
            }

            //$conn->close();
        }
    } else {
        echo "Error preparing query: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Overlay background */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 60%;
            max-width: 600px;
            position: relative;
            transition: transform 0.3s ease-in-out; /* Smooth modal transition */
        }

        .modal h2 {
            color: #2d3e50;
            font-size: 24px;
            margin-bottom: 15px;
            text-align: center;
        }

        .modal label {
            font-size: 16px;
            color: #555;
        }

        .modal input,
        .modal select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .modal button {
            padding: 12px 25px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .modal button:hover {
            background-color: #218838;
        }

        /* Close button for modal with Font Awesome */
        .close-btn {
            font-size: 30px;
            color: #ff0000;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 5px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            background-color: #ffdddd;
            color: #cc0000;
            transform: scale(1.2);
        }

        .close-btn:active {
            background-color: #ffaaaa;
            color: #990000;
            transform: scale(1);
        }

        /* Background content (user view page) behind the modal */
        .content {
            visibility: hidden; /* Hide content behind modal */
        }
    </style>
    <script>
        function closeModal() {
            window.history.back(); // Close or navigate back to the previous page
        }
    </script>
</head>
<body>
    <!-- Overlay Modal -->
    <div class="overlay">
        <div class="modal">
            <span class="close-btn" onclick="closeModal()">
                <i class="fas fa-times"></i> <!-- Font Awesome Close Icon -->
            </span>
            <h2>Edit User</h2>

            <form action="editUser.php?id=<?php echo $userId; ?>" method="POST">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>" required><br><br>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required><br><br>

                <label for="role">Role:</label>
                <select name="role" id="role" required>
                    <option value="Admin" <?php echo $user['role'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                    <option value="User" <?php echo $user['role'] == 'User' ? 'selected' : ''; ?>>User</option>
                </select><br><br>

                <button type="submit">Update User</button>
            </form>
        </div>
    </div>
</body>
</html>
